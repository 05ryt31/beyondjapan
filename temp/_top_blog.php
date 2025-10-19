   <div class="scloll">	
	   <ul class="home-blog-block-list js-switch-tabs">
		   <li class="active">最新</li>
		   <li>カテゴリー01</li>
		   <li>カテゴリー02</li>
		   <li>カテゴリー03</li>
	   </ul>
	</div>
	<div class="js-switch-content active">
		<div class="post-archive col">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 4,
				'paged' => $paged,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/_top_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>			
		</div>
	</div>
	<div class="js-switch-content">
		<div class="post-archive col">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 4,
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
			<?php get_template_part( 'temp/_top_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
	<div class="js-switch-content">
		<div class="post-archive col">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 4,
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
			<?php get_template_part( 'temp/_top_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
	</div>
	<div class="js-switch-content">
		<div class="post-archive col">
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 4,
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
			<?php get_template_part( 'temp/_top_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>	
		</div>
	</div>