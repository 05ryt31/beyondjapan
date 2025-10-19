$(function () {
	$(".drawer-hamburger").on("click", function () {
		$("body").toggleClass("drawer-open");
	});
});

/* ナビゲーション
------------------------------------- */
if ($('.dropdown-tit span').length) {
	$('.dropdown-tit span').on('click', function () {
		$(this).toggleClass('on');
		$(this).next('.dropdown-menu').slideToggle('fast');
	});
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".dropdown-menu").forEach(function (menu) {
    menu.addEventListener("click", function () {
      document.body.classList.remove("drawer-open");
    });
  });
});

/* js-switch-tabs
------------------------------------- */
if ($('.js-switch-tabs').length) {
	$('.js-switch-tabs li').on('click', function () {
		//num set
		var num = $('.js-switch-tabs li').index(this);

		//class="active" set in content
		$('.js-switch-content').removeClass('active');
		$('.js-switch-content').eq(num).addClass('active');

		//class="active" set in tab
		$('.js-switch-tabs li').removeClass('active');
		$(this).addClass('active');
	});
}


/* スクロールでクラスfixedをつけはずし
------------------------------------- */
$(function() {
	$(window).scroll(function () {
	if ($(this).scrollTop() > 100) {
				   /**  **/
	$('body').addClass("fixed");
	} else {
	$('body').removeClass("fixed");
	}
	});
	});

/* js-switch-img
------------------------------------- */
var imageSwitch = true;
if(imageSwitch){
	$(function() {
		var replaceWidth = 768.9;
		function imageSwitch(){
			var windowWidth = parseInt($(window).width());
			$('img[src*="_sp."],img[src*="_pc."]').each(function(){
				if(windowWidth >= replaceWidth){
					$(this).attr('src',$(this).attr('src').replace('_sp.', '_pc.'));
				}else{
					$(this).attr('src',$(this).attr('src').replace('_pc.', '_sp.'));
				}
			});
		}
		imageSwitch();
		var resizeTimer;
		$(window).on('resize',function(){
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function(){
				imageSwitch();
			},200);
		});
	});
}	