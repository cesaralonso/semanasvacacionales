$(document).ready(function() {
    var pathname = window.location.pathname;
    var properties = {};
    if (pathname == '/') {
        properties = {
            margin:10,
            loop:true,
            autoHeight:true,
            dots: true,
            autoplay:true,
            autoplayTimeout:4000,
            navText: ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:3
                }
            }
        }; 
    } else if(pathname.indexOf('promociones')) {
        properties = {
            margin:10,
            loop:true,
            autoHeight:true,
            dots: true,
            autoplay:true,
            autoplayTimeout:4000,
            navText: ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
        }
        }; 
    }else {
        properties = {
            margin:10,
            nav:true,
            navText: [$('.am-prev'), $('.am-next')],
            autoHeight:true,
            dots: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        }; 
    }
    $('.owl-carousel').owlCarousel(properties);
});