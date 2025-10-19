						<div class="post-archive-item">
							<p>
								<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : // サムネイルを持っているときの処理 ?>
					<img src="<?php $img_id = get_post_thumbnail_id(); $img_thumbnail = wp_get_attachment_image_src( $img_id , 'thum1000' ); echo ''.$img_thumbnail[0].'';?>">
					<?php else: // サムネイルを持っていないときの処理 ?>
					<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">		
					<?php endif; ?>	
								</a>  
							</p>
							<p class="item-txt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						</div>