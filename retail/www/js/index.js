var RetailIndex = {};

$(document).ready(function(){
    RetailIndex.banner();
    RetailIndex.tabs();
});

RetailIndex.banner = function(){
    $('.banner').revolution({
        delay:5000,
        startheight:500,
        startwidth:960,

        hideThumbs:300,

        thumbWidth:100,
        thumbHeight:50,
        thumbAmount:5,

        navigationType:"both",
        navigationArrows:"verticalcentered",
        navigationStyle:"round",

        touchenabled:"on",
        onHoverStop:"on",

        navOffsetHorizontal:0,
        navOffsetVertical:20,

        stopAtSlide:-1,
        stopAfterLoops:-1,

        shadow:1,
        fullWidth:"off"
    });
};

RetailIndex.tabs = function(){
    $("#tabs").tabs();
    $(".ui-tabs .ui-tabs-nav li a, .ui-tabs .ui-tabs-nav li").click(function () {
        $(".ui-tabs #fragment_holder").fadeIn("1000");
    });
};
