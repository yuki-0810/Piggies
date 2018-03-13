<?php

do_action( 'bp_before_group_header' );

?>

<div id="item-actions">
</div><!-- #item-actions -->

<?php if(is_user_logged_in()): ?>
<div class="group_header_wrap">
	<div id="group_title">
		<h3><?php bp_group_name(); ?></h3>
	</div><!-- #item-header-avatar -->
	
	<div class="group_infomation">
		<?php do_action( 'bp_before_group_header_meta' ); ?>
		<div id="group_item-meta">
			<?php do_action( 'bp_group_header_meta' ); ?>
		</div>
		<div id="group_item-button">
			<?php do_action( 'bp_group_header_actions' ); ?>
		</div><!-- #item-buttons -->
			<br/>
	</div><!-- #item-header-content -->
</div>
<?php endif; ?>
<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>
