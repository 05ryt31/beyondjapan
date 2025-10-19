<?php get_header();?>
<div class="post">
	<article class="archive reset">
		 <div class="container">
			<div class="categories reset">
				<h2 class="ja">「<?php single_term_title( ); ?>」の記事一覧</h2>
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
			<!--　アーカイブページナビ -->
			<div class="com_wp_pagenavi">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			</div>
			<!--　/アーカイブページナビ --> 			 
		 </div>
	</article>	
</div>
<?php get_footer(); ?>