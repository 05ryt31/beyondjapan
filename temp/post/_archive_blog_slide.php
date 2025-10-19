<div class="picup slid_blog">
	
			<?php
			$paged = (int) get_query_var('paged');
			$args = array(
				'posts_per_page' => 5,
				'paged' => $paged,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'pickup' //カテゴリースラッグ
			);
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
</div>
