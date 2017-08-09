<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!-- opengraph -->
<meta property="og:title" content="<?php bloginfo('name'); ?>">
<meta property="og:type" content="website">
<meta property="og:description" content="PAGE DESCRIPTION">
<meta property="og:url" content="http://websiteURL.com/">
<meta property="og:image" content="http://websiteURL.com/THUMBNAIL/image-300×200.png">
<meta property="og:site_name" content="PAGETITLE">

<?php
    wp_enqueue_script('jQuery', get_bloginfo('template_url') . '/scripts/jquery-1.11.1.min.js', array(), '1.0');
    wp_enqueue_script('rollover', get_bloginfo('template_url') . '/scripts/jquery.rollover.js', array(), '1.0');
?>
<?php wp_head(); ?>

<script type="text/javascript">
(function($) { $(function() {
  $('nav.global a img').rollover();
}); })(jQuery);
</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">
<header class="global">HEADER</header>