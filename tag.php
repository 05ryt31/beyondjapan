<?php get_header();?>
<div class="post">
	<article class="archive reset">
		<div class="container">
			<header class="archive-tit">
				<h2>「<?php single_term_title( ); ?>」の記事一覧</h2>
			</header>
			<div class="col3">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>	
			</div>
		</div>
			<!--　アーカイブページナビ -->
			<div class="com_wp_pagenavi">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			</div>
			<!--　/アーカイブページナビ --> 
	</article>
</div>
<?php get_footer(); ?>