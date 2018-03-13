<?php do_action( 'bp_before_group_request_membership_content' ); ?>

<?php if ( !bp_group_has_requested_membership() ) : ?>
	<h3 id="request-form-title">参加申請フォーム</h3>

	<form action="<?php bp_group_form_action('request-membership'); ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">
		<label for="group-request-membership-comments"><?php _e( '参加申請コメント(任意)', 'buddypress' ); ?></label>
		<textarea name="group-request-membership-comments" id="group-request-membership-comments"></textarea>

		<?php do_action( 'bp_group_request_membership_content' ); ?>

		<p><input type="submit" name="group-request-send" id="group-request-send" value="<?php esc_attr_e( '参加申請する', 'buddypress' ); ?>" />

		<?php wp_nonce_field( 'groups_request_membership' ); ?>
	</form><!-- #request-membership-form -->
<?php endif; ?>

<?php do_action( 'bp_after_group_request_membership_content' ); ?>
