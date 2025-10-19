		<div class="container">
			<div class="reset">
				<p class="cate">
					<?php $categories = get_the_category(); foreach( $categories as $cat ): ?>
					<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>
					<?php endforeach;?>
				</p>			
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="tag"><?php the_tags(''); ?></div>
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