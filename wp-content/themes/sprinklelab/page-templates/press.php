<?php
/*
Template Name: Press
*/

add_action('wp_enqueue_scripts', 'enqueuePressScripts');
function enqueuePressScripts()
{
    wp_enqueue_script('press-js', get_stylesheet_directory_uri() . '/js/press.js', array('clamp'), null, true);
    wp_enqueue_style('press-css', get_stylesheet_directory_uri() . '/css/press.css');
}
?>

<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = bb_cdn( $featuredImageArray[0] );

    if (empty($featuredImage)) {
    	$featuredImage = get_stylesheet_directory_uri() . '/images/press/press-bg.jpg';
    }
?>

<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-12">
				<h1 class="header major">
					<?php the_title(); ?>
				</h1>
			</div>
		</div>
	</div>
</section>
<section id="section-press">
	<div class="container">
		<div class="row">
			<?php if( have_posts() ) { ?>
				<div class="featured-press col-lg-10 col-lg-offset-1">
					<div class="row">
					<?php
						$count = 0;
						query_posts(array( 
					        'post_type' => 'press',
					        'showposts' => 100 
					    ) ); 
						while( have_posts() ) {
							the_post();

							$count++;

							$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'press-circle' );
							$thumb_url = is_array($thumb_url) ? bb_cdn( $thumb_url[0] ) : null;
							$link = esc_url(get_field('press_link'));

						    $li_template = '<div class="col-sm-4">
								<div class="new-project">	
									<a href="%1$s" target="_blank" class="press-rectangle" style="background-image:url(%2$s);">	
						                <div class="overlay">
						                	<div class="content">Read More <i class="fa fa-arrow-right"></i>
						                	</div>
						                </div>
						            </a>
						            <div class="text-area" id="subheader-text%3$s">
						            	<a href="%1$s" target="_blank" class="second-link">	
							            	<h4 class="header smallest">%4$s</h4>
							            </a>
							            <p>%5$s</p>
							        </div>
						        </div>
						    </div>';

						    printf($li_template, 
						    	$link,
						    	$thumb_url,
						    	$count,
						    	get_the_title(),
						    	get_the_content()
						    	);
						} // while have posts
					?>
					</div>
				</div>
			<?php } // if have posts ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>