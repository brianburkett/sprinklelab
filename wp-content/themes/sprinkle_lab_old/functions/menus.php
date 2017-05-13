<?php
add_action('init', function(){
	
	register_nav_menus(array(
		'main_nav'		=> 'Main Navigation',
		'footer_left'	=> 'Footer Left',
		'footer_right'	=> 'Footer Right'
	));
	
});