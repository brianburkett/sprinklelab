(function($) {
    $(function() {
    		var aspectRatio = 3/5,
    			$window = $(window);

    		$window.on('resize.press, load', function() {
    			var pressRectangle = $('.press-rectangle'),
    				width = pressRectangle.width(),
    				calculatedWidth = width * aspectRatio;

    			$('.press-rectangle').css({
    				'height': calculatedWidth
    			});
    		});

    		var testElements = $(".text-area");

            if (!isMobile) {
        		testElements.each( function(index) {
        			var height = $(this).find('.header').height(),
        				calculatedHeight = 93 - height,
        				calculatedHeight = String(calculatedHeight) + 'px',
        				id = $(this).attr('id'),
        				modal = document.getElementById(id);

    			    $clamp(modal, {clamp: calculatedHeight});
    			});
            }

    });
})(jQuery);