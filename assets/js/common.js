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

/* Note風 History/目次の折りたたみ機能
------------------------------------- */
function toggleHistory() {
	var body = document.getElementById('history-body');
	var icon = document.getElementById('history-icon');
	
	if (body.classList.contains('expanded')) {
		body.classList.remove('expanded');
		body.classList.add('collapsed');
		icon.classList.add('collapsed');
	} else {
		body.classList.remove('collapsed');
		body.classList.add('expanded');
		icon.classList.remove('collapsed');
	}
}

/* Goodpatch風 ブログ記事目次の自動生成
------------------------------------- */
document.addEventListener('DOMContentLoaded', function() {
	// 目次の自動生成（ブログ記事用）
	function generateTableOfContents() {
		var tocContainer = document.getElementById('article-toc');
		if (!tocContainer) return;
		
		var articleBody = document.querySelector('.article-body');
		if (!articleBody) return;
		
		var headings = articleBody.querySelectorAll('h2, h3, h4');
		if (headings.length === 0) {
			tocContainer.innerHTML = '<p style="color: #6b7280; font-size: 0.875rem;">目次項目がありません</p>';
			return;
		}
		
		var tocList = document.createElement('ul');
		tocList.className = 'toc-list';
		
		headings.forEach(function(heading, index) {
			// 見出しにIDを追加
			if (!heading.id) {
				heading.id = 'heading-' + index;
			}
			
			var listItem = document.createElement('li');
			listItem.className = 'toc-item ' + heading.tagName.toLowerCase();
			
			var link = document.createElement('a');
			link.href = '#' + heading.id;
			link.textContent = heading.textContent;
			link.addEventListener('click', function(e) {
				e.preventDefault();
				document.getElementById(heading.id).scrollIntoView({
					behavior: 'smooth'
				});
			});
			
			listItem.appendChild(link);
			tocList.appendChild(listItem);
		});
		
		tocContainer.appendChild(tocList);
	}
	
	// ページ読み込み時に目次を生成
	generateTableOfContents();
	
	// スムーススクロールの強化
	document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
		anchor.addEventListener('click', function(e) {
			e.preventDefault();
			var target = document.querySelector(this.getAttribute('href'));
			if (target) {
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		});
	});
});	