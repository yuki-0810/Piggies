<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">
		<img class="avatar" src="<?php echo get_stylesheet_directory_uri();?>/resources/images/logo1.png"/>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h2>
		<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
	</h2>

	<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
		<p class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></p>
	<?php endif; ?>

	<?php do_action( 'bp_before_member_header_meta' ); ?>

</div><!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>
