<?php
global $post;
$args = array(
	'post_type' => 'news',
	'numberposts' => 1
);
$myposts = get_posts( $args );
foreach ( $myposts as $post ): setup_postdata( $post );
?>
<dl>
	<dt><?php the_time('Y.n.j'); ?></dt>
	<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
</dl>
<?php endforeach; ?>
<?php wp_reset_query(); ?>