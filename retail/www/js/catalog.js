var RetailCatalog = {};
offset=0;

$(document).ready(function(){
    RetailCatalog.tooltip();
    RetailCatalog.sliders();
//  RetailCatalog.accordion();
//  Accordion в каталоге
    RetailCatalog.tabs();
//    RetailCatalog.moreButton();
    RetailCatalog.zoom();
    RetailCatalog.loadData();
//    RetailCatalog.sort();
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


//RetailCatalog.accordion = function(){
//
//};

RetailCatalog.tabs = function(){
    $("#example-one").organicTabs();

    $("#example-two").organicTabs({
        "speed": 200
    });
};

    //RetailCatalog.moreButton = function(){
    //    $(".any-goods").click(function(){
    //        $(".catalog-goods.more").slideToggle("slow");
    //        $(this).toggleClass("active");
    //    });
    //};
RetailCatalog.loadData =function (){

        $(".any-goods").click(function(){

            $.post( location.pathname, { 'offset': (offset+6)}).done(function(data) {
                  $( ".catalog-goods" ).append(data);
                    if(!data){
                        $('.any-goods').remove();
                    }
                  offset=offset+6;
                });
        });

}

RetailCatalog.zoom = function(){
    $('.jqzoom').jqzoom({
        zoomType: 'reverse',
        lens:true,
        preloadImages: false,
        alwaysOn:false
    });

}
