/*resize*/
var meta_viewport = $('meta[name="viewport"]');
function test_viewport() {
    var res = true;
    if (window.screen.availWidth > 360) {
        meta_viewport.attr('content', 'width=device-width, initial-scale=1, maximum-scale=1');
        res = true;
    } else {
        meta_viewport.attr('content', 'width=360, user-scalable=no, minimal-ui');
        res = false;
    }
    return res;
}
function change_viewport() {
    test_viewport();
    $(window).on('resize', function () {
        test_viewport();
    });
};

$(document).ready(function (){
    change_viewport();
    $(window).trigger('resize');


    $( window ).resize(function() {
        if ($(window).width() < 991) {
            $(".navbar-drop > a").on("click", function(e){
                event.preventDefault();
                $(this).parent().toggleClass('open');
            });

            $( ".navbar-drop" ).click(function() {
                if($(this).hasClass("open")) {
                    $(this).parent().addClass('nn');
                } else {
                    $(this).parent().removeClass('nn');
                }
            });

        }

    });

    if ($(window).width() < 991) {
        $(".navbar-drop > a").on("click", function(e){
            event.preventDefault();
            $(this).parent().toggleClass('open');
        });


        $( ".navbar-drop" ).click(function() {
            if($(this).hasClass("open")) {
                $(this).parent().addClass('nn');
            } else {
                $(this).parent().removeClass('nn');
            }
        });
    }

    $('.js-partners-slider').slick({
        infinite: true,
        responsive: [
            {
                breakpoint: 9000,
                settings: 'unslick'
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrow: true
                }
            }
        ]
    });


    $( ".navbar-drop" ).hover(function() {
        $(this).find('.drop').toggleClass('open');
        $('body').toggleClass('bg');
    });

    // $(function(){
    //     $(".textpage__gallery-item").hover(function(){
    //         console.log('work');
    //       $(this).find(".textpage__gallery-text").fadeIn();
    //     },function(){
    //     $(this).find(".textpage__gallery-text").fadeOut();
    //     }
    // );        
    // });

    // $(function() {
    //     $('.textpage__gallery-item').hover(function() { 
    //       $('.textpage__gallery-text').show(); 
    //     }, function() { 
    //       $('.textpage__gallery-text').hide(); 
    //     });
    //   });

    /*map*/

    mapboxgl.accessToken = 'pk.eyJ1IjoianVsaWE5OTkiLCJhIjoiY2pveTAxcHA5MDBicDN2cDZxMmcxYWFvNCJ9.kmW6GI65t12nDoOr51-uCw';

    var geojson = {
        "type": "FeatureCollection",
        "features": [
            {
                "type": "Feature",
                "properties": {
                    "iconSize": [36, 48]
                },
                "geometry": {
                    "type": "Point",
                    "coordinates": [
                        24.127,56.947
                    ]
                }
            }
        ]
    };

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/julia999/cjrkq6xse02py2smm0secamlj',
        center: [24.127,56.947],
        zoom: 14
    });
    map.addControl(new mapboxgl.NavigationControl());

    geojson.features.forEach(function(marker) {
        // create a DOM element for the marker
        var el = document.createElement('div');
        el.className = 'marker';
        el.style.backgroundImage = 'url(' + 'svg/pinmap.svg' + ')';
        el.style.width = marker.properties.iconSize[0] + 'px';
        el.style.height = marker.properties.iconSize[1] + 'px';
        el.style.marginTop = -(marker.properties.iconSize[1]/3) + 'px';

        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
    });

});
