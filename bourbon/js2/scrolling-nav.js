"use strict";

var $navbarHeight = undefined;
$(function( $ ) {
    if ($navbarHeight===undefined) {
        $navbarHeight = $('.navbar-expand-lg').outerHeight();
    }
});

//jQuery to collapse the navbar on scroll
$(window).on('scroll', function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').on('click', function(event) {
        var $anchor = $(this);

        var offset = $($anchor.attr('href')).offset();
        if (offset!==undefined) {
            $('html, body').stop().animate({
                scrollTop: offset.top - $navbarHeight
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        }
    });
});
