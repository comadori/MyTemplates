<?php
  session_start();    //セッションを開始

  require dirname(__FILE__).'/libs/functions.php';   //テンプレートエンジンの読み込み

  //画像認証ライブラリの読み込み(securimage)
//  include_once '../securimage/securimage.php';
//  $securimage = new Securimage();

  //POSTされたデータをチェック
  $_POST = checkInput($_POST);

  //固定トークンを確認（CSRF対策）
  if(isset($_POST['ticket'], $_SESSION['ticket'])){
    $ticket = $_POST['ticket'];
    if($ticket !== $_SESSION['ticket']){
      die('不正アクセスの疑いがあります。');
    }
  }else{
    die('不正アクセスの疑いがあります。');
  }

  //POSTされたデータを変数に格納
  $company = isset($_POST['company']) ? $_POST['company'] : NULL;
  $section = isset($_POST['section']) ? $_POST['section'] : NULL;
  $yourname = isset($_POST['yourname']) ? $_POST['yourname'] : NULL;
  $kana = isset($_POST['kana']) ? $_POST['kana'] : NULL;
  $mail1 = isset($_POST['mail1']) ? $_POST['mail1'] : NULL;
  $mail2 = isset($_POST['mail2']) ? $_POST['mail2'] : NULL;
  $tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
  $address = isset($_POST['address']) ? $_POST['address'] : NULL;
  $message = isset($_POST['message']) ? $_POST['message'] : NULL;
//  $captcha_code = isset($_POST['captcha_code']) ? $_POST['captcha_code'] : NULL;  //画像認証用データ


  //POSTされたデータを整形（前後にあるホワイトスペースを削除）
  $company = trim($company);
  $section = trim($section);
  $yourname = trim($yourname);
  $kana = trim($kana);
  $mail1 = trim($mail1);
  $mail2 = trim($mail2);
  $tel = trim($tel);
  $address = trim($address);
  $message = trim($message);

  //エラーメッセージを保存する配列の初期化
  $error = array();
  $errorClass = array();

  if($company == '') {
    $error[] = '会社名は必須項目です。';
    $errorClass['company'] = 'error';
  }else if(preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $company) == 0) {   //制御文字でないことと文字数をチェック
    $error[] = '会社名は50文字以内でお願いします。';
    $errorClass['company'] = 'error';
  }

  if(preg_match('/\A[[:^cntrl:]]{0,50}\z/u', $section) == 0) {   //制御文字でないことと文字数をチェック
    $error[] = '部署名は50文字以内でお願いします。';
    $errorClass['section'] = 'error';
  }

  if($yourname == '') {
    $error[] = 'お名前は必須項目です。';
    $errorClass['yourname'] = 'error';
  }else if(preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $yourname) == 0) {   //制御文字でないことと文字数をチェック
    $error[] = 'お名前は30文字以内でお願いします。';
    $errorClass['yourname'] = 'error';
  }

  if($kana == '') {
    $error[] = 'ふりがなは必須項目です。';
    $errorClass['kana'] = 'error';
  }else if(preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $kana) == 0) {   //制御文字でないことと文字数をチェック
    $error[] = 'ふりがなは50文字以内でお願いします。';
    $errorClass['kana'] = 'error';
  }

  //メールアドレスをチェック
  if($mail1 == ''){
    $error[] = 'メールアドレスは必須です。';
    $errorClass['mail1'] = 'error';
  }else{
    $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
    if(!preg_match($pattern, $mail1)){
      $error[] = 'メールアドレスの形式が正しくありません。';
      $errorClass['mail1'] = 'error';
    }
  }

  if($mail1 != $mail2){
    $error[] = 'メールアドレス (確認)が一致していません。';
  }

  //電話番号をチェック
  if($tel != ''){
    $pattern = '/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/';
    if(!preg_match($pattern, $tel)){
      $error[] = '電話番号は市外局番からハイフン有りの半角数字で御願いいたします。';
      $errorClass['tel'] = 'error';
    }
  }

  if(preg_match('/\A[[:^cntrl:]]{0,50}\z/u', $address) == 0) {   //制御文字でないことと文字数をチェック
    $error[] = 'ご住所は50文字以内でお願いします。';
    $errorClass['address'] = 'error';
  }

  // お問い合わせは任意項目なのでチェック無し

  // お問い合わせをチェック
  if( preg_match('/\A[\r\n\t[:^cntrl:]]{0,500}\z/u', $message) == 0 ) {
    $error[] = 'お問い合わせは500文字以内で御願いします。';
    $errorClass['message'] = 'error';
  }

  //画像認証のチェック
//  if(mb_strlen($captcha_code) <> 6){
//    $error[] = '*画像認証の確認キーワードは6文字で入力してください。';
//  }else if ($securimage->check($captcha_code) == false) {
//    $error[] = '*画像認証の確認キーワードが誤っています。';
//  }

  //チェックの結果にエラーがあった場合は、テンプレートの表示に必要な入力されたデータとエラーメッセージを配列「$data」に代入し、display()関数でform1_view.phpを表示
  if(count($error) >0){    //エラーがあった場合
    $data = array();
    $data['error'] = $error;
    $data['errorClass'] = $errorClass;
    $data['company'] = $company;
    $data['section'] = $section;
    $data['yourname'] = $yourname;
    $data['kana'] = $kana;
    $data['mail1'] = $mail1;
    $data['mail2'] = $mail2;
    $data['tel'] = $tel;
    $data['address'] = $address;
    $data['message'] = $message;
    $data['ticket'] = $ticket;
    display('contact1_view.php', $data);
  }else{    //エラーがなかった場合
    //POSTされたデータをセッション変数に保存
    $_SESSION['company'] = $company;
    $_SESSION['section'] = $section;
    $_SESSION['yourname'] = $yourname;
    $_SESSION['kana'] = $kana;
    $_SESSION['mail1'] = $mail1;
    $_SESSION['mail2'] = $mail2;
    $_SESSION['tel'] = $tel;
    $_SESSION['address'] = $address;
    $_SESSION['message'] = $message;

    //確認画面を表示
    $data = array();
    $data['company'] = $company;
    $data['section'] = $section;
    $data['yourname'] = $yourname;
    $data['kana'] = $kana;
    $data['mail1'] = $mail1;
    $data['mail2'] = $mail2;
    $data['tel'] = $tel;
    $data['address'] = $address;
    $data['message'] = $message;
    $data['ticket'] = $ticket;
    display('contact2_view.php', $data);
  }
