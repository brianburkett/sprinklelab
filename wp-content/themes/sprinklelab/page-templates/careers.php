<?php
/*
Template Name: Careers
*/

add_action('wp_enqueue_scripts', 'enqueueHomeScripts');
function enqueueHomeScripts()
{
    wp_enqueue_script('careers-js', get_stylesheet_directory_uri() . '/js/careers.js', array('jquery.scrollTo'), null, true);
    wp_enqueue_style('careers-css', get_stylesheet_directory_uri() . '/css/careers.css');
}

$careers = new WP_Query(array(
	'post_type'			=> 'jobs',
	'orderby'			=> 'asc'
));
?>

<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = bb_cdn ($featuredImageArray[0] );

    if (empty($featuredImage)) {
        $featuredImage = get_stylesheet_directory_uri() . '/images/careers/careers-bg.jpg';
    }
?>

<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="header major white">
					<span class="intro">Careers</span>
					<?php echo_test('careers_headline', $sprinkle_theme_options); ?>
					<span class="subheader"><?php echo_test('careers_subline', $sprinkle_theme_options); ?></span>
				</h1>
			</div>
		</div>
	</div>
	<img src="<?php echo get_stylesheet_directory_uri() . '/images/about/horizontal_down_arrow.png'; ?>">
</section>
<section id="section-careers">
	<div class="container">
		<div class="row">
			<div class="col-md-3" id="openings">
				<h4 class="header smallest">
					Openings
				</h4>

				<?php
					$count = 0;
					while( $careers->have_posts() ) :
						$careers->the_post();
						$count++;

						$position_template = '<a href="#position%1$s" class="medium job-position">%2$s</a>';
						printf($position_template, $count, get_the_title());
					endwhile;
				?>
			</div>
			<div class="col-md-9 positions">
				<?php
					$count = 0;
					while( $careers->have_posts() ) {
						$careers->the_post();
						$count++;

						$li_template ='
						<div class="row" id="position%1$s">
							<div class="col-md-9 col-sm-9">
								<h4 class="header smallest">%2$s</h4>
								<span class="location">%3$s</span>
								<p class="medium summary">Summary</p>
								%4$s
								<div class="toggle-content">%5$s</div>
								<a href="#" class="btn btn-border fifth clickable-region"><i class="fa fa-plus-square left"></i>Show full job description</a>
							</div>
							<div class="col-md-2 col-sm-3">
								<a href="%6$s" class="job-contact btn btn-border primary" target="_blank"><i class="fa fa-share left"></i>Apply</a>
							</div>
					    </div>';

						printf($li_template, 
							$count, 
							get_the_title(), 
							esc_attr(get_field('location')),
							get_the_content_with_formatting(),
							get_field('hidden_text'), 
							esc_url(get_field('link_to_apply'))
							);
					} // while have posts
				?>
			</div>
		</div>
	</div>
</section>

<div id="job-contact">
    <div id="modal">
        <div class="modal-header">
            <h2 class="header medium">
                <?php echo_test('contact_form_headline', $sprinkle_theme_options); ?>
            </h2>
        </div>
        <div class="modal-body">
            <form method="post" class="contact-form" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">          
                <input type="text" name="contact[name]" id="Name" value="" class="" placeholder="Name" required>             
                <input type="email" name="contact[email]" id="Email" value="" class="" placeholder="Email" required>                
                <input type="text" name="contact[phone]" id="Phone" value="" class="" placeholder="Phone number">
                <input type="text" name="contact[job]" id="Job" value="" class="" placeholder="Job you're interested in">
                <textarea name="contact[message]" placeholder="Your message..." id="Message"></textarea>
                <div class="submit-wrapper">
                    <input type="submit" width="206" height="86" value="Submit" alt="Send It!" title="Send It!">
                </div>
                <div class="message-container">
                    <p class="success"><span class="glyphicon glyphicon-ok"></span>Your message has been successfully submitted!</p>
                    <p class="error"><span class="glyphicon glyphicon-remove"></span>Sorry, but an error has occurred. Please try again later!</p>
                </div>
            </form>
        </div>
     </div>
</div>

<?php get_footer(); ?>