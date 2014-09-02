<?php
/*
    Plugin Name: Ahead Column Plugin
    Plugin URI:
    Description: Adding the custom post type. Version: 1.0
    Author: Shane McCarthy

*/

add_shortcode('aheadcolumnplugin','aotw_col_plugin');

function aotw_col_plugin($attr,$content){
if(isset($attr['page'])){
    $args = array(
    'p' => $attr['page'], // id of a page, post, or custom type
    'post_type' => 'any');
}else{
    $args = array(
         // id of a page, post, or custom type
        'post_type' => 'any');
}
    if(!empty($content)){
        $content =esc_html($content);
    }else{
        $content='';
    }
$my_posts = new WP_Query($args);
if ( $my_posts->have_posts() ) :

        while ( $my_posts->have_posts() ) : $my_posts->the_post();

$output ='<div class="portfolio-thumbnail-image"><div class="overflow-hidden">';
$output.='<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
$output.='<span class="portfolio-thumbnail-image-hover" style="opacity: 0;">';
$output.='<span class="hover-link" style="left: -50%;"></span></span></a>';

if ( has_post_thumbnail() ) { // check if the post has a post thumbnail assigned to it.
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($my_posts->ID), 'full' );
    $url=$thumb['0'];
    $output.='<img src="'.$url.'" alt="'.get_the_title().'">';}
   $output.='</div></div>';
$output.= '<div class="portfolio-thumbnail-context">';
    $output.= '<h2 class="portfolio-thumbnail-title port-title-color gdl-title">';
        $output.='<a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
    $output.= '<div class="portfolio-thumbnail-content">';
            $output.=$content;
            $output.='</div></div>';
endwhile;
endif;
return $output;
}
