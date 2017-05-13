<?php
/*
* Template Name: Videos
*/

add_action('wp_enqueue_scripts', 'enqueueVideoScripts');
function enqueueVideoScripts()
{
    wp_enqueue_script('videos-js', get_stylesheet_directory_uri() . '/js/videos.js', array('jquery'), null, true);
    wp_enqueue_style('videos-css', get_stylesheet_directory_uri() . '/css/videos.css');
}

$REFERER = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ' ';
$REFERER = explode('?', $REFERER);
$REFERER = implode('', $REFERER);
$autoplay = false;
if( strpos($REFERER, site_url('our-work')) !== false || $REFERER === site_url('/') )
	$autoplay = true;
?>
<?php get_header(); ?>

<?php
	global $sprinkle_theme_options;

	the_post();
	$video_meta = get_post_meta($post->ID, '_video_meta', true);
	$thumb_id = echo_test('background_image_id', $video_meta, false);
	$thumb_id = !empty($thumb_id) ? $thumb_id : get_post_thumbnail_id($post->ID);
	$thumb_url = wp_get_attachment_image_src( $thumb_id , 'hero' );
	$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
	$video = sprinkle_video_output(echo_test('video_type', $video_meta, false), echo_test('video_id', $video_meta, false), null, null, $autoplay);
	
	$what_we_did = echo_test('we_did_this', $video_meta, false);
	$work_description = echo_test('what_we_did_description', $video_meta, false);
?>

<section id="section-header" style="background: url('<?php echo bb_cdn( $thumb_url ); ?>')">
	<div class="dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <h1 class="header regular">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </div>
</section>
<section id="section-navigation" class="clearfix">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8 col-md-offset-1 col-sm-8 column back">
                <a href="<?php echo home_url(); ?>/our-work"><i class="fa fa-th"></i><i class="fa fa-angle-left"></i> Back to all
                </a>
            </div>
            <div class="col-md-3 col-sm-4 separate-link column">
                <?php
					$other_videos = array(
						'posts_per_page'  => -1,
						'orderby'         => 'menu_order title',
						'order'           => 'ASC',
						'post_type'			=> 'video'
					);
					$postlist = get_posts( $other_videos );

					$ids = array();
					foreach ($postlist as $thepost) {
					   $ids[] = $thepost->ID;
					}

					$thisindex = array_search($post->ID, $ids);

					if (isset($ids[$thisindex+1])) {
						$nextid = $ids[$thisindex+1];
					} else {
						$nextid = $ids[0];
					}
					
					echo '<a rel="next" class="next" href="' . get_permalink($nextid). '"><i class="fa fa-arrow-right"></i><div class="next-btn">Next<span class="title">' . get_the_title($nextid) . '</span></div></a>'; 
				?>
            </div>
        </div>
    </div>
</section>
<section id="section-main">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-1" id="about">
				<div class="row">
					<div class="col-md-12">
						<?php if ($video) { ?>
							<div class="video media" style="background-image:url('<?php echo $thumb_url; ?>');">
								<div class="embed-container">
									<?php echo $video; ?>
								</div>
							</div>
						<?php } else { ?>
							<img class="main-image media" src="<?php echo $thumb_url; ?>">
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<?php
						$video_ids = echo_test('what_we_did_gallery', $video_meta, false);
						if (!empty($video_ids)) { ?>
							<div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
						<?php } else { ?>
							<div class="col-md-12">
						<?php } ?>
						<p class="medium summary">Project Overview</p>
						<div id="main-content"><?php the_content(); ?></div>
						<?php if ($work_description || $what_we_did) : ?>
							<p class="medium summary" id="role">Our Role</p>
							<div class="what-we-did">
								<?php echo wpautop( html_entity_decode( $what_we_did ) ); ?>
							</div>
							<div class="project-description">
								<?php echo wpautop( html_entity_decode( $work_description ) ); ?>
							</div>
						<?php endif; ?>
						</div>
						<?php if (!empty($video_ids)) { ?>
							<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 project-gallery">
						<?php 
							$video_ids = !empty($video_ids) ? explode(',', $video_ids) : array();
					
							if( !empty($video_ids) ) {
								foreach( $video_ids as $video_id ) {
									$bkg_url = wp_get_attachment_image_src( $video_id, 'overview-gallery-thumb' );
									$bkg_url = is_array($bkg_url) && !empty($bkg_url) ? $bkg_url[0] : null;
									$full_image = wp_get_attachment_image_src( $video_id, 'hero' );
									$full_image = is_array($full_image) && !empty($full_image) ? $full_image[0] : null;
									?>

								<a class="image plus" href="<?php echo bb_cdn( $full_image ); ?>" rel="image-group">
									<img src="<?php echo $bkg_url; ?>">
									<span class="fa fa-plus"></span>
								</a>
							<?php } } ?>
							</div>
						<?php } ?>
					
				</div>
			</div>
			<div class="col-md-3" id="sidebar">
				<?php
					$testimonial_image = echo_test('testimonial_image_id', $video_meta, false);
					$testimonial_image = !empty($testimonial_image) ? wp_get_attachment_image_src( $testimonial_image, 'testimonial', 'medium' ) : array();
					$testimonial_image = is_array($testimonial_image) && !empty($testimonial_image) ? $testimonial_image[0] : null;
					$testimonial_text = echo_test('video_testimonial', $video_meta, false);
				?>
				<?php if ($testimonial_text) : ?>
					<div class="testimonial">
						<div class="constrain">
							<?php if( $testimonial_image ) : ?>
								<div class="image-turn-wrap">
									<img src="<?php echo bb_cdn( $testimonial_image ); ?>" width="163" height="163" />
								</div>
							<?php endif; ?>
							<p class="testimonial-bracket summary medium">
								<?php echo_test('video_person', $video_meta); ?>
							</p>
							<p class="job-title small">
								<?php echo_test('video_job', $video_meta); ?>
								<span class="company"><?php echo_test('video_company', $video_meta); ?></span>
							</p>
							<p>
								<?php echo_test('video_testimonial', $video_meta); ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
	      <a href="#" class="contact btn btn-default primary"><i class="fa fa-share left"></i>Work with us</a>
			</div>
		</div>
	</div>
</section>
<?php get_template_part('partials/bottom', 'bar'); ?>

<?php get_footer(); ?>