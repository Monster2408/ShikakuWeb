$(document).ready(function(){
	$("#topBtn").hide();
	$(window).on("scroll", function() {
		if ($(this).scrollTop() > 100) {
			$("#topBtn").fadeIn("fast");
		} else {
			$("#topBtn").fadeOut("fast");
		}
		scrollHeight = $(document).height(); //ドキュメントの高さ 
		scrollPosition = $(window).height() + $(window).scrollTop(); //現在地 
		footHeight = $("footer").innerHeight(); //footerの高さ（＝止めたい位置）
		width = window.innerWidth;
		if ( $(".footer-mc").innerHeight() > 0 ) {
			footHeight = footHeight + $(".footer-mc").innerHeight();
		}

		if ( scrollHeight - scrollPosition <= footHeight ) { //ドキュメントの高さと現在地の差がfooterの高さ以下になったら
			if ( width <= 500 ) {
				$("#topBtn").css({
					"position":"absolute", //pisitionをabsolute（親：wrapperからの絶対値）に変更
					"bottom": footHeight + 70 //下からfooterと広告(JMC)の高さ + 20px上げた位置に配置
				});
			} else {
				$("#topBtn").css({
					"position":"absolute", //pisitionをabsolute（親：wrapperからの絶対値）に変更
					"bottom": footHeight + 20 //下からfooterと広告(JMC)の高さ + 20px上げた位置に配置
				});
			}
		} else { //それ以外の場合は
			if ( width <= 500 ) {
				$("#topBtn").css({
					"position":"fixed", //pisitionをabsolute（親：wrapperからの絶対値）に変更
					"bottom": "70px" //下からfooterと広告(JMC)の高さ + 20px上げた位置に配置
				});
			} else {
				$("#topBtn").css({
					"position":"fixed", //pisitionをabsolute（親：wrapperからの絶対値）に変更
					"bottom": "20px" //下からfooterと広告(JMC)の高さ + 20px上げた位置に配置
				});
			}
		}
	});
	$('#topBtn').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
});
jQuery(function(){
	jQuery('a[href^="#"]').click(function() {
		var speed = 1000; // スピード 1000 で
		var href= jQuery(this).attr("href"); 
		var target = jQuery(href == "#" || href == "" ? 'html' :href);
		var headerHeight = 42; // ヘッダの高さ 
		var position = target.offset().top - headerHeight; // トップからヘッダの高さ分下まで
		jQuery('body,html').animate({scrollTop:position}, speed, 'swing');
		return false;
	});
});