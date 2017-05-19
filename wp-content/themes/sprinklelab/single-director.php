<?php
add_action('wp_enqueue_scripts', 'enqueueWorkScripts');
function enqueueWorkScripts()
{
    wp_enqueue_script('our-work-js', get_stylesheet_directory_uri() . '/js/our-work.js', array('jquery', 'infinitescroll', 'isotope', 'lavalamp', 'init-lavalamp', 'jquery.transit'), null, true);
    wp_enqueue_style('our-work-css', get_stylesheet_directory_uri() . '/css/our-work.css');
}
get_header();

global $sprinkle_theme_options;
$featuredImage = bb_cdn( bb_get_post_thumbnail_url( $post->ID, 'hero'));
$header_image = bb_cdn( bb_image_url( get_field('header_image', $post->ID), 'hero') );
if( $header_image ) {
	$featuredImage = $header_image;
}
?>
<section id="section-header" style="background-image: url(<?php echo $featuredImage; ?> );">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="header major">
                    <?php the_title(); ?>
                </h1>
				<div class="director-bio">
					<?php the_content(); ?>
				</div>
            </div>
        </div>
    </div>
</section>
<?php
$videos = bb_array(get_field('videos'));
if( $videos ) { ?>
	<section class="video-grid" style="margin-top: -1px;">
		<ul>
			<?php
			foreach($videos as $video) {
				extract(array_replace_recursive(array(
					'video' => null,
					'supersize' => false,
				), bb_array($video)));
				if( !$video ) {
					continue;
				}
				$video_meta = get_post_meta($video->ID, '_video_meta', true);
				$video_id = echo_test('video_id', $video_meta, false);
				$video_type = echo_test('video_type', $video_meta, false);
				$video_url = null;
				if ($video_type == 'youtube') {
					$video_url = 'http://youtube.com/' . $video_id;
				} else {
					$video_url = 'http://vimeo.com/' . $video_id;
				}
				// bb_print_r($video_url);
				$video_thumb = bb_cdn( bb_get_post_thumbnail_url( $video->ID, $supersize ? 'supersize-grid' : 'grid'));
				?>
				<li <?php if( $supersize ) echo 'class="supersize" '; ?>>
					<div class="image-overlay" <?php if( $video_thumb ) echo 'style="background-image:url('. $video_thumb .');"'; ?>></div>
					<?php if($video_url) { ?>
						<a href="<?php echo $video_url; ?>" class="fancybox video">
					<?php }else{ ?>
						<a href="<?php echo get_permalink( $video->ID ); ?>">
					<?php } ?>
						<span>
							<span class="play-button"></span>
							<strong><?php echo apply_filters( 'the_title', $video->post_title ); ?></strong>
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
<script type="text/javascript">
	var fancymodal = jQuery('.fancybox.video').fancybox({
		closeEffect: 'none',
		scrolling: 'no',
		padding: 0,
		width: '100%',
		height: '100%',
		autoCenter : true,
		type : 'iframe',
		margin: [0,0,0,0],
		helpers: {
			overlay : {
				locked : false,
				css : {
					'background' : 'rgba(0, 0, 0, 0.8)'
				}
			},
			media: {}
		},
		tpl: {
			closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
		}
	});

</script>
<?php get_template_part('partials/bottom', 'bar'); ?>

<?php get_footer(); ?>
