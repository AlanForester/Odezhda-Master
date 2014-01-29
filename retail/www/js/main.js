var Retail = {};

$(document).ready(function(){
    Retail.submenu();
    Retail.bottomModal();
    Retail.toTopBtn();
    Retail.social();
});

Retail.submenu = function(){
    if ($.browser.msie && $.browser.version.substr(0,1)<7)
    {
        $('li').has('ul').mouseover(function(){
            $(this).children('ul').show();
        }).mouseout(function(){
            $(this).children('ul').hide();
        })
    }
};

Retail.bottomModal = function(){
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
};

Retail.toTopBtn = function(){
    // прячем кнопку #back-top
    $("#up").hide();

    // появление/затухание кнопки #back-top
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
};

Retail.social = function(){
    $(".fixed-social a").hover(function(){
            $(this).stop().animate({"width":"60"},"500");
            return false;
        },
        function() {
            $(this).stop().animate({"width":"40"},"500");
            return false;
        }
    );
};
