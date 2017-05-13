<?php
$body_class = 'contact';
$contact_data = isset($_POST['contact']) && is_array($_POST['contact']) ? $_POST['contact'] : array();
$error = false;
$valid_human = true;
$email = true;
$mail_sent = false;

if( !empty($contact_data) ) {
	$contact_data = is_array($_POST['contact']) ? $_POST['contact'] : array();
	
	$email = isset($contact_data['email']) ? sanitize_email( $contact_data['email'] ) : null;
	$name = isset($contact_data['name']) ? sanitize_text_field( $contact_data['name'] ) : null;
	$phone = isset($contact_data['phone']) ? sanitize_text_field( $contact_data['phone'] ) : null;
	$company_name = isset($contact_data['company_name']) ? sanitize_text_field( $contact_data['company_name'] ) : null;
	$message = isset($contact_data['message']) ? sanitize_text_field( $contact_data['message'] ) : null;
	$human_check = isset($contact_data['human_check']) ? sanitize_text_field( strtolower( $contact_data['human_check'] ) ) : null;
	
	$human_proof = 'sprinkle donut';
	
	$valid_human = $human_check == $human_proof ? true : false;
	
	
	if( !$valid_human || !$email )
		$error = true;
	
	
	if( $email && $valid_human ) {
		$mail_sent = wp_mail('cameron@sprinklelab.com', 'Sprinkle Lab Contact Form', "Name		: $name
Email		: $email
Phone	: $phone
Company	: $company_name
Message	: $message
		", array("From: $name <$email>"));
	}
	
	
	
}

include_once('header.php');

global $sprinkle_theme_options;
?>
<section class="headline">
	<span class="pink-bar"></span>
	<span class="corner-icing pink"></span>
	<h3><?php echo_test('contact_headline', $sprinkle_theme_options); ?></h3>
</section>
<div class="contact-content-wrap gray-full-width">
	<div class="col-wrap">
		<section class="contact-form-wrap col-left">
			
			<?php if( $mail_sent ) { ?>
				<h4 class="success">
					Have you ever seen the words, "sprinkle donut" on a contact form? We'll now you have, you're welcome. 
					<br />
					<br />
					P.S. Thanks for getting in touch, we'll get back to you soon. 
				</h4>
			<?php } else { ?>
			
			<h4><?php echo_test('contact_form_headline', $sprinkle_theme_options); ?></h4>
			<p><?php echo_test('contact_form_description', $sprinkle_theme_options); ?></p>
			
			<form method="post" action="" class="contact-form">
				
				<?php if( $error ) { ?>
				<p class="error-alert">There was a problem with the entry. Please correct highlighted areas.</p>
				<?php } ?>
				
				<input type="text" name="contact[name]" id="contact_name" value="<?php echo_test('name', $contact_data); ?>" class="" />
				<label for="contact_name">Your name: </label>
				
				<input type="text" name="contact[email]" id="contact_email" value="<?php echo_test('email', $contact_data); ?>" class="<?php if( !$email ) echo 'error'; ?>"/>
				<label for="contact_email">Your email address: </label>
				
				<input type="text" name="contact[phone]" id="contact_phone" value="<?php echo_test('phone', $contact_data); ?>" class="" />
				<label for="contact_phone">Your phone number: </label>
				
				<input type="text" name="contact[company_name]" id="contact_company_name" value="<?php echo_test('company_name', $contact_data); ?>" />
				<label for="contact_company_name">Company name: </label>
				
				<textarea name="contact[message]" placeholder="Your message..."><?php echo_test('message', $contact_data) ?></textarea>
				
				<label for="contact_human_check" class="above<?php if( !$valid_human ) echo ' error'; ?>">Let us know you’re human: Type “sprinkle donut” below before submitting:</label>
				<input type="text" name="contact[human_check]" id="contact_human_check" value="<?php echo_test('human_check', $contact_data) ?>" />
				
				<div class="submit-wrapper">
					<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_contact-sumbit-v2.png" width="206" height="86" alt="Send It!" title="Send It!" />
				</div>
			</form>
			
			<?php } ?>

			
		</section>
		<?php get_sidebar('contact'); ?>
	</div><?php // .col-wrap ?>
</div>
<section class="call-to-action">
	<?php 
	$cta_link_text = echo_test('contact_cta_btn_text', $sprinkle_theme_options, false);
	$cta_link_url = echo_test('contact_cta_btn_url', $sprinkle_theme_options, false); 
	?>
	<h3><?php echo_test('contact_cta_text', $sprinkle_theme_options); if( $cta_link_text && $cta_link_url ) { ?> <a href="<?php echo $cta_link_url; ?>" class="btn pink"><?php echo $cta_link_text; ?></a><?php } ?></h3>
</section>
<?php include_once('footer.php'); ?>