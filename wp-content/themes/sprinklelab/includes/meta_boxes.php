<?php

add_action('add_meta_boxes', function($post_type){
	
	if( $post_type == 'video' ) {
	
		add_meta_box('video_descriptions','Video Descriptions', function($post) {
			$sprinkle_video_descriptions = get_post_meta($post->ID, '_video_descriptions', true);
			$sprinkle_video_descriptions = is_array($sprinkle_video_descriptions) ? $sprinkle_video_descriptions : array();
			?>
			<div class="description-meta-wrap">
				<label>
					Homepage Slider <small>( Inside Circle -- use "[nl]" without quotes to output a new line )</small>
					<textarea name="sprinkle_video_descriptions[homepage_slider]"><?php echo_test('homepage_slider', $sprinkle_video_descriptions); ?></textarea>
				</label>
				<label>
					Our Work Tagline <small>( Under Video Circle )</small>
					<textarea name="sprinkle_video_descriptions[our_work_tagline]"><?php echo_test('our_work_tagline', $sprinkle_video_descriptions); ?></textarea>
				</label>
			</div>
			<?php
			
		}, $post_type, 'side');
		
		add_meta_box('video_meta', 'Video Meta', function($post){
			$video_meta = get_post_meta($post->ID, '_video_meta', true);
			$video_meta = is_array($video_meta) ? $video_meta : array();
			$feature_on_homepage = get_post_meta($post->ID, '_feature_on_homepage', true);
			$subfeature_on_homepage = get_post_meta($post->ID, '_subfeature_on_homepage', true);
			
			$video_type = isset($video_meta['video_type']) && !empty($video_meta['video_type']) ? $video_meta['video_type'] : null;
			
			$loop_video = get_post_meta($post->ID, '_video_loop_url', true);
			$loop_video = is_string($loop_video) ? $loop_video : null;
			?>
			
			<div class="wrap">
				<input type="hidden" name="sprinkle_video_meta[fire]" value="true" />
				<table>
					<tr>
						<td><label for="video_tagline">Video Tagline</label></td>
						<td><input type="text" name="sprinkle_video_meta[video_tagline]" id="video_tagline" value="<?php echo_test('video_tagline', $video_meta) ?>" /></td>
					</tr>
					<tr>
						<td><label for="feature_on_homepage">Feature On Homepage</label></td>
						<td>
							<input type="hidden" name="feature_on_homepage" value="0" />
							<input type="checkbox" name="feature_on_homepage" id="feature_on_homepage" value="1" <?php checked(true, $feature_on_homepage) ?> />
						</td>
					</tr>
					<tr>
						<td><label for="subfeatured_on_homepage">Sub Feature On Homepage</label></td>
						<td>
							<input type="hidden" name="subfeature_on_homepage" value="0" />
							<input type="checkbox" name="subfeature_on_homepage" id="subfeature_on_homepage" value="1" <?php checked(true, $subfeature_on_homepage) ?> />
						</td>
					</tr>
					<tr>
						<td valign="top"><label for="video_loop">Loop Video</label><br /><small>only if video is featured on homepage</small></td>
						<td valign="top">
							<small>
							Files must either be: .mov and under <?php echo (int)(ini_get('upload_max_filesize')); ?> MB <br />
							Video Compression is highly encouraged, you should aim for videos under ~5mb
							</small><br />
							<input type="file" name="sprinkle_loop_video" /> <label><input type="checkbox" name="remove_video_loop" value="1" /> Remove Video</label>
							<?php if( strlen($loop_video) ) { ?><br /><small>Currently Stored: <strong><?php echo basename($loop_video); ?></strong></small><?php } ?>
						</td>
					</tr>
					<tr>
						<td><label for="video_cdn_url">Video CDN URL:</label></td>
						<td><input type="text" name="sprinkle_video_meta[video_cdn_url]" value="<?php echo_test( 'video_cdn_url', $video_meta ); ?>" /></td>
					</tr>
					<tr>
						<td valign="top"><label for="video_type">Video Type</label></td>
						<td>
							<label><input type="radio" name="sprinkle_video_meta[video_type]" id="video_type" value="youtube" <?php checked( 'youtube', $video_type ); ?> /> Youtube</label><br />
							<label><input type="radio" name="sprinkle_video_meta[video_type]" id="video_type" value="vimeo" <?php checked( 'vimeo', $video_type ); ?> /> Vimeo</label>
						</td>
					</tr>
					<tr>
						<td><label for="video_id">Video ID</label></td>
						<td><input type="text" name="sprinkle_video_meta[video_id]" id="video_id" value="<?php echo_test('video_id', $video_meta); ?>" /></td>
					</tr>
					<tr>
						<td><label for="background_image_id">Background Image ID:<br /> <small>If no ID, will use Featured Image</small></label></td>
						<td valign="top"><input type="text" name="sprinkle_video_meta[background_image_id]" id="background_image_id" value="<?php echo_test('background_image_id', $video_meta) ?>" />
					</tr>
					<tr>
						<td valign="top">What We Did:</td>
						<td>
							<textarea name="sprinkle_video_meta[we_did_this]" id="what_we_did"><?php echo_test('we_did_this', $video_meta) ?></textarea>
						</td>
					</tr>
					<tr>
						<td><label for="what_we_did_description">What We Did Description:</label></td>
						<td>
							<textarea name="sprinkle_video_meta[what_we_did_description]" id="what_we_did_description"><?php echo_test('what_we_did_description', $video_meta) ?></textarea>
						</td>
					</tr>
					<tr>
						<td><label for="what_we_did_gallery">What We Did Gallery Images:<br /> <small>separate image ID's by commas, no spaces</small></label></td>
						<td><input type="text" name="sprinkle_video_meta[what_we_did_gallery]" id="what_we_did_gallery" value="<?php echo_test('what_we_did_gallery', $video_meta) ?>" />
					</tr>
					<tr>
						<td><label for="video_testimonial">Testimonial Quote:</label></td>
						<td><textarea name="sprinkle_video_meta[video_testimonial]" id="video_testimonial"><?php esc_attr(echo_test('video_testimonial', $video_meta)); ?></textarea>
					</tr>
					<tr>
						<td><label for="video_person">Who's testimony is this?</label></td>
						<td>
							<input name="sprinkle_video_meta[video_person]" id="video_person" value="<?php echo_test('video_person', $video_meta); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="video_job">Testimonial job title</label></td>
						<td>
							<input name="sprinkle_video_meta[video_job]" id="video_job" value="<?php echo_test('video_job', $video_meta); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="video_job">Testimonial company</label></td>
						<td>
							<input name="sprinkle_video_meta[video_company]" id="video_company" value="<?php echo_test('video_company', $video_meta); ?>">
						</td>
					</tr>
					<tr>
						<td><label for="testimonial_image_id">Testimonial Image ID</label></td>
						<td>
							<input type="text" name="sprinkle_video_meta[testimonial_image_id]" id="testimonial_image_id" value="<?php echo_test('testimonial_image_id', $video_meta) ?>" />
						</td>
					</tr>
				</table>
			</div>
			
			<?php
			
		}, $post_type );
	
	}
	
	add_meta_box('post_meta', 'Post Options', function( $post ){
		
		$post_meta = get_post_meta( $post->ID, '_post_meta', true );
		$post_meta = is_array($post_meta) ? $post_meta : array();
		$video_type = isset($post_meta['video_type']) && !empty($post_meta['video_type']) ? $post_meta['video_type'] : null;
		
		?>
		<div class="wrap">
			<input type="hidden" name="post_meta[fire]" value="1" />
			<table>
				<tr>
					<td><label for="hide_title">Hide Title</label></td>
					<td>
						<input type="hidden" name="post_meta[hide_title]" value="0" />
						<input type="checkbox" name="post_meta[hide_title]" id="hide_title" value="1" <?php checked(true, echo_test( 'hide_title', $post_meta, false )); ?> />
					</td>
				</tr>
				<tr>
					<td valign="top"><label for="video_type">Video Type</label></td>
					<td>
						<label><input type="radio" name="post_meta[video_type]" id="video_type" value="youtube" <?php checked( 'youtube', $video_type ); ?> /> Youtube</label><br />
						<label><input type="radio" name="post_meta[video_type]" id="video_type" value="vimeo" <?php checked( 'vimeo', $video_type ); ?> /> Vimeo</label>
					</td>
				</tr>
				<tr>
					<td><label for="video_id">Video ID</label></td>
					<td><input type="text" name="post_meta[video_id]" id="video_id" value="<?php echo_test('video_id', $post_meta); ?>" /></td>
				</tr>
				
			</table>
		</div>

		<?php
		
	}, 'post');

});

add_action('post_edit_form_tag', function(){
	echo 'enctype="multipart/form-data"';
});

add_action('save_post', function($post_id){
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || wp_is_post_revision($post_id) )
		return;
	
	switch( get_post_type($post_id) ) {
		case 'video' :	
			if( isset($_POST['sprinkle_video_descriptions']) )
				update_post_meta($post_id, '_video_descriptions', bb_sanitize_data($_POST['sprinkle_video_descriptions']));
				
			if( isset($_POST['sprinkle_video_meta']) )
				update_post_meta($post_id, '_video_meta', $_POST['sprinkle_video_meta']);
		
			if( isset($_POST['feature_on_homepage']) )
				update_post_meta( $post_id, '_feature_on_homepage', bb_sanitize_data( $_POST['feature_on_homepage'] ) );
				
			if( isset($_POST['subfeature_on_homepage']) )
				update_post_meta( $post_id, '_subfeature_on_homepage', bb_sanitize_data( $_POST['subfeature_on_homepage'] ) );						
			
			if( isset($_FILES['sprinkle_loop_video']) ) {
				if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
				
				$uploaded_file = wp_handle_upload($_FILES['sprinkle_loop_video'], array('test_form'=>false));
				
				$uploaded_file = is_array($uploaded_file) && !is_wp_error($uploaded_file) ? $uploaded_file : array();
				
				$loop_video_url = isset($uploaded_file['url']) ? $uploaded_file['url'] : false;
				
				if( $loop_video_url )
					update_post_meta( $post_id, '_video_loop_url', $loop_video_url );
			}
			
			if( isset($_POST['remove_video_loop']) && $_POST['remove_video_loop'] )
				update_post_meta( $post_id, '_video_loop_url', null );
			break;

		case 'post'	:		
			if( isset($_POST['post_meta']) )
				update_post_meta( $post_id, '_post_meta', bb_sanitize_data($_POST['post_meta']) );
	}
	
});