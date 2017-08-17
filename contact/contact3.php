<?php
  session_start();    //セッションを開始
  
  require dirname(__FILE__).'/libs/functions.php';   //テンプレートエンジンの読み込み
  
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
  

  // 事務局のメールアドレス
  $corp_mail = 'nozomi@comadori.com';

  //変数にセッション変数を代入
  $company = $_SESSION['company'];
  $section = $_SESSION['section'];
  $yourname = $_SESSION['yourname'];
  $kana = $_SESSION['kana'];
  $mail1 = $_SESSION['mail1'];
  $mail2 = $_SESSION['mail2'];
  $tel = $_SESSION['tel'];
  $address = $_SESSION['address'];
  $message = $_SESSION['message'];

  $company_str = $company;
  $section_str = $section;
  $yourname_str = $yourname;
  $kana_str = $kana;
  $mail1_str = $mail1;
  $mail2_str = $mail2;
  $tel_str = $tel;
  $address_str = $address;
  $message_str = $message;

  // 事務局宛のメッセージ
  $subject = 'お問い合わせが届きました';
  $body = <<<EOF
ご担当者様：

$company_str
$yourname_str 様からお問い合わせを頂きました。

受付内容

会社名　：$company_str
部署名　：$section_str
お名前　：$yourname_str
ふりがな：$kana_str
メールアドレス：$mail1_str
電話番号：$tel_str
ご住所　：$address_str
お問い合わせ
----------------------------------------
$message_str
----------------------------------------

EOF;
  
  //メールの宛先
    $mailTo = $corp_mail;
    //Return-Pathに指定するメールアドレス
    $returnMail = $corp_mail;
  
    //mbstringの日本語設定
    mb_language('ja');
    mb_internal_encoding('UTF-8');
  
    //From ヘッダーを作成
    $header = 'From: ' . mb_encode_mimeheader($yourname). ' <' . $mail1. '>';
  
    //メールの送信、セーフモードがOnの場合は第5引数が使えない
    if(ini_get('safe_mode')){
        $result1 = mb_send_mail($mailTo, $subject, $body, $header);
    }else{
        $result1 = mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail);
  }
  



  // お客様宛のメッセージ
  $subject = 'お問い合わせありがとうございます';
  $body = <<<EOF
$company_str
$yourname_str 様

お問い合わせありがとうございます。

送信内容（控え）

会社名　：$company_str
部署名　：$section_str
お名前　：$yourname_str
ふりがな：$kana_str
メールアドレス：$mail1_str
電話番号：$tel_str
ご住所　：$address_str
お問い合わせ
----------------------------------------
$message_str
----------------------------------------

EOF;
  
  //メールの宛先
  $mailTo = $mail1;
  //Return-Pathに指定するメールアドレス
  $returnMail = $corp_mail;
  
  //mbstringの日本語設定
  mb_language('ja');
  mb_internal_encoding('UTF-8');
  
  //From ヘッダーを作成
  $header = 'From: ' . mb_encode_mimeheader('事務局'). ' <' . $corp_mail. '>';
  
  //メールの送信、セーフモードがOnの場合は第5引数が使えない
  if(ini_get('safe_mode')){
    $result2 = mb_send_mail($mailTo, $subject, $body, $header);
  }else{
    $result2 = mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail);
  }
  
  //送信結果を知らせる変数を初期化
   $message = '';
  
  //メール送信の結果判定
  if($result1 && $result2) {
    //冒頭の「1」は成功したかを判定するために使用（contact3_view.php で処理）
    $message = 'ありがとうございます。送信完了いたしました。';
    //成功した場合はセッションを破棄
    $_SESSION = array();   //空の配列を代入し、すべてのセッション変数を消去 
    session_destroy();   //セッションを破棄
  }else{
    $message = '申し訳ございませんが、送信に失敗しました。';
  }
    
  $data = array();
  $data['message'] = $message;
  display('contact3_view.php', $data);

