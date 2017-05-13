(function($) {
    $(function() {

    	var sprinkle = {};
	
		sprinkle.initialize = function(){
			sprinkle.setElems();
			//sprinkle.logoWiggle();
			
			if( $('body.our-work').length ) {
				sprinkle.videoFilters();
				sprinkle.videoInfiniteScroll();
			}
			
			if( $('body.blog').length )
				sprinkle.blogInfiniteScroll();
			
			if( $('body.single-video') )
				sprinkle.singleFancyBox();
		}

		sprinkle.setElems = function(){
		
			sprinkle.elems = {};
			sprinkle.elems.logo = $('h1');
			sprinkle.elems.main_navigation = $('#main-navigation');
			sprinkle.elems.featured_videos = $('.featured-videos');
			sprinkle.elems.video_filters = $('.work-filters li');
			sprinkle.elems.video_filters_links = $('.work-filters li a');
			sprinkle.elems.video_loading_more = $('.loading-more');
			sprinkle.elems.blog_roll = $('.blog-roll-list');
			sprinkle.elems.project_gallery = $('.project-gallery');
		}

		sprinkle.singleFancyBox = function(){
			if( !sprinkle.elems.project_gallery.length )
				return;
				
			sprinkle.elems.project_gallery.find('a[rel="image-group"]').fancybox({
				autoScale		: true,
				autoDimensions	: true,
				centerOnScroll	: true,
				cyclic			: true
			
			})
		}

		sprinkle.initialize();

	});
})(jQuery);