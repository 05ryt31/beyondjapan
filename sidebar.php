					<aside>
						<h3 class="side_tit en">Latest</h3>
<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => 'post',
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>						
						<dl>
							<dt>
								<time ><?php the_time('Y.m.d'); ?></time>
								<!--<span class="cate">
  <?php
    // カテゴリーをリンクで繰り返し表示
    $categories = get_the_category();
    foreach( $categories as $cat ):
  ?>
<a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a>
  <?php endforeach;?>
								</span>--></dt>
							<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
						</dl>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
						<h3 class="side_tit en">Category</h3>
						<ul>					
							<?php wp_list_categories('title_li='); ?>
						</ul>
						<h3 class="side_tit en">Archive</h3>
						<div class="select_arrow01">
<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
	<option value="">年を選択</option>
	<?php
	wp_get_archives (array(
		'type' => 'yearly',
		'format' => 'option',
		'post_type' => 'news'
	)); 
	?>
</select>
						</div>
					</aside>