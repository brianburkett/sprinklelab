<?php
add_action( 'admin_menu', function(){
	
	add_menu_page(
		'Theme Options',
		'Theme Options',
		'edit_posts',
		'theme-options',
		'sprinkle_theme_options',
		null, // icon url
		3
	);
		
} );

function sprinkle_theme_options(){

	if( isset($_POST['sprinkle_theme_options']) )
		update_option('sprinkle_theme_options', bb_sanitize_data($_POST['sprinkle_theme_options']));

	$sprinkle_theme_options = get_option('sprinkle_theme_options');
	$sprinkle_theme_options = is_array($sprinkle_theme_options) ? $sprinkle_theme_options : array();
	
	?>
	<form method="post" action="">
		<div class="wrap" id="sprinkle-options">
			<h2>Sprinkle Lab Theme Options</h2>
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>General Information</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="info_phone">Phone Number</label></td>
							<td><input type="text" name="sprinkle_theme_options[info_phone]" id="info_phone" value="<?php echo_test('info_phone', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="info_address">Office Address</label></td>
							<td><input type="text" name="sprinkle_theme_options[info_address]" id="info_address" value="<?php echo_test('info_address', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Social</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="social_facebook">Facebook URL <small>(must include http://)</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[social_facebook]" id="sprinkle_facebook" value="<?php echo_test('social_facebook', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="social_twitter">Twitter URL <small>(must include http://)</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[social_twitter]" id="social_twitter" value="<?php echo_test('social_twitter', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Homepage Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="home_sprinkle_lab_description">Description of Sprinkle Lab <br /><small>( use &#60;em&#62; to emphasize words  )</small></label></td>
							<td valign="top"><input type="text" name="sprinkle_theme_options[home_sprinkle_lab_description]" id="home_sprinkle_lab_description" value="<?php echo_test('home_sprinkle_lab_description', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_video_list_headline">Video List Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_video_list_headline]" id="home_video_list_headline" value="<?php echo_test('home_video_list_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_video_list_subline">Video List Subline</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_video_list_subline]" id="home_video_list_subline" value="<?php echo_test('home_video_list_subline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_cta_text">Call To Action Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_cta_text]" id="home_cta_text" value="<?php echo_test('home_cta_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_cta_btn_1_text">Call To Action Button 1 Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_cta_btn_1_text]" id="home_cta_btn_1_text" value="<?php echo_test('home_cta_btn_1_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_cta_btn_1_url">Call To Action Button 1 Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[home_cta_btn_1_url]" id="home_cta_btn_1_url" value="<?php echo_test('home_cta_btn_1_url', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_cta_btn_2_text">Call To Action Button 2 Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_cta_btn_2_text]" id="home_cta_btn_2_text" value="<?php echo_test('home_cta_btn_2_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="home_cta_btn_2_url">Call To Action Button 2 Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[home_cta_btn_2_url]" id="home_cta_btn_2_url" value="<?php echo_test('home_cta_btn_2_url', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="what_we_do_headline">What We Do Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[what_we_do_headline]" id="what_we_do_headline" value="<?php echo_test('what_we_do_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="what_we_do_subline">What We Do Subline</label></td>
							<td><input type="text" name="sprinkle_theme_options[what_we_do_subline]" id="what_we_do_subline" value="<?php echo_test('what_we_do_subline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="what_we_do_text">What We Do Text <br /><small>(plain text only)</small></label></td>
							<td><textarea name="sprinkle_theme_options[what_we_do_text]" id="what_we_do_text"><?php echo_test('what_we_do_text', $sprinkle_theme_options); ?></textarea></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Our Work Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="our_work_headline">Headline on Our Work Page</label></td>
							<td><input type="text" name="sprinkle_theme_options[our_work_headline]" id="our_work_headline" value="<?php echo_test('our_work_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="our_work_cta_text">Call To Action Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[our_work_cta_text]" id="our_work_cta_text" value="<?php echo_test('our_work_cta_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="our_work_cta_btn_text">Call To Action Button Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[our_work_cta_btn_text]" id="our_work_cta_btn_text" value="<?php echo_test('our_work_cta_btn_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="our_work_cta_btn_url">Call To Action Button Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[our_work_cta_btn_url]" id="our_work_cta_btn_url" value="<?php echo_test('our_work_cta_btn_url', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Single Video Page Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="single_video_cta_text">Call To Action Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[single_video_cta_text]" id="single_video_cta_text" value="<?php echo_test('single_video_cta_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="single_video_cta_btn_text">Call To Action Button Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[single_video_cta_btn_text]" id="single_video_cta_btn_text" value="<?php echo_test('single_video_cta_btn_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="single_video_cta_btn_url">Call To Action Button Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[single_video_cta_btn_url]" id="single_video_cta_btn_url" value="<?php echo_test('single_video_cta_btn_url', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Contact Page Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="contact_headline">Headline on Contact Page</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_headline]" id="contact_headline" value="<?php echo_test('contact_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_form_headline">Form Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_form_headline]" id="contact_form_headline" value="<?php echo_test('contact_form_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_form_description">Form Description</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_form_description]" id="contact_form_description" value="<?php echo_test('contact_form_description', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_cta_text">Call To Action Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_cta_text]" id="contact_cta_text" value="<?php echo_test('contact_cta_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_cta_btn_text">Call To Action Button Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_cta_btn_text]" id="contact_cta_btn_text" value="<?php echo_test('contact_cta_btn_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_cta_btn_url">Call To Action Button Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_cta_btn_url]" id="contact_cta_btn_url" value="<?php echo_test('contact_cta_btn_url', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Blog Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="blog_headline">Blog Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[blog_headline]" id="blog_headline" value="<?php echo_test('blog_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="blog_feautred_project">Featured Project in Sidebar</label></td>
							<td>
								<select name="sprinkle_theme_options[blog_feautred_project]" id="blog_feautred_project">
									<?php
									
									$selected_value = isset($sprinkle_theme_options['blog_feautred_project']) ? $sprinkle_theme_options['blog_feautred_project'] : null;
									
									$videos = new WP_Query(array(
										'post_type'	=> 'video',
										'nopaging'	=> true
									));
									
									if( $videos->have_posts() ) {
										while( $videos->have_posts() ) {
											$videos->the_post();
											global $post;
											
											$selected = ( $selected_value == $post->ID ) ? ' selected="selected" ' : null;
											
											echo "<option value=\"$post->ID\"$selected>". get_the_title() ."</option>";
											
										}
									}
									wp_reset_postdata();
									
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="top"><label for="blog_feautred_project_description">Featured Project Description</label></td>
							<td><textarea name="sprinkle_theme_options[blog_feautred_project_description]" id="blog_feautred_project_description"><?php echo_test('blog_feautred_project_description', $sprinkle_theme_options); ?></textarea></td>
						</tr>
						<tr>
							<td valign="top"><label for="blog_cta_text">Call To Action Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[blog_cta_text]" id="blog_cta_text" value="<?php echo_test('blog_cta_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="blog_cta_btn_text">Call To Action Button Text</label></td>
							<td><input type="text" name="sprinkle_theme_options[blog_cta_btn_text]" id="blog_cta_btn_text" value="<?php echo_test('blog_cta_btn_text', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="blog_cta_btn_url">Call To Action Button Link Url <small>( Must Include HTTP:// )</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[blog_cta_btn_url]" id="blog_cta_btn_url" value="<?php echo_test('blog_cta_btn_url', $sprinkle_theme_options); ?>" /></td>
						</tr>

					</table>
				</div><?php // .inside ?>
			</div>
			
		</div>
		<?php submit_button('Save Options'); ?>
	</form>
	<?php
}