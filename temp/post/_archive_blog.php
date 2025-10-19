    <div class="scloll">
	<ul class="categories-tabs js-switch-tabs">
		<li class="active">全て</li>
		<li>カテゴリー01</li>
		<li>カテゴリー02</li>
		<li>カテゴリー03</li>
	</ul>
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
				'category_name' => 'cate01' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<p class="com-btn btn01"><a href="/blog/cate01/">カテゴリー01の一覧を見る</a></p>
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
				'category_name' => 'cate02' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
		<p class="com-btn btn01"><a href="/blog/cate02/">カテゴリー02の一覧を見る</a></p>
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
				'category_name' => 'cate03' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
		<p class="com-btn btn01"><a href="/blog/cate03/">カテゴリー03の一覧を見る</a></p>
	</div>