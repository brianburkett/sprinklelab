<?php
/*
* Template Name: What We Do
*/

wp_redirect(site_url());

add_action('wp_enqueue_scripts', 'enqueueWhatWeDoScripts');
function enqueueWhatWeDoScripts()
{
    wp_enqueue_script('what-we-do-js', get_stylesheet_directory_uri() . '/js/what-we-do.js', array('jquery', 'lavalamp', 'init-lavalamp'), null, true);
    wp_enqueue_style('what-we-do-css', get_stylesheet_directory_uri() . '/css/what-we-do.css');
}
?>
<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = $featuredImageArray[0];

    if (empty($featuredImage)) {
        $featuredImage = get_stylesheet_directory_uri() . '/images/our-work/our-work-bg.jpg';
    }
?>
<section id="section-header" style="background-image: url(<?php echo bb_cdn( $featuredImage ); ?> );">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-lg-offset-1 col-md-8">
                <h1 class="header major">
                    <?php echo_test('what_we_do_headline', $sprinkle_theme_options); ?>
                    <span class="subheader"><?php echo_test('what_we_do_subline', $sprinkle_theme_options); ?></span>
                </h1>
            </div>
        </div>
    </div>
</section>
<section id="section-main">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/what-we-do/services-examples.png" id="services-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-1 col-md-10 col-sm-7">
                <h3 class="header small">
                    <?php the_field('section1_header'); ?>
                </h3>
                <p class="large bold">
                    <?php the_field('section1_subheader'); ?>
                </p>
                <p class="large">
                    <?php the_field('section1_summary'); ?>
                </p>
                <p class="medium summary">Based on</p>
                <ul>
                    <li>Location</li>
                    <li>Weather</li>
                    <li>Time</li>
                    <li>Date</li>
                    <li>Audience Segments</li>
                    <li>Retargetting</li>
                    <li>A/B Testing</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="section-seen">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-lg-8 col-lg-offset-1 col-md-10">
                <h3 class="header small">
                    <?php the_field('section2_header'); ?>
                </h3>
                <p class="large bold">
                    <?php the_field('section2_subheader'); ?>
                </p>
                <p class="large">
                    <?php the_field('section2_summary'); ?>
                </p>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-lg-3 col-lg-offset-1 col-md-4">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/media-icon.svg" id="media-icon">
                <p class="large summary">
                    <?php the_field('section3_header'); ?>
                </p>
                <p class="medium">
                    <?php the_field('section3_summary'); ?>
                </p>
            </div>
            <div class="col-lg-6 col-lg-offset-1 col-md-8">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/media-pic.png" id="media-image">
            </div>
        </div>
        <div class="row border-bottom">
             <div class="col-lg-3 col-lg-offset-1 col-md-4 col-md-offset-1 col-md-push-7 extra-right">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/format-icon.svg" id="videos-icon">
                <p class="large summary">
                    <?php the_field('section4_header'); ?>
                </p>
                <p class="medium">
                    <?php the_field('section4_summary'); ?>
                </p>
                <div id="formats">
                    <p><i class="fa fa-hand-o-down"></i> Click to view examples:</p>
                    <a href="#standard" class="medium selected">Standard web</a>
                    <a href="#social" class="medium">Social</a>
                    <a href="#mobile" class="medium">Mobile</a>
                    <a href="#tablet" class="medium">Tablet</a>
                    <a href="#in-display" class="medium">In-display</a>
                    <a href="#connected-tv" class="medium">Connected-TV</a>
                </div>
            </div>
            <div class="col-lg-6 col-lg-offset-1 col-lg-pull-4 col-md-7 col-md-pull-5">
                <div id="image-container">
                    <?php
                         $format_data = array(
                            array(
                                "title" => "Standard Web Pre-Roll",
                                "headline" => get_field('standard_headline'),
                                "description" => get_field('standard_description'),
                                "image" => get_field('standard_image')
                            ),
                             array(
                                "title" => "Social Video",
                                "headline" => get_field('social_headline'),
                                "description" => get_field('social_description'),
                                "image" => get_field('social_image')
                            ),
                            array(
                                "title" => "Mobile App Pre-roll",
                                "headline" => get_field('mobile_headline'),
                                "description" => get_field('mobile_description'),
                                "image" => get_field('mobile_image')
                            ),
                            array(
                                "title" => "Tablet App Pre-Roll",
                                "headline" => get_field('tablet_headline'),
                                "description" => get_field('tablet_description'),
                                "image" => get_field('tablet_image')
                            ),
                            array(
                                "title" => "In-display click-to-expand",
                                "headline" => get_field('indisplay_headline'),
                                "description" => get_field('indisplay_description'),
                                "image" => get_field('indisplay_image')
                            ),
                            array(
                                "title" => "Connected-TV Pre-roll",
                                "headline" => get_field('connected_headline'),
                                "description" => get_field('connected_description'),
                                "image" => get_field('connected_image')
                            )
                        );

                        $format_html = '<div class="format %1$s">
                            <img src="%2$s" class="%1$s">
                            <p class="medium uppercase titillium">%3$s</p>
                            <p class="small margin">%4$s</p>
                        </div>';

                        foreach($format_data as $format) {
                            $title = $format['title'];
                            $class = explode(' ', $title);

                            printf($format_html,
                                strtolower($class[0]),
                                $format['image']['url'],
                                $title,
                                esc_attr($format['description'])
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-lg-3 col-lg-offset-1 col-md-4">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/ab-testing.svg" id="ab-icon">
                <p class="large summary">
                    <?php the_field('section5_header'); ?>
                </p>
                <p class="medium">
                    <?php the_field('section5_summary'); ?>
                </p>
            </div>
            <div class="col-lg-7 col-md-8 extra-space">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/ab-image.png" id="ab-image">
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-lg-7 col-lg-offset-1 col-md-8" id="analytics-section">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/analytics-image.png" id="analytics-image">
            </div>
            <div class="col-lg-3 col-md-4">
                 <img src="<?php echo get_stylesheet_directory_uri() ?>/images/what-we-do/analytics-icon.svg" id="analytics-icon">
                <p class="large summary">
                    <?php the_field('section6_header'); ?>
                </p>
                <p class="medium">
                    <?php the_field('section6_summary'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>