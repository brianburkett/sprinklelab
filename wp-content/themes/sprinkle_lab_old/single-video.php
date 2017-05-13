<?php
$body_class = 'single-video';
get_header();
global $sprinkle_theme_options;

the_post();

$video_meta = get_post_meta($post->ID, '_video_meta', true);
?>

<section class="headline with-subline">
	<span class="pink-bar"></span>
	<span class="corner-icing pink"></span>
	<h3><?php the_title(); ?></h3>
	<h2><?php echo_test('video_tagline', $video_meta); ?></h2>
</section><?php // .headline ?>
<?php
$thumb_id = echo_test('background_image_id', $video_meta, false);
$thumb_id = !empty($thumb_id) ? $thumb_id : get_post_thumbnail_id($post->ID);
$thumb_url = wp_get_attachment_image_src( $thumb_id , 'full' );
$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
?>
<section class="video" style="background-image:url('<?php echo $thumb_url; ?>');">
	<div class="player">
		<?php echo sprinkle_video_output(echo_test('video_type', $video_meta, false), echo_test('video_id', $video_meta, false), 560, 315); ?>
	</div>
</section><?php // .video ?>
<section class="video-description">
	<div class="constrain">
		<?php the_content(); ?>
	</div>
</section><?php //video-description ?>
<section class="blue">
	<div class="constrain">
		<h3>What did we do?</h3>
		<ul class="what-we-did">
			<?php
			$what_did_we_do = isset($video_meta['what_we_did']) && is_array($video_meta['what_we_did']) ? $video_meta['what_we_did'] : array();
			?>
			<li class="graphic-strategy<?php if( in_array('strategy', $what_did_we_do) )echo ' active'; ?>">strategy</li>
			<li class="graphic-production<?php if( in_array('production', $what_did_we_do) )echo ' active'; ?>">production</li>
			<li class="graphic-delivery<?php if( in_array('delivery', $what_did_we_do) )echo ' active'; ?>">delivery</li>
		</ul>
		<div class="project-description">
			<?php echo wpautop( echo_test('what_we_did_description', $video_meta, false) ); ?>
		</div>
		<ul class="project-gallery">
			<?php
			$video_ids = echo_test('what_we_did_gallery', $video_meta, false);
			
			$video_ids = !empty($video_ids) ? explode(',', $video_ids) : array();
			
			if( !empty($video_ids) ) {
				foreach( $video_ids as $video_id ) {
					$bkg_url = wp_get_attachment_image_src( $video_id, 'what-we-did' );
					$bkg_url = is_array($bkg_url) && !empty($bkg_url) ? $bkg_url[0] : null;
					$full_image = wp_get_attachment_image_src( $video_id, 'full' );
					$full_image = is_array($full_image) && !empty($full_image) ? $full_image[0] : null;
					?>
					<li style="background-image:url('<?php echo $bkg_url; ?>');" ><a href="<?php echo $full_image; ?>" rel="image-group">Image</a></li>
					<?php
				}
			} ?>
		</ul>
	</div>
</section><?php // .blue ?>
<?php
$testimonial_image = echo_test('testimonial_image_id', $video_meta, false);
		
$testimonial_image = !empty($testimonial_image) ? wp_get_attachment_image_src( $testimonial_image, 'testimonial' ) : array();
$testimonial_image = is_array($testimonial_image) && !empty($testimonial_image) ? $testimonial_image[0] : null;

?>
<section class="testimonial">
	<div class="constrain">
		<?php if( $testimonial_image ) { ?>
		<div class="image-turn-wrap">
			<img src="<?php echo $testimonial_image; ?>" width="163" height="163" />
		</div>
		<?php } ?>
		<p><?php echo_test('video_testimonial', $video_meta); ?></p>
	</div>
</section>
<section class="call-to-action">
	<?php 
	$cta_link_text = echo_test('single_video_cta_btn_text', $sprinkle_theme_options, false);
	$cta_link_url = echo_test('single_video_cta_btn_url', $sprinkle_theme_options, false); 
	?>
	<h3><?php echo_test('single_video_cta_text', $sprinkle_theme_options); if( $cta_link_text && $cta_link_url ) { ?> <a href="<?php echo $cta_link_url; ?>" class="btn pink"><?php echo $cta_link_text; ?></a><?php } ?></h3>
</section>
<section class="other-videos">
	<div class="ooze-blue"></div>
	<div class="constrain">
		<div class="timeline-bar"></div>
		<h3>You'll also love...</h3>
		<div class="featured-videos-wrap">
			<ul class="featured-videos">
				<?php
				$other_videos = new WP_Query(array(
					'post_type'			=> 'video',
					'posts_per_page'	=> 4,
					'post__not_in'		=> array($post->ID),
					'orderby'			=> 'rand'
				));
				
				if( $other_videos->have_posts() ) {
					while( $other_videos->have_posts() ) {
						$other_videos->the_post();
						global $post;
						
						$tiny_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'related-circle' );
						$tiny_thumb_url = is_array($tiny_thumb_url) ? $tiny_thumb_url[0] : null;
						?>
						<li>
							<div class="featured-video-image-warp" style="background-image:url('<?php echo $tiny_thumb_url; ?>');">	
								<span class="image-reflection"></span>
								<a href="<?php the_permalink(); ?>" class="featured-play-button">
									<span><span></span></span>
									<strong>Play Now</strong>
								</a>
							</div>
							<em><?php the_title(); ?></em>
						</li>
						<?php
					}
				}
				wp_reset_postdata();
				?>
				
			</ul>
			
		</div><?php // .featured-videos-wrap ?>
	</div>
</section>
<?php global $noEmailSignup; $noEmailSignup = true; ?>
<?php get_footer(); ?>