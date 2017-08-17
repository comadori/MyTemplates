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

<?php if(isset($error)): ?>
<div class="errorMsg">
<p>入力エラーがあります。下記の項目を確認して下さい。</p>
<?php foreach($error as $val): ?>
<p><?php echo $val; ?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>

<form method="post" action="contact2.php">

<dl class="<?php echo $errorClass['company']; ?>">
<dt>会社名<span class="required">（※）</span></dt>
<dd><input type="text" name="company" value="<?php echo $company; ?>"></dd>
</dl>

<dl class="<?php echo $errorClass['section']; ?>">
<dt>部署名</dt>
<dd><input type="text" name="section" value="<?php echo $section; ?>"></dd>
</dl>

<dl class="<?php echo $errorClass['yourname']; ?>">
<dt>お名前<span class="required">（※）</span></dt>
<dd><input type="text" name="yourname" value="<?php echo $yourname; ?>"></dd>
</dl>

<dl class="<?php echo $errorClass['kana']; ?>">
<dt>ふりがな<span class="required">（※）</span></dt>
<dd><input type="text" name="kana" value="<?php echo $kana; ?>"></dd>
</dl>

<dl class="<?php echo $errorClass['mail1']; ?>">
<dt>メールアドレス<span class="required">（※）</span></dt>
<dd><input type="text" name="mail1" value="<?php echo $mail1; ?>">
<p class="caption">半角英数で入力してください。例）aaa@example.com</p>
</dd>
</dl>

<dl class="<?php echo $errorClass['mail2']; ?>">
<dt>メールアドレス (確認)<span class="required">（※）</span></dt>
<dd><input type="email" name="mail2" value="<?php echo $mail2; ?>">
<p class="caption">確認のため再度ご入力ください。</p>
</dd>
</dl>

<dl class="<?php echo $errorClass['tel']; ?>">
<dt>電話番号</dt>
<dd><input type="tel" name="tel" value="<?php echo $tel; ?>">
<p class="caption">ハイフン区切りで、半角英数で入力してください。例）045-6284-772</p>
</dd>
</dl>

<dl class="<?php echo $errorClass['address']; ?>">
<dt>ご住所</dt>
<dd><input type="text" name="address" value="<?php echo $address; ?>">
<p class="caption">例）神奈川県横浜市中区本牧町1-281</p>
</dd>
</dl>

<dl class="<?php echo $errorClass['message']; ?>">
<dt>お問い合わせ</dt>
<dd><textarea name="message"><?php echo $message; ?></textarea></dd>
</dl>

<div class="privacy">
<p>お客様よりお寄せ頂く個人情報は、お問い合わせ・ご要望へのご回答、情報提供に限り使用させていただきます。当社の「<a href="javascript:openWin('http://comadori.com/privacy/index.html','','width=750,height=600,scrollbars=yes');">個人情報取扱について</a>」をお読みのうえ、下記の「同意する」にチェックをつけたうえでご利用ください。</p>
<p class="input error"><input name="privacy" type="checkbox" id="privacy" value="privacy"><label for="privacy">同意する</label></p>
<script>
$('input#privacy').on('change',function(){
  var btn = $('form input.submit');
  var enable  = 'btn-confirm.png';
  var disable = 'btn-confirm-disable.png';
  if( $(this).prop('checked') ){
    btn.attr('src', btn.attr('src').replace(disable,enable));
    btn.removeClass('disable').removeAttr('disabled');
  }
  else{
    btn.attr('src', btn.attr('src').replace(enable,disable));
    btn.addClass('disable').attr('disabled','disabled');
  }
});
</script>
</div>

<p style="margin-top:3em;text-align:center;"><input type="image" src="images/btn-confirm-disable.png" class="submit disable" disabled="disabled"/></p>

<input type="hidden" name="ticket" value="<?php echo $ticket; ?>" />
</form>
</section>
</body>
</html>
