(function($) {

	if (location.hash) {
		setTimeout(function() {
			window.scrollTo(0, 0);
		}, 1);
	}

	$(window).on('load', function() {
	  hash = location.hash;
	  if(hash) {
	      name = hash;
				$('.work-filters ' + name).trigger('click');
	  }
	});

	var sprinkle = {};

	sprinkle.initialize = function(){
		sprinkle.setElems();

		if( $('body.page-our-work').length ) {
			sprinkle.videoFilters();
		}
	}

	sprinkle.setElems = function(){
		var isAnimating;
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

	sprinkle.lavalamp = function(){
		$(window).load(function(){
			sprinkle.elems.main_navigation.lavaLamp({ speed: 200 });
		});
	}



	sprinkle.videoFilters = function(){

		var isAnimating;

		//if( !sprinkle.elems.video_filters.length || !jQuery.Isotope )
			//return false;

		sprinkle.elems.featured_videos.isotope({
			itemSelector	: '.featured-videos li',
			layoutMode 		: 'fitRows'
		});

		window.sprinkleVideoFilter = '*';
		window.sprinkleVideoIDs = [];

		sprinkle.elems.featured_videos.find('li').each(function(){
			window.sprinkleVideoIDs.push($(this).data('post-id'));
		})

		sprinkle.elems.video_filters_links.on('click.filterVideos', function(e){
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

			if (!isAnimating) {
          // set animation flag
          isAnimating = true;

          // grab vars
          var $self = $(this),
              filter = $self.attr('id'),
              $directorBios = $('#section-director-bio'),
              $directors = $directorBios.find('.one-director'),
              $oldDirector = $directors.filter(':visible'),
              $newDirector = $directors.filter('.' + filter),
              directorDescriptionHeight = $directorBios.outerHeight(),
              oldDirectorHeight = $oldDirector.outerHeight();

          // update filter button selection
          if ($('.selected').get(0) != $self.get(0)) {
              $('.selected').removeClass('selected');
          }
          $self.addClass('selected');

          // lock program description height
          $directorBios.css('height', directorDescriptionHeight);

          if ($oldDirector.length < 1) {
          	$oldDirector = $('.all');
          }

          // animate video thumbnails
          $oldDirector.animate({
              opacity: 0
          }, window.settings.defaultAnimationDuration, function() {
              // remove old header from display
              $(this).css({
                  display: 'none'
              });

              // add new header to display for measurement
              $newDirector.css({
                  opacity: 0,
                  display: 'block'
              });

              // calculate height difference between new and old header
              var heightDifference = $newDirector.outerHeight() - oldDirectorHeight;

              // animate new header
              $newDirector.css({
                  position: ''
              })
                .animate({
                    opacity: 1
                }, window.settings.defaultAnimationDuration, function() {
                    isAnimating = false;
                });

              // animate program description
              $directorBios.animate({
                  height: directorDescriptionHeight + heightDifference
              }, window.settings.defaultAnimationDuration, function() {
                  $directorBios.css('height', '');
              });
          });
        }
		});

		window.sprinkleVideoFilterAllLoaded = {};
		sprinkle.elems.video_filters_links.each(function(){

			var $thisFilterLink = $(this),
				$thisFilter = $thisFilterLink.attr('href').split('#')[1];

			window.sprinkleVideoFilterAllLoaded[$thisFilter] = false;
		});
	};

	sprinkle.loadMoreVideos = function(limit){

		if ( window.sprinkleLoadingVideos || window.sprinkleVideoFilterAllLoaded['*'] || window.sprinkleVideoFilterAllLoaded[window.sprinkleVideoFilter] )
			return;

		var limit = limit ? limit : 9;

		window.sprinkleLoadingVideos = true;

		$.ajax({
			url		: ajaxurl,
			type	: 'post',
			data	: {
				action 		: 'sprinkle_video_ajax_fetch',
				filter		: window.sprinkleVideoFilter,
				notPosts	: window.sprinkleVideoIDs,
				limit		: limit
			},
			complete: function( videos ){
				var $featuredVideos = sprinkle.elems.featured_videos;
				var videos = $.parseJSON( videos.responseText );
				var newHTML = $(videos.video_html).not('TextNode');

				sprinkle.elems.featured_videos.append(newHTML).isotope( 'insert',  newHTML );

				if( videos.new_video_count < limit ) {

					var friendlyFilter = window.sprinkleVideoFilter == '*' ? '' : ' ' + $('.work-filters li.active a').text();

					sprinkle.elems.video_loading_more.text('All'+ friendlyFilter + ' Videos Loaded');
					window.sprinkleVideoFilterAllLoaded[window.sprinkleVideoFilter] = true;
				}

				sprinkle.elems.video_loading_more.css('opacity', 1).fadeOut(1750).dequeue();

				if( videos.ids )
					$.merge( window.sprinkleVideoIDs, videos.ids );

				window.sprinkleLoadingVideos = false;

			},
			beforeSend	: function(){
				sprinkle.elems.video_loading_more.text('Loading').show();
		  	}
		});
	};

	$(document).ready(function(){
		sprinkle.initialize();
	});

})(jQuery);
