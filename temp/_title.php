<?php global $cfs ;?>
<div class="reset">
	<?php if(is_page( array( 'plan_uc' ) )) : ?>
	<section class="plan-title uc">
		<div class="plan-title-block">
			<div class="container">
				<div class="plan-title-block-item">
					<h2 class="title">カリフォルニア大学編入プラン</h2>
					<p class="lead">夢の一流大学へ<br>
						賢く最短ルートで!</p>
				</div>
			</div>
		</div>
	</section>
	<?php elseif(is_page( array( 'plan_all' ) )) : ?>
	<section class="plan-title all">
		<div class="plan-title-block">
			<div class="container">
				<div class="plan-title-block-item">
					<h2 class="title">全米大学編入プラン</h2>
					<p class="lead">全米大学の理想のキャンパスへ<br>
						アイビーリーグも夢じゃない</p>
				</div>
			</div>
		</div>
	</section>
	<?php elseif(is_page( array( 'plan_canada' ) )) : ?>
	<section class="plan-title canada">
		<div class="plan-title-block">
			<div class="container">
				<div class="plan-title-block-item">
					<h2 class="title">カナダ大学編入プラン</h2>
					<p class="lead">費用もビザも安心<br>
						堅実で確かな留学</p>
				</div>
			</div>
		</div>
	</section>
	<?php elseif(is_page( array( 'plan_full' ) )) : ?>
	<section class="plan-title full">
		<div class="plan-title-block">
			<div class="container">
				<div class="plan-title-block-item">
					<h2 class="title">フルサポートプラン</h2>
					<p class="lead">留学の不安をまるごと解決<br>弊社オリジナルな<br class="view-sp">完全留学サポートプラン</p>
				</div>
			</div>
		</div>
	</section>
	<?php elseif (is_post_type_archive('stories')): ?>
	<section class="stories-title">
		<div class="stories-title-block">
			<div class="container">
				<div class="stories-title-block-item">
					<h2 class="title">留学体験記</h2>
					<p class="lead">迷いも不安も超えて<br>“海外大学”という選択。</p>
				</div>
			</div>
		</div>
	</section>
	<?php elseif (get_post_type() === 'stories'): ?>
	<?php if (is_object_in_term($post->ID, 'stories_cate',array('studyabroad'))): ?>
	<section class="stories-title studyabroad">
	<?php else : ?>
	<section class="stories-title">
	<?php endif; ?>	
		<div class="stories-title-block">
			<div class="container">
				<div class="stories-title-block-item">
					<?php if (is_object_in_term($post->ID, 'stories_cate',array('studyabroad'))): ?>
					<h2 class="title">留学体験記</h2>
					<p class="lead">一歩外に出たら、<br>自分の可能性が広がっていた</p>
					<?php else : ?>
					<h2 class="title">合格体験記</h2>
					<p class="lead">迷いも不安も超えて<br>“海外大学”という選択。</p>
					<?php endif; ?>	
				</div>
			</div>
		</div>
	</section>
	
	<?php else : ?>
	<div class="com-pagetit">
		<div class="container">
			<?php if (is_page()) : ?>
			<h1 class="ja"><?php the_title(); ?></h1>
			<?php elseif(is_404()): ?>
			<h1 class="ja">404エラー</h1>
			<?php elseif (get_post_type() === 'news'): ?>
			<h1 class="ja">お知らせ</h1>	
			<?php elseif(is_archive()) : ?>
			<?php
			// 現在表示しているカテゴリーのスラッグ取得
			$category = get_the_category();
			$cat_slug = $category[ 0 ]->category_nicename;
			$cat_name = $category[ 0 ]->cat_name;
			?>
			<h1 class="ja">お役立ちブログ</h1>
			<?php elseif(is_category() || is_single()) : ?>
			<p class="ja"> お役立ちブログ</p>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>		
<?php get_template_part( 'temp/_breadcrumb' ); ?>
