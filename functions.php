<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//WordPressのバージョン非表示
remove_action('wp_head','wp_generator');

add_theme_support('title-tag');

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

function add_blog_all_rewrite_rule() {
	add_rewrite_rule( '^blog/all/?$', 'index.php?post_type=post&blog_scope=all', 'top' );
}
add_action( 'init', 'add_blog_all_rewrite_rule' );

function add_blog_scope_query_var( $vars ) {
	$vars[] = 'blog_scope';
	return $vars;
}
add_filter( 'query_vars', 'add_blog_scope_query_var' );

function adjust_blog_scope_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$scope = $query->get( 'blog_scope' );
	if ( 'all' === $scope ) {
		$query->set( 'post_type', 'post' );
		$query->set( 'post_status', 'publish' );
		$query->set( 'posts_per_page', 12 );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	}
}
add_action( 'pre_get_posts', 'adjust_blog_scope_query' );

function flush_blog_rewrite_rules_on_switch() {
	add_blog_all_rewrite_rule();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'flush_blog_rewrite_rules_on_switch' );


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
	$labels->name = '留学情報ブログ'; // 投稿
	$labels->singular_name = '留学情報ブログ'; // 投稿
	$labels->add_new = '新規追加'; // 新規追加
	$labels->add_new_item = '留学情報ブログを追加'; // 新規投稿を追加
	$labels->edit_item = '留学情報ブログの編集'; // 投稿の編集
	$labels->new_item = '新規留学情報ブログ'; // 新規投稿
	$labels->view_item = '留学情報ブログを表示'; // 投稿を表示
	$labels->search_items = '留学情報ブログを検索'; // 投稿を検索
	$labels->not_found = '留学情報ブログが見つかりませんでした。'; // 投稿が見つかりませんでした。
	$labels->not_found_in_trash = 'ゴミ箱内に留学情報ブログが見つかりませんでした。'; // ゴミ箱内に投稿が見つかりませんでした。
	$labels->parent_item_colon = ''; // (なし)
	$labels->all_items = '留学情報ブログ一覧'; // 投稿一覧
	$labels->archives = '留学情報ブログアーカイブ'; // 投稿アーカイブ
	$labels->insert_into_item = '留学情報ブログに挿入'; // 投稿に挿入
	$labels->uploaded_to_this_item = 'この留学情報ブログへのアップロード'; // この投稿へのアップロード
	$labels->featured_image = 'アイキャッチ画像'; // アイキャッチ画像
	$labels->set_featured_image = 'アイキャッチ画像を設定'; // アイキャッチ画像を設定
	$labels->remove_featured_image = 'アイキャッチ画像を削除'; // アイキャッチ画像を削除
	$labels->use_featured_image = 'アイキャッチ画像として使用'; // アイキャッチ画像として使用
	$labels->filter_items_list = '留学情報ブログリストの絞り込み'; // 投稿リストの絞り込み
	$labels->items_list_navigation = '留学情報ブログリストナビゲーション'; // 投稿リストナビゲーション
	$labels->items_list = '留学情報ブログリスト'; // 投稿リスト
	$labels->menu_name = '留学情報ブログ'; // 投稿
	$labels->name_admin_bar = '留学情報ブログ'; // 投稿
	return $labels;
}
add_filter( 'post_type_labels_post', 'custom_post_labels' );

/**
 * =====================================================
 * SEO強化: 構造化データ（JSON-LD）
 * All in One SEOと競合しない形で追加
 * =====================================================
 */

/**
 * 組織情報の構造化データ（トップページ）
 */
function beyondjapan_organization_schema() {
    if (!is_front_page()) return;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Beyond Japan',
        'alternateName' => 'ビヨンドジャパン',
        'description' => 'アメリカ・カナダの大学への編入留学を専門サポート。コミュニティカレッジからカリフォルニア大学（UCLA、UCバークレー）への編入実績多数。',
        'url' => home_url('/'),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => get_template_directory_uri() . '/assets/image/common/logo.png'
        ),
        'image' => get_template_directory_uri() . '/assets/image/home/kv_pc.png',
        'areaServed' => array(
            '@type' => 'Country',
            'name' => 'Japan'
        ),
        'serviceType' => array(
            'アメリカ大学編入サポート',
            'カリフォルニア大学留学サポート',
            'コミュニティカレッジ留学',
            'UC編入サポート',
            'カナダ大学編入サポート'
        ),
        'knowsAbout' => array(
            'アメリカ大学編入',
            'カリフォルニア大学留学',
            'コミカレ留学',
            'UCLA編入',
            'UCバークレー編入',
            'UCSD編入',
            'コミュニティカレッジからの編入'
        ),
        'hasOfferCatalog' => array(
            '@type' => 'OfferCatalog',
            'name' => '留学サポートプラン',
            'itemListElement' => array(
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => 'カリフォルニア大学編入プラン',
                        'description' => 'コミュニティカレッジからUCLA、UCバークレー、UCSDへの編入をサポート'
                    )
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => '全米大学編入プラン',
                        'description' => 'アイビーリーグを含む全米のトップ大学への編入をサポート'
                    )
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => 'カナダ大学編入プラン',
                        'description' => 'UBC、トロント大学などカナダ名門大学への編入をサポート'
                    )
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => 'フルサポートプラン',
                        'description' => '留学前から大学編入まで2年間を徹底サポート'
                    )
                )
            )
        )
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'beyondjapan_organization_schema', 5);

/**
 * FAQ構造化データ（トップページ用）
 * Google検索結果にFAQリッチスニペットを表示
 */
function beyondjapan_faq_schema() {
    if (!is_front_page()) return;

    $faqs = array(
        array(
            'question' => 'コミュニティカレッジからカリフォルニア大学（UC）に編入できますか？',
            'answer' => 'はい、可能です。カリフォルニア大学の学生の3人に1人はコミュニティカレッジからの編入生です。Beyond Japanでは、UCLA、UCバークレー、UCSDなどのUC校への編入をサポートしており、UC合格率100%の実績があります。'
        ),
        array(
            'question' => 'コミカレからの編入のメリットは何ですか？',
            'answer' => '主なメリットは3つあります。1つ目は合格率が圧倒的に高いこと（UCトップ校への編入合格率50%以上）、2つ目は学費を約1,300万円節約できること、3つ目は英検2級程度の英語力からスタートできることです。'
        ),
        array(
            'question' => '英語力に自信がなくても留学できますか？',
            'answer' => 'はい、英検2級程度の英語力があれば留学を始められます。コミュニティカレッジで2年間学びながら英語力を伸ばし、4年制大学への編入を目指すことができます。'
        ),
        array(
            'question' => 'Beyond Japanの合格保証とは何ですか？',
            'answer' => 'UCB（バークレー）、UCLA、UCSDのTOP3校に編入合格できなかった場合、代金を全額返金する保証制度です。文系が対象で、理系は事前テスト合格者が対象となります。'
        ),
        array(
            'question' => 'アメリカ大学編入にかかる費用はどのくらいですか？',
            'answer' => 'コミュニティカレッジを経由することで、4年間直接大学に通う場合と比べて約1,300万円の節約が可能です。具体的な費用は留学先や期間によって異なりますので、無料カウンセリングでご相談ください。'
        )
    );

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array()
    );

    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = array(
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => $faq['answer']
            )
        );
    }

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'beyondjapan_faq_schema', 6);

/**
 * サービス詳細の構造化データ（各プランページ用）
 */
function beyondjapan_service_schema() {
    $services = array(
        'plan_uc' => array(
            'name' => 'カリフォルニア大学編入プラン',
            'description' => 'コミュニティカレッジからカリフォルニア大学（UCLA、UCバークレー、UCSD等）への編入を専門サポート。UC合格率100%の実績。学費を1,300万円節約しながら世界ランキング上位の名門大学へ編入できます。',
            'provider' => 'Beyond Japan',
            'areaServed' => 'カリフォルニア州、アメリカ合衆国',
            'serviceType' => 'カリフォルニア大学編入サポート'
        ),
        'plan_all' => array(
            'name' => '全米大学編入プラン',
            'description' => 'コミュニティカレッジから全米のトップ大学への編入をサポート。コロンビア大学、NYU、USC等アイビーリーグを含む名門大学への編入実績あり。',
            'provider' => 'Beyond Japan',
            'areaServed' => 'アメリカ合衆国全土',
            'serviceType' => '全米大学編入サポート'
        ),
        'plan_canada' => array(
            'name' => 'カナダ大学編入プラン',
            'description' => 'カナダのコミュニティカレッジからUBC（ブリティッシュコロンビア大学）、トロント大学等への編入をサポート。費用を抑えながらカナダの名門大学へ。',
            'provider' => 'Beyond Japan',
            'areaServed' => 'カナダ',
            'serviceType' => 'カナダ大学編入サポート'
        ),
        'plan_full' => array(
            'name' => 'フルサポートプラン',
            'description' => '留学前から大学編入まで2年間を密着サポート。出願・VISA申請、Essay添削、履修登録、編入申請、米国生活サポートまで充実のサービス。奨学金申請サポートやオンライン英会話も含む。',
            'provider' => 'Beyond Japan',
            'areaServed' => 'アメリカ合衆国、カナダ',
            'serviceType' => 'フルサポート留学プログラム'
        )
    );

    // 現在のページスラッグを取得
    global $post;
    if (!is_page() || !$post) return;

    $slug = $post->post_name;

    if (!isset($services[$slug])) return;

    $service = $services[$slug];

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service['name'],
        'description' => $service['description'],
        'provider' => array(
            '@type' => 'EducationalOrganization',
            'name' => $service['provider'],
            'url' => home_url('/')
        ),
        'areaServed' => $service['areaServed'],
        'serviceType' => $service['serviceType'],
        'url' => get_permalink()
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'beyondjapan_service_schema', 7);

/**
 * パンくずリストの構造化データ
 */
function beyondjapan_breadcrumb_schema() {
    if (is_front_page()) return;

    global $post;

    $breadcrumbs = array(
        array(
            'name' => 'ホーム',
            'url' => home_url('/')
        )
    );

    if (is_page()) {
        $breadcrumbs[] = array(
            'name' => get_the_title(),
            'url' => get_permalink()
        );
    } elseif (is_single()) {
        if (get_post_type() === 'post') {
            $breadcrumbs[] = array(
                'name' => '留学情報ブログ',
                'url' => home_url('/blog/')
            );
        }
        $breadcrumbs[] = array(
            'name' => get_the_title(),
            'url' => get_permalink()
        );
    } elseif (is_archive()) {
        $breadcrumbs[] = array(
            'name' => get_the_archive_title(),
            'url' => get_post_type_archive_link(get_post_type())
        );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array()
    );

    $position = 1;
    foreach ($breadcrumbs as $crumb) {
        $schema['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $crumb['name'],
            'item' => $crumb['url']
        );
        $position++;
    }

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'beyondjapan_breadcrumb_schema', 8);

/**
 * WebSite構造化データ（サイト検索ボックス用）
 */
function beyondjapan_website_schema() {
    if (!is_front_page()) return;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Beyond Japan',
        'alternateName' => 'ビヨンドジャパン - アメリカ大学編入・カリフォルニア大学留学サポート',
        'url' => home_url('/'),
        'description' => 'コミュニティカレッジからUCLA・UCバークレーへの編入をサポート。UC合格率100%実績の留学エージェント。',
        'inLanguage' => 'ja',
        'publisher' => array(
            '@type' => 'Organization',
            'name' => 'Beyond Japan'
        )
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'beyondjapan_website_schema', 4);

/**
 * =====================================================
 * パフォーマンス最適化
 * =====================================================
 */

/**
 * 画像にlazy loading属性を自動追加
 * ファーストビュー以外の画像を遅延読み込み
 */
function beyondjapan_add_lazy_loading($content) {
    if (is_admin()) return $content;

    // loading="lazy" がまだない画像に追加
    $content = preg_replace(
        '/<img(?![^>]*loading=)([^>]*)>/i',
        '<img loading="lazy"$1>',
        $content
    );

    return $content;
}
add_filter('the_content', 'beyondjapan_add_lazy_loading');
add_filter('post_thumbnail_html', 'beyondjapan_add_lazy_loading');
add_filter('get_avatar', 'beyondjapan_add_lazy_loading');

/**
 * テンプレート全体の画像にlazy loading追加（出力バッファリング）
 * ファーストビュー画像（kv_）は除外
 */
function beyondjapan_buffer_start() {
    if (is_admin()) return;
    ob_start('beyondjapan_process_output');
}

function beyondjapan_buffer_end() {
    if (is_admin()) return;
    if (ob_get_level() > 0) ob_end_flush();
}

function beyondjapan_process_output($html) {
    // ファーストビュー画像を除く画像にlazy loadingを追加
    // kv_, logo, favicon は除外（ファーストビューで必要）
    $html = preg_replace_callback(
        '/<img(?![^>]*\bloading=)([^>]*)>/i',
        function($matches) {
            // srcにkv_, logo, faviconが含まれていなければlazy loadingを追加
            if (!preg_match('/(kv_|logo|favicon)/i', $matches[1])) {
                return '<img loading="lazy"' . $matches[1] . '>';
            }
            return $matches[0];
        },
        $html
    );
    return $html;
}

add_action('template_redirect', 'beyondjapan_buffer_start', 1);
add_action('shutdown', 'beyondjapan_buffer_end', 999);

/**
 * 画像にdecoding="async"属性を追加
 * ブラウザの画像デコードを非同期化
 */
function beyondjapan_add_async_decoding($content) {
    if (is_admin()) return $content;

    // decoding="async" がまだない画像に追加
    $content = preg_replace(
        '/<img(?![^>]*decoding=)([^>]*)>/i',
        '<img decoding="async"$1>',
        $content
    );

    return $content;
}
add_filter('the_content', 'beyondjapan_add_async_decoding', 11);
add_filter('post_thumbnail_html', 'beyondjapan_add_async_decoding', 11);

/**
 * WordPress標準のlazy loadingを確実に有効化
 */
add_filter('wp_lazy_loading_enabled', '__return_true');

/**
 * 不要なWordPress機能を無効化（パフォーマンス向上）
 */
function beyondjapan_remove_unnecessary_features() {
    // 絵文字スクリプトを削除
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // RSD/WLW リンクを削除
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');

    // 短縮URLを削除
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // REST API リンクを削除（使用していない場合）
    // remove_action('wp_head', 'rest_output_link_wp_head');

    // oEmbed関連を削除
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'beyondjapan_remove_unnecessary_features');

/**
 * DNS Prefetchを追加（追加のドメイン用）
 */
function beyondjapan_dns_prefetch() {
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.googletagmanager.com">' . "\n";
}
add_action('wp_head', 'beyondjapan_dns_prefetch', 0);
?>