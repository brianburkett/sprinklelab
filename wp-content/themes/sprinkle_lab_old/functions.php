<?php

show_admin_bar(false);

define('functions_folder', __DIR__.'/functions');

$dir = opendir(functions_folder);
while( ($currentFile = readdir($dir)) !== false ) {
	$ext = explode('.', $currentFile);
	if ( end($ext) !== 'php') {
        continue;
    }

include_once( functions_folder . '/' . $currentFile );
}

closedir($dir);

// Echo out Safe Varaibles
function bb_safe_vars($safe_vars=array(), $meta=array()){
	
	foreach($safe_vars as $safe_var_key => $safe_var_value){
	
		unset($safe_vars[$safe_var_key]);
		
		if( gettype($meta) == 'string' ){
			$safe_vars[$safe_var_value] = isset($meta) ? $meta : null;
		}else{
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

add_action('pre_get_posts', function($wp_query){
	
	if( is_post_type_archive('video') && $wp_query->is_main_query() && !is_admin() )
		$wp_query->query_vars['posts_per_page'] = 9;
	
});


function sprinkle_video_output($video_type=null, $video_id=null, $width="737", $height="414"){

	if( !$video_type || !$video_id )
		return null;
	
	switch( $video_type ) {
		case 'youtube'	:
							return '<iframe width="'. $width .'" height="'. $height .'" src="//www.youtube.com/embed/'. $video_id .'?autohide=1&fs=1&rel=0&hd=1&color=white&modestbranding=1&theme=light&showinfo=0&iv_load_policy=1&hd=1&vq=hd720" frameborder="0" allowfullscreen></iframe>';
							break;
		case 'vimeo'	:
							return '<iframe src="http://player.vimeo.com/video/'. $video_id .'?hd=1&show_title=1&show_byl…ortrait=0&color=ffffff&fullscreen=1&title=0&byline=0&portrait=0&loop=false" width="'. $width .'" height="'. $height .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
							break;
	}
	
}

function sprinkle_nav_current($page){
	
	$current = false;
	
	switch ( $page ) {
		
		case 'home'		:
							$current = is_front_page();
							break;
		case 'our-work'	:
							$current = is_post_type_archive('video') || get_post_type() == 'video';
							break;
		case 'blog'		:
							$current = is_home() || is_single('post');
							break;
		case 'contact'	:
							$current = is_page('contact');
							break;
		
		
	}
	
	
	if( $current )
		echo ' current';
	else
		return false;
}

/*

if( is_admin() && isset($_GET['fixdata']) ) {
	
	$videos = new WP_Query(array(
		'post_type'	=> 'video',
		'posts_per_page'	=> -1
	));
	
	if( $videos->have_posts() ) {
		while( $videos->have_posts() ) {
			
			$videos->the_post();
			
			$video_meta = get_post_meta($post->ID, '_video_loop_url', true);
			
			update_post_meta( $post->ID, '_video_loop_url', str_replace('http://sprinklelab.gopagoda.com/', 'http://www.sprinklelab.com/', $video_meta) );
			
			bb_print_r(get_post_meta($post->ID, '_video_loop_url', true));
			
		}
	
	}
	
	die();
	
}
*/