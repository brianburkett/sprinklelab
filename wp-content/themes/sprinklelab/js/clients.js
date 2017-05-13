(function($) {
    $(function() {

        var $window = $(window);

        $window.on('resize.clients, load', function() {
            $('#section-clients .row > div').css('height','auto');
            $('#section-clients .row > div').equalHeights();
        });

        /* Equal Heights
        *****************************************/
        $.fn.equalHeights = function() {
            var maxHeight = 0,
                $this = $(this);

            $this.each( function() {
                var height = $(this).innerHeight();

                if ( height > maxHeight ) { maxHeight = height; }
            });

            return $this.css('height', maxHeight);
        };

        // auto-initialize plugin
        $('[data-equal]').each(function(){
            var $this = $(this),
                target = $this.data('equal');
            $this.find(target).equalHeights();
        });     

    });
})(jQuery);