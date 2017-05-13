<?php
add_action('init', function(){

$post_types = array(

		'video' => array(
						'label' 		=> 'Videos',
						'labels'		=> array(
										    	'singular_name'			=> 'Video',
										    	'all_items'				=> 'All Videos',
										    	'add_new'				=> _x('Add New', 'Video'),
										    	'edit_item'				=> _x('Edit', 'Video'),
										    	'new_item'				=> _x('New', 'Video'),
										    	'view_item'				=> _x('View', 'Video'),
										    	'search_items'			=> _x('Search', 'Videos'),
										    	'not_found'				=> 'No Videos Found',
										    	'not_found_in_trash'	=> 'No Videos Found in Trash'
										    ),
						'public'		=> true,
						'supports'		=> array('title', 'editor', 'thumbnail'),
						'menu_icon'		=> get_bloginfo('stylesheet_directory') . '/admin/images/camera-lens.png',
						'rewrite'		=> array('slug'=>'our-work'),
						'has_archive'	=> true
					)

	);
	
	foreach( $post_types as $post_type => $args ) {
	
		register_post_type($post_type, $args);
	
	}
	
	$taxonomies = array(
	
		'video_type'	=> array(
							'object_type'	=> 'video',
							'label'			=> 'Video Type',
							'hierarchical'	=> true
							
		
						)
		
	);
	
	foreach( $taxonomies as $taxonomy_name => $taxonomy_args ) {
		
		register_taxonomy($taxonomy_name, $taxonomy_args['object_type'], $taxonomy_args);
		
	}	
	
});