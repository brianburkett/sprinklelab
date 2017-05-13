(function($) {
    $(function() {
        
        var sprinkle = {};
    
        sprinkle.initialize = function(){
            sprinkle.setElems();
            sprinkle.singleFancyBox();
        }

        sprinkle.setElems = function(){
        
            sprinkle.elems = {};
            sprinkle.elems.project_gallery = $('#first-row');
        }

        sprinkle.singleFancyBox = function(){
            if( !sprinkle.elems.project_gallery.length )
                return;
                
            sprinkle.elems.project_gallery.find('a[rel="image-group"]').fancybox({
                    autoScale       : true,
                    autoDimensions  : true,
                    centerOnScroll  : true,
                    cyclic          : true
            })
        }

        sprinkle.initialize();



    });
})(jQuery);