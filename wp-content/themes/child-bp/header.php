<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<?php if(is_user_logged_in()): ?>
		<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> style="margin-top:27px!important; background-color:#353232;">
	<?php else:?>
		<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >
	<?php endif; ?>
	<head profile="http://gmpg.org/xfn/11">
<meta name="google-site-verification" content="PXHUB4UXsGTjJ2BwG5nxMKpnQqsAFzfl4SrXN3GXpII" />
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php endif; ?>
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php bp_head(); ?>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> id="bp-default">
	<!-- モバイル端末での表示の場合 -->
	<?php if ( wp_is_mobile() ) : ?>
		<!-- ログインしている場合の表示 -->
		<?php if(is_user_logged_in()): ?>
		<div id="footer-widget-area">
			<div class="bp-login-widget-user-avatar">
				<a href="<?php echo bp_loggedin_user_domain(); ?>/notifications/">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/images/logo1.png" width="50px" height="50px"/>
					<?php //bp_loggedin_user_avatar( 'type=thumb&width=50&height=50' ); ?>
						<?php 
							$count = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); 
							if($count){
								echo '<span id="header-count">' .$count. '</span>';
							}
						?>
				</a>
				<div class="group_create_button">
					<?php global $bp; ?>
					<a href="<?php echo $bp->loggedin_user->domain;?>groups/create"><span id="create_group_span">グループ作成</span></a>
				</div>
			</div>
			<?php if( is_front_page() ):?>
    			<ul id="groups-list" class="item-list">
					<input id="search_sample_button" class="class_search_box" type="text" class="select_01" placeholder=" 他のグループを検索"/> 
					<!-- <input id="search_sample_button" type="submit" value="Search"></p>-->
					<ul class="result">
					</ul>
    			</ul>
			<?php else:?>
				<a class="group-search-link" href="<?php echo home_url(); ?>">別のグループを探す</a>
			<?php endif; ?>
		</div>

		<!-- ログインしていない場合の表示 -->
		<?php else:?>
			<?php 
					$slug_name = $post->post_name;
					if( $slug_name !== 'registration'):
				
			?>
			<?php do_action( 'bp_before_sidebar_login_form' ) ?>
			<div id="footer">
				<div id="top-wrap">
					<div id="top-description-area">
						<h2 id="top-title">Piggies</h2>
						<h3 id="top-subtitle">ようこそ</h3>
						<p id="top-description">登録して、友達と情報を共有しよう。</p>
					</div>
					<div id="top-button-area">
						<p class="register-button"><a href="<?php echo home_url().'/registration/' ?>">アカウントを作成する</a></p>
						<p class="login-description">すでにアカウントをお持ちですか？</p>
						<p class="login-button"><a>ログイン</a></p>
					</div>
					<div id="top-login-form">
						<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
							<label><?php _e( 'ユーザー名', 'buddypress' ); ?><br />
							<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>
        				
							<label><?php _e( 'パスワード', 'buddypress' ); ?><br />
							<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>
        				
							<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'ログインを記録する', 'buddypress' ); ?></label></p>
        				
							<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php esc_attr_e( 'ログイン', 'buddypress' ); ?>" tabindex="100" />
        				
						</form>
					</div>
				</div>
			</div><!-- #footer -->
			<?php endif; ?>

		<?php endif;?>

		<!-- PCでの表示の場合 -->
		<?php else: ?>
			<h1 style="text-align:center;padding-top:20px;">このサイトはスマートフォン専用です</h1>

		<?php endif;?>

		<?php do_action( 'bp_after_header'     ); ?>
		<?php do_action( 'bp_before_container' ); ?>

		<div id="container">
