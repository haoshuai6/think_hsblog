(function($) {
    $.fn.backToTop = function() {
        var selectz = $(this);
        selectz.hide();
        $(window).scroll(function() {
            if ($(this).scrollTop() > $(window).height()) {
                selectz.fadeIn();
            } else {
                selectz.fadeOut();
            }
        });
    };
}(jQuery));
