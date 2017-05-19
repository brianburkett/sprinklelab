<?php
/*
Template Name: Directors
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
                    <?php echo_test('directors_headline', $sprinkle_theme_options); ?>
                </h1>
            </div>
        </div>
    </div>
</section>
<?php
$directors = bb_array(get_field('directors'));
if( $directors ) { ?>
	<section class="video-grid" style="margin-top: -1px;">
		<ul>
			<?php
			foreach($directors as $director) {
				extract(array_replace_recursive(array(
					'director' => null, // post object
					'supersize' => false
				), bb_array($director)));
				if( !$director ) {
					continue;
				}
				$video_thumb = bb_cdn( bb_get_post_thumbnail_url( $director->ID, $supersize ? 'supersize-grid' : 'grid'));
				?>
				<li <?php if( $supersize ) echo 'class="supersize" '; ?>>
					<div class="image-overlay" <?php if( $video_thumb ) echo 'style="background-image:url('. $video_thumb .');"'; ?>></div>
					<a href="<?php echo get_permalink( $director->ID ); ?>">
						<span>
							<strong style="margin-top: 0px;"><?php echo apply_filters( 'the_title', $director->post_title ); ?></strong>
						</span>
					</a>
				</li>
				<?php
			}
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
