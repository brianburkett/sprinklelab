(function($) {
    $(function() {

        /* Open questions accordian-style
         *************************************/

        $('.clickable-region').on('click', function() {
            var toggledContent = $(this).siblings('.toggle-content'),
                openContent = $('.toggle-content.open');

            if (toggledContent.css('display') == 'none') {
                openContent.slideUp(500);
                openContent.removeClass('open');
                $(this).html('<i class="fa fa-plus-square left"></i>Show less job description');
            } else {
                $(this).html('<i class="fa fa-plus-square left"></i>Show full job description');
            }

            toggledContent.slideToggle(500);
            toggledContent.toggleClass('open');

            return false;
        });

        smoothScroll();

        function smoothScroll() {
            $('.job-position').click(function() {
                var target = $(this);
                var hash = this.hash;

                stopAnimatedScroll();

                var destination = $(hash).offset().top-80;
                $('html, body').stop().animate({ 
                    scrollTop: destination
                }, 400, function() { window.location.hash = hash; });
                return false;
            });

            function stopAnimatedScroll(){
                if ( $('*:animated').length > 0 ) { $('*:animated').stop(); }
            }
        }

    });
})(jQuery);