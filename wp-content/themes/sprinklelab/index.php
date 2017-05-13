<?php

add_action('wp_enqueue_scripts', 'enqueueBlogScripts');
function enqueueBlogScripts()
{
    wp_enqueue_script('blog-js', get_stylesheet_directory_uri() . '/js/blog.js', array('jquery', 'infinite-scroll', 'isotope'), null, true);
    wp_enqueue_style('blog-css', get_stylesheet_directory_uri() . '/css/blog.css');
}

?>
<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = bb_cdn( $featuredImageArray[0] );

    if (empty($featuredImage)) {
        $featuredImage = get_stylesheet_directory_uri() . '/images/blog/blog-bkg.jpg';
    }

    global $yoast_meta_description;
?>

<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
</section>
<section id="section-posts">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
                <p class="small green" id="sprinkle-blog">
                    Sprinkle <span class="pink">Blog</span>
                </p>
                <ul class="blog-roll-list clearfix">
                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                        <li class="post">
                            <div class="col-md-10 col-sm-11 post-content">
                                <a href="<?php the_permalink(); ?>">
                                    <p class="header"><?php echo the_title(); ?></p>
                                </a>
                                <p class="date small"><?php the_date(); ?></p>
                                <div class="real-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-1" id="social-section">
                                <div class="social-icons">
                                    <a href="<?php echo the_permalink(); ?>" data-image="<?php echo get_fbimage(); ?>" data-title="<?php echo the_title();?>" data-desc="<?php echo $yoast_meta_description; ?>" class="btn btn-social facebook share"></a>

                                    <a href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&amp;text=<?php echo the_title(); ?>&amp;via=sprinklelab" target="_blank" class="btn btn-social twitter share"></a>

                                    <a href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink());?>" class="btn btn-social google-plus share" target="_blank"></a>
                                </div>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
                <div class="next_posts_wrap" style="display:none;"><?php next_posts_link(); ?></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>