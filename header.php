<!doctype html>
<html lang="ja">
<head>
<?php global $cfs ;?>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>

<!-- DNS Prefetch & Preconnect（パフォーマンス最適化） -->
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://code.jquery.com" crossorigin>
<link rel="preconnect" href="https://unpkg.com" crossorigin>
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

<!-- 外部CSS（メディアクエリで最適化） -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/></noscript>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/></noscript>
<link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css"/></noscript>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanjp-narrow.min.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanjp-narrow.min.css"/></noscript>

<!-- ローカルCSS -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_basic.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/common.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/form.css">
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/image/favicon.ico" >

<?php if ( is_home() || is_front_page() ) : ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_home.css">
<?php elseif (get_post_type() === 'stories'): ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_stories.css">
<?php elseif (get_post_type() === 'news'): ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_post.css">
<?php elseif(is_archive() || is_single() ||is_page( array( 'blog' ) )) : ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_blog.css">	
<?php elseif(is_page() || is_404() ) : ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/style_page.css">
<?php endif; ?>
<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<?php
// 現在表示している固定ページのスラッグ取得
//$page = get_post( get_the_ID() );
//$slug = $page->post_name;
//?>
<style>
<//?php echo $cfs->get('cf_css'); ?>
</style>
<?php wp_head(); ?>
</head>
	
<body id="Top" <?php body_class("drawer drawer--top"); ?>>
<div class="ovreLay"></div>	

<div class="wrap">
<div id="gheader">
	<header class="header container reset">
		<div class="header-col">
			<div class="header-col-left">
<!-- SEO: ロゴはH1ではなくdivで統一（H1は各ページのメインコンテンツに配置） -->
<div class="header-col-left-logo"><a href="<?php echo home_url('/'); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/logo.png" alt="Beyond Japan - 海外留学・UC編入専門エージェント"/></a></div>
				
			</div>
			<div class="header-col-right">
				<div class="header-navi">
					<?php get_template_part( 'temp/_gnavi' ); ?>
				</div>
			</div>
		</div>
	</header>
</div>
<button type="button" class="drawer-hamburger" tabindex="0" accesskey="U"> <span class="drawer-hamburger-icon"></span></button>		
<div id="contents">
<main id="main">
<?php if ( is_home() || is_front_page() ) : ?>
<?php else : ?>
<?php get_template_part( 'temp/_title' ); ?>
<?php endif; ?>