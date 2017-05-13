<?php get_header(); ?>

<?php
if( have_posts() ) {
	
	while( have_posts() ) {
		
		the_post();
		?>
		<section class="headline">
			<span class="pink-bar"></span>
			<span class="corner-icing pink"></span>
			<h3><?php the_title(); ?></h3>
		</section><?php // .headline ?>
		
		<section class="page-content post-content constrain">
			<?php the_content(); ?>
		</section>
		
		<?php
		
		
	}
	
} ?>

<?php get_footer(); ?>