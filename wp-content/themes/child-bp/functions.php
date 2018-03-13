<?php

add_action( 'wp_enqueue_scripts', 'bp_default_parent_theme_enqueue_styles' );

function bp_default_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'bp-default-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-bp-style',get_stylesheet_directory_uri() . '/style.css',array( 'bp-default-style' ));
    wp_enqueue_style( 'jquery-ui.min',get_stylesheet_directory_uri() . '/resources/css/jquery-ui.min.css');
   // wp_enqueue_style( 'validationEngine',get_stylesheet_directory_uri() . '/resources/css/validationEngine.jquery.css');

    wp_enqueue_script( 'child-bp-js',get_stylesheet_directory_uri() . '/js/group-ajax-search.js');
	wp_enqueue_script('jquery.infinitescroll.min',get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '1.0');
	wp_enqueue_script( 'dtheme-ajax-js', get_stylesheet_directory_uri() . '/_inc/global.js', array( 'jquery' ), bp_get_version() );
	wp_enqueue_script('jquery-ui.min',get_stylesheet_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0');
    wp_enqueue_script( 'click-notice',get_stylesheet_directory_uri() . '/js/click-notice.js');
   // wp_enqueue_script( 'jquery.validationEngine',get_stylesheet_directory_uri() . '/js/jquery.validationEngine.js');
}

function subscriber_go_to_home( $user_id ) {
	$user = get_userdata( $user_id );
	if ( !$user->has_cap( 'edit_posts' ) ) {
		wp_redirect( get_home_url() );
		exit();
	}
}
add_action( 'auth_redirect', 'subscriber_go_to_home' );

function custom_login() { ?>
	<style>
		body.login div#login h1 a {
			background-image:url( wp-content/themes/child-bp/resources/images/logo1.png );
		}	
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login' );

// ajax url
function add_my_ajaxurl() { ?>
    <script>
        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
    </script>
<?php }
add_action( 'wp_head', 'add_my_ajaxurl', 1 );
 
// get_postsでデータをjsonへ
function ajax_get_posts(){
    // jsから受け渡しするデータ
    $select_01 = $_POST['select_01'];

	$user_id = get_current_user_id();
	$args_uni = array(
	    'field'     => '大学名',
	    'user_id'   => $user_id,
	);
	$uni_name = bp_get_profile_field_data( $args_uni );
 
	$args_test = array(
		'type'	=> 'popular',
		'meta_query' => array(
						'relation' => 'AND',
							array(
								'key' 			  => 'university-name',
								'value' 		  => $uni_name,
								'compare' 		  => '=',
							),
						),
		'max' => 10,
		'search_terms'    => $select_01,
	);

    $returnObj = array();
    $i = 0;

	if ( bp_has_groups($args_test) ){
    	while ( bp_groups() ) : bp_the_group();
			$group_name = bp_get_group_name();
			$group_permalink = bp_get_group_permalink();
            $group_type = bp_get_group_type();
			$group_member_count = bp_get_group_member_count();
			$group_join_button  = bp_get_group_join_button();
				if( $group_join_button == false ){
					$group_join_button = 'あなたが管理者のグループです';
				}
			$group_gakubu = custom_field('university-major');
			$group_teacher = custom_field('university-teacher');

    	    $returnObj[$i] = array(
				'group_name' 	  		=> $group_name,
				'group_permalink' 		=> $group_permalink,
				'group_type'	  		=> $group_type,
				'group_member_count'	=> $group_member_count,
				'group_join_button'		=> $group_join_button,
				'group_gakubu'			=> $group_gakubu,
				'group_teacher' 		=> $group_teacher,
			);
			$i++;
    	endwhile;
	}
 
    // json形式に出力
    echo json_encode( $returnObj );
	//echo $group_name;
    die();
}
add_action( 'wp_ajax_ajax_get_posts', 'ajax_get_posts' );
add_action( 'wp_ajax_nopriv_ajax_get_posts', 'ajax_get_posts' );


//function add_meta_to_activity( $content, $user_id, $null, $activity_id ) {
   // bp_activity_update_meta( $activity_id, 'class-date', $_POST['date_class'] );

//}
//add_action( 'bp_groups_posted_update', 'add_meta_to_activity', 10, 4 );


function bp_remove_group_step_invites() {
	global $bp;
	unset( $bp->groups->group_creation_steps['group-invites'] );
	
}
add_action( 'bp_init', 'bp_remove_group_step_invites', 9999 ); 

 
function my_setcookie() {
    if ( is_home() ) setcookie( 'visitedHome', 'true', time() + 60*60*24*7, '/' );
    setcookie( 'isMobile', wp_is_mobile() ? 'true' : 'false', 0, '/' );
}
add_action( 'get_header', 'my_setcookie');

