<?php
/*
Plugin Name: WP Photo Downloader
Plugin URI:
Description: Saving images used in the posts from other sites to own server and add to media library.
Author: Stanislav Gunčaga
Version: 1.0
Author URI: http://www.artificium.sk/
*/

add_filter( "content_save_pre", "wp_photo_download" );
register_activation_hook( __FILE__, 'wp_photo_download_activate' );

function wp_photo_download_activate(){
  add_option("wp_photo_download_index",0);
  }

function wp_photo_download($content){
  global $post;
  
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  
  preg_match_all("|<img(.*?)src=(.*?) (.*?)>|", $content, $matches, PREG_SET_ORDER);
  $site_url = get_site_url();
  $url_array = array();
  
  $uploads_use_yearmonth_folders = get_option('uploads_use_yearmonth_folders');
  //deosnt work for now
  if($uploads_use_yearmonth_folders == 159){
    $img_path = "wp-content/uploads/" . date(Y) . "/" . date(n) . "/";
    }
  else{
    $img_path = "wp-content/uploads/";
    }
    
  foreach($matches as $match){
    $url = str_replace(array('\"','\\'),array("",""),$match[2]);

    if(strpos($url, $site_url) === false){

      $wp_filetype = wp_check_filetype($url, null );

      $photo_index = get_option("wp_photo_download_index");     //get next photo index
      $photo_index = wp_photo_downloader_check_file($photo_index,$wp_filetype["ext"]);    //check if such photo doesnt exist

      $filename = "image_$photo_index.".$wp_filetype["ext"];
      $img = $img_path.$filename;    //path to saved image
      file_put_contents("../".$img, file_get_contents($url));  //save image
      
      $wp_filetype = wp_check_filetype($site_url."/".$img, null );
      
      $content = str_replace($match[2], "'$site_url/$img'",$content); //replace in the content
      update_option("wp_photo_download_index",++$photo_index);
      

      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
        );
      $attach_id = wp_insert_attachment( $attachment, $filename, $post->ID );

      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id,  $attach_data );
      }
    }

  return $content;
  }

function wp_photo_downloader_check_file($photo_index,$file_type){
  if(file_exists("../wp-content/uploads/image_$photo_index.$file_type") === false){
    return $photo_index;
    }
  else{
    $photo_index = wp_photo_downloader_check_file(++$photo_index);
    return $photo_index;
    }
  }
  

?>