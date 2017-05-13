<?php
/*
Template Name: About
*/
wp_enqueue_script('about-js', get_stylesheet_directory_uri() . '/js/about.js', array('jquery.scrollTo', 'clients', 'lavalamp', 'init-lavalamp'), null, true);
wp_enqueue_style('about-css', get_stylesheet_directory_uri() . '/css/about.css');

?>

<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = bb_cdn( $featuredImageArray[0] );
?>
<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
	<div class="dark-overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-12">
				<h1 class="header major smaller">
					<?php echo_test('about_headline', $sprinkle_theme_options); ?>
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<p class="large"><?php echo_test('about_subline', $sprinkle_theme_options); ?></p>
				<p class="large"><i class="fa fa-map-marker"></i><span class="lighter">Proudly located in</span> Oakland, CA</p>
			</div>
		</div>
	</div>
	<img src="<?php echo get_stylesheet_directory_uri() . '/images/about/horizontal_down_arrow.png'; ?>">
</section>
<section id="section-collage">
	<div class="container">
		<div class="row" id="first-row">
			<div class="col-sm-12">
				<div id="photo-mosaic">
					<?php
					$our_team_html = '<div class="column">
						<h3 class="header major">
							<span class="display">Meet</span> the <span class="display">Team</span>
						</h3>
						<p class="cursive">
							<span class="bolder">behind our delicious delicacies
						</p>
						<a class="image plus" href="%1$s" id="first-image" rel="image-group">
							<img src="%1$s" rel="image-group">
							<span class="fa fa-plus"></span>
						</a>
					</div>
					<div class="column small">
						<a class="image plus" href="%2$s" rel="image-group">
							<img src="%2$s" rel="image-group">
							<span class="fa fa-plus"></span>
						</a>
						<a class="image plus" href="%3$s" rel="image-group">
							<img src="%3$s">
							<span class="fa fa-plus"></span>
						</a>
						<a class="image plus" href="%4$s" rel="image-group">
							<img src="%4$s">
							<span class="fa fa-plus"></span>
						</a>
					</div>
					<div class="column">
						<a class="image plus" href="%5$s" rel="image-group">
							<img src="%5$s">
							<span class="fa fa-plus"></span>
						</a>
						<a class="image plus" href="%6$s" rel="image-group">
							<img src="%6$s">
							<span class="fa fa-plus"></span>
						</a>
					</div>
					<div class="column small">
						<a class="image plus" href="%7$s" rel="image-group">
							<img src="%7$s">
							<span class="fa fa-plus"></span>
						</a>
						<a class="image plus" href="%8$s" rel="image-group">
							<img src="%8$s">
							<span class="fa fa-plus"></span>
						</a>
						<a class="image plus" href="%9$s" rel="image-group">
							<img src="%9$s">
							<span class="fa fa-plus"></span>
						</a>
					</div>';

					$photos = getPhotos();
					$echo = (count($photos) < 8) ? false: true;
					
					if ($echo) {
						$images = get_field('team_pictures');

						printf($our_team_html, 
							bb_cdn( $images[0]['url'] ),
							bb_cdn( $images[1]['url'] ),
							bb_cdn( $images[2]['url'] ),
							bb_cdn( $images[3]['url'] ),
							bb_cdn( $images[4]['url'] ),
							bb_cdn( $images[5]['url'] ),
							bb_cdn( $images[6]['url'] ),
							bb_cdn( $images[7]['url'] ),
							bb_cdn( $images[8]['url'] )
						);
					}

					function getPhotos() {
						$images = get_field('team_pictures');
						$imageArray = array();

						for ($i = 0; $i <= 8; $i++) {
							if (!empty($images[$i])) {
								array_push($imageArray, $images[$i]['url']);
							}
						}

						return $imageArray;
					}

					?>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 cursive" id="join-team">
				Interested in joining the team?
				<a class="cursive" href="<?php echo get_permalink(get_page_by_path('careers')); ?>">View Openings</a>
			</div>
		</div>
	</div>
</section>
<section id="section-testimonies">
	<div class="container">
		<h3 class="header medium">
			Our Clients
			<span class="subheader">say nice things</span>
		</h3>
		<div class="row">
			<?php
				$testimonials = array('testimonial1', 'testimonial2');

				$testimonial_html = '<div class="col-lg-4 col-md-offset-1 col-md-5">
					<div class="testimony-wrap">
						<img src="%1$s" class="rounded"> 
						<div class="testimonial">
							<p class="medium name">%2$s</p>
							<p class="small title">%3$s</p>
							<p class="small uppercase company">%4$s</p>
							<p class="quote">%5$s</p>
						</div>
					</div>
				</div>';

				foreach($testimonials as $testimonial) {
					$quote = get_field($testimonial);
					$source = $testimonial . '_source';
					$source = get_field($source);
					$job_description = $testimonial . '_job';
					$job_description = get_field($job_description);
					$company = $testimonial . '_company';
					$company = get_field($company);
					$image = $testimonial . '_image';
					$image = get_field($image);
					
					printf($testimonial_html,
						bb_cdn( $image['url'] ),
						$source,
						$job_description,
						$company,
						$quote);
				}
			?>		
		</div>
	</div>
</section>
<section id="section-contact">
	<div class="container">
		<div class="col-md-12">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/about/donut.png" srcset="<?php echo get_stylesheet_directory_uri(); ?>/images/about/donut.png 1x, <?php echo get_stylesheet_directory_uri(); ?>/images/about/donut-2x.png 2x"/>
			<h5 class="header major white">
				Swing by for a donut
			</h5>
			<p class="medium">Our location</p>
			<p class="large white">
				<?php echo_test('info_address', $sprinkle_theme_options); ?><br><?php echo_test('info_address_2', $sprinkle_theme_options); ?>
			</p>
			<p class="medium">Give us a call</p>
			<p class="large white"><?php echo_test('info_phone', $sprinkle_theme_options); ?></p>
			<a href="#" class="contact btn btn-default primary"><i class="fa fa-chevron-right left"></i>Send a message</a>
		</div>
	</div>
</section>
<?php //get_template_part('partials/clients', 'list'); ?>
<!--<?php get_template_part('partials/awards', 'list'); ?>-->
<?php get_footer(); ?>