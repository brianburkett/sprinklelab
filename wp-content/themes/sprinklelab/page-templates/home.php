<?php
/*
Template Name: Home
*/

add_action('wp_enqueue_scripts', 'enqueueHomeScripts');
function enqueueHomeScripts()
{
    wp_enqueue_script('home-js', get_stylesheet_directory_uri() . '/js/home.js', array('jquery.scrollTo', 'clients', 'jquery.videobackground', 'lavalamp', 'init-lavalamp'), null, true);
    wp_enqueue_style('home-css', get_stylesheet_directory_uri() . '/css/home.css');
}

$featured_videos = new WP_Query(array(
	'post_type'				=> 'video',
	'nopaging'				=> true,
	'meta_key'				=> '_feature_on_homepage',
	'meta_value'			=> true
));
	
$latest_videos = new WP_Query(array(
	'post_type'			=> 'video',
	'posts_per_page'	=> 3,
	'orderby'			=> 'rand',
	'meta_key'			=> '_subfeature_on_homepage',
	'meta_value'		=> true
));

?>

<?php get_header(); ?>

<?php
    $featuredImageArray = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero');
    $featuredImage = bb_cdn( $featuredImageArray[0] );
    $loop_video = bb_cdn( get_field('loop_video') );
?>
<section id="section-header-video">
	<div class="video-bg" style="background-image: url(<?php echo $featuredImage; ?> );"></div>
	<?php if( $loop_video ) { ?>
	<div id="video-loop" data-video-url="<?php echo $loop_video; ?>" data-poster="<?php echo $featuredImage; ?>"></div>
	<?php } ?>
	<?php if( $featured_videos->have_posts() ) : 
		$video_data = array();
		$c = 1;
		while( $featured_videos->have_posts() ) :
			$featured_videos->the_post();
			$video_meta = get_post_meta($post->ID, '_video_meta', true);
			$video_id = echo_test('video_id', $video_meta, false);
			$video_type = echo_test('video_type', $video_meta, false);

			if ($video_type == 'youtube') {
				$video_url = 'http://youtube.com/' . $video_id;
			} else {
				$video_url = 'http://vimeo.com/' . $video_id;
			}
		?>	
		<?php endwhile; ?>
	<?php wp_reset_postdata(); endif; ?>
	<div class="container">
		<div id="play-circle">
			<h1 class="header major">
				<?php echo_test('home_sprinkle_lab_description', $sprinkle_theme_options); ?>
			</h1>
			<?php if (!empty($video_url)) : ?>
				<a id="click-to-play" href="<?php echo $video_url; ?>" class="fancybox video">
					<div id="watch-reel">
						<span class="play-button"></span>
						<?php echo_test('home_video_list_headline', $sprinkle_theme_options); ?>
					</div>
				</a>
			<?php endif; ?>
			<div class="videoTag">
				<video controls preload>
					<source src="<?php echo $video_url; ?>" type="video/mp4">
					Your browser does not support the HTML 5 video tag.
				</video>
			</div>
		</div>
	</div>
</section>
<?php
$featured_videos = get_field('featured_videos');
if( $featured_videos ) {
	?>
	<section class="video-grid">
		<ul>
		<?php
			foreach( $featured_videos as $cell ) {
				extract($cell);
				$video_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $video->ID ), $supersize ? 'supersize-grid' : 'grid');
			    $video_thumb = is_array( $video_thumb ) ? bb_cdn( $video_thumb[0] ) : null;
				?>
				<li <?php if( $supersize ) echo 'class="supersize" '; ?>>
					<div class="image-overlay" <?php if( $video_thumb ) echo 'style="background-image:url('. $video_thumb .');"'; ?>></div>
					<a href="<?php echo get_permalink( $video->ID ); ?>">
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
	<?php
}
	
?>



<?php /* if( $latest_videos->have_posts() ) : ?>
	<section id="section-main-work">
		<ul class="featured-videos clearfix">
		<?php
			while( $latest_videos->have_posts() ) {
				$latest_videos->the_post();
				global $post;
				$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '3-col' );
				$thumb_url = is_array($thumb_url) ? bb_cdn( $thumb_url[0] ) : null;
		?>
			<li class="show-work">
				<a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo $thumb_url; ?>');">
					<div class="overlay"></div>
					<div class="main-work">
						<p class="medium"><span class="play-button"></span>
						<?php the_title(); ?></p>
					</div>
				</a>
			</li>
		<?php }  ?>
		</ul>
	</section>
<?php endif; */ ?>

<?php //get_template_part('partials/clients', 'list'); ?>

<?php get_footer(); ?>