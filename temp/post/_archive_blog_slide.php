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
			<div class="item">
				<p class="thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php
								$img_id       = get_post_thumbnail_id();
								$img_thumbnail = wp_get_attachment_image_src( $img_id, 'thum1000' );
								echo '<img src="' . esc_url( $img_thumbnail[0] ) . '" alt="">';
							?>
						<?php else : ?>
							<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">
						<?php endif; ?>
					</a>
				</p>
				<div>
					<div class="cate">
						<?php $categories = get_the_category(); ?>
						<?php if ( $categories ) : ?>
							<?php foreach ( $categories as $cat ) : ?>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="tag"><?php the_tags( '' ); ?></div>
				</div>
			</div>
	<?php endwhile; endif; ?>
	<?php wp_reset_postdata(); ?>
</div>
