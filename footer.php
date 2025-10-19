</main>
<!-- /main -->
</div>
<!-- /#contents -->
<!--<div id="js-pagetop" class="pageTop"><a href="#Top">ページトップへ</a></div> -->

<!-- #gFooter -->
<div id="gFooter" class="reset">
	<footer class="footer">
		<div class="container">
			<div class="footer-col">
				<div class="footer-col-left">
					<p class="footer-logo"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/logo_f.png" alt=""/></p>
					<p class="footer-name"><small>株式会社</small> Beyond Japan</p>
				</div>
				<div class="footer-col-right">
					<nav class="footer-navi">
						<div class="footer-navi-list">
							<p>編入制度について</p>
							<ul class="list2nd">
								<li><a href="<?php echo home_url('/transfer/'); ?>">編入制度について</a></li>
								<li><a href="<?php echo home_url('/transfer_flow/'); ?>">編入までの流れ</a></li>
							</ul>
						</div>
						<div class="footer-navi-list">
							<p>プラン</p>
							<ul class="list2nd">
								<li><a href="<?php echo home_url('/plan_uc/'); ?>">カリフォルニア大学編入プラン</a></li>
								<li><a href="<?php echo home_url('/plan_all/'); ?>">全米大学編入プラン</a></li>
								<li><a href="<?php echo home_url('/plan_canada/'); ?>">カナダ大学編入プラン</a></li>
								<li><a href="<?php echo home_url('/plan_full/'); ?>">フルサポートプラン</a></li>
							</ul>
						</div>
						<div class="footer-navi-list">
							<p>私たちについて</p>
							<ul class="list2nd">
								<li><a href="<?php echo home_url('/about/'); ?>">私たちの想い</a></li>
								<li><a href="<?php echo home_url('/about/#sec02'); ?>">ごあいさつ</a></li>
								<li><a href="<?php echo home_url('/about/#sec03'); ?>">会社情報</a></li>
							</ul>
						</div>
						<div class="footer-navi-list">
						<ul>
							<li><a href="<?php echo home_url('/news/'); ?>">お知らせ</a></li>
							<li><a href="<?php echo home_url('/blog/'); ?>">お役立ちブログ</a></li>
							<li><a href="<?php echo home_url('/stories/'); ?>">留学体験記</a></li>
							<li><a href="<?php echo home_url('/low/'); ?>">特定商取引法に基づく表示</a></li>
							<li><a href="<?php echo home_url('/low/'); ?>">規約</a></li>
						</ul>
						</div>

					</nav>
				</div>
			</div>
			<div class="contact">
				<p><a href="<?php echo home_url('/contact/'); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/icon_mail_w.png" alt=""/>無料カウンセリング</a></p>
			</div>
			<div class="footer-copy">
				<p>Copyright 2025  株式会社  Beyond Japan All rights reserved.</p>
			</div>
		</div>
	</footer>
</div>
<!-- /#gFooter -->
</div>
</div>
<!-- /#wrap -->

<div class="followerBanner reset">
	<ul>
		<li class="line"><a target="_blank" href="https://page.line.me/601lqdhg">LINE無料相談<img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_btn01.png" alt=""/></a></li>
		<li><a href="<?php echo home_url('/contact/'); ?>">無料カウンセリング<img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_btn02.png" alt=""/></a></li>
	</ul>
</div>

<?php wp_footer(); ?>
<!-- js -->
<script src="https://code.jquery.com/jquery-3.7.1.js"  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/common.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/ajax-item.js"></script>
<!-- scrollable --> 
<script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function () {
    new ScrollHint('.js-scrollable', {
      i18n: {
        scrollable: "スクロールできます"
      }
    });
  });
</script>
<!-- scrollable --> 
<!-- /js -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$('.slid_banner').slick({
  infinite: true,
  arrows:  true,
  prevArrow: '<p class="prev-arrow"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_arrow01.png" alt=""/></p>',
  nextArrow: '<p class="next-arrow"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_arrow01.png" alt=""/></p>',
  dots: true,
  slidesToShow: 2,
  speed: 1000,
  fade: false,
  autoplay: true,
  cssEase: 'linear',
  centerMode:false,
  centerPadding:'0',
  variableWidth: false,
	responsive: [
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 2,

  				variableWidth: false,
			},
		}
	]
});

$('.slid_blog').slick({
  infinite: true,
  arrows:  true,
  prevArrow: '<p class="prev-arrow"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_arrow01.png" alt=""/></p>',
  nextArrow: '<p class="next-arrow"><img src="<?php bloginfo('template_directory'); ?>/assets/image/common/ico_arrow01.png" alt=""/></p>',
  dots:  true,
  slidesToShow: 2,
  speed: 1000,
  fade: false,
  autoplay: true,
  cssEase: 'linear',
  centerMode: true,
  centerPadding:'20%',
  variableWidth: false,
	responsive: [
		{
			breakpoint:999,
			settings: {
			slidesToShow: 1,
				vertical: false,
				arrows: true,
				dots:  false,
				centerPadding:'2%',
			}
		}
	]
});
</script>
<?php if ( is_home() || is_front_page() ) : ?>

<?php endif; ?>

</body></html>