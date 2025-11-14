<div class="note-blog-archive all">
	<div class="blog-archive-header">
		<div class="container">
			<h1 class="archive-title">留学情報ブログ</h1>
			<p class="archive-description">留学やキャリアに関する最新情報をお届けします</p>
		</div>
	</div>

	<div class="container">
		<div class="col3">
			<?php
			$paged = (int) get_query_var( 'paged' );
			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 12,
				'paged'          => $paged,
				'orderby'        => 'post_date',
				'order'          => 'DESC',
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					get_template_part( 'temp/post/_archive_blog_parts' );
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>

		<?php if ( function_exists( 'wp_pagenavi' ) ) : ?>
			<div class="com_wp_pagenavi">
				<?php wp_pagenavi( array( 'query' => $the_query ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
