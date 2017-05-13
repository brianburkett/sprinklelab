<?php

$post_types = array(
    'video' => array(
        'label'  => 'Videos',
        'labels' => array(
            'singular_name'         => 'Video',
            'all_items'             => 'All Videos',
            'add_new'               => _x('Add New', 'Video'),
            'edit_item'             => _x('Edit', 'Video'),
            'new_item'              => _x('New', 'Video'),
            'view_item'             => _x('View', 'Video'),
            'search_items'          => _x('Search', 'Videos'),
            'not_found'             => 'No Videos Found',
            'not_found_in_trash'    => 'No Videos Found in Trash'
        ),
        'public'        => true,
        'supports'      => array('title', 'editor', 'thumbnail'),
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    ),
    'director' => array(
        'label'  => 'Directors',
        'labels' => array(
            'singular_name'         => 'Director',
            'all_items'             => 'Directors',
            'add_new'               => _x('Add New', 'Director'),
            'edit_item'             => _x('Edit', 'Director'),
            'new_item'              => _x('New', 'Director'),
            'view_item'             => _x('View', 'Director'),
            'search_items'          => _x('Search', 'Director'),
            'not_found'             => 'No Directors Found',
            'not_found_in_trash'    => 'No Directors Found in Trash'
        ),
        'public'        => true,
        'supports'      => array('title', 'editor', 'thumbnail'),
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=video',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    ),
    'press' => array(
        'labels' => array(
            'name' => ('Award or Press'),
            'singular_name' => ('Award'),
            'add_new' => ('Add Award or Press'),
            'add_new_item' => ('Add New Award or Press'),
            'edit_item' => ('Edit Entry'),
            'new_item' => ('New Award or Press'),
            'view_item' => ('View Entry'),
            'search_items' => ('Search Entries'),
            'not_found' => ('No Entries found'),
            'not_found_in_trash' => ('No Entry found in Trash'),
            'menu_name' => 'Press and Awards'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'supports' => array('title','editor','page-attributes','thumbnail')
    ),
    'jobs' => array(
        'labels' => array(
            'name' => ('Jobs'),
            'singular_name' => ('Job'),
            'add_new' => ('Add Job'),
            'add_new_item' => ('Add New Job'),
            'edit_item' => ('Edit Entry'),
            'new_item' => ('New Job'),
            'view_item' => ('View Job'),
            'search_items' => ('Search Entries'),
            'not_found' => ('No Entries found'),
            'not_found_in_trash' => ('No Entry found in Trash'),
            'menu_name' => 'Careers'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'supports' => array('title','editor','page-attributes','thumbnail')
    )
);

// add custom post types
add_action('init', 'ic_custom_post_types');
function ic_custom_post_types(){
    global $post_types;

    foreach( $post_types as $post_type => $params ) {
        register_post_type( $post_type, $params );
        flush_rewrite_rules();
    }
};

$taxonomies = array(
 
    'video_type'    => array(
        'object_type'   => 'video',
        'label'         => 'Video Type',
        'hierarchical'  => true
    ),
    'press_category' => array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Press or Award Category',
            'singular_name' => 'Press or Award Category',
            'search_items' => 'Search Press Categories',
            'popular_items' => 'Popular Press Categories',
            'all_items' => 'All Press Categories',
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => 'Edit Press Category',
            'update_item' => 'Update Press Category',
            'add_new_item' => 'Add Press Category',
            'new_item_name' => 'New Press Category',
            'separate_items_with_commas' => 'Separate Press Categories with commas',
            'add_or_remove_items' => 'Add or remove Press Categories',
            'choose_from_most_used' => 'Choose from the most used Press Categories',
            'menu_name' => 'Press Categories',

        ),
        'object_type' => 'press'
    )
);

// add custom post taxonomies
function ic_custom_taxonomy(){
    global $taxonomies;
    
    foreach( $taxonomies as $taxonomy => $params ) {
        register_taxonomy($taxonomy, $params['object_type'], $params);  
    }
};
add_action('init', 'ic_custom_taxonomy');  

?>