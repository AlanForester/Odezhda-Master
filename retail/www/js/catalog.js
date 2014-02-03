var RetailCatalog = {};

$(document).ready(function(){
    RetailCatalog.tooltip();
    RetailCatalog.sliders();
    RetailCatalog.accordion();
    RetailCatalog.tabs();
    RetailCatalog.moreButton();
    RetailCatalog.zoom();
});

RetailCatalog.tooltip = function(){
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
};

RetailCatalog.sliders = function(){
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
};

RetailCatalog.accordion = function(){
    $( "#accordion" ).accordion({
        heightStyle: "content"
    });
};

RetailCatalog.tabs = function(){
    $("#example-one").organicTabs();

    $("#example-two").organicTabs({
        "speed": 200
    });
};

RetailCatalog.moreButton = function(){
    $(".any-goods").click(function(){
        $(".catalog-goods.more").slideToggle("slow");
        $(this).toggleClass("active");
    });
};

RetailCatalog.zoom = function(){
    $('.jqzoom').jqzoom({
        zoomType: 'reverse',
        lens:true,
        preloadImages: false,
        alwaysOn:false
    });
};