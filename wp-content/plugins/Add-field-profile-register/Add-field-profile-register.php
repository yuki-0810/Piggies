<?php
/*
Plugin Name: Add Field to Profile Register
Description: Let Groups Pick their favorite Color
Version: 1.0
Requires at least: 3.3
Tested up to: 3.3.1
License: GPL3
Author: Yuki
*/
function bp_group_meta_init() {
function custom_field($meta_key='') {
//get current group id and load meta_key value if passed. If not pass it blank
return groups_get_groupmeta( bp_get_group_id(), $meta_key) ;
}
//code if using seperate files require( dirname( __FILE__ ) . '/buddypress-group-meta.php' );
// This function is our custom field's form that is called in create a group and when editing group details
function group_header_fields_markup() {
global $bp, $wpdb;?>
<label for="university-name">大学名</label>
<input id="university-name" type="text" name="university-name" value="<?php echo custom_field('university-name'); ?>" />
<br>
<label for="university-major">学部</label>
<input id="university-major" type="text" name="university-major" value="<?php echo custom_field('university-major'); ?>" />
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
echo "<p> 大学名:" . custom_field('university-name') . "</p>";
echo "<p> 学部:" . custom_field('university-major') . "</p>";
}
add_action('bp_group_header_meta' , 'show_field_in_header') ;
}
add_action( 'bp_include', 'bp_group_meta_init' );
/* If you have code that does not need BuddyPress to run, then add it here. */
?>
