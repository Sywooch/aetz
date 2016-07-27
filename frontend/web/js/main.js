$(document).ready(function(){
    $('.single-item').slick({
        speed: 500,
        autoplay: true,
        autoplaySpeed: 2200,
        fade: true,
        slidesToShow: 1,
        cssEase: 'linear'
    });
    $('.second-item').slick({
        speed: 500,
        autoplay: true,
        autoplaySpeed: 1800,
        slidesToShow: 1,
        cssEase: 'linear'
    });
    $('.carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true
    });
});
