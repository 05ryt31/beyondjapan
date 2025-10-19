<?php get_header();?>
<div class="post">
	<article class="archive reset">
		 <div class="container">
			<div class="categories reset">
				<h2 class="ja">「<?php single_term_title( ); ?>」の記事一覧</h2>
			</div>
			<div class="col3">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<div class="item">
					<p class="thumbnail">
						<a href="<?php the_permalink(); ?>"><?php if( get_field('cf_training_pic') ):?>
							<p class="thumbnail"><img src="<?php the_field('cf_training_pic');?>" alt=""></p>
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
				<?php wp_reset_postdata(); ?>	
			</div>
			<!--　アーカイブページナビ -->
			<div class="com_wp_pagenavi">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			</div>
			<!--　/アーカイブページナビ --> 			 
		 </div>
	</article>	
</div>
<?php get_footer(); ?>