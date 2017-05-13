<?php
/*
Template Name: Our Work
*/

add_action('wp_enqueue_scripts', 'enqueueWorkScripts');
function enqueueWorkScripts()
{
    wp_enqueue_script('our-work-js', get_stylesheet_directory_uri() . '/js/our-work.js', array('jquery', 'infinitescroll', 'isotope', 'lavalamp', 'init-lavalamp', 'jquery.transit'), null, true);
    wp_enqueue_style('our-work-css', get_stylesheet_directory_uri() . '/css/our-work.css');
}
get_header();

global $sprinkle_theme_options;
?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = $featuredImageArray[0];

    if (empty($featuredImage)) {
    	$featuredImage = get_stylesheet_directory_uri() . '/images/our-work/our-work-bg.jpg';
    }
?>

<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="header major">
                    <?php echo_test('our_work_headline', $sprinkle_theme_options); ?>
                </h1>
            </div>
        </div>
    </div>
</section>
<?php /*
<section id="section-filter" class="filter-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      	<ul class="work-filters">
					<li class="active"><a href="#*" class="btn btn-filter selected" id="all">All</a></li>
					<?php
					$args = array( 'post_type' => 'director');
					$directors = new WP_Query( $args );
					while ( $directors->have_posts() ) : $directors->the_post();
					?>
						<li>
							<a href="#<?php echo $post->post_name; ?>" class="btn btn-filter" id="<?php echo $post->post_name; ?>"><?php echo the_title(); ?></a>
						</li>
					<?php endwhile; ?>
				</ul>
      </div>
    </div>
  </div>
</section>
*/ ?>
<section id="section-director-bio">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="one-director all no-padding"></div>
				<?php
					$args = array( 'post_type' => 'director');
					$directors = new WP_Query( $args );
					while ( $directors->have_posts() ) : $directors->the_post();
						$directorImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'our-work');
	    				$directorImage = bb_cdn( $directorImageArray[0] );
					?>
					<div class="one-director <?php echo $post->post_name; ?>">
						<div class="btn-circle" style="background-image: url(<?php echo $directorImage; ?>);">
						</div>
						<h4 class="header smallest">
							<?php echo get_the_title(); ?>
							<span class="subheader"><?php echo get_the_content(); ?></span>
						</h4>
					</div>
				<?php endwhile; ?>				
			</div>
		</div>
	</div>
</section>
<?php 
query_posts(array( 
    'post_type' => 'video',
    'nopaging' => 1,
    'meta_query' => array(
	    'relation' => 'OR',
		array(
			'key' => 'exclude_from_listings',
			'value' => 0,
			'compare' => 'LIKE'
		),
		array(
			'key' => 'exclude_from_listings',
			'compare' => 'NOT EXISTS'
		)
	)
) ); 
if( have_posts() ) { ?>
	<section class="video-grid" style="margin-top: -1px;">
		<ul>
			<?php
			while( have_posts() ) {
				the_post();
				global $post;
				//sprinkle_video_list_template($post);
				$supersize = get_field('supersize');
				$video_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $supersize ? 'supersize-grid' : 'grid');
			    $video_thumb = is_array( $video_thumb ) ? bb_cdn( $video_thumb[0] ) : null;
				?>
				<li <?php if( $supersize ) echo 'class="supersize" '; ?>>
					<div class="image-overlay" <?php if( $video_thumb ) echo 'style="background-image:url('. $video_thumb .');"'; ?>></div>
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<span>
							<span class="play-button"></span>
							<strong><?php echo apply_filters( 'the_title', $post->post_title ); ?></strong>
						</span>
					</a>
				</li>
				<?php								
			} // while have posts
			?>
		</ul>
	</section>
	<script type="text/javascript">
		(function($){
			function setup_grid() {
				var $video_grid = $('.video-grid');
				
				if( $video_grid.length ) {
					
					// Isotope
					$video_grid.isotope({
						itemSelector	: 'li',
						layoutMode 		: 'masonry'
					});
					
					
					// Special hover loop
					var brand_hover = ['hp','hb','hg'],
						current_hover = -1;
						
					$video_grid.find('li a').on('mouseenter', function(){
						var $this = $(this);
						$this.removeClass('hp hb hg');
						current_hover ++;
						if( current_hover > 2 )
							current_hover = 0;
						$this.addClass(brand_hover[current_hover]);
					});
				}
			}
			
			setup_grid();
			
			$(document).ready(function(){
				setup_grid();
			});
			
		})(jQuery);
	</script>
<?php wp_reset_postdata(); } // if have posts ?>
</section>
<?php get_template_part('partials/bottom', 'bar'); ?>

<?php get_footer(); ?>