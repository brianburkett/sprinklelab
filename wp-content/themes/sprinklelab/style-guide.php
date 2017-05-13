<?php
/*
Template Name: Style Guide
*/

add_action('wp_enqueue_scripts', 'enqueue_styleguide_scripts');
function enqueue_styleguide_scripts()
{
    wp_enqueue_style('style-guide', get_stylesheet_directory_uri() . '/css/style-guide.css');
}

get_header();
?>

<section id="section-buttons">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="header medium">Buttons</h1>

				<div id="solid-buttons" class="button-container">
					<a href="#" class="btn btn-default primary">Solid Green</a>
					<a href="#" class="btn btn-default primary arrow">Solid Green</a>
					<a href="#" class="btn btn-default tertiary">Solid White</a>
					<a href="#" class="btn btn-default quaternary">Solid Grey</a>
				</div>
				<div id="border-buttons" class="button-container">
					<a href="#" class="btn btn-border primary"><i class="fa fa-share left"></i>Get in Touch</a>
					<a href="#" class="btn btn-border primary"><i class="fa fa-arrow-right left"></i>See All Work</a>
					<a href="#" class="btn btn-border secondary"><i class="fa fa-share left"></i>Get in Touch</a>
					<a href="#" class="btn btn-border secondary"><i class="fa fa-arrow-right left"></i>See All Work</a>
					<a href="#" class="btn btn-border tertiary"><i class="fa fa-share left"></i>Get in Touch</a>
					<a href="#" class="btn btn-border tertiary"><i class="fa fa-arrow-right left"></i>See All Work</a>
				</div>
				<div id="filter-buttons" class="button-container">
					<a href="#" class="btn btn-filter">Filter Button</a>
				</div>
				<div id="social-buttons" class="button-container">
					<a href="#" class="btn btn-social facebook"></a>
					<a href="#" class="btn btn-social twitter"></a>
					<a href="#" class="btn btn-social google-plus"></a>
					<a href="#" class="btn btn-social vimeo"></a>
					<a href="#" class="btn btn-social youtube"></a>
				</div>
				<div id="plus-buttons" class="button-container">
					<div class="image plus">
						<img class="plus" src="<?php echo get_stylesheet_directory_uri(); ?>/images/home/subaru-logo.png">
						<i class="fa fa-plus"></i>
					<div>

				</div>
				<div id="slideshow-nav-buttons" class="button-container">
					<a href="#" class="btn slideshow-nav-button previous"></a>
					<a href="#" class="btn slideshow-nav-button next"></a>
				</div>
                <div id="continue-button" class="button-container">
                    <a href="#" class="btn btn-continue-arrow">Continue</a>
                </div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>