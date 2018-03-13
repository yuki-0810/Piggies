<?php
/*
Plugin Name: Group Add Meta
Plugin URI: http://MyWebsite.com
Description: Let Groups Pick their favorite Color
Version: 1.0
Requires at least: 3.3
Tested up to: 3.3.1
License: GPL3
Author: Your Name
Author URI: http://YourCoolWebsite.com
*/
function bp_group_meta_init() {
function custom_field($meta_key='') {
//get current group id and load meta_key value if passed. If not pass it blank
return groups_get_groupmeta( bp_get_group_id(), $meta_key) ;
}
//code if using seperate files require( dirname( __FILE__ ) . '/buddypress-group-meta.php' );
// This function is our custom field's form that is called in create a group and when editing group details
function group_header_fields_markup() {
global $bp, $wpdb;

$user_id = get_current_user_id();
$args_uni = array(
    'field'     => '大学名',
    'user_id'   => $user_id,
);
$uni_name = bp_get_profile_field_data( $args_uni );

if($uni_name === '東京大学'){
	$gakubu_list = array('法学部','医学部','工学部','文学部','理学部','農学部','経済学部','教養学部','教育学部','薬学部');
}elseif($uni_name === '早稲田大学'){
	$gakubu_list = array('政治経済学部','法学部','文学部','文化構想学部','教育学部','商学部','基幹理工学部','創造理工学部','先進理工学部','社会科学部','人間科学部','スポーツ科学部','国際教養学部');
}elseif($uni_name === '慶応大学'){
	$gakubu_list = array('文学部','経済学部','法学部','商学部','医学部','理工学部','総合政策学部','環境情報学部','看護医療学部','薬学部');
}elseif($uni_name === '明治大学'){
	$gakubu_list = array('法学部','商学部','政治経済学部','文学部','理工学部','農学部','経営学部','情報コミュニケーション学部','国際日本学部','総合数理学部');
}elseif($uni_name === '青山学院大学'){
	$gakubu_list = array('文学部','教育人間科学部','経済学部','法学部','経営学部','国際政治経済学部','総合文化政策学部','理工学部','社会情報学部','地球社会共生学部');
}elseif($uni_name === '立教大学'){
	$gakubu_list = array('文学部','異文化コミュニケーション学部','経済学部','経営学部','理学部','社会学部','法学部','観光学部','コミュニティ福祉学部','現代心理学部','グローバル・リベラルアーツ・プログラム');
}elseif($uni_name === '中央大学'){
	$gakubu_list = array('法学部','経済学部','商学部','理工学部','文学部','総合政策学部');
}elseif($uni_name === '法政大学'){
	$gakubu_list = array('法学部','文学部','経営学部','国際文化学部','人間環境学部','キャリアデザイン学部','デザイン工学部','GIS(グローバル教養学部)','経済学部','社会学部','社会学部','現代福祉学部','スポーツ健康学部','情報科学部','理工学部','生命科学部');
}else{
	$gakubu_list = '';
}
?>

<label for="university-name">大学名</label>
<input id="university-name" type="text" name="university-name" readonly="readonly" value="<?php echo $uni_name; ?>" />
<br>
<label for="university-major">学部</label>
<select id="university-major" name="university-major" >
<?php
	foreach( $gakubu_list as $gakubu ){
		echo '<option value="' .$gakubu. '">' .$gakubu.'</option>';
	}
?>
</select> 
<br>
<label for="university-teacher">講師名(必須)</label>
<input id="university-teacher" type="text" name="university-teacher" value="" />
<br>
<?php }
// This saves the custom group meta ? props to Boone for the function
// Where $plain_fields = array.. you may add additional fields, eg
//  $plain_fields = array(
//      'field-one',
//      'field-two'
//  );
function group_header_fields_save( $group_id ) {
global $bp, $wpdb;
$plain_fields = array(
'university-name',
'university-major',
'university-teacher',
);
foreach( $plain_fields as $field ) {
$key = $field;
if ( isset( $_POST[$key] ) ) {
$value = $_POST[$key];
groups_update_groupmeta( $group_id, $field, $value );
}
}
}
add_filter( 'groups_custom_group_fields_editable', 'group_header_fields_markup' );
add_action( 'groups_group_details_edited', 'group_header_fields_save' );
add_action( 'groups_created_group',  'group_header_fields_save' );
 
// Show the custom field in the group header
function show_field_in_header( ) {
echo "<p> " . custom_field('university-major') . "</p>";
echo "<p> " . custom_field('university-teacher') . "先生</p>";
}
add_action('bp_group_header_meta' , 'show_field_in_header') ;
}
add_action( 'bp_include', 'bp_group_meta_init' );
/* If you have code that does not need BuddyPress to run, then add it here. */
?>
