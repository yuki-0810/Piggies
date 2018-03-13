<?php
//load javascript files
add_action("bp_gallery_js_loaded","bp_gallery_js_loaded");
function bp_gallery_get_template_cssjs_dir_url(){
   return bp_gallery_get_template_url();
}

function bp_gallery_js_loaded(){
     $url=bp_gallery_get_template_cssjs_dir_url();

if($url){
   
   
   wp_enqueue_script( 'wp-mediaelement', array('jquery') );
   wp_register_script("gallery_theme_js",$url."/theme.js",array("jquery","wp-mediaelement"));
   wp_enqueue_script("gallery_theme_js");
   
  if(is_user_logged_in()){
        wp_enqueue_script("swfobject");
        wp_enqueue_script("swfupload");
        wp_enqueue_script("jqswfupload",$url."/inc/swfupload/jquery.swfupload.js",array("swfupload"));//for uploader
     //wp_enqueue_script("img_tagger",BP_GALLERY_PLUGIN_URL."inc/js/phototagger/mytagger.js");
        }
}
}
/**
 * Load css for gallery
 */
//add_action("bp_gallery_css_loaded","bp_gallery_extra_css");
function bp_gallery_extra_css(){
      $url=bp_gallery_get_template_cssjs_dir_url();
    if(apply_filters ("bp_gallery_load_css",1))
        wp_enqueue_style("gallery",$url."/inc/css/structure.css");//load from theme file
   // if(apply_filters ("bp_gallery_load_mejs_css",1))
      //  wp_enqueue_style("mediaelement_css",$url."/inc/mediaelement/mediaelementplayer.min.css");
      wp_enqueue_style('mediaelement');
      wp_enqueue_style('wp-mediaelement');
      
}

add_action("bp_after_activity_loop","gallery_enable_player_for_activity");//make sure to activate player after each loading of activity
function gallery_enable_player_for_activity(){
?>
<script type="text/javascript">
 gallery_activate_player();
    
</script>
<?php
}

///override the gallery settings, global tersm

add_action("gallery_settings_js_loaded","gallery_override_js_terms");

function gallery_override_js_terms(){
//
//gallery_upload_settings.button_image_url="url of the upload button"
    $url= bp_gallery_get_template_cssjs_dir_url();
 ?>
 <script type='text/javascript'>
  
    bp_player_base="<?php echo $url ; ?>/inc/videoplayer/";
    bp_video_player_url=bp_player_base+"flowplayer-3.1.5.swf";
    bp_audio_player_url=bp_player_base+"flowplayer.audio.swf";

    gallery_home_url="<?php echo bp_get_gallery_home_url();?>";

    gallery_plugin_url="<?php echo BP_GALLERY_PLUGIN_URL;?>";
    gallery_debaug_mode="<?php echo bp_gallery_is_debug_mode();?>";
    
    gallery_enable_flash_uploader="<?php echo bp_gallery_is_flash_uploader_enabled();?>";
    //gallery_enable_flash_uploader=parseInt(gallery_enable_flash_uploader);//-0;//convert to int

    gallery_uploader_base_url="<?php echo $url;?>/inc/swfupload/"
    //for swfupload
    gallery_upload_settings={
		upload_url: ajaxurl,
		file_post_name: 'file',
		file_size_limit : "<?php echo gallery_get_max_media_size(true);?>",
		//file_types : "*.jpg;*.png;*.gif",
		//file_types_description : "Image files",
		file_upload_limit : 0,
		flash_url : gallery_uploader_base_url+"swfupload.swf",
		button_image_url : gallery_uploader_base_url+'upload_btn.png',
		button_width : 114,
		post_params:{cookie:encodeURIComponent(document.cookie),
                        auth_cookie:"<?php if ( is_ssl() ) echo $_COOKIE[SECURE_AUTH_COOKIE]; else echo $_COOKIE[AUTH_COOKIE]; ?>",
                        logged_in_cookie:"<?php echo $_COOKIE[LOGGED_IN_COOKIE] ;?>"

            },

		button_height : 29,
                http_success : [201, 202],
		//button_placeholder_id : id,
		debug: !!gallery_debaug_mode
	};



</script>
<?php
}

//filter video/audio publishing html into activity for media elementjs template

add_filter("bp_get_gallery_media_video_thumb_html","bp_get_gallery_media_video_thumb_html_mep",20,2);
add_filter("bp_get_gallery_media_audio_thumb_html","bp_get_gallery_media_audio_thumb_html_mep",20,2);


function bp_get_gallery_media_video_thumb_html_mep($content,$media){
      $size= gallery_get_media_size_settings("video");
    if($media->is_remote)
        return $content;//=bp_get_media_meta ($media->id, "embeded_media_thumb_content");
    else
      return "<video src='".bp_get_media_full_src($media). "' type='video/". gallery_get_file_extension_from_media($media)."' width='".$size['thumb']['width']."' height='".$size['thumb']['height']."' title='".bp_get_media_title ($media)."'> </video>";

    return $content;
}
function bp_get_gallery_media_audio_thumb_html_mep($content,$media){
      $size= gallery_get_media_size_settings("audio");
    if($media->is_remote)
        return $content;//=bp_get_media_meta ($media->id, "embeded_media_thumb_content");
    else
      return "<audio src='".bp_get_media_full_src($media). "' type='audio/". gallery_get_file_extension_from_media($media)."' width='".$size['thumb']['width']."' title='".bp_get_media_title ($media)."' > </audio>";
return $content;
}
remove_filter("gallery_activity_media_content","gallery_video_audio_activity_content",10,3);

//buddypress will filter out the embeded media code, we need to pass it for activity content
