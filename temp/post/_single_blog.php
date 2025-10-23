<article class="note-blog-article">
	<header class="note-blog-header">
		<div class="container">
			<div class="note-blog-meta">
				<?php $categories = get_the_category(); if($categories): ?>
					<div class="note-blog-category">
						<?php foreach( $categories as $cat ): ?>
							<span class="category-tag"><?php echo $cat->name; ?></span>
						<?php endforeach;?>
					</div>
				<?php endif; ?>
			</div>
			
			<h1 class="note-blog-title"><?php the_title(); ?></h1>
			
			<div class="note-blog-author">
				<div class="author-avatar">
					<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/author-default.png" alt="管理者">
				</div>
				<div class="author-info">
					<div class="author-name">Beyond Japan</div>
					<div class="author-details">
						<span><?php echo get_the_date('Y年n月j日'); ?></span>
					</div>
				</div>
			</div>
			
			<?php $tags = get_the_tags(); if($tags): ?>
				<div class="note-blog-tags">
					<?php foreach($tags as $tag): ?>
						<a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-link">#<?php echo $tag->name; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</header>
	
	<!-- メイン画像 -->
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="note-blog-featured-image">
		<div class="container">
			<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'full' ); echo ''.$img_thumbnail[0].'';?>" alt="<?php the_title(); ?>">
		</div>
	</div>
	<?php endif; ?>
	
	<div class="note-blog-content">
		<div class="container">
			<div class="content-body">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</article>