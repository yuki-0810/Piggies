<?php /* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_activity_loop() */ ?>

<?php do_action( 'bp_before_activity_loop' ) ?>

<?php global $bp;
if ( bp_is_active("activity")&&bp_has_activities( "action=new_media_update&show_hidden=1&secondary_id=".$bp->gallery->current_media->id ) ) : ?>


	<?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
	<noscript>
		<div class="pagination">
			<div class="pag-count"><?php bp_activity_pagination_count() ?></div>
			<div class="pagination-links"><?php bp_activity_pagination_links() ?></div>
		</div>
	</noscript>

	<?php if ( empty( $_POST['page'] ) ) : ?>
		<ul id="activity-stream" class="activity-list item-list">
	<?php endif; ?>

	<?php while ( bp_activities() ) : bp_the_activity(); ?>

		<?php include( bp_gallery_locate_template( array( 'gallery/single/media/activity-entry.php' ), false ) ) ?>

	<?php endwhile; ?>

	<?php if ( bp_get_activity_count() == bp_get_activity_per_page() ) : ?>
		<li class="load-more">
			<a href="#more"><?php _e( 'Load More', 'bp-gallery' ) ?></a> &nbsp; <span class="ajax-loader"></span>
		</li>
	<?php endif; ?>

	<?php if ( empty( $_POST['page'] ) ) : ?>
		</ul>
	<?php endif; ?>

<?php else : ?>
<?php if ( is_user_logged_in() ) : ?>
				<?php bp_gallery_locate_template( array( 'gallery/single/media/post-form.php'), true ) ?>
			<?php endif; ?>
	<!--<div id="message" class="info">
		<p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'bp-gallery' ) ?></p>
	</div>-->
<?php endif; ?>

<?php do_action( 'bp_after_activity_loop' ) ?>

<form action="" name="activity-loop-form" id="activity-loop-form" method="post">
	<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ) ?>
</form>