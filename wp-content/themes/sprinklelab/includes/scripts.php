<?php

add_action('init', 'theme_register_scripts');
function theme_register_scripts()
{
    wp_register_style('core', get_stylesheet_directory_uri() . '/css/core.css');
    wp_register_style('fancybox', get_stylesheet_directory_uri() . '/bower_components/fancybox/source/jquery.fancybox.css', null, '2.1');

	wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js', array('jquery'), '3.1.0', true);
	wp_register_script('jquery.scrollTo', get_stylesheet_directory_uri() . '/bower_components/jquery.scrollTo/jquery.scrollTo.min.js', array('jquery'), '1.4.11', true);
    wp_register_script('parsley', get_stylesheet_directory_uri() . '/bower_components/parsleyjs/dist/parsley.min.js', array('jquery'), '1.4.11', true);
    wp_register_script('clamp', get_stylesheet_directory_uri() . '/bower_components/clamp.js/clamp.min.js', array('jquery'), '1.0', true);
	wp_register_script('spin-js', get_stylesheet_directory_uri() . '/bower_components/spin.js/spin.js', null, '1.0', true);
    wp_register_script('jquery.transit', get_stylesheet_directory_uri() . '/bower_components/jquery.transit/jquery.transit.js', array('jquery'), '0.9.9', true);
    wp_register_script('fancybox', get_stylesheet_directory_uri() . '/bower_components/fancybox/source/jquery.fancybox.pack.js', array('jquery'), '2.1', true);
    wp_register_script('fancybox-media', get_stylesheet_directory_uri() . '/bower_components/fancybox/source/helpers/jquery.fancybox-media.js', array('fancybox'), '2.1', true);
    wp_register_script('modernizr', get_stylesheet_directory_uri() . '/bower_components/modernizr/modernizr.js', null, '1.0', true);
    wp_register_script('isotope', get_stylesheet_directory_uri() . '/bower_components/isotope/dist/isotope.pkgd.min.js', array('jquery'), '1.0', true);
    wp_register_script('clients', get_stylesheet_directory_uri() . '/js/clients.js', array('jquery'), '1.0', true);
    wp_register_script('infinite-scroll', get_stylesheet_directory_uri() . '/bower_components/infinite-scroll/jquery.infinitescroll.min.js', array('jquery'), '1.0', true);
    wp_register_script('infinitescroll', get_stylesheet_directory_uri() . '/bower_components/infiniteScroll/js/infiniteScroll.min.js', array('jquery'), '1.0', true);
    wp_register_script('init-lavalamp', get_stylesheet_directory_uri() . '/js/init-lavalamp.js', array('jquery'), '1.0', true);
    wp_register_script('easing', get_stylesheet_directory_uri() . '/bower_components/jquery.easing/js/jquery.easing.min.js', array('jquery'), '1.0', true);
    wp_register_script('lavalamp', get_stylesheet_directory_uri() . '/js/libraries/lavalamp/js/jquery.lavalamp.min.js', array('jquery'), '1.0', true);
    wp_register_script('jwplayer', get_stylesheet_directory_uri() . '/js/libraries/jwplayer/jwplayer.js', array('jquery'), '1.0', true);
    wp_register_script('jquery.videobackground', get_stylesheet_directory_uri() . '/bower_components/jquery-videobackground/script/jquery.videobackground.js', array('jquery'), null, true);

	wp_register_script('video-grid', get_stylesheet_directory_uri() . '/js/video-grid.js', array('jquery'), '2.1', true);
	
    // Global
    wp_register_script('ic-global', get_stylesheet_directory_uri() . '/js/global.js', array('modernizr', 'jquery', 'bootstrap', 'fancybox', 'fancybox-media', 'spin-js', 'parsley', 'jwplayer', 'isotope', 'video-grid'), '1.0', false);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_globals');

function theme_enqueue_globals()
{
	// Load our local version jQuery and move to footer if we're not in the admin
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_stylesheet_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', false, '1.11.0', true);
    }
    wp_enqueue_style('fancybox');
    //wp_enqueue_style('core');
    wp_enqueue_script('ic-global');
    wp_enqueue_style('video-grid', get_stylesheet_directory_uri() . '/css/video-grid.css');
}