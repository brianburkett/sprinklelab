<?php global $sprinkle_theme_options; 
?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-8" id="blue-column">
						<div id="stay-connected">Stay Connected</div>
						<form class="input-group input-group-lg form-horizontal email-form" id="email-form" method="post" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" data-parsley-errors-container="#errors-container">
							<input type="hidden" name="thx" value="<%= baseurl %>/?email-signup-result=success"/>
							<input type="hidden" name="err" value="<%= baseurl %>/?email-signup-result=error"/>
							<input type="hidden" name="usub" value="<%= baseurl %>/?email-signup-result=unsubscribe"/>
							<input type="hidden" name="MID" value="10415228"/>
							<input type="hidden" name="SubAction" value="sub_add_update"/>
							<input type="hidden" name="Email Type" value="HTML"/>
							<div class="input-group input-group-lg email-group">
								<input type="email" class="form-control" placeholder="Leave your email address here" name="email" required autocomplete="off"/>
					            <span class="input-group-btn submit-btn-wrap">
					                <input type="Submit" class="btn btn-border primary" value="Submit"/>
					            </span>
							</div>
							<div id="errors-container"></div>
						    <div class="message-container">
						        <p class="success"><span class="glyphicon glyphicon-ok"></span>Your email has been successfully submitted!</p>
						        <p class="error"><span class="glyphicon glyphicon-remove"></span>Sorry, but an error has occurred. Please try again later!</p>
						    </div>
						</form>
						<ul id="social-links">
							<li><a href="<?php echo_test('social_twitter', $sprinkle_theme_options); ?>" target="_blank">Twitter</a></li>
							<li><a href="<?php echo_test('social_linkedin', $sprinkle_theme_options); ?>" target="_blank">LinkedIn</a></li>
							<li><a href="<?php echo_test('social_facebook', $sprinkle_theme_options); ?>" target="_blank">Facebook</a></li>
						</ul>
						<?php wp_nav_menu(array(
	                        'theme_location' => 'terms-nav',
	                        'container' => 'nav',
	                        'container_class' => 'term-items',
	                        'container_id' => 'terms-nav',
	                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li>&copy; Sprinkle Lab 2014</li></ul>',
	                        'menu' => 'Terms & Privacy Navigation'
	                    )); ?>
					</div>
					<div class="col-md-3 col-sm-4" id="black-column">
						<?php wp_nav_menu(array(
	                        'theme_location' => 'footer-nav',
	                        'container' => 'nav',
	                        'container_class' => 'footer-items',
	                        'container_id' => 'footer-nav',
	                        'menu' => 'Footer Navigation'
	                    )); ?>
	                </div>
				</div>
			</div>
		</footer>
		<div id="contact">
			<div id="modal">
	            <div class="modal-header">
		            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/donut.png" />
	                <h2 class="header medium">
						<?php echo_test('contact_headline', $sprinkle_theme_options); ?>
					</h2>
	            </div>
	            <div class="modal-body">
		            <ul class="contact-list">
			            <li>
			            	<strong>Cameron Woodward</strong>
			            	<em>Executive Producer</em>
			            	<ul>
				            	<li><a href="tel:1-415-690-8059"><i class="fa fa-phone-square"></i> <span>1 (415) 690-8059</span></a></li>
				            	<li><a href="mailto:cameron@sprinklelab.com"><i class="fa fa-envelope"></i> <span>cameron@sprinklelab.com</span></a></li>
			            	</ul>
			            </li>
			            <li>
			            	<strong>Brandon Tauszik</strong>
			            	<em>Creative Director</em>
			            	<ul>
				            	<li><a href="tel:1-510-990-0656"><i class="fa fa-phone-square"></i> <span>1 (510) 990-0656</span></a></li>
				            	<li><a href="mailto:brandon@sprinklelab.com"><i class="fa fa-envelope"></i> <span>brandon@sprinklelab.com</span></a></li>
			            	</ul>
			            </li>
			            <li>
			            	<strong>Matty Barnes</strong>
			            	<em>Supervising Producer</em>
			            	<ul>
				            	<li><a href="tel:1-510-698-9777"><i class="fa fa-phone-square"></i> <span>1 (510) 698-9777</span></a></li>
				            	<li><a href="mailto:matty@sprinklelab.com"><i class="fa fa-envelope"></i> <span>matty@sprinklelab.com</span></a></li>
			            	</ul>
			            </li>
			            <li>
			            	<ul>
				            	<li><a href="https://www.google.com/maps/place/Sprinkle+Lab/@37.8241542,-122.2901158,17z/data=!3m1!4b1!4m5!3m4!1s0x80857e3d7e2f5955:0xe6a2abf9559c7207!8m2!3d37.82415!4d-122.2879271"  target="_blank" rel="noopener noreferrer"><i class="fa fa-map-marker"></i> <span>3246 Ettie Street #23, Oakland, CA 94608</span></a></li>
			            	</ul>
			            </li>
		            </ul><!-- /.contact-list -->
		            <?php /*
	            	<form method="post" class="contact-form" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">			
						<input type="text" name="contact[name]" id="Name" value="" class="" placeholder="Name" required>
						
						<input type="email" name="contact[email]" id="Email" value="" class="" placeholder="Email" required>
						
						<input type="text" name="contact[phone]" id="Phone" value="" class="" placeholder="Phone number">
						
						<input type="text" name="contact[company_name]" id="Company" value="" placeholder="Company Name">
						
						<textarea name="contact[message]" placeholder="Your message..." id="Message" required></textarea>
				
						<div class="submit-wrapper">
							<input type="submit" width="206" height="86" value="Submit" alt="Send It!" title="Send It!">
						</div>
						<div class="message-container">
					        <p class="success"><span class="glyphicon glyphicon-ok"></span>Your message has been successfully submitted!</p>
					        <p class="error"><span class="glyphicon glyphicon-remove"></span>Sorry, but an error has occurred. Please try again later!</p>
					    </div>
					</form>
					*/ ?>
	            </div>
	         </div>
		</div>
		<?php wp_footer() ?>
	</body>
</html>