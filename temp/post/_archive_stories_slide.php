<div class="picup slid_blog">
	
	<?php
	global $post;
	$args = array(
	'post_type' => 'stories',
	'tax_query' => array(
		array(
			'taxonomy' => 'stories_cate',
			'field' => 'slug',
			'terms' => 'pickup',
			//'operator' => 'NOT IN',// 指定したタームを除外
			'numberposts' => 5
		),
	),
	);					
	$myposts = get_posts( $args );
	foreach ( $myposts as $post ): setup_postdata( $post );
	?>
				<div class="item">
					<p class="thumbnail">
						<a href="<?php the_permalink(); ?>">
								<?php if( get_field('stories_pic') ):?>
								<img src="<?php the_field('stories_pic');?>" alt="">
								<?php else:?>
								<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">			
								<?php endif; ?>
						</a>	
					</p>
					<div>
						<div class="cate">
							<?php $terms = get_the_terms($post->ID, 'stories_cate'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'stories_cate').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<h2 class="title"><?php $text = mb_substr(get_field('stories_title'),0,36,'utf-8');  echo $text.'...';?></h2>
						<p><a href="<?php the_permalink(); ?>?post_id=<?php echo $post->ID; ?>"><?php the_title(); ?></a></p>
						<div class="tag">
							<?php $terms = get_the_terms($post->ID, 'stories_tag'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'stories_tag').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
	<?php endforeach; ?>
	<?php wp_reset_query(); ?>
	
</div>