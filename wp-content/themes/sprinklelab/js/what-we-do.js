(function($) {
    $(function() {
    	var $window = $(window),
            $body = $('body'),
            $sectionFormats = $('#image-container'),
            sectionTeamMembersPadding = parseInt($sectionFormats.css('padding-top')),
            $sectionInfo = $('#section-info'),
            $filterButtons = $('#formats a');

        var isAnimating;
    	$filterButtons.on('click', function() {
            if (!isAnimating) {
                // set animation flag
                isAnimating = true;

                // grab vars
                var $self = $(this),
                    filter = $self.attr('href').slice(1),
                    $imageContainer = $('#image-container'),
                    $image = $imageContainer.find('.format'),
                    $oldImage = $image.filter(':visible'),
                    $newImage = $image.filter('.' + filter),
                    shouldChange = true;

                // update filter button selection
                if ($('.selected').get(0) != $self.get(0)) {
                    $('.selected').removeClass('selected');
                } else {
                    shouldChange = false;
                }
                $self.addClass('selected');

                if (shouldChange) {

                    // animate headers
                    $oldImage.animate({
                        left: '-=1000px'
                    }, 250, function() {
                        // remove old header from display
                        $(this).css({
                            display: 'none'
                        });

                        // add new header to display for measurement
                        $newImage.css({
                            display: 'block'
                        });

                        // animate new header
                        $newImage
                            .animate({
                                left: '0px'
                            }, 250, function() {
                                isAnimating = false;
                            });
                    });
                } else {
                    isAnimating = false;
                }
            }

            return false;
    	});

	});
})(jQuery);