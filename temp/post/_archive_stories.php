			<div class="categories reset">
				<?php if (is_post_type_archive('stories')): ?>
				<ul class="categories-list">
					<?php wp_list_categories('title_li=&taxonomy=stories_cate&exclude=25'); ?>
				</ul>			
				<?php else : ?>
					<h2 class="ja">「<?php single_term_title( ); ?>」の記事一覧</h2>
				<?php endif; ?>
			</div>

			<div class="col3">			
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
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
				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>			
			</div>