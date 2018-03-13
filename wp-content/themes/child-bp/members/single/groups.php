<?php

/**
 * BuddyPress - Users Groups
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>
	<div class="groups mygroups">

	<?php 
	if ( is_user_logged_in() ) :
	$user_id = bp_loggedin_user_id();

	$args_tests = array(
		'type'	=> 'popular',
		'per_page' => '6',
		'user_id' => $user_id
	);
	
	$i = 0;
	
	?>
	<?php if ( bp_has_groups($args_tests) ) : ?>
	 
	    <ul class="grid-list">
	    <?php while ( bp_groups() ) : bp_the_group(); 
			$i++;
		?>
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
						//}elseif($i === 7){
						//	$select_img_path = '/resources/images/color7.png';
						//	echo $dir_url.$select_img_path;
						//}elseif($i === 8){
						//	$select_img_path = '/resources/images/color8.png';
						//	echo $dir_url.$select_img_path;
							$i = 0;
						}else{
							$select_img_path = '/resources/images/color1.png';
							echo $dir_url.$select_img_path;
						}
					?>" 
					alt=""></a>
	            	<div class="item">
	            	    <span class="item-title"><a class="class_title" href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></span>
	            	    <span class="item-desc"><?php echo "<p>" . custom_field('university-teacher') . "</p>"; ?></span>	
	            	    <span class="item-desc"><?php echo "<p>" . custom_field('university-major') . "</p>"; ?></span>	
	            	    <?php do_action( 'bp_directory_groups_item' ) ?>
						<span class="action"><?php //do_action( 'bp_directory_groups_actions' ) ?></span>
	            	</div>
	            </div>
	        </li>
	    <?php endwhile; ?>
	    </ul>
	 
	    <?php do_action( 'bp_after_groups_loop' ) ?>
	 
	<?php else: ?>
	 
	    <div id="message" class="info">
	        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
	    </div>
	 
	<?php endif; ?>

	<?php
	if ( bp_has_groups($args_test) ) : 
	?>
		<script type="text/javascript">
		jQuery(function($){
				$('#container').infinitescroll({
				loading: {
		        	finishedMsg: "<span class='finished_message'>参加しているグループはこれ以上ありません。</span>",
		        	msgText: "<span class='message_text'>ロード中です･･･</span>"  //最後の項目の後にはカンマを付けない
		       	},
					navSelector  : ".pagination-links",
					nextSelector : ".pagination-links a",
					itemSelector : ".grid-list",
				});
			});
		</script>	
	    <div class="pagination">
	        <div class="pagination-links" id="group-dir-pag">
	            <?php bp_groups_pagination_links() ?>
	        </div>
	    </div>
	</div>
	<?php endif; ?>

	<?php do_action( 'bp_after_member_groups_content' ); ?>

<?php endif; ?>
