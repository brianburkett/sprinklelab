<?php
add_action('wp_enqueue_scripts', function(){
	
	// Styles
	wp_register_style('isotope', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/isotope/isotope.css');
	wp_register_style('fancybox', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/fancybox/jquery.fancybox-1.3.4.css');
	wp_register_style('style', get_bloginfo('stylesheet_directory') . '/style.css');

	wp_enqueue_style('style');
	
	
	// Scritps
	wp_register_script(	'infinitescroll', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/infinitescroll/jquery.infinitescroll.min.js');
	wp_register_script(	'isotope', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/isotope/jquery.isotope.min.js');
	wp_register_script(	'fancybox', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/fancybox/jquery.fancybox-1.3.4.pack.js');
	wp_register_script(	'lavalamp', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/lavalamp/jquery.lavalamp.js');
	wp_register_script(	'easing', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/easing/jquery.easing.1.3.min.js');
	wp_register_script(	'jwplayer', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/jwplayer/jwplayer.js');
	wp_register_script(	'jwplayer-html5', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/jwplayer/jwplayer.html5.js');
	//wp_register_script(	'classywiggle', get_bloginfo('stylesheet_directory') . '/javascripts/plugins/classywiggle/jquery.classywiggle.js');
	wp_register_script(	'scripts', get_bloginfo('stylesheet_directory') . '/javascripts/scripts.js');
	
	
	wp_localize_script( 'scripts', 'wordpress', array( 'ajax' => admin_url( 'admin-ajax.php' ) ) );
	
	if( is_admin() ) {
		wp_enqueue_script('jquery');
	} else {
		//wp_deregister_script( 'jquery' );
		//wp_register_script('jquery', get_bloginfo('stylesheet_directory') . '/javascripts/jquery-2.0.3.min.js');
		wp_enqueue_script('jquery');
	}
	
	// Video Specific Files
	if( is_post_type_archive('video') ) {
		wp_enqueue_style('isotope');
		wp_enqueue_script('isotope');
	}
	
	if( is_home() ) {
		wp_localize_script( 'scripts', 'wordpress', array( 'stylesheetdirectory' => get_bloginfo('stylesheet_directory') ) );
		wp_enqueue_script('infinitescroll');
	}
	
	if( is_front_page() ) {
		wp_enqueue_script('jwplayer');
		wp_enqueue_script('jwplayer-html5');
	}
	
	if( is_single() && get_post_type() == 'video' ) {
		wp_enqueue_style('fancybox');
		wp_enqueue_script('fancybox');
	}
 	
	wp_enqueue_script('easing');
	wp_enqueue_script('lavalamp');
	//wp_enqueue_script('classywiggle');
	wp_enqueue_script('scripts');
	
});

add_action('admin_enqueue_scripts', function(){
	
	// Styles
	wp_register_style('admin', get_bloginfo('stylesheet_directory') . '/admin/admin.css');
	
	wp_enqueue_style('admin');
	
	// Scripts
	
});