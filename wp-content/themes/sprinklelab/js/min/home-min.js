(function($) {
    $(function() {

         var $window = $(window),
            muted = false,
            $sectionHomeHeading = $('#section-header-video');


        if (!Modernizr.touch) {

            /* Video background
             *******************************************/
            /*$('.video-bg').videobackground({
                videoSource: [
                    ['/wp-content/themes/sprinklelab/video/home-bg.mp4', 'video/mp4'],
                    ['/wp-content/themes/sprinklelab/video/home-bg.ogv', 'video/ogg']
                ],
                loop: true,
                resize: false,
                preload: true,
                autoplay: true,
                controls: false,
                loadedCallback: function() {
                    if (!muted) {
                        muted = true;
                        $(this).videobackground('mute');
                    }
                }
            });

            $('.video-bg').prop('muted', true);*/
        }

        /* Adjust position of programs images
         *******************************************/
       /* $window.on('resize.home', function() {
            var $images = $('.bg img'),
                offset = parseInt($('.bg').outerWidth() - $images.outerWidth()) / 2,
                left = Math.min(offset, 0);

            $images.css({
                'left': left
            })
        }).trigger('resize.home'); */

        $('.fancybox.video').on('click', function() {
            isMobile = Modernizr.mq(window.settings.mediaQueryExtraSmall);
            $('.video-bg').videobackground('play');

            $('.fancybox.video').fancybox({
                closeEffect: 'none',
                scrolling: 'no',
                padding: 0,
                width: '100%',
                height: '100%',
                margin: [0,0,0,0],
                helpers: {
                    overlay : {
                        locked : false,
                        css : {
                            'background' : 'rgba(0, 0, 0, 0.8)'
                        }
                    },
                    media: {}
                },
                tpl: {
                    closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
                },
                afterClose: function() {
                    $('.video-bg').videobackground('play');
                }
            });

        });
		
		if (!Modernizr.touch) {
			
			var options = {
				element : 		$('#video-loop'),
				ID :			'video-loop',
				file :			'',
				image :			'',
				width :			'100%',
				controls :		false,
				autostart :		true,
				mute :			true,
				stretching :	'fill',
				wmode :			'transparent',
				repeat :		true
			};
			
			if( options.element.hasClass('jwplayer') ) {
				return;
			}
	
			options.file = options.file.length ? options.file : options.element.data('video-url');
			options.image = options.image.length ? options.image : options.element.data('poster');
			window.jwplayer.key = 'e0JTSawMNOkt9EEjDYygiruMMK+sbEsP3cbXJA==';
			window.jwplayer(options.ID).setup(options);
			
		}
       
      
    });
})(jQuery);

