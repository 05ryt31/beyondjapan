<article class="goodpatch-blog-article">
	<!-- ヒーローセクション -->
	<div class="blog-hero">
		<div class="blog-hero-background">
			<?php if ( has_post_thumbnail() ) : ?>
				<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'full' ); echo ''.$img_thumbnail[0].'';?>" alt="<?php the_title(); ?>" class="hero-image">
			<?php else: ?>
				<div class="hero-gradient"></div>
			<?php endif; ?>
		</div>
		<div class="blog-hero-content">
			<div class="container">
				<div class="hero-meta">
					<?php $categories = get_the_category(); if($categories): ?>
						<div class="hero-categories">
							<?php foreach( $categories as $cat ): ?>
								<span class="category-pill"><?php echo $cat->name; ?></span>
							<?php endforeach;?>
						</div>
					<?php endif; ?>
					<div class="publish-date">
						<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
					</div>
				</div>
				<h1 class="hero-title"><?php the_title(); ?></h1>
				<?php if(has_excerpt()): ?>
					<p class="hero-excerpt"><?php the_excerpt(); ?></p>
				<?php endif; ?>
				<?php $tags = get_the_tags(); if($tags): ?>
					<div class="hero-tags">
						<?php foreach($tags as $tag): ?>
							<span class="tag-pill">#<?php echo $tag->name; ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- 記事コンテンツ -->
	<div class="blog-content">
		<div class="container">
			<div class="content-wrapper">
				<div class="main-content">
					<div class="article-body">
						<?php the_content(); ?>
					</div>
				</div>
				
				<!-- サイドバー -->
				<aside class="blog-sidebar">
					<!-- 目次 -->
					<div class="sidebar-section">
						<div class="toc-container">
							<h3 class="toc-title">この記事の目次</h3>
							<div id="article-toc" class="toc-list">
								<!-- JavaScript で生成 -->
							</div>
						</div>
					</div>
					
					<!-- 関連記事 -->
					<div class="sidebar-section">
						<h3 class="sidebar-title">関連記事</h3>
						<div class="related-posts">
							<?php
							$categories = get_the_category();
							if ($categories) {
								$category_ids = array();
								foreach($categories as $category) {
									$category_ids[] = $category->term_id;
								}
								$args = array(
									'category__in' => $category_ids,
									'post__not_in' => array(get_the_ID()),
									'posts_per_page' => 3,
									'orderby' => 'rand'
								);
								$related_posts = get_posts($args);
								foreach($related_posts as $post) : setup_postdata($post);
							?>
							<article class="related-post-card">
								<a href="<?php the_permalink(); ?>" class="related-post-link">
									<div class="related-post-image">
										<?php if (has_post_thumbnail()) : ?>
											<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'medium' ); echo ''.$img_thumbnail[0].'';?>" alt="<?php the_title(); ?>">
										<?php else: ?>
											<div class="no-image-placeholder"></div>
										<?php endif; ?>
									</div>
									<div class="related-post-content">
										<h4 class="related-post-title"><?php echo wp_trim_words(get_the_title(), 10); ?></h4>
										<time class="related-post-date"><?php echo get_the_date('Y.m.d'); ?></time>
									</div>
								</a>
							</article>
							<?php 
								endforeach; 
								wp_reset_postdata();
							}
							?>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</article>