<?php global $sprinkle_theme_options; ?>
<aside>
	
	<?php
	$featured_project = (integer) echo_test('blog_feautred_project', $sprinkle_theme_options, false);
	
	$featured_project = get_post($featured_project);
	
	if( $featured_project ) {
		?>
		<div class="sticky">
		
			<div class="image-turn-wrap">
				<?php echo get_the_post_thumbnail( $featured_project->ID, 'featured-project' ); ?>
			</div>
			
			<h6>Our Projects</h6>
			
			<p><?php echo html_entity_decode( echo_test('blog_feautred_project_description', $sprinkle_theme_options, false) ); ?></p>
			
		</div><?php // .sticky ?>
	<?php } ?>
	
	<div class="social-sidebar">
		<h6>Connect with us</h6>
		<ul class="social-sidebar-list">
			<?php 
			$twitter = echo_test('social_twitter', $sprinkle_theme_options, false);
			if( $twitter ) {
				?>
				<li><a href="<?php echo $twitter; ?>" class="social-twitter">Twitter</a></li>
				<?php
			}
			
			$facebook = echo_test('social_facebook', $sprinkle_theme_options, false);
			if( $facebook ) {
				?>
				<li><a href="<?php echo $facebook; ?>" class="social-facebook">Facebook</a></li>
				<?php
			}
			?>
			<li><a href="<?php bloginfo('rss_url'); ?>" class="social-rss">RSS</a></li>
			<li><a href="<?php echo site_url('/contact'); ?>" class="social-mail">Contact</a></li>
		</ul>
	</div><?php // .social-sidebar ?>
	
	<div class="sidebar-newsletter">
		<h6>Sign up for our newsletter</h6>
		<form method="post" action="http://sprinklelab.us2.list-manage.com/subscribe/post?u=c04c7223f15fc607c239ec6c3&id=775301d5a9">
			<input type="text" name="EMAIL" placeholder="Your email address" />
			<div class="submit-wrapper">
				<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/btn_subscribe.png" width="117" height="80" alt="Subscribe" title="Subscribe" />
			</div>
		</form>
	</div><?php // sidebar-newsletter ?>
	
	
</aside>