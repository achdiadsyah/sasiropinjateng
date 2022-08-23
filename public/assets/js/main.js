$(document).ready(function () {

    "use strict";

    $('#modalPoster').modal('show');

    $(window).load(function () {
        $('.page-preloader spinner').fadeOut();
        $('.page-preloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({
            'overflow': 'visible'
        });
    })

    $(".animated-text").typed({
        strings: [
            "Happy Anniversary Ruhul Islam Anak Bangsa ",
            "25Th with Ruhul Islam Anak Bangsa"
        ],
        typeSpeed: 40,
        loop: true,
    });
});