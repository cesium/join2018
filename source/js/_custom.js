// Eventify, Responsive HTML5 Event Template - Version 1.0 //

// Javascripts //
$(document).ready(function() {
    $('.top-bar nav').addClass('hidden');
    $('.menu-link').on('click', function(
        e) {
        e.preventDefault();
        $('.top-bar nav').toggleClass(
            'hidden');
    });
    $(window).scroll(function() {
        if ($(window).scrollTop() <= 50) {
            $('.top-bar').removeClass('alt')
        } else {
            $('.top-bar').addClass('alt')
        }
    });
    $(window).load(function() {
        if ($(window).scrollTop() <= 30) {
            $('.top-bar').removeClass('alt')
        } else {
            $('.top-bar').addClass('alt')
        }
    });
    $('#mainnav .nav a').click(function(e) {
        e.preventDefault();
        var des = $(this).attr('href');
        if ($('.navbar').hasClass(
                'in')) {
            $('.navbar .btn-navbar').trigger(
                'click');
        }
        goToSectionID(des);
    })
    $('#mainnav li').localScroll({
        duration: 1000
    });
    $('.logo').localScroll({
        duration: 1000
    });
    $('.mapbutton').localScroll({
        duration: 1000
    });
    $('.top-bar').onePageNav({
        currentClass: 'current',
        filter: ':not(.external)'
    });
    var viewHeight = $(window).height();
    $("#intro").css({
        'height': viewHeight
    });
    $(window).on('resize', function() {
        var viewHeight = $(window).height();
        $("#intro").css({
            'height': viewHeight
        });
    });
    $('.flexslider').flexslider({
        animation: "slide"
    });
    $('#schedule-tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    })
    $("[rel=tooltip]").tooltip();
    $("[data-rel=tooltip]").tooltip();
    $('#intro').parallax("50%", 0.1);
    $('#venue').parallax("50%", 0.02);
    $(".speakers-carousel").carousel({
        dispItems: 1,
        direction: "horizontal",
        pagination: false,
        loop: false,
        autoSlide: false,
        autoSlideInterval: 5000,
        delayAutoSlide: 2000,
        effect: "slide",
        animSpeed: "slow"
    });
    $('.toggle-item-title').click(function() {
        $(this).next().slideToggle();
        $(this).toggleClass(
            'ui-state-active');
    });
    $('#countdown').countdown({
        until: '-1m +1d',
        timezone: -4,
        layout: '{d<}<div class="span3"><div class="digit-container">{dn}<span class="label-container">{dl}</span></div></div>{d>}{h<}<div class="span3"><div class="digit-container">{hn}<span class="label-container">{hl}</span></div></div>{h>}{m<}<div class="span3"><div class="digit-container">{mn}<span class="label-container">{ml}</span></div></div>{m>}{s<}<div class="span3"><div class="digit-container">{sn}<span class="label-container">{sl}</span></div></div>{s>}',
        timeSeparator: '',
        isRTL: false,
        format: 'dHMS',
        alwaysExpire: true,
        onExpiry: liftOff
    });

    function liftOff() {
        $('.hasCountdown').css({
            display: 'none'
        });
        $('#countdown').addClass('hidden');
        $('#register-button').addClass('hidden');
        $('.register-title').addClass('hidden');
        $('.register-box').append('<h2>We are at capacity and can no longer accept registrations.</h2>');
        $('.register-box').append('<button class="btn btn-large btn-primary disabled" disabled="true" id="register-button">Sold Out</button>');
    }
    // $('.tweet').twittie({
    //     dateFormat: '%B %d, %Y',
    //     template: '<div class="date">{{date}}</div> {{tweet}}',
    //     count: 3,
    //     hideReplies: true
    // });
    // setInterval(function() {
    //     var item = $('.tweet ul').find('li:first');
    //     item.animate({
    //         'opacity': '0'
    //     }, 1000, function() {
    //         $(this).detach().appendTo('.tweet ul').removeAttr('style');
    //     });
    // }, 12000);
    $('#map_canvas').gmap({
        'center': new google.maps.LatLng(41.560337, -8.3969115),
        'zoom': 17,
        'mapTypeControl': false,
        'navigationControl': false,
        'streetViewControl': false,
        'scrollwheel': false,
        'styles': [{
            stylers: [{
                gamma: 0.60
            }, {
                hue: "#5DBEB2"
            }, {
                invert_lightness: false
            }, {
                lightness: 2
            }, {
                saturation: -20
            }, {
                visibility: "on"
            }]
        }]
    });
    var image = {
        url: 'images/marker.png',
        size: new google.maps.Size(51, 63),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(26, 63)
    };
    $('#map_canvas').gmap().bind('init', function() {
        $('#map_canvas').gmap('addMarker', {
            'id': 'marker-1',
            'position': '41.5596907,-8.3976961',
            'bounds': false,
            'icon': image
        }).click(function() {
            $('#map_canvas').gmap('openInfoWindow', {
                'content': '<h4>JOIN 2016</h4><p><strong>Complexo Pedagógico 2</strong><br>Anfiteatro B1</p>'
            }, this);
        });
    });
    // end
})
