//页面加载
$('body').show();
NProgress.start();
setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1500);
//返回顶部按钮
$(function(){
    $(window).scroll(function(){
        if($(window).scrollTop()>100){
            $(".gotop").fadeIn();
        }
        else{
            $(".gotop").hide();
        }
    });
    $(".gotop").click(function(){
        $('html,body').animate({'scrollTop':0},500);
    });
});
$(function () {
    $('[data-toggle="popover"]').popover();
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
//鼠标滑过显示 滑离隐藏
$(function(){
    $(".carousel").hover(function(){
        $(this).find(".carousel-control").show();
    },function(){
        $(this).find(".carousel-control").hide();
    });
});
$(function(){
    $(".hot-content ul li").hover(function(){
        $(this).find("h3").show();
    },function(){
        $(this).find("h3").hide();
    });
});
//页面元素智能定位
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top; //当前元素对象element距离浏览器上边缘的距离
        var pos = element.css("position"); //当前元素距离页面document顶部的距离
        $(window).scroll(function() { //侦听滚动时
            var scrolls = $(this).scrollTop();
            if (scrolls > top) { //如果滚动到页面超出了当前元素element的相对页面顶部的高度
                if (window.XMLHttpRequest) { //如果不是ie6
                    element.css({ //设置css
                        position: "fixed", //固定定位,即不再跟随滚动
                        top: 0 //距离页面顶部为0
                    }).addClass("shadow"); //加上阴影样式.shadow
                } else { //如果是ie6
                    element.css({
                        top: scrolls  //与页面顶部距离
                    });
                }
            }else {
                element.css({ //如果当前元素element未滚动到浏览器上边缘，则使用默认样式
                    position: pos,
                    top: top
                }).removeClass("shadow");//移除阴影样式.shadow
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};
//启用页面元素智能定位
$(function(){
    $(".search_p").smartFloat();
});
//页面加载时给img和a标签添加draggable属性
(function () {
    $('img').attr('draggable', 'false');
    $('a').attr('draggable', 'false');
})();
//返回顶部按钮
$("#gotop").hide();
$(window).scroll(function () {
    if ($(window).scrollTop() > 100) {
        $("#gotop").fadeIn();
    } else {
        $("#gotop").fadeOut();
    }
});
$("#gotop").click(function () {
    $('html,body').animate({
        'scrollTop': 0
    }, 500);
});
 
//图片延时加载
$("img.thumb").lazyload({
    placeholder: "/static/home/images/occupying.png",
    effect: "fadeIn"
});
$(".single .content img").lazyload({
    placeholder: "/static/home/images/occupying.png",
    effect: "fadeIn"
});

//启用工具提示
$('[data-toggle="tooltip"]').tooltip();

//鼠标滚动超出侧边栏高度绝对定位
$(window).scroll(function () {
    var sidebar = $('.sidebar');
    var sidebarHeight = sidebar.height();
    var sidebarWidth =  $(window).width();
    var windowScrollTop = $(window).scrollTop();
    if (windowScrollTop > sidebarHeight - 60 && sidebar.length) {
        if(sidebarWidth >= 1000  &&　sidebarWidth　<= 1506){
            $('.fixed').css({
                'position': 'fixed',
                'top': '50px',
                'width': '320px'
            });
        } else {
            $('.fixed').css({
                'position': 'fixed',
                'top': '50px',
                'width': '360px'
            });
        }
    } else {
        $('.fixed').removeAttr("style");
    }
});
