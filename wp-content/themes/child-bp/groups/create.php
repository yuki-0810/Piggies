<?php

/**
 * BuddyPress - Create Group
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

	<div id="content">
		<div class="padder">
		
		<?php do_action( 'bp_before_create_group_content_template' ); ?>

		<form action="<?php bp_group_creation_form_action(); ?>" method="post" id="create-group-form" class="standard-form" enctype="multipart/form-data">
			<h3 class="create-title"><?php _e( 'グループを作成', 'buddypress' ); ?></h3>

			<?php do_action( 'bp_before_create_group' ); ?>

			<div class="item-list-tabs no-ajax" id="group-create-tabs" role="navigation">
			</div>

			<?php do_action( 'template_notices' ); ?>

			<div class="item-body" id="group-create-body">

				<?php /* Group creation step 1: Basic group details */ ?>
				<?php if ( bp_is_group_creation_step( 'group-details' ) ) : ?>

					<?php do_action( 'bp_before_group_details_creation_step' ); ?>

					<label for="group-name"><?php _e( '授業名 (必須)', 'buddypress' ); ?></label>
					<input type="text" name="group-name" id="group-name" aria-required="true" value="<?php bp_new_group_name(); ?>" />

					<!--<label for="group-desc"><?php _e( '授業の概要(必須)', 'buddypress' ); ?></label>-->
					<textarea name="group-desc" id="group-desc" aria-required="true">no data<?php bp_new_group_description(); ?></textarea>

					<?php
					do_action( 'bp_after_group_details_creation_step' );
					do_action( 'groups_custom_group_fields_editable' ); // @Deprecated

					wp_nonce_field( 'groups_create_save_group-details' ); ?>

				<?php endif; ?>

				<?php /* Group creation step 2: Group settings */ ?>
				<?php if ( bp_is_group_creation_step( 'group-settings' ) ) : ?>

					<?php do_action( 'bp_before_group_settings_creation_step' ); ?>

					<h4><?php _e( 'グループの公開設定', 'buddypress' ); ?></h4>

					<div class="radio">

						<label><input type="radio" name="group-status" value="private" checked="checked" />
							<strong><?php _e( '承認制グループ(推奨)', 'buddypress' ); ?></strong>
							<ul>
								<li><?php _e( '参加申請が承認された人だけが参加できます。', 'buddypress' ); ?></li>
								<li><?php _e( 'グループ内の投稿は参加メンバーだけが見ることができます。', 'buddypress' ); ?></li>
							</ul>
						</label>

						<label><input type="radio" name="group-status" value="hidden"<?php if ( 'hidden' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
							<strong><?php _e('個人用グループ', 'buddypress'); ?></strong>
							<ul>
								<li><?php _e( '自分専用のグループです。', 'buddypress' ); ?></li>
								<li><?php _e( '基本的に他の誰かが参加することはできません。', 'buddypress' ); ?></li>
							</ul>
						</label>
					</div>

					<h4><?php _e( '承認の制限設定', 'buddypress' ); ?></h4>

					<p><?php _e( 'グループ参加承認の権限を与える範囲を選択してください。', 'buddypress' ); ?></p>

					<div class="radio">
						<label>
							<input type="radio" name="group-invite-status" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> />
							<strong><?php _e( '全てのメンバー', 'buddypress' ); ?></strong>
						</label>

						<label>
							<input type="radio" name="group-invite-status" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> />
							<strong><?php _e( '自分のみ', 'buddypress' ); ?></strong>
						</label>
					</div>

					<?php if ( bp_is_active( 'forums' ) ) : ?>

						<h4><?php _e( 'Group Forums', 'buddypress' ); ?></h4>

						<?php if ( bp_forums_is_installed_correctly() ) : ?>

							<p><?php _e( 'Should this group have a forum?', 'buddypress' ); ?></p>

							<div class="checkbox">
								<label><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php checked( bp_get_new_group_enable_forum(), true, true ); ?> /> <?php _e( 'Enable discussion forum', 'buddypress' ); ?></label>
							</div>
						<?php elseif ( is_super_admin() ) : ?>

							<p><?php printf( __( '<strong>Attention Site Admin:</strong> Group forums require the <a href="%s">correct setup and configuration</a> of a bbPress installation.', 'buddypress' ), bp_core_do_network_admin() ? network_admin_url( 'settings.php?page=bb-forums-setup' ) :  admin_url( 'admin.php?page=bb-forums-setup' ) ); ?></p>

						<?php endif; ?>

					<?php endif; ?>

					<?php do_action( 'bp_after_group_settings_creation_step' ); ?>

					<?php wp_nonce_field( 'groups_create_save_group-settings' ); ?>

				<?php endif; ?>

				<?php /* Group creation step 3: Avatar Uploads */ ?>
				<?php if ( bp_is_group_creation_step( 'group-avatar' ) ) : ?>

					<?php do_action( 'bp_before_group_avatar_creation_step' ); ?>

					<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

						<div class="left-menu">

							<?php bp_new_group_avatar(); ?>

						</div><!-- .left-menu -->

						<div class="main-column">
							<p><?php _e( "グループのイメージ画像をアップロードしてください。", 'buddypress' ); ?></p>

							<p>
								<input type="file" name="file" id="file" />
								<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Upload Image', 'buddypress' ); ?>" />
								<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
							</p>

							<p><?php _e( '画像を設定しない場合は、"次へ"ボタンを押してください。', 'buddypress' ); ?></p>
						</div><!-- .main-column -->

					<?php endif; ?>

					<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

						<h3><?php _e( 'Crop Group Avatar', 'buddypress' ); ?></h3>

						<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Avatar to crop', 'buddypress' ); ?>" />

						<div id="avatar-crop-pane">
							<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Avatar preview', 'buddypress' ); ?>" />
						</div>

						<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Crop Image', 'buddypress' ); ?>" />

						<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
						<input type="hidden" name="upload" id="upload" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />

					<?php endif; ?>

					<?php do_action( 'bp_after_group_avatar_creation_step' ); ?>

					<?php wp_nonce_field( 'groups_create_save_group-avatar' ); ?>

				<?php endif; ?>

				<?php /* Group creation step 4: Invite friends to group */ ?>
				<?php if ( bp_is_group_creation_step( 'group-invites' ) ) : ?>

					<?php do_action( 'bp_before_group_invites_creation_step' ); ?>

					<?php if ( bp_is_active( 'friends' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

						<div class="left-menu">

							<div id="invite-list">
								<ul>
									<?php bp_new_group_invite_friend_list(); ?>
								</ul>

								<?php wp_nonce_field( 'groups_invite_uninvite_user', '_wpnonce_invite_uninvite_user' ); ?>
							</div>

						</div><!-- .left-menu -->

						<div class="main-column">

							<div id="message" class="info">
								<p><?php _e('Select people to invite from your friends list.', 'buddypress'); ?></p>
							</div>

							<?php /* The ID 'friend-list' is important for AJAX support. */ ?>
							<ul id="friend-list" class="item-list" role="main">

							<?php if ( bp_group_has_invites() ) : ?>

								<?php while ( bp_group_invites() ) : bp_group_the_invite(); ?>

									<li id="<?php bp_group_invite_item_id(); ?>">

										<?php bp_group_invite_user_avatar(); ?>

										<h4><?php bp_group_invite_user_link(); ?></h4>
										<span class="activity"><?php bp_group_invite_user_last_active(); ?></span>

										<div class="action">
											<a class="remove" href="<?php bp_group_invite_user_remove_invite_url(); ?>" id="<?php bp_group_invite_item_id(); ?>"><?php _e( 'Remove Invite', 'buddypress' ); ?></a>
										</div>
									</li>

								<?php endwhile; ?>

								<?php wp_nonce_field( 'groups_send_invites', '_wpnonce_send_invites' ); ?>

							<?php endif; ?>

							</ul>

						</div><!-- .main-column -->

					<?php else : ?>

						<div id="message" class="info">
							<p><?php _e( 'グループの作成を完了しますか？.', 'buddypress' ); ?></p>
						</div>

					<?php endif; ?>

					<?php wp_nonce_field( 'groups_create_save_group-invites' ); ?>

					<?php do_action( 'bp_after_group_invites_creation_step' ); ?>

				<?php endif; ?>

				<?php do_action( 'groups_custom_create_steps' ); // Allow plugins to add custom group creation steps ?>

				<?php do_action( 'bp_before_group_creation_step_buttons' ); ?>

				<?php if ( 'crop-image' != bp_get_avatar_admin_step() ) : ?>

					<div class="submit" id="previous-next">

						<?php /* Previous Button */ ?>
						<?php if ( !bp_is_first_group_creation_step() ) : ?>

							<input type="button" value="<?php esc_attr_e( '戻る', 'buddypress' ); ?>" id="group-creation-previous" name="previous" onclick="location.href='<?php bp_group_creation_previous_link(); ?>'" />

						<?php endif; ?>

						<?php /* Next Button */ ?>
						<?php if ( !bp_is_last_group_creation_step() && !bp_is_first_group_creation_step() ) : ?>

							<input type="submit" value="<?php esc_attr_e( '作成完了', 'buddypress' ); ?>" id="group-creation-next" name="save" />

						<?php endif;?>

						<?php /* Create Button */ ?>
						<?php if ( bp_is_first_group_creation_step() ) : ?>

							<input type="submit" value="<?php esc_attr_e( '次へ', 'buddypress' ); ?>" id="group-creation-create" name="save" />

						<?php endif; ?>

						<?php /* Finish Button */ ?>
						<?php if ( bp_is_last_group_creation_step() ) : ?>

							<input type="submit" value="<?php esc_attr_e( '完了', 'buddypress' ); ?>" id="group-creation-finish" name="save" />

						<?php endif; ?>
					</div>

				<?php endif;?>

				<?php do_action( 'bp_after_group_creation_step_buttons' ); ?>

				<?php /* Don't leave out this hidden field */ ?>
				<input type="hidden" name="group_id" id="group_id" value="<?php bp_new_group_id(); ?>" />

				<?php do_action( 'bp_directory_groups_content' ); ?>

			</div><!-- .item-body -->

			<?php do_action( 'bp_after_create_group' ); ?>

		</form>
		
		<?php do_action( 'bp_after_create_group_content_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_footer( 'buddypress' ); ?>
