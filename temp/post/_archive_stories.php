<div class="note-archive">
	<div class="note-archive-header">
		<?php if (is_post_type_archive('stories')): ?>
			<h1 class="archive-title">留学体験記</h1>
			<div class="archive-categories">
				<ul class="categories-list">
					<?php wp_list_categories('title_li=&taxonomy=stories_cate&exclude=25'); ?>
				</ul>
			</div>
		<?php else : ?>
			<h1 class="archive-title">「<?php single_term_title( ); ?>」の記事一覧</h1>
		<?php endif; ?>
	</div>

	<div class="note-cards-grid">			
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<article class="note-card">
			<a href="<?php the_permalink(); ?>" class="card-link">
				<div class="card-image">
					<?php if( get_field('stories_pic') ):?>
						<img src="<?php the_field('stories_pic');?>" alt="<?php the_title(); ?>">
					<?php else:?>
						<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="<?php the_title(); ?>">			
					<?php endif; ?>
				</div>
				<div class="card-content">
					<div class="card-meta">
						<?php $terms = get_the_terms($post->ID, 'stories_cate'); ?>
						<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
								<span class="category-tag"><?php echo $term->name; ?></span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<h2 class="card-title">
						<?php 
						$custom_title = get_field('stories_title');
						$display_title = $custom_title ? $custom_title : get_the_title();
						$text = mb_substr($display_title, 0, 60, 'utf-8');
						echo mb_strlen($display_title) > 60 ? $text.'...' : $text;
						?>
					</h2>
					<div class="card-author">
						<span class="author-name"><?php the_title(); ?></span>
						<?php if( get_field('stories_university') ):?>
							<span class="author-detail"><?php the_field('stories_university'); ?></span>
						<?php endif; ?>
					</div>
					<?php $tags = get_the_terms($post->ID, 'stories_tag'); ?>
					<?php if($tags && count($tags) > 0): ?>
						<div class="card-tags">
							<?php 
							$tag_count = 0;
							foreach($tags as $tag): 
								if($tag_count >= 3) break;
							?>
								<span class="tag">#<?php echo $tag->name; ?></span>
							<?php 
								$tag_count++;
							endforeach; 
							?>
						</div>
					<?php endif; ?>
				</div>
			</a>
		</article>
		<?php endwhile; endif; ?>
		<?php wp_reset_query(); ?>			
	</div>
</div>