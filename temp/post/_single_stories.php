<article class="note-article">
	<header class="note-header">
		<div class="container">
			<div class="note-meta">
				<?php $terms = get_the_terms($post->ID, 'stories_cate'); ?>
				<?php if($terms): ?>
					<div class="note-category">
						<?php foreach($terms as $term): ?>
							<span class="category-tag"><?php echo $term->name; ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			
			<h1 class="note-title">
				<?php 
				$custom_title = get_post_meta($post->ID, 'stories_title', true);
				echo $custom_title ? nl2br($custom_title) : get_the_title();
				?>
			</h1>
			
			<div class="note-author">
				<div class="author-avatar">
					<?php if( get_field('stories_pic') ):?>
						<img src="<?php the_field('stories_pic');?>" alt="<?php the_title(); ?>">
					<?php else:?>
						<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="<?php the_title(); ?>">			
					<?php endif; ?>
				</div>
				<div class="author-info">
					<div class="author-name"><?php the_title(); ?></div>
					<div class="author-details">
						<?php if( get_field('stories_university') ):?>
							<span><?php the_field('stories_university'); ?></span>
						<?php endif; ?>
						<?php if( get_field('stories_major') ):?>
							<span><?php the_field('stories_major'); ?></span>
						<?php endif; ?>
						<?php if( get_field('stories_company') ):?>
							<span><?php the_field('stories_company'); ?></span>
						<?php endif; ?>
						<?php if( get_field('stories_post') ):?>
							<span><?php the_field('stories_post'); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
			
			<?php $tags = get_the_terms($post->ID, 'stories_tag'); ?>
			<?php if($tags): ?>
				<div class="note-tags">
					<?php foreach($tags as $tag): ?>
						<a href="<?php echo get_term_link($tag->slug,'stories_tag'); ?>" class="tag-link">#<?php echo $tag->name; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</header>
	
	<div class="note-content">
		<div class="container">
			<?php if (is_object_in_term($post->ID, 'stories_cate',array('studyabroad'))): ?>
				<div class="content-body">
					<?php the_content(); ?>
				</div>
			<?php else : ?>
				<div class="content-body">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</article>	