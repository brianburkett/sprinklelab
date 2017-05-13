<?php 
global $body_class, $sprinkle_theme_options;
$body_class = 'home';

get_header();


$featured_videos = new WP_Query(array(
	'post_type'				=> 'video',
	'nopaging'				=> true,
	'meta_key'				=> '_feature_on_homepage',
	'meta_value'			=> true
));

if( $featured_videos->have_posts() ) {
?>

<section id="video-carousel-wrap">
	<ul id="video-carousel">
		<?php
		$video_data = array();
		$c = 1;
		while( $featured_videos->have_posts() ) {
			$featured_videos->the_post();
			
			$video_meta = get_post_meta($post->ID, '_video_meta', true);
			$video_meta = is_array($video_meta) ? $video_meta : array();
			
			$video_descriptions = get_post_meta($post->ID, '_video_descriptions', true);
			
			$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
			
			$video_url = get_post_meta($post->ID, '_video_loop_url', true);
			$video_url = is_string($video_url) ? $video_url : null;
			
			$video_cdn_url = isset($video_meta['video_cdn_url']) ? $video_meta['video_cdn_url'] : null;
			
			$video_url = !empty( $video_cdn_url ) ? $video_cdn_url : $video_url;
			
			array_push($video_data, array(
				'title'			=> get_the_title(),
				'permalink'		=> get_permalink(),
				'tagline'		=> echo_test('video_tagline', $video_meta, false),
				'description'	=> echo_test('homepage_slider', $video_descriptions, false),
				'image'			=> $thumb_url,
				'video'			=> $video_url
				
			));
			?>
			<li style="background-image:url('<?php echo $thumb_url; ?>');"<?php if($c == '1') echo ' class="active" '; ?> data-title="<?php the_title(); ?>" data-permalink="<?php echo get_permalink($post->ID); ?>" data-tagline="<?php echo_test('video_tagline', $video_meta); ?>" data-description="<?php echo_test('homepage_slider', $video_descriptions); ?>" data-image="<?php echo $thumb_url; ?>" data-video="<?php echo $video_url; ?>"></li>
			<?php
			$c++;
		}
		//rewind_posts();
		?>
	</ul><?php // #video-carousel ?>
	<?php $video_data[0] = is_array($video_data[0]) ? $video_data[0] : array(); ?>
	<div id="video-loop-wrap"><div id="video-loop"></div></div>
	<div style="postiton:absolute;top:0;left:0;right:0;bottom:0;z-index:10;"></div>
	
	<script type="text/javascript">
		var jwPlayer = false;
	    <?php if( !wp_is_mobile() ) { ?>
	    
		if( jQuery('#video-carousel li:first-child').data('video') ) {
	    
			var jwPlayer = jwplayer("video-loop").setup({
		        file		: "<?php echo $video_data[0]['video']; ?>",
		        mute		: true,
		        controls	: false,
		        width		: '100%',
		        height		: 690,
		        repeat		: false,
		        autostart	: true,
		        stretching	: 'fill'
		        //primary		: 'flash',
		        //image		: "<?php echo $video_data[0]['image']; ?>"
		    });
		    
		    jwPlayer.onPlay(function(){
				videoDuration = jwPlayer.getDuration();
			  
				jwPlayer.onTime( function(playback){
				
					if (playback.position >= playback.duration - .25  )
						jwPlayer.seek(0)
				  
				});
			    
		    });
	    }
	     
	    <?php } ?>
	</script>
	
	
	<span class="pattern dots fade"></span>
	
	
	<span class="carousel-control previous"><span>Previous</span></span>
	<span class="carousel-control next"><span>Next</span></span>
	
	
	<div id="play-circle">
		<a href="<?php echo_test('permalink', $video_data[0]); ?>" class="play-permalink">
			<!--
<span class="play-color top"></span>
			<span class="play-color bottom"></span>
-->
			<div class="half-wrap top">
				<h3><?php echo_test('tagline', $video_data[0]); ?></h3>
				<h2><?php echo_test('title', $video_data[0]); ?></h2>
			</div>
			<div class="half-wrap bottom">
				<p><?php echo str_replace(array('[nl]', ' [nl]', ' [nl] ', '[nl] '), '<br />', echo_test( 'description', $video_data[0], false ) ); ?></p>
			</div>
			<span class="play-button">Play</span>
		</a>
		
		<script type="text/javascript">
			(function($){
			
				window.reduce_font_size_by = function(element, size_limit){
				
					size_limit = parseInt(size_limit);
					
					if( !size_limit )
						return;
				
					element.each(function(){
						
						$font = $(this);
						
						if( parseInt( $font.css('line-height') ) > size_limit )
							$font.css('line-height', size_limit + 'px' );
						
						if( $font.css('visibility') == 'visible' )
							$font.css('visibility', 'hidden');
						
						if($font.outerHeight() > size_limit) {
							var adjustTextTo = parseInt($font.css('font-size')) - 1 + 'px';
							$font.css({
								'font-size' 	:  adjustTextTo,
								'line-height'	:  adjustTextTo
							});
							if( $font.outerHeight() > size_limit )
								reduce_font_size_by($font, size_limit)
						}
						
						if( $font.outerHeight() <= size_limit )
							$font.css('visibility', 'visible');
						
					});
					
				}
				
				
				$(document).ready(function(){
					
					var $text_element = $('#play-circle h2');
					
					// params: element to check for, outer height limit
					reduce_font_size_by($text_element, 56);
					
				});
			})(jQuery);
			
			(function($){
				
				// Video Slider
				var sprinkleSlider = {};
				
				sprinkleSlider.initialize = function(){
				
					sprinkleSlider.setElements();
					sprinkleSlider.interaction();	
				}
				
				sprinkleSlider.setElements = function(){
					
					sprinkleSlider.elements = {};
					
					sprinkleSlider.elements.images = {};
					sprinkleSlider.elements.images.wrap = $('#video-carousel');
					sprinkleSlider.elements.images.li = sprinkleSlider.elements.images.wrap.find('li');
					sprinkleSlider.elements.circle = {};
					sprinkleSlider.elements.circle.wrap = $('#play-circle');
					sprinkleSlider.elements.circle.title = sprinkleSlider.elements.circle.wrap.find('h2');
					sprinkleSlider.elements.circle.link = sprinkleSlider.elements.circle.wrap.find('.play-permalink');
					sprinkleSlider.elements.circle.tagline = sprinkleSlider.elements.circle.wrap.find('h3');
					sprinkleSlider.elements.circle.description = sprinkleSlider.elements.circle.wrap.find('p');
					sprinkleSlider.elements.circle.width = sprinkleSlider.elements.circle.wrap.outerWidth();
					sprinkleSlider.elements.navigation = {};
					sprinkleSlider.elements.navigation.elems = $('.carousel-control');
					sprinkleSlider.elements.navigation.next = sprinkleSlider.elements.navigation.elems.not('previous');
					sprinkleSlider.elements.navigation.previous = sprinkleSlider.elements.navigation.elems.not('next');
					
				}
				
				sprinkleSlider.interaction = function(){
					
					sprinkleSlider.elements.navigation.elems.bind('click.sprinkeSliderNavigation', function(e){
						
						e.preventDefault();
						
						// If slider is animating, exit function
						if( window.sprinkleSliderAnmiating )
							return;
						
						// We are animating
						window.sprinkleSliderAnmiating = true;
						
						// Cached Vars
						$buttonClicked = $(this);
						
						// Figure Out Direction based on class of clicked button
						direction = $buttonClicked.is('.next') ? 'next' : 'previous';
						
						// Determine Next Slide
						currentSlide = sprinkleSlider.elements.images.wrap.find('.active');
						originalSlide = currentSlide;
						
						nextSlide = null;
						
						if( direction == 'next' ) {
							nextSlide = currentSlide.next('li');
							nextSlide = nextSlide.length ? nextSlide : sprinkleSlider.elements.images.li.eq(0);
						}else if( direction == 'previous' ) {
							nextSlide = currentSlide.prev('li');
							nextSlide = nextSlide.length ? nextSlide : sprinkleSlider.elements.images.li.eq(sprinkleSlider.elements.images.li.length - 1);
						}
						
						nextSlide.css('display', 'block');
						
						currentSlide.fadeOut(750, function(){
							sprinkleSlider.elements.images.li.removeClass('active');
							nextSlide.addClass('active');
						});
						
						function sprinkle_bring_circle_back_in(){
							
							sprinkleSlider.elements.circle.title.text(nextSlide.data('title'));
							
							sprinkleSlider.elements.circle.title.css({
								'font-size'		: 56,
								'line-height'	: 56
							});
							
							
							reduce_font_size_by(sprinkleSlider.elements.circle.title, 56);
							
							sprinkleSlider.elements.circle.link.attr('href', nextSlide.data('permalink'));
							
							sprinkleSlider.elements.circle.tagline.text(nextSlide.data('tagline'));
							sprinkleSlider.elements.circle.description.html(nextSlide.data('description').replace(/\[nl\]/g, '<br />'));
							
							sprinkleSlider.elements.circle.wrap
							.css('left', direction == 'next' ? '100%' : -parseInt(sprinkleSlider.elements.circle.width) )
							.delay(250)
							.animate(
								{
									left	: '50%',
									opacity	: 1
								},
								500,
								function(){
									window.sprinkleSliderAnmiating = false;
								}
							);
							
						}
						
						
						// Animate and Update the Play Circle through a series of callbacks
						sprinkleSlider.elements.circle.wrap
						.animate(
							{
								left	: direction == 'next' ? '0%' : '100%',
								opacity	: 0
							},
							500,
							function(){
							
								sprinkle_bring_circle_back_in();
							
								if( jwPlayer ) {
									
									jwPlayer.play(false);
									
									
									/*
									if( !window.playListPlayback ) {
									
										jwPlayer.onPlaylist(function(){
										
											window.playListPlayback = true;
											
											
											
										});
									
									}
									*/
									
									jwPlayer.load([{
										file: nextSlide.data('video')
									}]);
									
									jwPlayer.play(true); 

								}
							
							}
						);
						
					});
					
				}
				
				
				
				sprinkleSlider.initialize();

				
			})(jQuery);
			
						
		</script>
		
	</div><?php // #play-circle ?>
	
	
</section><?php // #video-carousel-wrap ?>
<?php
} // if videos have posts
wp_reset_postdata();
?>

<section class="blue">
	<div class="constrain">
		<h3 class="text-replace-we-make-delicious-videos">We Make Delicious Videos</h3>
		<h4><?php echo html_entity_decode( echo_test( 'home_sprinkle_lab_description', $sprinkle_theme_options, false ) ); ?></h4>
	</div>
</section><?php // .blue ?>

<?php
	
$latest_videos = new WP_Query(array(
	'post_type'			=> 'video',
	'posts_per_page'	=> 3,
	'orderby'			=> 'rand',
	'meta_key'			=> '_subfeature_on_homepage',
	'meta_value'		=> true
));

if( $latest_videos->have_posts() ) {

?>
<section class="sprinkle">
	
	<div class="gradient"></div>
	<div class="timeline-bar"></div>
	<div class="icing-sprinkles"></div>
	<div class="gradient-circle pos-bottom"></div>
	
	<div class="constrain">
		<h3><?php echo_test('home_video_list_headline', $sprinkle_theme_options); ?></h3>
		<h4><?php echo_test('home_video_list_subline', $sprinkle_theme_options) ?></h4>
		<div class="featured-videos-wrap">
			<ul class="featured-videos">
				
				<?php
				while( $latest_videos->have_posts() ) {
					$latest_videos->the_post();
					global $post;
					$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'featured-circle' );
					$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
				?>
				
				<li>
					<div class="featured-video-image-warp" style="background-image:url('<?php echo $thumb_url; ?>');">	
						<span class="image-reflection"></span>
						<a href="<?php the_permalink(); ?>" class="featured-play-button">
							<span><span></span></span>
							<strong>Play Now</strong>
						</a>
					</div>
					<em><?php the_title(); ?></em>
				</li>
				
				<?php } // while latest videos have posts ?>
				
			</ul>
			
		</div><?php // .featured-videos-wrap ?>
		
	</div><?php // .constrain  ?>
	
</section><?php // .sprinkle ?>

<?php } // if latest videos have posts  ?>

<section class="call-to-action">
	<?php
	$cta_button_1 = false;
	$cta_button_2 = false;
	$combo_cta_buttons = false;
	
	$home_cta_btn_1_text = echo_test('home_cta_btn_1_text', $sprinkle_theme_options, false);
	$home_cta_btn_1_url = echo_test('home_cta_btn_1_url', $sprinkle_theme_options, false);
	$home_cta_btn_2_text = echo_test('home_cta_btn_2_text', $sprinkle_theme_options, false);
	$home_cta_btn_2_url = echo_test('home_cta_btn_2_url', $sprinkle_theme_options, false);
	
	if( $home_cta_btn_1_text && $home_cta_btn_1_url )
		$cta_button_1 = true;
	
	if( $home_cta_btn_2_text && $home_cta_btn_2_url )
		$cta_button_2 = true;
	
	if( $cta_button_1 && $cta_button_2 )
		$combo_cta_buttons = true;
		
	?>
	<h3><?php echo_test('home_cta_text', $sprinkle_theme_options); if( $cta_button_1 ) { ?> <a href="<?php echo $home_cta_btn_1_url; ?>" class="btn pink"><?php echo $home_cta_btn_1_text; ?></a><?php } if( $combo_cta_buttons ) echo ' or '; if( $cta_button_2 ) { ?><a href="<?php echo $home_cta_btn_2_url; ?>" class="btn green"><?php echo $home_cta_btn_2_text; ?></a><?php } ?></h3>
</section>

<section class="what-we-do">
	<div class="gradient-circle pos-top"></div>
	<div class="corner-icing green"></div>
	<h3><?php echo_test('what_we_do_headline', $sprinkle_theme_options); ?></h3>
	<h4><?php echo_test('what_we_do_subline', $sprinkle_theme_options) ?></h4>
	
	<ol>
		<li style="background-image:url('<?php bloginfo('stylesheet_directory'); ?>/images/image_rocket-strategy.png');">
			<strong>1</strong> Strategy
		</li>
		<li style="background-image:url('<?php bloginfo('stylesheet_directory'); ?>/images/image_rocket-production.png');">
			<strong>2</strong> Production
		</li>
		<li style="background-image:url('<?php bloginfo('stylesheet_directory'); ?>/images/image_rocket-delivery.png');">
			<strong>3</strong> Delivery
		</li>
	</ol>
	
	<div class="content-block">
		<p><?php echo_test('what_we_do_text', $sprinkle_theme_options); ?></p>
	</div>
	
	<span style="display:block;height:2px;position:absolute !important;bottom:0;left:0;right:0;background:#FFF;"></span>
	
</section>


<?php get_footer(); ?>