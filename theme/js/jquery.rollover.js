/**
 * jQuery.rollover
 *
 * @version    1.0.4
 * @author     Hiroshi Hoaki <info@rewish.jp>
 * @copyright  2010-2013 Hiroshi Hoaki
 * @license    The MIT License
 * @link       http://rewish.jp/blog/releases/jquery_rollover
 *
 * Usage:
 * jQuery(document).ready(function($) {
 *   // <img>
 *   $('#nav a img').rollover();
 *
 *   // <input type="img">
 *   $('form input:img').rollover();
 *
 *   // set suffix
 *   $('#nav a img').rollover('_over');
 * });
 */
jQuery.fn.rollover = function(suffix) {
	suffix = suffix || '_ro';
	var check = new RegExp(suffix + '\\.\\w+$');
	return this.each(function() {
		var img = jQuery(this);
		var src = img.attr('src');
		if (check.test(src)) return;
		var _ro = src.replace(/\.\w+$/, suffix + '$&');
		jQuery('<img>').attr('src', _ro);
		img.hover(
			function() { img.attr('src', _ro); },
			function() { img.attr('src', src); }
		);
	});
};
