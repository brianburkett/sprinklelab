<!DOCTYPE html>
<html>
<head>
<?php
global $body_class, $sprinkle_theme_options;


$sprinkle_theme_options = get_option('sprinkle_theme_options');
$sprinkle_theme_options = is_array($sprinkle_theme_options) ? $sprinkle_theme_options : array();
?>
<meta charset="utf-8" />
<meta property="og:image" content="<?php bloginfo('stylesheet_directory'); ?>/images/sprinkle_lap_og_logo.jpg" />
<meta property="og:title" content="Sprinkle Lab" />
<meta property="og:description" content="Sprinkle Lab is an Emmy award winning, full-service video production studio. We translate brand messages into beautiful and compelling media through the understanding of our clients values, vision and unique positioning." />
<title>Sprinkle Lab</title>

<?php wp_head(); ?>
<?php if( is_front_page() ) { ?>
<script>
	jwplayer.key = "e0JTSawMNOkt9EEjDYygiruMMK+sbEsP3cbXJA==";
</script>
<?php } ?>
</head>
<?php // classes: home ?>
<body class="<?php if(isset($body_class)) echo $body_class; ?>">
<header>
	<div class="constrain">
	
		<h1><a href="<?php echo site_url(); ?>">Sprinkle Lab</a></h1>
		<?php 
		/*
		wp_nav_menu(array(
			'theme_location'	=> 'main_nav',
			'container'			=> false,
			'menu_id'			=> 'main-navigation'
		));
		*/
		
		
		
		
		?>
		
		<ul id="main-navigation">
			<li class="<?php sprinkle_nav_current('home'); ?>"><a href="<?php echo site_url(); ?>" class="nav-home">Home</a>
			<li class="<?php sprinkle_nav_current('our-work'); ?>"><a href="<?php echo site_url('our-work'); ?>" class="nav-our-work">Our Work</a>
			<li class="<?php sprinkle_nav_current('blog'); ?>"><a href="<?php echo site_url('blog'); ?>" class="nav-the-blog">The Blog</a>
			<li class="<?php sprinkle_nav_current('contact'); ?>"><a href="<?php echo site_url('contact'); ?>" class="nav-get-in-touch">Get In Touch</a>
		</ul>
		
	</div><?php // .constrain ?>
</header>

