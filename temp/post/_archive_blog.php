<div class="note-blog-archive">
	<div class="blog-archive-header">
		<div class="container">
			<h1 class="archive-title">留学情報ブログ</h1>
			<p class="archive-description">留学やキャリアに関する最新情報をお届けします</p>
		</div>
	</div>
	
	<div class="blog-filter-section">
		<div class="container">
			<div class="filter-tabs">
				<ul class="categories-tabs js-switch-tabs">
					<li class="active">全て</li>
					<li>アメリカ</li>
					<li>カナダ</li>
					<li>その他</li>
				</ul>
			</div>
		</div>
	</div>	
	<div class="js-switch-content active">
		<div id="item-list" data-category="" data-begin="0">
			<div class="item-result col3">
				<!-- Ajaxで取得して表示 -->
			</div>	
			<div class="loading" style="display:none; text-align: center; margin-top: 1em;">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/image/common/loading.gif">
			</div>
			<p class="com-btn btn01">
				<a class="more-btn">もっと見る</a>
			</p>
		</div>		
	</div>
	<div class="js-switch-content">
		<div class="col2">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 6,
				'paged' => $paged,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'usa' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<p class="com-btn btn01"><a href="/blog/usa/">ブログの一覧を見る</a></p>
	</div>
	<div class="js-switch-content">
		<div class="col3">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 6,
				'paged' => $paged,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'canada' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
		<p class="com-btn btn01"><a href="/blog/canada/">ブログの一覧を見る</a></p>
	</div>
		<div class="col2">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 6,
				'paged' => $paged,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'other' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
		<p class="com-btn btn01"><a href="/blog/other/">ブログの一覧を見る</a></p>