<?php

/**
 * BuddyPress - Activity Post Form
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form" name="whats-new-form" role="complementary">

	<?php do_action( 'bp_before_activity_post_form' ); ?>

	<div class="form-explain">
		<h4 class="title-form">写真を共有しましょう</h4>
	</div>

	<div id="whats-new-content">
		<div id="whats-new-textarea">
			<script>
			jQuery(function($){
			    $("#datepicker").datepicker({
 				   dateFormat: 'yy/mm/dd',
 				   yearSuffix: '年',
 				   showMonthAfterYear: true,
 				   monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
 				   dayNames: ['日', '月', '火', '水', '木', '金', '土'],
 				   dayNamesMin: ['日', '月', '火', '水', '木', '金', '土'],
 				   minDate: '-4m',
 				   maxDate: '+0d',
				   showOn: 'both',
    			   buttonImage: "<?php echo get_stylesheet_directory_uri(); ?>/resources/css/images/calendar-icon.png",
    			   buttonText: 'カレンダーから選択',
    			   buttonImageOnly: true
				});	
		   });
			</script>	
			<div class="date-pick-form">
				<p class="description">授業の日付を選択してください</p>
				<input type="text" name="datepicker" id="datepicker" class="datepicker">
			</div>
			<p class="description">写真をアップロード</p>
		</div>

		<div id="whats-new-options">
			<div id="whats-new-submit">
				<input type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" value="<?php esc_attr_e( 'Post Update', 'buddypress' ); ?>" />
			</div>

			<?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

				<div id="whats-new-post-in-box">

					<?php _e( 'Post in', 'buddypress' ); ?>:

					<select id="whats-new-post-in" name="whats-new-post-in">
						<option selected="selected" value="0"><?php _e( 'My Profile', 'buddypress' ); ?></option>

						<?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0' ) ) :
							while ( bp_groups() ) : bp_the_group(); ?>

								<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

							<?php endwhile;
						endif; ?>

					</select>
				</div>
				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />

			<?php elseif ( bp_is_group_home() ) : ?>

				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
				<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

			<?php endif; ?>

			<?php do_action( 'bp_activity_post_form_options' ); ?>

		</div><!-- #whats-new-options -->
	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php do_action( 'bp_after_activity_post_form' ); ?>

</form><!-- #whats-new-form -->
