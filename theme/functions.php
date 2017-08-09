<?php // THEME SUPPORTS
//add_theme_support('post-thumbnails');
add_theme_support('editor-style');
?>
<?php
//header部の無駄なものを削除
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra',3,0);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'rel_canonical');
?>
<?php
//管理画面のメニュー・余分なものを削除する
function remove_menus() {
//remove_menu_page('index.php'); // ダッシュボード
//remove_menu_page('separator1'); // セパレータ1
//remove_menu_page('edit.php'); // 投稿
//remove_menu_page('upload.php'); // メディア
//remove_menu_page('link-manager.php'); // リンク
//remove_menu_page('edit.php?post_type=page'); // 固定ページ
//remove_menu_page('edit-comments.php'); // コメント
//remove_menu_page('separator2'); // セパレータ1
//remove_menu_page('themes.php'); // 外観
//remove_menu_page('plugins.php'); // プラグイン
//remove_menu_page('users.php'); // ユーザー
//remove_menu_page('tools.php'); // ツール
//remove_menu_page('options-general.php'); // 設定
//remove_menu_page('profile.php'); // プロフィール(管理者以外のユーザー用)
//remove_menu_page('profile.php'); // プロフィール(管理者以外のユーザー用)
}
add_action('admin_menu', 'remove_menus'); ?>
<?php //投稿の画面からいらない入力欄を消す
function remove_default_post_screen_metaboxes() {
remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
remove_meta_box( 'commentsdiv','post','normal' ); // コメント
remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
remove_meta_box( 'authordiv','post','normal' ); // 作成者
remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
//remove_meta_box( 'revisionsdiv','post','normal' ); // リビジョン
}
add_action('admin_menu','remove_default_post_screen_metaboxes');

// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
global $wp_meta_boxes;
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

?>
<?php
//////////ダッシュボードウィジェットを追加//////////
add_action('wp_dashboard_setup', 'my_dashboard_widgets');
function my_dashboard_widgets() {
	wp_add_dashboard_widget('serverinfo_widget', 'サーバー情報', 'my_dashboard_widget_serverinfo');
}
function my_dashboard_widget_serverinfo() {
	$a = array(
		'php' => phpversion(),
		'MySQL' => mysql_get_server_info(),
		'IP' => $_SERVER['REMOTE_ADDR'],
		'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'],
		'WordPress' => get_bloginfo('version'),
	);
	foreach ($a as $k => $v) {
		$a[$k] = '<li><strong>' . $k . ':</strong> ' . $v . '</li>';
	}
	echo '<ul>' . implode('', $a) . '</ul>';
}
?>
<?php
function edit_admin_menus() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'REPLACENAME'; // [投稿]を[REPLACENAME]に変更
    $submenu['edit.php'][5][0] = 'REPLACENAME一覧'; // [投稿一覧]を[REPLACENAME一覧]に変更
    $menu[60][0] = 'デザイン管理'; //
}
add_action( 'admin_menu', 'edit_admin_menus' );
?>
<?php // REMOVE WIDGET ITEMS
function remove_widget() {
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('meteorslides_widget');
}
add_action('widgets_init', 'remove_widget'); ?>
<?php if ( function_exists('register_sidebar') )
	register_sidebar(array(
	// トップページ・左側 //
	'name' => 'TOPPAGE [LEFT]',
	'id' => 'left',
	'before_widget' => '<div class="inner left">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>' ));
	// トップページ・中央 //
	register_sidebar(array(
	'name' => 'TOPPAGE [MIDDLE]',
	'id' => 'middle',
	'before_widget' => '<div class="inner middle">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>' ));
	// トップページ・右側 //
	register_sidebar(array(
	'name' => 'TOPPAGE [RIGHT]',
	'id' => 'right',
	'before_widget' => '<div class="inner right">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>' ));
?>
<?php
function get_the_post_image($postid,$size,$order=0,$max=null) { // 投稿画像を自動で取得する
	$attachments = get_children(array('post_parent' => $postid, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
	if ( is_array($attachments) ){
		foreach ($attachments as $key => $row) {
			$mo[$key]  = $row->menu_order;
			$aid[$key] = $row->ID;
		}
		array_multisort($mo, SORT_ASC,$aid,SORT_DESC,$attachments);
		$max = empty($max)? $order+1 :$max;
		for($i=$order;$i<$max;$i++){
			return wp_get_attachment_image( $attachments[$i]->ID, $size );
		}
	}
}


//////////メディアのリンク先から添付ファイルのページの選択肢を消去する//////////
function media_script_buffer_start() {
    ob_start();
}
add_action( 'post-upload-ui', 'media_script_buffer_start' );
function media_script_buffer_get() {
    $scripts = ob_get_clean();
    $scripts = preg_replace( '#<option value="post">.*?</option>#s', '', $scripts );
    echo $scripts;
}
add_action( 'print_media_templates', 'media_script_buffer_get' );


//////////404.phpへリダイレクトしたいテンプレートを指定//////////
function load_404()
{ if (is_attachment()) {
	include( TEMPLATEPATH . '/404.php');
	exit;
	}
} add_action('template_redirect', 'load_404');


//////////ページネーションを画像にするためのコード作成////////
define('PATH_TEMP', esc_html(get_bloginfo('template_url')));


//////////カスタム投稿の設定
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'information',
		array(
			'labels' => array('name' => __( 'ニュース' ),
			'singular_name' => __( 'ニュース' )
			),
			'supports' => array( 'title','editor' ),
			'menu_icon' => get_bloginfo('template_url').'/images/icn-news.png',
			'has_archive' => true,
			'public' => true,
			'menu_position' =>5,
		)
	);
	register_taxonomy( // CATEGORY for INFORMATION
		'info-cat',
		'information',
		array(
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'label' => 'カテゴリー',
			'singular_label' => 'カテゴリー',
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'query_var' => true
		)
	);
	register_taxonomy( // TAG for INFORMATION
		'info-tag',
		'information',
		array(
		  'hierarchical' => false,
		  'update_count_callback' => '_update_post_term_count',
		  'label' => 'タグ',
		  'singular_label' => 'タグ',
		  'public' => true,
		  'show_ui' => true
		)
	);
}
?>
