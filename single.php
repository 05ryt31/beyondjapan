<?php get_header();?>
<div class="post">
	<article class="single">
		<?php if (get_post_type() === 'stories'): ?>
		<?php get_template_part( 'temp/post/_single_stories' ); ?>
		<?php elseif (get_post_type() === 'news'): ?>
		<?php get_template_part( 'temp/post/_single_news' ); ?>
		<?php elseif(is_archive() || is_single() ||is_page( array( 'blog' ) )) : ?>
		<?php get_template_part( 'temp/post/_single_blog' ); ?>
		<?php endif; ?>
		<!--　シングル記事ページャー 
		 <div class="container">
			 <div class="reset">
                
                <ul class="com_wp_btn01">
                    <li><?php previous_post_link('%link', '前の記事'); ?></li>
					<?php if (get_post_type() === 'stories'): ?>
					<li><a href="/stories/">一覧へ戻る</a></li>
					<?php elseif (get_post_type() === 'blog'): ?>
					<li><a href="/blog/">一覧へ戻る</a></li>
					<?php elseif (get_post_type() === 'training'): ?>
					<li><a href="/training/">一覧へ戻る</a></li>
					<?php elseif(is_archive() || is_single() ||is_page( array( 'document' ) )) : ?>
					<li><a href="/document/">一覧へ戻る</a></li>
					<?php endif; ?>
                    <li><?php next_post_link('%link', '次の記事'); ?></li>
                 </ul>
                　
			</div>	 
		 </div>
/シングル記事ページャー --> 
	</article>
	<div class="reset">
		<?php get_template_part( 'temp/_cv-contact' ); ?>
	</div>	
</div>
<?php get_footer(); ?>