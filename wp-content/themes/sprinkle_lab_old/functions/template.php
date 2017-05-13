<?php
function sprinkle_video_list_template($post, $echo=true){
	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'work-circle' );
	$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
	
	$sprinkle_video_descriptions = get_post_meta($post->ID, '_video_descriptions', true);
	$sprinkle_video_descriptions = is_array($sprinkle_video_descriptions) ? $sprinkle_video_descriptions : array();
	
	$video_types = wp_get_object_terms( $post->ID, 'video_type' );
	$video_types = is_array($video_types) && !is_wp_error($video_types) ? $video_types : array();
	
	$video_classes = '';
	foreach( $video_types as $video_type ) {
		if( !is_object($video_type) || !isset($video_type->slug) )
			continue;
			
		$video_classes .= ' '.$video_type->slug;
	}
	
	$li_template ="
	<li class=\"$video_classes\" data-post-id=\"{$post->ID}\">
		<div class=\"featured-video-image-warp\" style=\"background-image:url('$thumb_url');\">	
			<span class=\"image-reflection\"></span>
			<a href=\"". get_permalink() ."\" class=\"featured-play-button\">
				<span><span></span></span>
				<strong>Play Now</strong>
			</a>
		</div>
		<em>". get_the_title() ."</em>
		<p>". echo_test( 'our_work_tagline', $sprinkle_video_descriptions, false ) ."</p>
	</li>";
	
	if( $echo )
		echo $li_template;
	else
		return  $li_template;
}