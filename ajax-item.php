<?php
require_once '../../../wp-load.php';
$offset         = isset( $_POST['post_num_now'] ) ? $_POST['post_num_now'] : 1;
$posts_per_page = isset( $_POST['post_num_add'] ) ? $_POST['post_num_add'] : 0;
$category_name  = isset( $_POST['category_name'] ) ? $_POST['category_name'] : "";
$response = "";
$ajax_query = new WP_Query(
array(
'post_type' => 'post',
'posts_per_page' => $posts_per_page,
'offset' => $offset,
'category_name' => $category_name,
'orderby' => 'date',
'order' => 'DESC'
)
);
if ( $ajax_query->have_posts() ) :
while ( $ajax_query->have_posts() ) :
$ajax_query->the_post();
/* 投稿情報取得 */
$thumbnail  = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
$url        = get_permalink();
$title      = get_the_title();
$date       = get_the_date('Y.m.d');
$cat = get_the_category();
$cat = $cat[0];
$caturl = get_category_link($cat->term_id);

        /* タグ取得 */
        $tags = get_the_tags();
        $tag_html = '';
        if ( $tags ) {
            foreach ( $tags as $tag ) {
                $tag_link = get_tag_link( $tag->term_id );
                $tag_html .= '<a href="' . esc_url( $tag_link ) . '">' . esc_html( $tag->name ) . '</a> ';
            }
        }

/* 挿入HTML生成 */
$response .= '<div class="item">';
$response .= '<p class="thumbnail"><a href="'.$url.'"><img src="'.$thumbnail.'" alt=""/></a></p>';
$response .= '<div>';
$response .= '<h2 class="title"><a href="'.$url.'">'.$title.'</a></h2>';
$response .= '<div class="tag">'.$tag_html.'</div>';
$response .= '<div class="cate"><a href="'.$caturl.'">'.$cat->cat_name.'</a></div>';
$response .= '</div>';
$response .= '</div>';
endwhile;
endif;
echo $response;
wp_reset_postdata();
?>