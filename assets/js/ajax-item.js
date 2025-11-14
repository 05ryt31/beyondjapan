jQuery(function() {
/* 初期設定 */
let el = document.getElementById("item-list");
let cat = el.dataset.category;
let beg = el.dataset.begin;
let postNumNow = Number(beg);
let postNumAdd = 3; // 一度に表示する数
/* 最初の一回読み込み */
window.onload = loading1();
/* more_btnで読み込み */
$('.more-btn').click(function() {
loading2();
});
/* 情報取得関数 */
function loading1(){
jQuery.ajax({
type: "POST",
url: 'http://beyondjp.net/wp-content/themes/beyondjapan/ajax-item.php', // フルパスで指定
data: {
post_num_now: postNumNow,
post_num_add: postNumAdd,
category_name: cat
},
success: function(response) {
jQuery(".item-result").append(response);
postNumNow += postNumAdd;
}
});
}
function loading2(){
jQuery(".more_btn").hide();
jQuery(".loading").show();
jQuery.ajax({
type: "POST",
url: 'http://beyondjp.net/wp-content/themes/beyondjapan/ajax-item.php', // フルパスで指定
data: {
post_num_now: postNumNow,
post_num_add: postNumAdd,
category_name: cat
},
success: function(response) {
jQuery(".item-result").append(response);
jQuery(".more-btn").show();
jQuery(".loading").hide();
postNumNow += postNumAdd;
}
});
}
});