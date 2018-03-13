<?php get_header(); ?>
<?php

$user_id = get_current_user_id();
$args_uni = array(
    'field'     => '大学名',
    'user_id'   => $user_id,
);
$uni_name = bp_get_profile_field_data( $args_uni );

if($uni_name === '東京大学'){
	$args = array(
	    'field'     => '学部(東大)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}elseif($uni_name === '早稲田大学'){
	$args = array(
	    'field'     => '学部(早稲田)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );

}elseif($uni_name === '慶応大学'){
	$args = array(
	    'field'     => '学部(慶応)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}elseif($uni_name === '明治大学'){
	$args = array(
	    'field'     => '学部(明治)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}elseif($uni_name === '青山学院大学'){
	$args = array(
	    'field'     => '学部(青山)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );

}elseif($uni_name === '立教大学'){
	$args = array(
	    'field'     => '学部(立教)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}elseif($uni_name === '中央大学'){
	$args = array(
	    'field'     => '学部(中央)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}elseif($uni_name === '法政大学'){
	$args = array(
	    'field'     => '学部(法政)',
	    'user_id'   => $user_id,
	);
	$gakubu = bp_get_profile_field_data( $args );
}else{
	$gakubu = '';
}
?>

<?php 
if ( is_user_logged_in() ) :

//参加していないグループのパラメータ
$args_test = array(
	'type'	=> 'popular',
	'meta_query' => array(
					'relation' => 'AND',
						array(
							'key' => 'university-name',
							'value' => $uni_name,
							'compare' => '=',
						),
						array(
							'key' => 'university-major',
							'value' => $gakubu,
							'compare' => '=',
						),
					),
	'per_page' => '100',
	'max' => '100',
);

//参加グループパラメータ
$args_join = array(
	'type'	=> 'active',
	'max' => '30',
	'user_id' => $user_id,
	'per_page' => '30',
	'max' => '30'
);

//インディケーター%比較配列
$i = 0;
$join_group = array();

?>
    <ul class="grid-list">
	<!--メンバーが属しているグループ表示 -->
	<?php $user_id = bp_loggedin_user_id(); if ( bp_has_groups( $args_join ) ) : ?>
    	<?php while ( bp_groups() ) : bp_the_group(); $i++; ?>
        <li>
            <div>
                <a href="<?php bp_group_permalink() ?>"><img src="
				<?php
					$dir_url = get_stylesheet_directory_uri(); 
					if( $i === 1 ){
						$select_img_path = '/resources/images/color1.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 2){
						$select_img_path = '/resources/images/color2.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 3){
						$select_img_path = '/resources/images/color3.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 4){
						$select_img_path = '/resources/images/color4.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 5){
						$select_img_path = '/resources/images/color5.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 6){
						$select_img_path = '/resources/images/color6.png';
						echo $dir_url.$select_img_path;
						$i = 0;
					//}elseif($i === 7){
					//	$select_img_path = '/resources/images/color7.png';
					//	echo $dir_url.$select_img_path;
					//}elseif($i === 8){
					//	$select_img_path = '/resources/images/color8.png';
					//	echo $dir_url.$select_img_path;
					//	$i = 0;
					}else{
						$select_img_path = '/resources/images/color1.png';
						echo $dir_url.$select_img_path;
					}
				?>" 
				alt=""></a>
            	<div class="item">
            	    <span class="item-title"><a class="class_title" href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></span>
            	    <span class="item-desc"><?php echo "<p>" . custom_field('university-teacher') . "</p>"; ?></span>	
            	    <?php do_action( 'bp_directory_groups_item' ) ?>
            	</div>
            </div>
        </li>
		<?php $join_group[] = bp_get_group_id(); ?>
    	<?php endwhile; ?>
 	<?php endif;?>

<?php if ( bp_has_groups($args_test) ) : ?>
 
	<!--メンバーが属していないグループ表示 -->
    <?php while ( bp_groups() ) : bp_the_group(); ?>
		<?php $now_group_id = bp_get_group_id();?>
		<?php if( !in_array( $now_group_id ,$join_group, true )): $i++;?>
        <li class="non-join">
            <div>
                <a href="<?php bp_group_permalink() ?>"><img src="
				<?php
					$dir_url = get_stylesheet_directory_uri(); 
					if( $i === 1 ){
						$select_img_path = '/resources/images/color1.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 2){
						$select_img_path = '/resources/images/color2.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 3){
						$select_img_path = '/resources/images/color3.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 4){
						$select_img_path = '/resources/images/color4.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 5){
						$select_img_path = '/resources/images/color5.png';
						echo $dir_url.$select_img_path;
					}elseif($i === 6){
						$select_img_path = '/resources/images/color6.png';
						echo $dir_url.$select_img_path;
						$i = 0;
					//}elseif($i === 7){
					//	$select_img_path = '/resources/images/color7.png';
					//	echo $dir_url.$select_img_path;
					//}elseif($i === 8){
					//	$select_img_path = '/resources/images/color8.png';
					//	echo $dir_url.$select_img_path;
					//	$i = 0;
					}else{
						$select_img_path = '/resources/images/color1.png';
						echo $dir_url.$select_img_path;
					}
				?>" 
				alt=""></a>
            	<div class="item">
            	    <span class="item-title"><a class="class_title" href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></span>
            	    <span class="item-desc"><?php echo "<p>" . custom_field('university-teacher') . "</p>"; ?></span>	
            	    <?php do_action( 'bp_directory_groups_item' ) ?>
            	</div>
            </div>
        </li>
		<?php endif;?>
    <?php endwhile; ?>
    <div class="pagination">
        <div class="pagination-links" id="group-dir-pag">
            <?php bp_groups_pagination_links() ?>
        </div>
    </div>
    </ul>

	<!--インフィニットスクロール-->
	<script type="text/javascript">
	jQuery(function($){
			$('#container').infinitescroll({
			loading: {
	        	finishedMsg: "<span class='finished_message'>見つかりませんか？検索を使用しましょう。</span>",
	        	msgText: "<span class='message_text'>ロード中です･･･</span>"  //最後の項目の後にはカンマを付けない
	       	},
				navSelector  : ".pagination-links",
				nextSelector : ".pagination-links a",
				itemSelector : ".non-join",
			});
		});
	</script>	

<!--サーチエンジン用-->
	<div id="not_found_list" style="display:none!important;"> 
    <ul id="groups-list" class="item-list">

		<input type="text" class="select_01" />
		<input id="search_sample_button" type="submit" value="検索"></p>
		 
		<ul class="result">
		</ul>

    </ul>
	</div>
 
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 
    <div id="message" class="info">
        <p><?php _e( 'グループはありません。必要なグループを作成しましょう。', 'buddypress' ) ?></p>
    </div>
 
<?php endif; ?>

<?php endif; ?>
<?php get_footer(); ?>
