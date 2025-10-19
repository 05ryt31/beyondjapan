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
	<div>
		<div class="cate">
		  <?php $categories = get_the_category(); foreach( $categories as $cat ): ?>
			<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>
			<?php endforeach;?>
		</div>
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="tag"><?php the_tags(''); ?></div>
	</div>
</div>