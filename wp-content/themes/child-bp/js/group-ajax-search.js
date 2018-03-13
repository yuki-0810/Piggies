jQuery(document).ready(function($){ 
    // 2重クリック防止フラグ
    var click_flag = true;
 
    // ボタンクリックイベント
    $('#search_sample_button').keypress(function(e){
		if ( e.which == 13 ) {
            $('.result li').remove();
            $('.result').append('<li class="loading">読み込み中</li>');
            // セレクトボックスで選択されているvalueを取得
            var select_01 = $('.class_search_box').val();
            //alert(select_01);
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    // データ受け渡し
                    'select_01' : select_01,
                    'action' : 'ajax_get_posts',
                },
                success: function( response ) {
                    $('.result .loading').remove();
                    jsonData = JSON.parse( response );
                    var count = jsonData.length;
                    if ( count == '0' ) {
                        // 検索結果がない場合
                        $('.result').append('<li>検索結果がありません。</li>');
                    } else {
                        // リストに出力
                        $.each( jsonData, function( i, val ) {
                        $('.result').append('<li><a class="search-lists" href="' + val['group_permalink'] + '">' + val['group_name'] + '<p>' + val['group_gakubu'] + '<span>' + val['group_teacher'] + '</span></p>' + '</a>' + val['group_join_button'] + '</li>');
                        });
                    }
				 	//alert( response );
                },
                error: function( response ) {
                    // ajaxエラーの場合
                    $('.result .loading').remove();
                    $('.result').append('<li>エラーが起こりました。お手数ですがページの再読み込みを行ってください。</li>');
                }
            });
        }
    });
});
