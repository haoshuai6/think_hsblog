/* Preloader by Shahriar 
 * http://www.cssmoban.com// 
 **/
(function ($) {
    $(window).load(function () {
        $('#status').fadeOut();
        $('#preloader').delay(300).fadeOut('slow');
    });
}(jQuery));