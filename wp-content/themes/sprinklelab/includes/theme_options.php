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
							<td valign="top"><label for="info_address">Office Address Line 1</label></td>
							<td><input type="text" name="sprinkle_theme_options[info_address]" id="info_address" value="<?php echo_test('info_address', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="info_address_2">Office Address Line 2</label></td>
							<td><input type="text" name="sprinkle_theme_options[info_address_2]" id="info_address_2" value="<?php echo_test('info_address_2', $sprinkle_theme_options); ?>" /></td>
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
						<tr>
							<td valign="top"><label for="social_linkedin">Linkedin URL <small>(must include http://)</small></label></td>
							<td><input type="text" name="sprinkle_theme_options[social_linkedin]" id="social_linkedin" value="<?php echo_test('social_linkedin', $sprinkle_theme_options); ?>" /></td>
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
							<td valign="top"><label for="home_video_list_headline">Video play text</label></td>
							<td><input type="text" name="sprinkle_theme_options[home_video_list_headline]" id="home_video_list_headline" value="<?php echo_test('home_video_list_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div>
			</div>

			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>What we do Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="what_we_do_headline">What We Do Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[what_we_do_headline]" id="what_we_do_headline" value="<?php echo_test('what_we_do_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="what_we_do_subline">What We Do Subline</label></td>
							<td><input type="text" name="sprinkle_theme_options[what_we_do_subline]" id="what_we_do_subline" value="<?php echo_test('what_we_do_subline', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>

			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>About Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="about_headline">Headline on About Page</label></td>
							<td><input type="text" name="sprinkle_theme_options[about_headline]" id="about_headline" value="<?php echo_test('about_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="about_subline">About page subline</label></td>
							<td><textarea name="sprinkle_theme_options[about_subline]" id="about_subline"><?php echo_test('about_subline', $sprinkle_theme_options); ?></textarea></td>
						</tr>
					</table>
				</div>
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
							<td valign="top"><label for="contact_form_description">Form Description</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_form_description]" id="contact_form_description" value="<?php echo_test('contact_form_description', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Our Work Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="our_work_headline">Our Work Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[our_work_headline]" id="our_work_headline" value="<?php echo_test('our_work_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>

			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>Career page Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="careers_headline">Careers Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[careers_headline]" id="careers_headline" value="<?php echo_test('careers_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="careers_subline">Careers Subline</label></td>
							<td><input type="text" name="sprinkle_theme_options[careers_subline]" id="careers_subline" value="<?php echo_test('careers_subline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="contact_form_headline">Contact form headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[contact_form_headline]" id="contact_form_headline" value="<?php echo_test('contact_form_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>

			<div class="option-wrap metabox-holder postbox">
				<h3 class="hndle"><span>404 Page Options</span></h3>
				<div class="inside">
					<table>
						<tr>
							<td valign="top"><label for="fourohfour_headline">404 Headline</label></td>
							<td><input type="text" name="sprinkle_theme_options[fourohfour_headline]" id="fourohfour_headline" value="<?php echo_test('fourohfour_headline', $sprinkle_theme_options); ?>" /></td>
						</tr>
						<tr>
							<td valign="top"><label for="fourohfour_subline">404 Subline</label></td>
							<td><input type="text" name="sprinkle_theme_options[fourohfour_subline]" id="fourohfour_subline" value="<?php echo_test('fourohfour_subline', $sprinkle_theme_options); ?>" /></td>
						</tr>
					</table>
				</div><?php // .inside ?>
			</div>
			
		</div>
		<?php submit_button('Save Options'); ?>
	</form>
	<?php
}