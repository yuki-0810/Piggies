	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> style="background-color:white;" >
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php endif; ?>
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php bp_head(); ?>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> id="bp-default">
	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_activation_page' ); ?>

		<div class="page" id="activate-page">

			<h3 id="activate-title"><?php if ( bp_account_was_activated() ) :
				_e( 'アカウント有効化完了', 'buddypress' );
			else :
				_e( 'Activate your Account', 'buddypress' );
			endif; ?></h3>

			<?php do_action( 'template_notices' ); ?>

			<?php do_action( 'bp_before_activate_content' ); ?>

			<?php if ( bp_account_was_activated() ) : ?>

				<?php if ( isset( $_GET['e'] ) ) : ?>
					<p><?php _e( 'アカウントが有効化されました', 'buddypress' ); ?></p>
				<?php else : ?>
					<p id="activate-description"><?php 
					$top_url = home_url();
					printf( __( 'アカウントの有効化が完了しました。トップページに戻ってログインしてください。', 'buddypress' ), wp_login_url( bp_get_root_domain() ) ); ?></p>
					<p id="sub-logo"><img src="<?php echo get_stylesheet_directory_uri();   ?>/resources/images/logo1.png"/></p>
					<a id="activate-login" href="<?php echo $top_url; ?>">ログイン</a>
				<?php endif; ?>

			<?php else : ?>

				<p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

				<form action="" method="get" class="standard-form" id="activation-form">

					<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
					<input type="text" name="key" id="key" value="" />

					<p class="submit">
						<input type="submit" name="submit" value="<?php esc_attr_e( 'Activate', 'buddypress' ); ?>" />
					</p>

				</form>
				<a id="activate-login" href="<?php echo $top_url; ?>">ログイン</a>

			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ); ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_activation_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

		<?php do_action( 'bp_after_header'     ); ?>
		<?php do_action( 'bp_before_container' ); ?>

		<div id="container">
<?php get_footer( 'buddypress' ); ?>
