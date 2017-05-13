(function($) {
    $(function() {

		$('.post').find('iframe').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');

		         /* Add correct data to FB share
         *******************************************/
        window.fbAsyncInit = function() {
            FB.init({
                appId: '775832832477729',
                xfbml: true,
                version: 'v2.1'
            });
        };
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function postToFeed(title, desc, url, image) {
            var obj = {
                method: 'share',
                href: url,
                picture: image,
                name: title,
                description: desc
            };

            function callback(response) {}
            FB.ui(obj, callback);
        }

        $('.facebook.share').click(function() {
            elem = $(this);
            postToFeed(elem.data('title'), elem.data('desc'), elem.prop('href'), elem.data('image'));

            return false;
        });

    });
})(jQuery);