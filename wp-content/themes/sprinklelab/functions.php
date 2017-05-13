<?php

foreach (glob(dirname(__FILE__).'/includes/*.php') as $filename) {
	require_once($filename);
}

//Page Slug Body Class
add_filter( 'body_class', 'add_slug_body_class' );
function add_slug_body_class( $classes ) 
{
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}

function echo_test($key, $array, $echo=true) {
	if( !is_array($array) || !is_string($key) )
		return;
	
	$passes = false;
	
	if( isset($array[$key]) && !empty($array[$key]))
		$passes = true;
		
	if( !$passes )
		return null;
	else if( $echo )
		echo stripslashes(esc_attr($array[$key]));
	else if( !$echo )
		return stripslashes(esc_attr($array[$key]));
}

// Echo out Safe Varaibles
function bb_safe_vars($safe_vars=array(), $meta=array()){
	
	foreach($safe_vars as $safe_var_key => $safe_var_value){
		unset($safe_vars[$safe_var_key]);
		
		if( gettype($meta) == 'string' ){
			$safe_vars[$safe_var_value] = isset($meta) ? $meta : null;
		} else{
			$safe_vars[$safe_var_value] = isset($meta[$safe_var_value]) ? $meta[$safe_var_value] : null;
		}
	}
	
	return $safe_vars;
}

// Quick Debug Function for E-Z Reading ;)
function bb_print_r($var, $args=array()){
	$defaults = array(
		'strip_tags'	=> false,
		'allow_tags'	=> null
	);
	
	$options = array_merge($defaults, $args);
	
	if($options['strip_tags'])
	$var = strip_tags($var, $options['allow_tags']);
	
	echo '<pre>';
	print_r($var);
	echo '</pre>';
};


// Sanitize Data
function bb_sanitize_data($data){
	
	if( is_string($data) )
		return wp_kses( $data, wp_kses_allowed_html( 'post' ));
	else if( is_array($data) )
		return array_map('bb_sanitize_data', $data);
		
	return null;
	
}

add_action('pre_get_posts', function($wp_query){
	
	if( is_post_type_archive('video') && $wp_query->is_main_query() && !is_admin() )
		$wp_query->query_vars['posts_per_page'] = 9;
	
});


function sprinkle_video_output($video_type=null, $video_id=null, $width="737", $height="414", $autoplay=false){

	if( !$video_type || !$video_id )
		return null;
	
	if($autoplay)
		$autoplay = '&autoplay=1';
	else
		$autoplay = null;
	
	
	switch( $video_type ) {
		case 'youtube'	:
			return '<iframe width="'. $width .'" height="'. $height .'" src="//www.youtube.com/embed/'. $video_id .'?autohide=1&fs=1&rel=0&hd=1&color=white&modestbranding=1&theme=light&showinfo=0&iv_load_policy=1&hd=1&vq=hd720'. $autoplay .'" frameborder="0" allowfullscreen></iframe>';
			break;
		case 'vimeo'	:
			return '<iframe src="http://player.vimeo.com/video/'. $video_id .'?hd=1&show_title=1&show_byl…ortrait=0&color=ffffff&fullscreen=1&title=0&byline=0&portrait=0&loop=false'. $autoplay .'" width="'. $width .'" height="'. $height .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			break;
	}
	
}

// Get Facebook image for Open Graph meta tags
function get_fbimage() {
	global $post;
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
	if ( has_post_thumbnail($post->ID)) {
		$fbimage = $src[0];
	} else {
		global $post, $posts;
		$fbimage = '';

		if($post->post_content) {
			$output = preg_match_all('/<img\s+[^>]*src="([^"]*)"[^>]*>/i',
			$post->post_content, $matches);
            if (count($matches[1]) > 0) {
			    $fbimage = $matches[1][0];
            }
		}
	}
	if (empty($fbimage)) {
		$fbimage = get_stylesheet_directory_uri() . "/images/sprinklelab-logo.jpg";
	}
	return $fbimage;
}

//Add Featured Image Support
add_theme_support('post-thumbnails');

// Clean up the <head>
add_action('init', 'removeHeadLinks');
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}

remove_action('wp_head', 'wp_generator');

add_action( 'init', 'register_menus' );
function register_menus() {
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',
			'footer-nav' => 'Footer Navigation',
			'terms-nav' => 'Terms & Privacy Navigation'
		)
	);
}

// Remove image height and width dimensions
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); return $html;
}

function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

add_filter('get_the_content_with_formatting', 'get_the_content_with_formatting');

function get_the_content_with_formatting ($more_link_text = 'more...', $stripteaser = false) {
	$content = get_the_content($more_link_text, $stripteaser);
	$content = str_replace( '“', '"', $content);
	$content = apply_filters('the_content', $content);
	//$content = esc_attr($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

add_filter('content_edit_pre', 'replace_content');

function replace_content($content) {
	//$content = str_replace( '“', '"', $content);
	$content = str_replace( '&#8212;', "–", $content ); 
	return $content;
}


function add_custom_types_to_tax( $query ) {
if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

// Get all your post types
$post_types = get_post_types();

$query->set( 'post_type', $post_types );
return $query;
}
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

add_action('init', 'demo_add_default_boxes');
 
function demo_add_default_boxes() {
    register_taxonomy_for_object_type('category', 'director');
}

function bb_cdn( $url ) {
	
	//return $url;
	return str_replace( site_url(), 'https://s3-us-west-1.amazonaws.com/sprinklelab', $url );
	
}

function bb_the_content_cdn( $content ) {
	
	return str_replace( site_url('/wp-content/uploads'), 'https://s3-us-west-1.amazonaws.com/sprinklelab/wp-content/uploads', $content );
	
}

add_filter('the_content', 'bb_the_content_cdn');