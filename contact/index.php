<?php
  session_start();   //セッションを開始
  //session_start()関数は、必ず、Webブラウザへの出力が行われる前に、呼び出す必要がある

  session_regenerate_id(TRUE);    //セッションIDを変更（セッションハイジャック対策）

  require dirname(__FILE__).'/libs/functions.php';   //テンプレートエンジンの読み込み

  //テンプレートに渡す変数の初期化
  $data = array(); //配列を初期化
  //初回以外ですでにセッション変数に値が代入されていれば、その値を。そうでなければNULLで初期化
  //（contact1_view.phpを表示する際、最初は入力データがないのでこの初期化をしないとエラーとなる）
  $data['company'] = isset($_SESSION['company']) ? $_SESSION['company'] : NULL; 
  $data['section'] = isset($_SESSION['section']) ? $_SESSION['section'] : NULL; 
  $data['yourname'] = isset($_SESSION['yourname']) ? $_SESSION['yourname'] : NULL; 
  $data['kana'] = isset($_SESSION['kana']) ? $_SESSION['kana'] : NULL; 
  $data['mail1'] = isset($_SESSION['mail1']) ? $_SESSION['mail1'] : NULL; 
  $data['mail2'] = isset($_SESSION['mail2']) ? $_SESSION['mail2'] : NULL; 
  $data['tel'] = isset($_SESSION['tel']) ? $_SESSION['tel'] : NULL; 
  $data['address'] = isset($_SESSION['address']) ? $_SESSION['address'] : NULL; 
  $data['message'] = isset($_SESSION['message']) ? $_SESSION['message'] : NULL; 

  //CSRF対策の固定トークンを生成
  if(!isset($_SESSION['ticket'])){
    //セッション変数にトークンを代入
    $_SESSION['ticket'] = sha1(uniqid(mt_rand(), TRUE));
  }
  
  //トークンをテンプレートに渡す
  $data['ticket'] = $_SESSION['ticket'];
  
  display('contact1_view.php', $data);  //テンプレートの表示
  //functions.php の display() を呼び出すと $data はエスケープ処理され、include によりテンプレートが読み込まれ表示される

