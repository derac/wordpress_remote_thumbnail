<?php
/*
Plugin Name: Remote Thumbnail -  edit 5.7
Description: Lightweight plugin to use remote images for post thumbnails and featured image. Enter remote image url into custom field 'remote_thumbnail' of any post.
Version: 1.2
Author: Samuel Diethelm - Derek Olson
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

class remote_thumbnail_plugin{
    public static function thumbnail_html($html, $post_ID, $post_image_id, $size, $attr){
        $src = get_post_meta($post_ID,'remote_thumbnail',true);
        if (!$src) { return $html }
        return '<img id="post-thumbnail" src="'.$src.'">';
    }

    public static function return_false_thumbnail_id($value, $object_id, $meta_key, $single ){
        if(!$single || $meta_key != '_thumbnail_id')
            return $value;

        $src = get_post_meta($object_id,'remote_thumbnail',true);
        if(!$src)
            return $value;

        return -1;
    }
}
add_filter('post_thumbnail_html', array('remote_thumbnail_plugin','thumbnail_html'), 11, 5);
add_filter('get_post_metadata' , array('remote_thumbnail_plugin','return_false_thumbnail_id'),10,4);
