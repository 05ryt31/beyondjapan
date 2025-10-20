	<section class="cv_member">
		<div class="cv_member-block">
			<div class="col">
				<div class="col-left">
					<div class="col-left-box">
						<p class="lead">留学のExpert（専門）である</p>
						<h2 class="title">運営メンバーご紹介</h2>
						<!--<p><a href="#">一覧をみる</a></p>-->
					</div>
				</div>
				<div class="col-right">
					<div class="slid_banner">
						<?php
						global $post;
						$args = array(
						'post_type' => 'stories',
						'tax_query' => array(
							array(
								'taxonomy' => 'stories_cate',
								'field' => 'slug',
								'terms' => 'studyabroad',
								//'operator' => 'NOT IN',// 指定したタームを除外
								'numberposts' => 5
							),
						),
						);					
						$myposts = get_posts( $args );
						foreach ( $myposts as $post ): setup_postdata( $post );
						?>
						<div class="slide-item">
							<div class="slide-item-left">
								<p class="lead"><?php the_field('stories_title'); ?></p>
								<p class="name"><?php the_title(); ?></p>
								<dl>
									<dt>役職</dt>
									<dd><?php the_field('stories_position'); ?></dd>
								</dl>
								<p><b><?php the_field('stories_university'); ?></b>　編入</p>
								<p class="link"><a href="<?php the_permalink(); ?>?post_id=<?php echo $post->ID; ?>">詳しく見る<img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_arrow02.png" alt=""/></a></p>
							</div>
							<div class="slide-item-right">
								<p>
								<?php if( get_field('stories_pic') ):?>
								<img src="<?php the_field('stories_pic');?>" alt="">
								<?php else:?>
								<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">			
								<?php endif; ?>
								</p>
							</div>
						</div>
	<?php endforeach; ?>
	<?php wp_reset_query(); ?>

					</div>
				</div>
			</div>
		</div>
	</section>
