<article class="goodpatch-blog-card">
	<a href="<?php the_permalink(); ?>" class="blog-card-link">
		<div class="blog-card-image">
			<?php if ( has_post_thumbnail() ) : ?>
				<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'large' ); echo ''.$img_thumbnail[0].'';?>" alt="<?php the_title(); ?>">
			<?php else: ?>
				<div class="blog-card-gradient"></div>
			<?php endif; ?>
			<div class="blog-card-overlay"></div>
		</div>
		<div class="blog-card-content">
			<div class="blog-card-meta">
				<?php $categories = get_the_category(); if($categories): ?>
					<div class="blog-card-categories">
						<?php foreach( $categories as $cat ): ?>
							<span class="blog-category-pill"><?php echo $cat->name; ?></span>
						<?php endforeach;?>
					</div>
				<?php endif; ?>
				<time class="blog-card-date" datetime="<?php echo get_the_date('c'); ?>">
					<?php echo get_the_date('Y.m.d'); ?>
				</time>
			</div>
			<h2 class="blog-card-title"><?php the_title(); ?></h2>
			<?php if(has_excerpt()): ?>
				<p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
			<?php endif; ?>
			<?php $tags = get_the_tags(); if($tags): ?>
				<div class="blog-card-tags">
					<?php 
					$tag_count = 0;
					foreach($tags as $tag): 
						if($tag_count >= 3) break;
					?>
						<span class="blog-tag-pill">#<?php echo $tag->name; ?></span>
					<?php 
						$tag_count++;
					endforeach; 
					?>
				</div>
			<?php endif; ?>
		</div>
	</a>
</article>