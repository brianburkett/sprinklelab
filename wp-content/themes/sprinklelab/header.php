<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sprinkle Lab</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="fb:app_id" content="775832832477729" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900|Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
	    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	    var stylesheetdirectory = "<?php echo get_stylesheet_directory_uri(); ?>";
	</script>
	<?php 
		global $sprinkle_theme_options, $post;
		$sprinkle_theme_options = get_option('sprinkle_theme_options');
		$sprinkle_theme_options = is_array($sprinkle_theme_options) ? $sprinkle_theme_options : array();

		if($post) {
			$yoast_meta_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
		}
	
	?>
	<meta name="google-site-verification" content="-p-JCGQhcS8icdNFYKqgX5SImdUMWMVUYgfO6EVLuxA" />
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-44419172-1', 'auto');
	  ga('send', 'pageview');

	</script>
	<style type="text/css">
		header #header-logo-link {
			background-image: url('http://www.sprinklelab.com/wp-content/themes/sprinklelab/images/sprinklelab-logo-1.png') !important;
			background-size: contain !important;
			background-repeat: no-repeat !important;
			background-position: center !important;
		}
	</style>
	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/overrides.css?v=1.0.0.1">
	
	<?php wp_head(); ?>
	
</head>
<body <?php body_class() ?>>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '775832832477729',
	      xfbml      : true,
	      version    : 'v2.2'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<header id="site-header">
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand"  id="header-logo-link" href="<?php echo home_url(); ?>"></a>
		    </div>
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <?php wp_nav_menu(array(
              'theme_location' => 'main-nav',
              'container' => false,
              'menu_class'      => 'nav navbar-nav navbar-right',
              'menu' => 'Main Navigation'
          )); 
          ?>
	      </div>
	    </div>
	  </nav>
	</header>