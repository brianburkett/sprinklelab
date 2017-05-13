<?php

add_action('wp_ajax_nopriv_sprinkle_video_ajax_fetch', 'sprinkle_video_ajax_fetch');
add_action('wp_ajax_sprinkle_video_ajax_fetch', 'sprinkle_video_ajax_fetch');

function sprinkle_video_ajax_fetch(){

	$post__not_in = isset($_POST['notPosts']) && is_array($_POST['notPosts']) ? $_POST['notPosts'] : array();
	$video_type = isset($_POST['filter']) && !empty($_POST['filter']) && $_POST['filter'] != '*' ? $_POST['filter'] : null;
	$posts_per_page = isset($_POST['limit']) && !empty($_POST['limit']) ? $_POST['limit'] : 9;
	
	$new_videos = new WP_Query(array(
		'post_type'			=> 'video',
		'posts_per_page'	=> $posts_per_page,
		'post__not_in'		=> $post__not_in,
		'video_type'		=> $video_type
	));
	
	$new_videos_ids = $new_videos->have_posts() ? wp_list_pluck($new_videos->posts, 'ID') : array();
	
	$new_video_html = '';
	
	if( $new_videos->have_posts() ) {
		
		while( $new_videos->have_posts() ) {
			
			$new_videos->the_post();
			global $post;
			
			$new_video_html .= sprinkle_video_list_template($post,false);
			
		}
		
	}
	
	die(json_encode(array(
		'new_video_count' 	=> $new_videos->post_count,
		'ids' 				=> $new_videos_ids,
		'video_html'		=> trim(preg_replace('/[ \t]+/', ' ', str_replace(array("\r\n", "\r", "\n", '> <'), '', $new_video_html))) //trim( str_replace('\n', '',  str_replace('\r', '', preg_replace('/[ \t]+/', ' ', $new_video_html ))))
	)));
	
	
}