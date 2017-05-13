<?php

add_action('wp_enqueue_scripts', 'enqueueFourohFourScripts');
function enqueueFourohFourScripts()
{
    wp_enqueue_style('fourohfour', get_stylesheet_directory_uri() . '/css/fourohfour.css');
}

?>
<?php get_header(); ?>

<section id="section-posts">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
                <h1 class="header hero">
                    <?php echo_test('fourohfour_headline', $sprinkle_theme_options); ?>
                    <span class="subheader">
                        <?php echo_test('fourohfour_subline', $sprinkle_theme_options); ?>
                    </span>
                </h1>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>