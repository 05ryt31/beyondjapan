<div id="pankz" class="reset">
	<ul class="flex">
		<?php if (get_post_type() === 'post'): ?>
		<li><a href="/">HOME</a>
			<?php if( is_archive() ) : ?>
			<?php the_archive_title(); ?>
			<?php endif; ?>
			<?php if(is_single() ) : ?>
			<a href="/blog/">お役立ちブログ</a>
			<!--<?php
			$category = get_the_category();
			if ( $category[ 0 ] ) {
				echo '<a href="' . get_category_link( $category[ 0 ]->term_id ) . '">' . $category[ 0 ]->cat_name . '</a>';
			}
			?>-->
			<?php the_title(); ?>
			<?php endif; ?>
		</li>
		<?php elseif (get_post_type() === 'stories'): ?>
		<li>
			<a href="/">HOME</a>
			<?php if ( is_post_type_archive('stories') ) : ?>合格体験記
　　　　　　<?php elseif (is_object_in_term($post->ID, 'stories_cate',array('studyabroad'))): ?>
			留学体験記｜<?php the_title(); ?>
			<?php else : ?>
			<?php if ( is_post_type_archive('stories') ) : ?>合格体験記<?php endif; ?>
			<?php if (is_tax('stories_tag') || is_tax('stories_cate')): ?><a href="/stories/">合格体験記</a><?php single_term_title( ); ?><?php endif; ?>
			<?php if ( is_singular('stories') ) : ?><a href="/stories/">合格体験記</a><?php the_title(); ?><?php endif; ?>
			<?php endif; ?>	
		</li>
		<?php else : ?>
		<?php
		if ( function_exists( 'bcn_display' ) ) {
			// Display the breadcrumb
			echo '<li>';
			bcn_display();
			echo '</li>';
		}
		?>
		<?php endif; ?>
	</ul>
</div>
