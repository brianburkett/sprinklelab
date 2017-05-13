<?php

add_action('wp_enqueue_scripts', 'enqueueBlogScripts');
function enqueueBlogScripts()
{
    wp_enqueue_script('blog-js', get_stylesheet_directory_uri() . '/js/single-post.js', array('jquery'), null, true);
    wp_enqueue_style('blog-css', get_stylesheet_directory_uri() . '/css/blog.css');
}

?>
<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( $post->post_parent, 'hero');
    $featuredImage = bb_cdn( $featuredImageArray[0] );

    if (empty($featuredImage)) {
        $featuredImage = get_stylesheet_directory_uri() . '/images/blog/blog-bkg.jpg';
    }

    global $yoast_meta_description;
?>

<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
</section>
<section id="section-posts">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <div class="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-1">
                        <a href="<?php the_permalink(); ?>">
                            <p class="header"><?php echo the_title(); ?></p>
                        </a>
                        <p class="date small"><?php the_date(); ?></p>
                        <div class="real-content">
                            <?php echo get_the_content_with_formatting(); ?>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1" id="social-section">
                        <div id="social-share-icons">
                            <div class="social-icons">
                                <a href="<?php echo the_permalink(); ?>" data-image="<?php echo get_fbimage(); ?>" data-title="<?php echo the_title();?>" data-desc="<?php echo $yoast_meta_description; ?>" class="btn btn-social facebook share"></a>

                                <a href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&amp;text=<?php echo the_title(); ?>&amp;via=sprinklelab" target="_blank" class="btn btn-social twitter share"></a>

                                <a href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink());?>" class="btn btn-social google-plus share" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php get_footer(); ?>