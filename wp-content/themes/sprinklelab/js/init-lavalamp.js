(function($) {
    $(function() {
      
        var nav = $('#menu-main-navigation'),
            $window = $(window);

        function initLavalamp() {
            nav.lavalamp();   
        }

        function destroyLavalamp() {
            nav.lavalamp('destroy');   
        }

        var currentState;
        
        $window.on('resize.lavalamp', function() {
            var isMobile = Modernizr.mq(window.settings.mediaQueryExtraSmall);

            if (isMobile && currentState != 'mobile') {
                currentState = 'mobile';
                destroyLavalamp();
            } else if (!isMobile && currentState != 'desktop') {
                currentState = 'desktop';
                initLavalamp();
            }
        }).trigger('resize.lavalamp');
    });
})(jQuery);