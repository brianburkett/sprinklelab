<?php
$body_class = 'our-work';

include_once('header.php');

global $sprinkle_theme_options;
?>

<section class="headline">
	<span class="pink-bar"></span>
	<span class="corner-icing pink"></span>
	<h3><?php echo_test('our_work_headline', $sprinkle_theme_options); ?></h3>
</section><?php // .headline ?>

<section class="work-grid">
	<div class="constrain">
		<ul class="work-filters">
			<li class="active"><a href="#*">All</a></li>
			<?php
			$video_types = get_terms('video_type', array(
				'orderby'	=> 'count'
			));
			
			$video_types = is_array($video_types) && !is_wp_error($video_types) ? $video_types : array();
			foreach( $video_types as $video_type ) {
				if( !is_object($video_type) || !isset($video_type->name) || !isset($video_type->slug) )
					continue;
				?>
				<li><a href="#<?php echo $video_type->slug; ?>"><?php echo $video_type->name; ?></a></li>
				<?php
			}
			?>
		</ul>
			<?php if( have_posts() ) { ?>
				<ul class="featured-videos">
					<?php
					
					while( have_posts() ) {
						
						the_post();
						global $post;
						sprinkle_video_list_template($post);
						
					} // while have posts
					?>
				</ul>
			<?php } // if have posts ?>
			<div class="loading-more" style="display:none;">Loading More</div>
	</div><?php // .constrain ?>
</section><?php // .work-grid ?>

<section class="call-to-action">
	<?php
	$cta_link_text = echo_test('our_work_cta_btn_text', $sprinkle_theme_options, false);
	$cta_link_url = echo_test('our_work_cta_btn_url', $sprinkle_theme_options, false);
	?>
	<h3><?php echo_test('our_work_cta_text', $sprinkle_theme_options); if( $cta_link_text && $cta_link_url ) { ?> <a href="<?php echo $cta_link_url; ?>" class="btn pink"><?php echo $cta_link_text; ?></a><?php } ?></h3>
</section><?php // .call-to-action ?>

<?php include_once('footer.php'); ?>