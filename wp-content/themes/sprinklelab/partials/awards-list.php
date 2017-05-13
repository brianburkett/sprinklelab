<?php
	$latest_press = new WP_Query(array(
		'post_type'			=> 'press',
		'posts_per_page'	=> 4,
		'orderby'			=> 'rand'
	));

	if( $latest_press->have_posts() ) :
?>

<section id="section-awards" class="our-clients">
	<div class="container">
		<h3 class="header small">
			Press & Awards
		</h3>
		<div class="row">
		<?php
			while( $latest_press->have_posts() ) {
				$latest_press->the_post();
				global $post;
				$title = get_the_title();
				$link = esc_url(get_field('press_link'));

				$template = '<div class="col-md-2 col-md-offset-1 col-sm-6">
							<a href="%1$s" target="_blank" class="medium">%2$s</a>
						</div>';
				printf($template, $link, $title);
			}
		?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a id="view-all" href="<?php echo get_permalink(get_page_by_path('press')); ?>"><i class="fa fa-arrow-right"></i> View all</a>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>