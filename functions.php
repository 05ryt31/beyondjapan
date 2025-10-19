<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//WordPressのバージョン非表示
remove_action('wp_head','wp_generator');

//CSSやJSのバージョン非表示
function remove_cssjs_ver2( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );


// 留学体験記アーカイブから運営メンバーを除外
function exclude_specific_term_from_stories_archive($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('stories')) {
        $tax_query = array(
            array(
                'taxonomy' => 'stories_cate',
                'field'    => 'slug',
                'terms'    => array('studyabroad'), // 除外したいタームのスラッグ
                'operator' => 'NOT IN',
            ),
        );
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'exclude_specific_term_from_stories_archive');


// 画像取得（ID指定がなければ表示中の記事の画像を取得）
function catch_that_image($post_id = NULL)
{
	if ( !empty($post_id) )
	{
		$posts = get_post($post_id);
		$post_content = $posts->post_content;
	}
	else
	{
		global $post, $posts;
		$post_content = $post->post_content;
	}

	$first_img = '';
	ob_start();
	ob_end_clean();

	$output = preg_match_all('/<img.*?src=(["\'])(.+?)\1.*?>/i', $post_content, $matches);
	$first_img = $matches[2][0];

	if ( empty($first_img) ) {
		$first_img = '';
	}

	return $first_img;
}

/* 作った任意のフォルダへ固定ページテンプレート */
    function custom_page_template($template) {
        $new_template = '';

        $page_templates = array(
            'テンプレート名' => '作った任意のフォルダ名/固定ページテンプレートファイル名',
            'カリフォルニア大学編入プラン' => 'temp_page/page-plan_uc',
			'全米大学編入プラン' => 'temp_page/page-plan_all',
			'カナダ大学編入プラン' => 'temp_page/page-plan_canada',
			'フルサポートプラン' => 'temp_page/page-plan_full',
			'私たちについて' => 'temp_page/page-about',
			'編入について' => 'temp_page/page-transfer',
			'編入までの流れ' => 'temp_page/page-transfer_flow',
			'特定商取引法に基づく表示' => 'temp_page/page-low',
			'お問い合わせ' => 'temp_page/page-contact',
        );

        foreach ($page_templates as $page_slug => $template_path) {
            if (is_page($page_slug)) {
                $new_template = locate_template(array($template_path));
                break;
            }
        }

        if (!empty($new_template)) {
            return $new_template;
        }

        return $template;
    }
    add_filter('page_template', 'custom_page_template');



/* 【管理画面】独自のCSS・JSファイルを読み込ませる */
function add_admin_style(){
  $path_css = get_template_directory_uri().'/css/admin.css';
  wp_enqueue_style('admin_style', $path_css);
  $path_js = get_template_directory_uri().'/js/admin.js';
  wp_enqueue_script('admin_script', $path_js);
}
add_action('admin_enqueue_scripts', 'add_admin_style');

/* 【管理画面】投稿編集画面で不要な項目を非表示にする */
add_action( 'init', function() { 
	//remove_post_type_support('post','thumbnail');
}, 99);

/* 【管理画面】固定ページ編集画面でエディターを非表示にする */
add_filter('use_block_editor_for_post',function($use_block_editor,$post){
 	if($post->post_type==='page'){
		remove_post_type_support('page','editor');
  		return false;
 	}
 	return $use_block_editor;
},10,2);

/* 投稿アーカイブページの作成*/
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog'; //任意のスラッグ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 ); 


function custom_admin_style() {
	?><style>
		.smart-cf-upload-image img { width: 150px; height: 150px; object-fit: cover; }
	</style><?php
}
add_action( 'admin_head', 'custom_admin_style' );

/**
 * アーカイブタイトルを変更する
 */
function ag_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_post_type_archive() ){
        $title = post_type_archive_title('', false);
    } elseif (is_date()) {
        $title = get_the_time('Y年n月');
    } elseif (is_search()) {
        $title = '検索結果：'.esc_html( get_search_query(false) );
    } elseif (is_404()) {
        $title = '「404」ページが見つかりません';
    } else {

    }
    return $title; 
}; 
add_filter( 'get_the_archive_title', 'ag_archive_title');

//サイトのURL取得ショートコード
add_shortcode('surl', 'shortcode_surl');
function shortcode_surl() {
	return site_url();
}

//ショートコードを使ったphpファイルの呼び出し
function my_php_Include($params = array()) {
extract(shortcode_atts(array('file' => 'default'), $params));
ob_start();
include(get_theme_root() . '/' . get_template() . "/temp/$file.php");
return ob_get_clean();
}
add_shortcode('myphp', 'my_php_Include');

// テンプレートURL取得ショートコード
add_shortcode( 'tp', 'shortcode_tp' );
function shortcode_tp( $atts, $content = '' ) {
	return get_template_directory_uri().$content;
}

// アイキャッチ画像を有効にする
add_theme_support('post-thumbnails');
add_filter( 'post_thumbnail_html', 'custom_attribute' );
function custom_attribute( $html ){
    // width height を削除する
$html = preg_replace('/(width|height)="\d*"\s/', '', $html);
return $html;
}

//アイキャッチ画像の定義と切り抜き
//add_image_size('thum500',500,500,true);
//add_image_size('thum1000',1000,600,true);
//add_image_size('thum2400',2400,800,true);

//自動生成するpタグやbrタグを固定ページだけ取り除く
remove_filter('the_content','wpautop');
add_filter('the_content','custom_content');
function custom_content($content){
if(get_post_type()=='page') 
    return $content; //
else
 return wpautop($content);
}

// サイト側の上部管理バーを非表示
add_filter('show_admin_bar', '__return_false');

// 200文字以上は省略し「…」の後にリンク付きの「続きを読む」。
function my_excerpt( $length ) {
global $post;
$content = mb_substr( strip_tags( $post -> post_content ), 0, $length );
$content = $content . ' ... ';
return $content;
}

// 特定の親ページを持つ子ページ以下（孫・玄孫）の全ての階層ページを対象とする条件分岐	
function is_parent_slug() {
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}

// <body>にスラッグを用いたclassを付与する
add_filter( 'body_class', 'add_page_slug_class_name' );
function add_page_slug_class_name( $classes ) {
  if ( is_page() ) {
    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;
  }
  return $classes;
}

/* カスタム投稿タイプを追加 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    /* 【お知らせ】カスタム投稿タイプを追加 */
    register_post_type( 
		'news', //カスタム投稿タイプ名を指定
        array(
            'labels' => array(
            'name' => __( 'お知らせ' ),
            'singular_name' => __( 'news' ),
            'capability_type' => array( 'news' ),
            'map_meta_cap'    => true	
        ),
		'show_in_rest' => true,
        'public' => true,
        'has_archive' => true, /* アーカイブページを持つ */
       'menu_position' =>5, //管理画面のメニュー順位
        'supports' => array( 'title', 'thumbnail','editor' ),
        'rewrite' => array('with_front' => false,),			
        )
    );
/* 【お知らせ】カテゴリタクソノミー(カテゴリー分け)を使えるように設定する */
  register_taxonomy(
    'news_cate',
    'news',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );
	

    /* 【留学体験記】カスタム投稿タイプを追加 */
    register_post_type( 
		'stories', //カスタム投稿タイプ名を指定
        array(
            'labels' => array(
            'name' => __( '留学体験記' ),
            'singular_name' => __( 'stories' ),
            'capability_type' => array( 'stories' ),
            'map_meta_cap'    => true,
			
        ),
		'show_in_rest' => true,
        'public' => true,
        'has_archive' => true, /* アーカイブページを持つ */
       'menu_position' =>5, //管理画面のメニュー順位
        'supports' => array( 'title', 'editor' ),
        //'rewrite' => array('with_front' => false,),			
        )
    );
/* 【合格体験記】カテゴリタクソノミー(カテゴリー分け)を使えるように設定する */
  register_taxonomy(
    'stories_cate',
    'stories',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );
  /* 【合格体験記】カテゴリタクソノミー(タグ分け)を使えるように設定する */
  register_taxonomy(
    'stories_tag',
    'stories',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
	
    $rm = new WP_Roles();
        $rm->add_role("authid", "権限名" );
    foreach( array( "authid",  "administrator" ) as $rid ) {
        $role = $rm->get_role($rid);
        $role->add_cap("read");
        $role->add_cap("add_ptauth");
        $role->add_cap("add_ptauths");
        $role->add_cap("edit_ptauth");
        $role->add_cap("edit_ptauths");
        $role->add_cap("delete_ptauth");
        $role->add_cap("delete_ptauths");
        $role->add_cap("publish_ptauths");
    }
    $role->add_cap("delete_others_ptauths");
    $role->add_cap("edit_others_ptauths");	
}
add_action( 'init', 'create_post_type', 0 );

// 投稿のラベルを変更
function custom_post_labels( $labels ) {
	$labels->name = 'お役立ちブログ'; // 投稿
	$labels->singular_name = 'お役立ちブログ'; // 投稿
	$labels->add_new = '新規追加'; // 新規追加
	$labels->add_new_item = 'お役立ちブログを追加'; // 新規投稿を追加
	$labels->edit_item = '投稿の編集'; // 投稿の編集
	$labels->new_item = '新規お役立ちブログ'; // 新規投稿
	$labels->view_item = 'お役立ちブログを表示'; // 投稿を表示
	$labels->search_items = 'お役立ちブログを検索'; // 投稿を検索
	$labels->not_found = 'お役立ちブログが見つかりませんでした。'; // 投稿が見つかりませんでした。
	$labels->not_found_in_trash = 'ゴミ箱内にお役立ちブログが見つかりませんでした。'; // ゴミ箱内に投稿が見つかりませんでした。
	$labels->parent_item_colon = ''; // (なし)
	$labels->all_items = 'お役立ちブログ一覧'; // 投稿一覧
	$labels->archives = 'お役立ちブログアーカイブ'; // 投稿アーカイブ
	$labels->insert_into_item = 'お役立ちブログに挿入'; // 投稿に挿入
	$labels->uploaded_to_this_item = 'このお役立ちブログへのアップロード'; // この投稿へのアップロード
	$labels->featured_image = 'アイキャッチ画像'; // アイキャッチ画像
	$labels->set_featured_image = 'アイキャッチ画像を設定'; // アイキャッチ画像を設定
	$labels->remove_featured_image = 'アイキャッチ画像を削除'; // アイキャッチ画像を削除
	$labels->use_featured_image = 'アイキャッチ画像として使用'; // アイキャッチ画像として使用
	$labels->filter_items_list = 'お役立ちブログリストの絞り込み'; // 投稿リストの絞り込み
	$labels->items_list_navigation = 'お役立ちブログリストナビゲーション'; // 投稿リストナビゲーション
	$labels->items_list = 'お役立ちブログリスト'; // 投稿リスト
	$labels->menu_name = 'お役立ちブログ'; // 投稿
	$labels->name_admin_bar = 'お役立ちブログ'; // 投稿
	return $labels;
}
add_filter( 'post_type_labels_post', 'custom_post_labels' );

global $wp_rewrite;
$wp_rewrite->flush_rules();

?>