/*
Template Name: Swiggiweb - Online Food Ordering Website Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/
(function($) {
    "use strict"; // Start of use strict

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();


    $('.offer-slider').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        slidesToShow: 4,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            }
        ]
    });


    $('.cat-slider').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        slidesToShow: 8,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 4
                }
            }
        ]
    });

    // Trending slider

    $('.trending-slider').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        slidesToShow: 3,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });


    // Most popular slider

    $('.popular-slider').slick({
        centerMode: true,
        centerPadding: '30px',
        slidesToShow: 1,
        arrows: false,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    // Osahan Slider
    $('.osahan-slider').slick({
        centerMode: false,
        slidesToShow: 1,
        arrows: false,
        dots: true
    });

    // osahan-slider-map
    $('.osahan-slider-map').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        autoplay: true,
        slidesToShow: 5,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    autoplay: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    autoplay: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            }
        ]
    });


    var $main_nav = $('#main-nav');
    var $toggle = $('.toggle');

    var defaultOptions = {
        disableAt: false,
        customToggle: $toggle,
        levelSpacing: 40,
        navTitle: 'Askbootstrap',
        levelTitles: true,
        levelTitleAsBack: true,
        pushContent: '#container',
        insertClose: 2
    };

    // call our plugin
    var Nav = $main_nav.hcOffcanvasNav(defaultOptions);

})(jQuery); // End of use strict
//javascript cho các trang dao diện ng dùng
function changeImage(a) {
    console.log(document.getElementById("imgClick").src = a);
    document.getElementById("imgClick").src = a;
}

function clickComment() {
    var click = document.getElementById("clickComment");
    var comment = document.getElementById("comment");
    var content = document.getElementById("content");
    content.style.display = 'none';
    comment.style.display = 'block';
}
function clickContent() {
    var click = document.getElementById("clickContent");
    var comment = document.getElementById("comment");
    var content = document.getElementById("content");
    content.classList.remove('d-none');
    content.style.display = 'block';
    comment.style.display = 'none';
}

function cong() {
    var val = document.getElementById("quantity").value;
    document.getElementById("quantity").value = parseInt(val) + 1;
}

function tru() {
    var val = document.getElementById("quantity").value;
    if (parseInt(val) > 1) {
        document.getElementById("quantity").value = parseInt(val) - 1;
    }
}

window.addEventListener('scroll', function(ev) {
 
    var someDiv = document.getElementById('headerScroll');
    var distanceToTop = someDiv.getBoundingClientRect().top;
    function scrollFunction() {
           // do your stuff here;
           document.getElementById('nav-bottom').classList.remove('d-none');
           if (distanceToTop == 0 || distanceToTop > -80) {
           document.getElementById('nav-bottom').classList.add('d-none');
           }
       }
       window.onscroll = scrollFunction;
   //  console.log(distanceToTop);
   });