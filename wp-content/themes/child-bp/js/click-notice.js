jQuery(document).ready(function($){ 
	//グループページ
	var $contents = $(".bpfb_images .thickbox"),
		contentsWid = $contents.outerWidth(true),
		contentsLen = $contents.length;
	$(".bpfb_images").width(contentsWid * contentsLen);
	$(".bpfb_images br").remove();	

	//プロフィールページ
	$("#user-notifications .no-count").append(' 件');	
	$("#user-notifications .count").append(' 件');	
	$("#groups-personal-li .no-count").append(' 件');	
	$("#groups-personal-li .count").append(' 件');	

	$("#user-notifications .no-count").prepend('承認リクエスト ');	
	$("#user-notifications .count").prepend('承認リクエスト ');	
	$("#groups-personal-li .no-count").prepend('参加グループ ');	
	$("#groups-personal-li .count").prepend('参加グループ ');	

	$("#notifications-my-notifications-personal-li #notifications-my-notifications").html('未読');	
	$("#read-personal-li #read").html('過去のお知らせ');	

	//トップページログイン表示切替
	$(function(){
	    $("#top-login-form").css("display", "none");
	    $(".login-button").click(function(){
	        $("#top-login-form").animate( { height: 'toggle' }, 'normal' );
	    });
	});

	//グループバリデーション

	//ユーザー登録
	$(function(){
	　$("#basic-details-section #signup_username").each(function(){
	　　$(this).bind('keyup', enterform(this));
	　});
	});
	
	function enterform(elm){
	　var v, old = elm.value;
	　return function(){
	　　if(old != (v=elm.value)){
	　　　old = v;
			str = $(this).val();
			$('#profile-details-section #field_1').text(str);
	　　}
	　}
	}	

	//リサイズ処理
	var timer = false;
	$(window).resize(function() {
	    if (timer !== false) {
	        clearTimeout(timer);
	    }
	    timer = setTimeout(function() {
	        console.log('resized');
	        // 何らかの処理
	    }, 200);
	});

});
