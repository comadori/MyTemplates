<!DOCTYPE html>
<html lang="ja">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="" />
<meta name="keywords" content="" />

<meta property="fb:app_id" content="000000000000000" />
<meta property="og:title" content="SITENAME" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://THEMEPATH/img/snsThumbnail.png" />
<meta property="og:url" content="http://URL/" />
<meta property="og:site_name" content="SITENAME" />
<meta property="og:description" content="" />

<title>CONTACT FORM</title>

<link rel="stylesheet" href="../common/css/normalize.css" />
<link rel="stylesheet" href="../common/css/font-awesome.min.css"><!-- http://fontawesome.io/examples/ -->
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" type="text/css" href="../common/css/print.css" media="print" />
<link rel="shortcut icon" href="http://URL/favicon.ico" />
<link rel="apple-touch-icon" href="http://URL/webclip.png">

<script src="../common/js/jquery.min.js"></script>
<script src="../common/js/shared.js" rel="sharedjs"></script>
<!--[if lt IE 9]>
<script src="/common/js/html5shiv-printshiv.js"></script>
<script src="/common/js/css3-mediaqueries.js"></script> 
<![endif]-->

</head>

<body id="body" class="toppage">
<section>

<div class="lead">
<p>下記の内容でお間違いがないかご確認のうえ、送信ボタンを押してください。<br>
</p>
</div>

<dl>
<dt>会社名</dt>
<dd><?php echo $company; ?></dd>
</dl>

<dl>
<dt>部署名</dt>
<dd><?php echo $section; ?></dd>
</dl>

<dl>
<dt>お名前</dt>
<dd><?php echo $yourname; ?></dd>
</dl>

<dl>
<dt>ふりがな</dt>
<dd><?php echo $kana; ?></dd>
</dl>

<dl>
<dt>メールアドレス</dt>
<dd><?php echo $mail1; ?></dd>
</dd>
</dl>

<dl>
<dt>電話番号</dt>
<dd><?php echo $tel; ?></dd>
</dd>
</dl>

<dl>
<dt>ご住所</dt>
<dd><?php echo $address; ?></dd>
</dd>
</dl>

<dl>
<dt>お問い合わせ</dt>
<dd><?php echo $message; ?></dd>
</dl>

<div class="button-container">
<form action="index.php" method="post">
  <input type="image" src="images/btn-back.png" value="入力画面へ戻る" class="back" />
</form>
<form action="contact3.php" method="post">
  <!--完了ページへトークンをPOSTする、隠しフィールド「ticket」-->
  <input type="hidden" name="ticket" value="<?php echo $ticket; ?>" />
  <input type="image" src="images/btn-submit.png" value="送信" class="submit-confirmed" />
</form>
</div>

</section>
</body>
</html>