			<div class="col3">
				<?php
				global $post;
				$args = array(
				'post_type' => 'news',
				'tax_query' => array(
					array(
						'taxonomy' => 'news_cate',
						'field' => 'slug',
						'terms' => 'pickup',
						//'operator' => 'NOT IN',// 指定したタームを除外
						'numberposts' => 3
					),
				),
				);					
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ): setup_postdata( $post );
				?>
				<div class="item">
					<p class="thumbnail">
						<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : // サムネイルを持っているときの処理 ?>
					<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum1000' ); echo ''.$img_thumbnail[0].'';?>">
					<?php else: // サムネイルを持っていないときの処理 ?>
					<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">		
					<?php endif; ?>	
						</a>
					</p>
					<div class="cate">
							<?php $terms = get_the_terms($post->ID, 'news_cate'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'news_cate').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
					</div>
					<p class="date">
						<time><?php the_time('Y.m.d'); ?></time>
					</p>
					<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<?php endforeach; ?>
				<?php wp_reset_query(); ?>
			</div>
			<div class="txt-list">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<div class="item">
					<div class="cate">
						<span class="date"><time><?php the_time('Y.m.d'); ?></time></span>
							<?php $terms = get_the_terms($post->ID, 'news_cate'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'news_cate').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
					</div>
					<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>