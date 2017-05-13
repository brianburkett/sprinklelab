(function($){
	
	var sprinkle = {};
	
	sprinkle.initialize = function(){
		sprinkle.setElems();
		//sprinkle.logoWiggle();
		sprinkle.lavalamp();
		sprinkle.spinDoughnuts();
		
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
	
	sprinkle.logoWiggle = function(){
		
		sprinkle.elems.logo.bind({
			'mouseenter.wiggle'	: function(){
									sprinkle.elems.logo.ClassyWiggle('start');
									window.sprinkleLogoTimeOut = setTimeout(function(){
										sprinkle.elems.logo.ClassyWiggle('stop');
										
									}, 500)
								  },
			'mouseleave.wiggle'	: function(){
									sprinkle.elems.logo.ClassyWiggle('stop');
									window.clearTimeout(window.sprinkleLogoTimeOut)
								  }
		});
		
	}
	
	sprinkle.lavalamp = function(){
		$(window).load(function(){
			sprinkle.elems.main_navigation.lavaLamp({ speed: 200 });	
		});
		
	}
					
	sprinkle.spinDoughnutButton = function(element, degree) {
	    
	        element.css({ transform: 'rotate(' + degree + 'deg)'});
	        
	        // timeout increase degrees:
	        sprinkle.doughnutSpinnerTimer = setTimeout(function() {
	          	degree++;
	            sprinkle.spinDoughnutButton(element, degree); // loop it
	        },5);
	    }
	
	sprinkle.spinDoughnuts = function(){
		
		if( sprinkle.elems.featured_videos.length )
			sprinkle.elems.featured_videos.delegate('li', {
				'mouseenter.spinBtn'	: function(){
											var $thisDoughnut = $(this).find('span > span'),
											degree = 0;
											sprinkle.spinDoughnutButton($thisDoughnut, degree);
										},
				'mouseleave.spinBtn'	: function(){
											clearTimeout(sprinkle.doughnutSpinnerTimer);
										}
			    				
			});
		
	}
	
	sprinkle.videoFilters = function(){
	
		if( !sprinkle.elems.video_filters.length || !jQuery.Isotope )
			return;
			
		sprinkle.elems.featured_videos.isotope({
			
			itemSelector	: '.featured-videos li',
			layoutMode 		: 'fitRows'
			
		});
		
		window.sprinkleVideoFilter = '*';
		window.sprinkleVideoIDs = [];
		
		sprinkle.elems.featured_videos.find('li').each(function(){
			
			window.sprinkleVideoIDs.push($(this).data('post-id'))
			
		})
		
		sprinkle.elems.video_filters_links.bind('click.filterVideos', function(e){
			
			e.preventDefault();
			
			var $thisFilter = $(this),
				$thisLi = $thisFilter.parent('li');
			
			if( $thisLi.hasClass('active') )
				return;
			
			sprinkle.elems.video_filters.removeClass('active');
			
			$thisLi.addClass('active');
			
			var filter = $thisFilter.attr('href').split('#')[1];
			
			filter = filter != '*' ? '.'+filter : filter;
			
			sprinkle.elems.featured_videos.isotope({
				'filter'	: filter
			});
			
			window.sprinkleVideoFilter = filter;
			
			var visibleVideoCount = sprinkle.elems.featured_videos.find('.isotope-item').not('.isotope-hidden').length;
			
			if( visibleVideoCount < 9 )
				sprinkle.loadMoreVideos(9 - visibleVideoCount);
			else if ( visibleVideoCount % 3 != 0 )
				sprinkle.loadMoreVideos(Math.abs(Math.floor(3 - Math.ceil( 13 / 3 ))));
			
		});
		
		window.sprinkleVideoFilterAllLoaded = {};
		sprinkle.elems.video_filters_links.each(function(){
				
				
			var $thisFilterLink = $(this),
				$thisFilter = $thisFilterLink.attr('href').split('#')[1];
			
			window.sprinkleVideoFilterAllLoaded[$thisFilter] = false;
			
		});
		
	};
	
	sprinkle.videoInfiniteScroll = function(){
		
		var $featuredVideos = sprinkle.elems.featured_videos;
		
		if( !$featuredVideos.length )
			return;	
		
		var $document = $(document),
			$window = $(window),
			featuredVideosTop = $featuredVideos.offset().top;
		
		$window.scroll(function(){
			
			if($window.scrollTop() + $window.height() >= featuredVideosTop + $featuredVideos.height() - 360 ) {
				
				
				sprinkle.loadMoreVideos(9);
				
			}
				
			
		});
		
	};
	
	sprinkle.loadMoreVideos = function(limit){
		
		if ( window.sprinkeLoadingVideos || window.sprinkleVideoFilterAllLoaded['*'] || window.sprinkleVideoFilterAllLoaded[window.sprinkleVideoFilter] )
			return;
			
		var limit = limit ? limit : 9;
		
		window.sprinkeLoadingVideos = true;

		$.ajax({
			url			: wordpress.ajax,
			type		: 'post',
			data		: {
							action 		: 'sprinkle_video_ajax_fetch',
							filter		: window.sprinkleVideoFilter,
							notPosts	: window.sprinkleVideoIDs,
							limit		: limit
						  },
			complete	: function( videos ){
							
							var videos = $.parseJSON( videos.responseText );
							
							var newHTML = $(videos.video_html).not('TextNode');
							
							sprinkle.elems.featured_videos.isotope( 'insert',  newHTML );
							
							if( videos.new_video_count < limit ) {
								var friendlyFilter = window.sprinkleVideoFilter == '*' ? '' : ' ' + $('.work-filters li.active a').text();
								
								sprinkle.elems.video_loading_more.text('All'+ friendlyFilter + ' Videos Loaded');
								window.sprinkleVideoFilterAllLoaded[window.sprinkleVideoFilter] = true;
							}
							
							sprinkle.elems.video_loading_more.css('opacity', 1).fadeOut(1750).dequeue();
							
							if( videos.ids )
								$.merge( window.sprinkleVideoIDs, videos.ids );
							
							window.sprinkeLoadingVideos = false;
							
						  },
			beforeSend	: function(){
							sprinkle.elems.video_loading_more.text('Loading More').show();
						  }
			
		});

			
	};
	
	sprinkle.blogInfiniteScroll = function(){
		
		sprinkle.elems.blog_roll.infinitescroll({
			
			navSelector		: 'div.next_posts_wrap',
			nextSelector	: 'div.next_posts_wrap a',
			itemSelector	: '.blog-roll-list > li',
			loading			: {
								img			: wordpress.stylesheetdirectory + '/images/loading-more.gif',
								msgText		: 'Loading More',
								speed		: 'slow',
								finishedMsg	: 'All Posts Loaded'
							  }
	
		});
		
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
	
	$(document).ready(function(){
		
		sprinkle.initialize();
		
	});
	
})(jQuery);