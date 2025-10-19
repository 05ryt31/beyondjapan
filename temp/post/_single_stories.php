<?php if (is_object_in_term($post->ID, 'stories_cate',array('studyabroad'))): ?>
　　　　<section class="studyabroad">
			<div class="container">
				<?php the_content(); ?>
			</div>
　　　　</section>
<section class="profile reset">
			<div class="container">
				<div class="profile-col">
					<div>
						<div class="thumbnail">
							<p>
								<?php if( get_field('stories_pic') ):?>
								<img src="<?php the_field('stories_pic');?>" alt="">
								<?php else:?>
								<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">			
								<?php endif; ?>
							</p>
						</div>
					</div>
					<div>
						<table>
							<tr>
								<th>名前</th>
								<td><?php the_title(); ?></td>
							</tr>
							<?php if( get_field('stories_communitycolleg') ):?>
							<tr>
								<th>コミカレ名</th>
								<td><?php the_field('stories_communitycolleg'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_university') ):?>
							<tr>
								<th>大学名</th>
								<td><?php the_field('stories_university'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_company') ):?>
							<tr>
								<th>所属</th>
								<td><?php the_field('stories_company'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_post') ):?>
							<tr>
								<th>役職</th>
								<td><?php the_field('stories_post'); ?></td>
							</tr>
							<?php endif; ?>	
						</table>
					</div>
				</div>
			</div>
		</section>
<?php else : ?>
<section class="profile reset">
			<div class="container">
				<div class="profile-col">
					<div>
						<div class="thumbnail">
							<p>
								<?php if( get_field('stories_pic') ):?>
								<img src="<?php the_field('stories_pic');?>" alt="">
								<?php else:?>
								<img src="<?php print get_template_directory_uri(); ?>/assets/image/common/noimage.png" alt="">			
								<?php endif; ?>
							</p>
						</div>
						<div class="tag">
							<?php $terms = get_the_terms($post->ID, 'stories_tag'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'stories_tag').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<div>
						<div class="cate">
							<?php $terms = get_the_terms($post->ID, 'stories_cate'); ?>
							<?php if($terms): ?>
							<?php foreach($terms as $term): ?>
							<?php echo '<a href="'.get_term_link($term->slug,'stories_cate').'">'.$term->name.'</a>'; ?>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<h1 class="title">
							<?php echo nl2br(get_post_meta($post->ID, 'stories_title', true)); ?>
						</h1>
						<table>
							<tr>
								<th>名前</th>
								<td><?php the_title(); ?></td>
							</tr>
							<?php if( get_field('stories_communitycolleg') ):?>
							<tr>
								<th>コミカレ名</th>
								<td><?php the_field('stories_communitycolleg'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_university') ):?>
							<tr>
								<th>大学名</th>
								<td><?php the_field('stories_university'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_company') ):?>
							<tr>
								<th>勤務先</th>
								<td><?php the_field('stories_company'); ?></td>
							</tr>
							<?php endif; ?>	
							<?php if( get_field('stories_post') ):?>
							<tr>
								<th>役職</th>
								<td><?php the_field('stories_post'); ?></td>
							</tr>
							<?php endif; ?>	
						</table>
					</div>
				</div>
			</div>
		</section>
	<?php the_content(); ?>
<?php endif; ?>	

