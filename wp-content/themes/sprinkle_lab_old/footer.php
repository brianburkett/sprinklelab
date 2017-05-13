<?php
global $sprinkle_theme_options;

$sprinkle_theme_options = is_array($sprinkle_theme_options) ? $sprinkle_theme_options : array();

?>

<footer>
	<?php
	if( is_front_page() )
		echo '<div class="triple-donuts"></div>';
	?>
	<div class="constrain">
		<form class="newsletter-signup" action="http://sprinklelab.us2.list-manage.com/subscribe/post?u=c04c7223f15fc607c239ec6c3&id=775301d5a9" method="post">
			<h6>Sign up for our newsletter</h6>
			<fieldset>
				<input type="text" name="EMAIL" placeholder="Your Email Address" />
				<div class="submit-wrap">
					<input type="image" src="<?php bloginfo('stylesheet_directory') ?>/images/button_submit-form-sprite.png" height="84" width="52" />
				</div>
			</fieldset>
		</form>
		<div class="footer-links">
			<ul class="social-links">
				<?php
				$twitter_url = echo_test('social_twitter', $sprinkle_theme_options, false);
				
				if( strlen($twitter_url) ) { ?>
					<li><a href="<?php echo $twitter_url; ?>" class="footer-twitter">Twitter</a></li>
				<?php }
				
				$facebook_url = echo_test('social_facebook', $sprinkle_theme_options, false);
				
				if( strlen($facebook_url) ) { ?>
					<li><a href="<?php echo $facebook_url; ?>" class="footer-facebook">Facebook</a></li>
				<?php } ?>
			
			</ul>
			
			<?php
			wp_nav_menu(array(
				'theme_location'	=> 'footer_left',
				'container'			=> false,
				'menu_id'			=> '',
				'menu_class'		=> 'left-links'
			));
			
			wp_nav_menu(array(
				'theme_location'	=> 'footer_right',
				'container'			=> false,
				'menu_id'			=> '',
				'menu_class'		=> 'right-links'
			));
			
			?>
			
		</div><?php // .footer-links ?>
		
	</div><?php // .constrain ?>
	
</footer>
<?php wp_footer(); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44419172-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>