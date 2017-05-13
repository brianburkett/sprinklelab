<?php
function sprinkle_video_list_template($post, $echo=true){
	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'our-work' );
	$thumb_url = is_array($thumb_url) ? bb_cdn( $thumb_url[0] ) : null;
	
	$sprinkle_video_descriptions = get_post_meta($post->ID, '_video_descriptions', true);
	$sprinkle_video_descriptions = is_array($sprinkle_video_descriptions) ? $sprinkle_video_descriptions : array();
	
	$video_types = wp_get_object_terms( $post->ID, 'video_type' );
	$video_types = is_array($video_types) && !is_wp_error($video_types) ? $video_types : array();

	$director = get_field('directors');

	if( $director ) {
		$postis = $director;
		setup_postdata( $postis ); 
		$postName = $postis->post_name;
		wp_reset_postdata();
	} else {
		$postName = '*';
	}
	
	$video_classes = '';
	foreach( $video_types as $video_type ) {
		if( !is_object($video_type) || !isset($video_type->slug) )
			continue;
			
		$video_classes .= ' '.$video_type->slug;
	}

	$li_template ="
	<li class=\"$postName\" data-post-id=\"{$post->ID}\">
		<div class=\"new-project\">	
			<a href=\"" . get_permalink() . "\" class=\"btn-circle\" style=\"background-image:url('$thumb_url');\">	
                <div class=\"overlay\"><div class=\"content\"></div></div>
            </a>
            <h4 class=\"header smallest\">" . get_the_title() . "
            	<span class=\"subheader\">" . echo_test( 'our_work_tagline', $sprinkle_video_descriptions, false ) . "</span>
            </h4>
        </div>
    </li>";
	
	if( $echo )
		echo $li_template;
	else
		return  $li_template;
}