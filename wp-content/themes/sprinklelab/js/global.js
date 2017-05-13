(function($) {
    $(function() {

        /* Variables
         ***************************/
        var $window = $(window),
            currentState,
            initiated,
            size;

        window.settings = {};

        // store media queries for global use later
        window.settings.mediaQueryLarge = 'only screen and (min-width: 1200px)';
        window.settings.mediaQueryMedium = 'only screen and (min-width: 992px) and (max-width: 1199px)';
        window.settings.mediaQuerySmall = 'only screen and (min-width: 768px) and (max-width: 991px)';
        window.settings.mediaQueryTablet = 'only screen and (max-width: 991px)';
        window.settings.mediaQueryExtraSmall = 'only screen and (max-width: 767px)';
        window.settings.mediaQuerySuperSmall = 'only screen and (max-width: 480px)';

        // store transition settings
        window.settings.defaultAnimationDuration = 300; // in milliseconds


        isTablet = Modernizr.mq(window.settings.mediaQueryTablet);
        isMobile = Modernizr.mq(window.settings.mediaQueryExtraSmall),
        isMobileSmall = Modernizr.mq(window.settings.mediaQuerySuperSmall);

        $window.on('resize.email', function() {
            var formWidth = $('#blue-column').outerWidth() - 30 - 130,
                width = $('.email-form input[type=email]').css('width'),
                isMobile = Modernizr.mq(window.settings.mediaQueryExtraSmall);
               
            $('.email-form input[type=email]').css('width', formWidth);
        }).trigger('resize.email');
    

        $('.contact, .job-contact').on('click', function() {
            var classes = $(this).attr('class'),
            href = '#' + classes.slice(0, classes.indexOf(" "));
           
            $.fancybox({
                href: href,
                width: '100%',
                margin: [0,0,0,0],
                scrolling: 'no',
                height: 'auto',
                padding: 0,
                wrapCSS: 'modal-wrap',
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
            })

            return false;
        });

        // Variables
        

        $('form input[type=submit]').on('click', function(event) {
            var $form2 = $(this).parents('.contact-form');

            if (event) event.preventDefault();
            $form2.parsley().validate();
            validateFronttwo($form2);

            if (true === $form2.parsley().isValid()) {
                registertwo($form2);
            }
        });

        //$('.contact-form').find()
        var spinner = new Spinner({
            lines: 11, // The number of lines to draw
            length: 5, // The length of each line
            width: 3, // The line thickness
            radius: 6, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#FFF', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: '35%', // Top position relative to parent
            left: '50%' // Left position relative to parent
        });

        function displaySpinner(show, form) {
            var $submitBtnWrap = form.find('.submit-wrapper'),
                $submitBtn = $submitBtnWrap.find('input[type="submit"]');

            if (typeof(show) === 'undefined') show = true;

            if (show) {
                $submitBtn.attr('disabled', 'disabled').val('');
                spinner.spin($submitBtnWrap.get(0));
            } else {
                $submitBtn.removeAttr('disabled').val('Submit');
                spinner.stop();
            }
        }

        /* Contact form
         **************************************/

        // Validate contact form & pass it once all fields are validated 
        var validateFronttwo = function(form) {
            if (true === form.parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
                return true;
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        }

        // Send message
        function registertwo(form) {
            displaySpinner(true, form);

            var postData = {};

            $.each(form.find('input, textarea').not('input[type=submit]'), function(index, v) {
                var value = String(v.value),
                    key = String(v.id);

                postData[key] = value;
            });

            $.post('/wp-admin/admin-ajax.php', {
                action: 'send_email',
                data: postData
            }, function(data) {
                console.log(data);
                displaySpinner(false, form);
                if (data == 'success') {
                    form.addClass('success');
                } else {
                    form.addClass('error');
                }
            });

            return false;
        }

    });
})(jQuery);