<?php
$body_class = 'blog';

add_action('wp_head', function(){
	
	//echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
	
});

get_header();

global $sprinkle_theme_options;

?>
<section class="headline">
	<span class="pink-bar"></span>
	<span class="corner-icing pink"></span>
	<h3><?php echo_test('blog_headline', $sprinkle_theme_options); ?></h3>
</section>
<div class="blog-content-wrap gray-full-width">
	<div class="col-wrap">
		<section class="blog-roll col-left">
			<ul class="blog-roll-list">
				
				<?php
				if( have_posts() ) {
					while( have_posts() ) {
						the_post();
						global $post;
						$post_meta = get_post_meta( $post->ID, '_post_meta', true );
						$post_meta = is_array($post_meta) ? $post_meta : array();
						
						$hide_title = echo_test('hide_title', $post_meta, false);
						
						$video_type = echo_test('video_type', $post_meta, false);
						$video_id = echo_test('video_id', $post_meta, false);
						
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog' );
						$thumb_url = is_array($thumb_url) ? $thumb_url[0] : null;
						
						$post_content = get_the_content();
						
						?>				
						<li>
							<div class="post-title">
								<h4><?php the_title(); ?></h4>
							</div>
							
							<div class="post-meta">
								<div class="post-date"><?php echo get_the_date('M'); ?> <strong><?php echo get_the_date('d'); ?></strong></div>
								<ul class="post-social">
									<li><a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); echo '+'; echo urlencode(get_permalink()); ?>" class="tweet"><span>Tweet</span></a></li>
								</ul>
							</div>
							
							<div class="post-content-wrap"<?php if( !$post_content ) echo ' style="height:315px;"' ?>>
								<?php
								
								$video_output = sprinkle_video_output($video_type, $video_id);
								
								if( !empty($video_output) )
									echo $video_output;
								else
									the_post_thumbnail('blog');
								
								if( $post_content ) {
								?>
								<div class="post-content">
									<?php echo wpautop($post_content); ?>
								</div><?php // .post-content ?>
								<?php } ?>
							</div>
						</li>
				
						<?php
					}
				}
				?>
				
			</ul>
			<div class="next_posts_wrap" style="display:none;"><?php next_posts_link(); ?></div>
			<!-- <div class="loading-more">Loading More</div> -->
		</section>
		<?php include_once('sidebar.php'); ?>
	</div><?php // .col-wrap ?>
</div><?php // .blog-content-wrap ?>
	
<section class="call-to-action">
	<?php 
	$cta_link_text = echo_test('blog_cta_btn_text', $sprinkle_theme_options, false);
	$cta_link_url = echo_test('blog_cta_btn_url', $sprinkle_theme_options, false); 
	?>
	<h3><?php echo_test('blog_cta_text', $sprinkle_theme_options); if( $cta_link_text && $cta_link_url ) { ?> <a href="<?php echo $cta_link_url; ?>" class="btn pink"><?php echo $cta_link_text; ?></a><?php } ?></h3>
</section>
<?php get_footer(); ?>