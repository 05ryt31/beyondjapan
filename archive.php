<?php
get_header();
$cat_info         = get_category( $cat );
$blog_scope       = get_query_var( 'blog_scope' );
$is_blog_archive  = ( get_post_type() === 'post' ) && ( is_archive() || is_single() || is_page( array( 'blog' ) ) );
?>
<div class="post">
	<article class="archive reset">
	<?php if ( get_post_type() === 'post' ) : ?>
	<?php if ( is_archive() && 'all' !== $blog_scope ) : ?>
	<?php get_template_part( 'temp/post/_archive_blog_slide' ); ?>
	<?php endif; ?>
	<?php elseif ( is_post_type_archive( 'stories' ) ) : ?>
	<?php get_template_part( 'temp/post/_archive_stories_slide' ); ?>
	<?php endif; ?>

	<?php if ( $is_blog_archive && 'all' !== $blog_scope ) : ?>
		<?php get_template_part( 'temp/post/_archive_blog' ); ?>
	<?php else : ?>
		<div class="container">
			<?php if ( get_post_type() === 'stories' ) : ?>
				<?php get_template_part( 'temp/post/_archive_stories' ); ?>
			<?php elseif ( get_post_type() === 'news' ) : ?>
				<?php get_template_part( 'temp/post/_archive_news' ); ?>
			<?php elseif ( is_archive() || is_single() || is_page( array( 'blog' ) ) ) : ?>
				<?php if ( 'all' === $blog_scope ) : ?>
					<?php get_template_part( 'temp/post/_archive_blog_all' ); ?>
				<?php else : ?>
					<?php get_template_part( 'temp/post/_archive_blog' ); ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( is_post_type_archive( 'stories' ) ) : ?>
			<!--　アーカイブページナビ -->
			<div class="com_wp_pagenavi">
				<?php if ( function_exists( 'wp_pagenavi' ) ) { wp_pagenavi(); } ?>
			</div>
			<!--　/アーカイブページナビ --> 
			<?php endif; ?>
		</div>
	<?php endif; ?>
	</article>	
</div>
<?php get_footer(); ?>