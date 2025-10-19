<?php if (have_posts()) : while (have_posts()) : the_post();?>

<div class="container">
			<div class="reset">
				<div class="cate">
					<?php $terms = get_the_terms($post->ID, 'news_cate'); ?>
					<?php if($terms): ?>
					<?php foreach($terms as $term): ?>
					<?php echo '<a href="'.get_term_link($term->slug,'news_cate').'">'.$term->name.'</a>'; ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="date">
					<time><?php the_time('Y.m.d'); ?></time>
				</div>
				<h1 class="title"><?php the_title(); ?></h1>
				<p class="thumbnail">
					<?php if ( has_post_thumbnail() ) : // サムネイルを持っているときの処理 ?>
					<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum1000' ); echo ''.$img_thumbnail[0].'';?>">
					<?php else: // サムネイルを持っていないときの処理 ?>
					<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">		
					<?php endif; ?>	
				</p>
			</div>
			<div class="post-area"> 
				<?php the_content(); ?>
			</div>
		</div>

<?php endwhile; endif; ?>