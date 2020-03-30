(function ($) {
    'use strict';

    var $window = $(window);

    // :: Nav Active Code
    if ($.fn.classyNav) {
        $('#essenceNav').classyNav();
    }

    // :: Sliders Active Code
    if ($.fn.owlCarousel) {
        $('.popular-products-slides').owlCarousel({
            items: 4,
            margin: 30,
            loop: true,
            nav: true,
            dots: false,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            autoplay: true,
            
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });


        $('.product_thumbnail_slides').owlCarousel({
            items: 1,
            margin: 0,
            loop: $('.product_thumbnail_slides').find('.thumb-item').length >= 2 ? true : false,
            nav: true,
            navText: ["<img src='" + themeData.file_uri + "/img/long-arrow-left.svg' alt=''>", "<img src='" + themeData.file_uri + "/img/long-arrow-right.svg' alt=''>"],
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000
        });
    }

    // :: Header Cart Active Code
    var cartbtn1 = $('#essenceCartBtn');
    var cartbtn3 = $('.glissement');
    var cartOverlay = $(".cart-bg-overlay");
    var cartWrapper = $(".right-side-cart-area");
    var cartbtn2 = $("#rightSideCart");
    var cartOverlayOn = "cart-bg-overlay-on";
    var cartOn = "cart-on";

    cartbtn1.on('click', function () {
        cartOverlay.toggleClass(cartOverlayOn);
        cartWrapper.toggleClass(cartOn);
    });

    cartbtn3.on('click', function () {
        cartOverlay.toggleClass(cartOverlayOn);
        cartWrapper.toggleClass(cartOn);
    });

    cartOverlay.on('click', function () {
        $(this).removeClass(cartOverlayOn);
        cartWrapper.removeClass(cartOn);
    });
    cartbtn2.on('click', function () {
        cartOverlay.removeClass(cartOverlayOn);
        cartWrapper.removeClass(cartOn);
    });

    // :: ScrollUp Active Code
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1000,
            easingType: 'easeInOutQuart',
            scrollText: '<i class="fa fa-angle-up" aria-hidden="true"></i>'
        });
    }

    // :: Sticky Active Code
    $window.on('scroll', function () {
        if ($window.scrollTop() > 0) {
            $('.header_area').addClass('sticky');
        } else {
            $('.header_area').removeClass('sticky');
        }
    });

    // :: Nice Select Active Code
    if ($.fn.niceSelect) {
        $('.single_product_details_area select').niceSelect();
    }

    var timer;

    if ($('#max_price').length) {
        

        var val1 = parseInt($('#min_price').val());
        var val2 = parseInt($('#max_price').val());

        $('.range-price').html(`Range: ${val1} CFA  - ${val2} CFA`);

        // :: Slider Range Price Active Code
        $('.slider-range-price').each(function () {
            var min = val1;
            var max = val2;
            var unit = jQuery(this).data('unit');
            var value_min = val1;
            var value_max = val2;
            var label_result = jQuery(this).data('label-result');
            var t = $(this);
            $(this).slider({
                range: true,
                min: min,
                max: max,
                values: [value_min, value_max],
                slide: function (event, ui) {
                    var result = label_result + " " + ui.values[0] + unit + ' - ' + ui.values[1] + unit;
                    console.log(t);
                    t.closest('.slider-range').find('.range-price').html(result);
                    $('.min-input').val(ui.values[0]);
                    $('.max-input').val(ui.values[1]);
                    
                    clearTimeout(timer);
                    
                    timer = setTimeout(function (){
                        submitPrice();
                    },1500);
                }
            });
        });
    }else{
        $('#pricy-slide').css('display','none');
    }
    
    
    function submitPrice(){
        $('#price-submit').click();
    }
    
    // :: Favorite Button Active Code
    var favme = $(".favme");

    favme.on('click', function () {
        $(this).toggleClass('active');
    });

    favme.on('click touchstart', function () {
        $(this).toggleClass('is_animating');
    });

    favme.on('animationend', function () {
        $(this).toggleClass('is_animating');
    });

    // :: Nicescroll Active Code
    if ($.fn.niceScroll) {
        $(".cart-list, .cart-content").niceScroll();
    }

    // :: wow Active Code
    if ($window.width() > 767) {
        new WOW().init();
    }

    // :: Tooltip Active Code
    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // :: PreventDefault a Click
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });

})(jQuery);


(function ($) {
    var slides = $('.similar-products-slides').find('.single-product-item').length;
    var bool;
    if (slides > 4) {
        bool = true;
    } else {
        bool = false;
    }
    if ($.fn.owlCarousel) {
        $('.similar-products-slides').owlCarousel({
            items: 4,
            margin: 30,
            loop: bool,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var methods = document.getElementsByClassName('methodik');
    for (var i = 0; i < methods.length; i++) {
        if (methods[i].checked == true) {
            document.getElementById('bill-method').value = methods[i].value;
        }
    }
    $('.methodik').change(function () {
        var test = document.getElementsByClassName('methodik');
        for (var i = 0; i < test.length; i++) {
            if (test[i].checked == true) {
                document.getElementById('bill-method').value = test[i].value;
            }
        }
    });
    $('#region').change(function () {
        var tot = $('#totales').val();
        var ship = $('#region').val().split('_');
        var result = parseInt(tot) + parseInt(ship[0]);
        $('#shipping').html(numberWithCommas(parseInt(ship[0])) + ' CFA');
        $('#total-price').html(numberWithCommas(result) + ' CFA');
    });
})(jQuery);