<?php

/**
 * BuddyPress - Activity Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_activity_loop' ); ?>

<?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ) ) ) : ?>

	<?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
	<noscript>
		<div class="pagination">
			<div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
			<div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
		</div>
	</noscript>

	<?php if ( empty( $_POST['page'] ) ) : ?>

		<ul id="activity-stream" class="activity-list item-list">

	<?php endif; ?>

	<?php
			$today_date = date("Y/n/j");
			$today_date_1w = date("Y/n/j", strtotime("-1 week" ));
			$today_date_2w = date("Y/n/j", strtotime("-2 week" ));
			$today_date_3w = date("Y/n/j", strtotime("-3 week" ));
			$today_date_4w = date("Y/n/j", strtotime("-4 week" ));
			$today_date_5w = date("Y/n/j", strtotime("-5 week" ));
			$today_date_6w = date("Y/n/j", strtotime("-6 week" ));
			$today_date_7w = date("Y/n/j", strtotime("-7 week" ));
			$today_date_8w = date("Y/n/j", strtotime("-8 week" ));
			$today_date_9w = date("Y/n/j", strtotime("-9 week" ));
			$today_date_10w = date("Y/n/j", strtotime("-10 week" ));
			$today_date_11w = date("Y/n/j", strtotime("-11 week" ));
			$today_date_12w = date("Y/n/j", strtotime("-12 week" ));
			$today_date_13w = date("Y/n/j", strtotime("-13 week" ));

			$today_date_3wd = date("n/j", strtotime("-3 week" ));
			$today_date_4wd = date("n/j", strtotime("-4 week" ));
			$today_date_5wd = date("n/j", strtotime("-5 week" ));
			$today_date_6wd = date("n/j", strtotime("-6 week" ));
			$today_date_7wd = date("n/j", strtotime("-7 week" ));
			$today_date_8wd = date("n/j", strtotime("-8 week" ));
			$today_date_9wd = date("n/j", strtotime("-9 week" ));
			$today_date_10wd = date("n/j", strtotime("-10 week" ));
			$today_date_11wd = date("n/j", strtotime("-11 week" ));
			$today_date_12wd = date("n/j", strtotime("-12 week" ));
			$today_date_13wd = date("n/j", strtotime("-13 week" ));
	?>
	<?php 
		//while ( bp_activities() ) : bp_the_activity(); 
		//	global $activities_template;
		//	$act_ID = $activities_template->activity->id;
		//	$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
        //
		//	if( strtotime($today_date_4w) >= strtotime($date_meta) ){
		//		if( strtotime($date_meta) > strtotime($today_date_3w) ){
		//			$w4_val = $date_meta;
		//			echo $w4_val;
		//		}
		//	}
        //
		//endwhile;		
	?>
	<h2 class="activity-header">今週</h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
		<?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ).'&max=100' ) ) :?>
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
    		
					if( strtotime($today_date) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_1w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
			<?php endwhile; ?>
		<?php endif; ?>
		</div>
	</div>
	
	<h2 class="activity-header">先週</h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
    		
					if( strtotime($today_date_1w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_2w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header">先々週</h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
    		
					if( strtotime($today_date_2w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_3w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_4wd.'～'.$today_date_3wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_3w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_4w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_5wd.'～'.$today_date_4wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_4w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_5w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_6wd.'～'.$today_date_5wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_5w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_6w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_7wd.'～'.$today_date_6wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_6w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_7w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_8wd.'～'.$today_date_7wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_7w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_8w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>
	
	<h2 class="activity-header-date"><?php echo $today_date_9wd.'～'.$today_date_8wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_8w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_9w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_10wd.'～'.$today_date_9wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_9w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_10w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_11wd.'～'.$today_date_10wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_10w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_11w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>

	<h2 class="activity-header-date"><?php echo $today_date_12wd.'～'.$today_date_11wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_11w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_12w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>
	
	<h2 class="activity-header-date"><?php echo $today_date_13wd.'～'.$today_date_12wd; ?></h2>
	<div class="horizontal-scroll">	
		<div id="activity-content-wrap">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>
				<?php 
					global $activities_template;
					$act_ID = $activities_template->activity->id;
					$date_meta = bp_activity_get_meta( $act_ID, 'datepicker', true );
					
					if( strtotime($today_date_12w) >= strtotime($date_meta) ){
						if( strtotime($date_meta) > strtotime($today_date_13w) ){
							if ( bp_activity_has_content() ):
						 		bp_activity_content_body();
				 			endif;
						}
					}
				?>
    		
			<?php endwhile; ?>
		</div>
	</div>
	<div id="group-end-space"></div>
	<?php if ( empty( $_POST['page'] ) ) : ?>

		</ul>

	<?php endif; ?>

<?php else : ?>

	<div id="message" class="info">
		<p><?php _e( 'このグループには投稿がまだありません！写真を共有しましょう。', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_activity_loop' ); ?>

<?php if ( empty( $_POST['page'] ) ) : ?>

	<form action="" name="activity-loop-form" id="activity-loop-form" method="post">

		<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

	</form>

<?php endif; ?>
