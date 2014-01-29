jQuery(document).ready(function() {
    jQuery('.banner').revolution(
        {
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
});

$(function() {
    if ($.browser.msie && $.browser.version.substr(0,1)<7)
    {
        $('li').has('ul').mouseover(function(){
            $(this).children('ul').show();
        }).mouseout(function(){
            $(this).children('ul').hide();
        })
    }
});

$(document).ready(function() {
    $('.jqzoom').jqzoom({
        zoomType: 'reverse',
        lens:true,
        preloadImages: false,
        alwaysOn:false
    });
    //$('.jqzoom').jqzoom();
});

$(document).ready(function() {

    //Default Action
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content

    //On Click Event
    $("ul.tabs li").click(function() {
        $("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab_content").hide(); //Hide all tab content
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });

});

$(function() {
    if ($.browser.msie && $.browser.version.substr(0,1)<7)
    {
        $('li').has('ul').mouseover(function(){
            $(this).children('ul').show();
        }).mouseout(function(){
            $(this).children('ul').hide();
        })
    }
});

$(function() {
    $( document ).tooltip({
        position: {
            my: "center bottom-20",
            at: "center top",
            using: function( position, feedback ) {
                $( this ).css( position );
                $( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
            }
        }
    });
});

$(function() {
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 17000,
        values: [ 700, 7000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});

$(function() {
    $( "#slider-range1" ).slider({
        range: true,
        min: 0,
        max: 17000,
        values: [ 700, 7000 ],
        slide: function( event, ui ) {
            $( "#amount1" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount1" ).val( "$" + $( "#slider-range1" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range1" ).slider( "values", 1 ) );
});

$(document).ready(function() {
    $( "#accordion" ).accordion({
        heightStyle: "content"
    });
});

$(document).ready(function(){
    $(".our-goods").click(function(){
        $(".our-goods-modal").slideToggle("slow");
        $(this).toggleClass("active");
        var a = $(".our-goods").text();
        if (a=='-') {$(".our-goods").text('+') } else {$(".our-goods").text('-')};
        return false;
    });

    $(".your-goods").click(function(){
        $(".your-goods-modal-wrapper").slideDown("slow");
        return false;
    });
    $(".close-modal-see-goods").click(function(){
        $(".your-goods-modal-wrapper").slideUp("slow");
        return false;
    });
});

$(function(){
    $('#exampleModal').arcticmodal();
});

$(document).ready(function(){
    // прячем кнопку #back-top
    $("#up").hide();

    // появление/затухание кнопки #back-top
    $(function (){
        $(window).scroll(function (){
            if ($(this).scrollTop() > 100){
                $('#up').fadeIn();
            } else{
                $('#up').fadeOut();
            }
        });

        // при клике на ссылку плавно поднимаемся вверх
        $('#up').click(function (){
            $('body,html').animate({
                scrollTop:0
            }, 800);
            return false;
        });
    });
});

jQuery(document).ready(function() {
    $(".fixed-social a").hover(function(){
            $(this).stop().animate({"width":"60"},"500");
            return false;
        },
        function() {
            $(this).stop().animate({"width":"40"},"500");
            return false;
        }
    );
});
