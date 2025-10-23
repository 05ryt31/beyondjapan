<div class="note-blog-archive">
	<div class="blog-archive-header">
		<div class="container">
			<h1 class="archive-title">お役立ちブログ</h1>
			<p class="archive-description">留学やキャリアに関する最新情報をお届けします</p>
		</div>
	</div>
	
	<div class="blog-filter-section">
		<div class="container">
			<div class="filter-tabs">
				<ul class="categories-tabs js-switch-tabs">
					<li class="active">全て</li>
					<li>カテゴリー01</li>
					<li>カテゴリー02</li>
					<li>カテゴリー03</li>
				</ul>
			</div>
		</div>
	</div>	
	<div class="blog-content-section">
		<div class="container">
			<div class="js-switch-content active">
				<div id="item-list" data-category="" data-begin="0">
					<div class="item-result note-blog-grid">
						<!-- Ajaxで取得して表示 -->
					</div>	
					<div class="loading-spinner" style="display:none;">
						<div class="spinner"></div>
						<p>読み込み中...</p>
					</div>
					<div class="load-more-section">
						<button class="note-load-more-btn more-btn">
							<span>もっと見る</span>
						</button>
					</div>
				</div>		
			</div>
			<div class="js-switch-content">
				<div class="note-blog-grid">
					<?php
					$paged = (int) get_query_var('paged');
					$args = array(
						'posts_per_page' => 6,
						'paged' => $paged,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'category_name' => 'cate01' //カテゴリースラッグ
					);
					$the_query = new WP_Query($args);
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="category-view-all">
					<a href="/blog/cate01/" class="note-view-all-btn">
						<span>カテゴリー01の一覧を見る</span>
					</a>
				</div>
			</div>
			<div class="js-switch-content">
				<div class="note-blog-grid">
					<?php
					$paged = (int) get_query_var('paged');
					$args = array(
						'posts_per_page' => 6,
						'paged' => $paged,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'category_name' => 'cate02' //カテゴリースラッグ
					);
					$the_query = new WP_Query($args);
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>	
				</div>
				<div class="category-view-all">
					<a href="/blog/cate02/" class="note-view-all-btn">
						<span>カテゴリー02の一覧を見る</span>
					</a>
				</div>
			</div>
			<div class="js-switch-content">
				<div class="note-blog-grid">
					<?php
					$paged = (int) get_query_var('paged');
					$args = array(
						'posts_per_page' => 6,
						'paged' => $paged,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
						'category_name' => 'cate03' //カテゴリースラッグ
					);
					$the_query = new WP_Query($args);
					if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php get_template_part( 'temp/post/_archive_blog_parts' ); ?>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>	
				</div>
				<div class="category-view-all">
					<a href="/blog/cate03/" class="note-view-all-btn">
						<span>カテゴリー03の一覧を見る</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>