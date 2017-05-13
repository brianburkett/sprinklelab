<?php global $sprinkle_theme_options; ?>
<aside>
			
	<div class="sticky">
	
		<h6>We've worked with...</h6>
		
		<img src="<?php bloginfo('stylesheet_directory') ?>/images/logos_worked-with.png" width="293" height="176" alt="IBM, Yammer, Charity:Water, P, razorfish, Invisible Children" style="display:block;margin: 0 auto;" />
		
	</div><?php // .sticky ?>
	
	
	<?php
	$sprikle_phone_number = echo_test('info_phone', $sprinkle_theme_options, false);
	$sprikle_address = echo_test('info_address', $sprinkle_theme_options, false);
	if( $sprikle_phone_number || $sprikle_address ) {
	?>
	<div class="other-ways-to-contact-us">
		<h6>Other ways to contact us</h6>
		<?php if( $sprikle_phone_number ) { ?>
		<p><strong>Our Phone Number:</strong> <?php echo $sprikle_phone_number; ?></p>
		<?php
		}
		
		if( $sprikle_address ) {
		?>
		<p><strong>Our Office Address:</strong> <?php echo $sprikle_address; ?></p>
		<?php } ?>
	</div>
	<?php } ?>
	
	
</aside>