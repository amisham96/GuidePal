(function ($) {
    "use strict";
    $(window).on('load', function () {
        $('.preloader').fadeOut(1000);
    });

    // lightcase 
    $('a[data-rel^=lightcase]').lightcase();

    $(document).ready(function () {

        /*==== header Section Start here =====*/
        $("ul>li>ul").parent("li").addClass("menu-item-has-children");
        // drop down menu width overflow problem fix
        $('ul').parent('li').on('hover', function () {
            var menu = $(this).find("ul");
            var menupos = $(menu).offset();
            if (menupos.left + menu.width() > $(window).width()) {
                var newpos = -$(menu).width();
                menu.css({
                    left: newpos
                });
            }
        });
        $('.mainmenu ul li a').on('click', function (e) {
            var element = $(this).parent('li');
            if (parseInt($(window).width()) < 992) {
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp(300, "swing");
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown(300, "swing");
                    element.siblings('li').children('ul').slideUp(300, "swing");
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp(300, "swing");
                }
            }
        })
        //Header
        /*var fixed_top = $("header");
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200) {
                fixed_top.addClass("header-fixed animated fadeInDown");
            } else {
                fixed_top.removeClass("header-fixed animated fadeInDown");
            }
        });
        */

        // scroll up start here
      /*  $(function () {
            $(window).on('scroll', function () {
                if ($(this).scrollTop() > 300) {
                    $('.scrollToTop').css({
                        'bottom': '2%',
                        'opacity': '1',
                        'transition': 'all .5s ease'
                    });
                } else {
                    $('.scrollToTop').css({
                        'bottom': '-30%',
                        'opacity': '0',
                        'transition': 'all .5s ease'
                    })
                }
            });

            //Click event to scroll to top
            $('a.scrollToTop').on('click', function () {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                return false;
            });
        });
        */

        // button effict
        // document.querySelectorAll('.default-btn').forEach(button => button.innerHTML = '<div><span>' + button.textContent.trim().split('').join('</span><span>')  +  '</span></div>');



        //Member Filter Isotop
        // init Isotope
        var $grid = $('.member__grid').isotope({
            itemSelector: '.member__item',
            layoutMode: 'fitRows',
        });

        // filter functions
        var filterFns = {
            // show if name ends with -ium
            ium: function () {
                var name = $(this).find('.name').text();
                return name.match(/ium$/);
            }
        };
        // bind filter button click
        $('.member__buttongroup').on('click', '.filter-btn', function () {
            var filterValue = $(this).attr('data-filter');
            // use filterFn if matches value
            filterValue = filterFns[filterValue] || filterValue;
            $grid.isotope({
                filter: filterValue
            });
        });
        // change is-checked class on buttons
        $('.member__buttongroup').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', '.filter-btn', function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });


        

    });
    
    //Banner slider
    var swiper = new Swiper('.banner__slider', {
        slidesPerView: 1,
        spaceBetween: 0,
        // autoplay: {
        //     delay: 10000,
        //     disableOnInteraction: false,
        // },
        loop: true,
    });

    //====ragi slider================
    var swiper = new Swiper(".ragi__slider", {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".ragi-next",
            prevEl: ".ragi-prev",
        },
        breakpoints: {
            767: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1439: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },
    });
    
    
    //====details slider================
    var swiper = new Swiper(".details__slider", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
       /* autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },*/
        navigation: {
            nextEl: ".details-next",
            prevEl: ".details-prev",
        },
       /* breakpoints: {
            767: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1439: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },*/
    });
	
	
	//====blog slider================
    var swiper = new Swiper(".blog__slider", {
        spaceBetween: 20,
        loop: true,
       /* autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },*/
        navigation: {
            nextEl: ".ragi-next",
            prevEl: ".ragi-prev",
        },
        breakpoints: {
            767: {
                slidesPerView: 1,
            },
            1199: {
                slidesPerView: 3,
            },
            1439: {
                slidesPerView: 5,
            },
        },
    });

    
    //countdown 
    $(window).on('scroll', function () {
        $('.counter').data('countToOptions', {
            formatter: function (value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });
        // start all the timers
        $('.counter').each(count);  
        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });


    // post thumb slider
    /*var swiper = new Swiper('.blog__slider', {
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.thumb-next',
            prevEl: '.thumb-prev',
        },
        loop: true,
    });
*/

    // product view mode change js
    $(function() {
        $('.product-view-mode').on('click', 'a', function (e) {
            e.preventDefault();
            var shopProductWrap = $('.shop-product-wrap');
            var viewMode = $(this).data('target');
            $('.product-view-mode a').removeClass('active');
            $(this).addClass('active');
            shopProductWrap.removeClass('grid list').addClass(viewMode);
        });
    });

    // model option start here
    $(function() {
        $('.view-modal').on('click', function () {
            $('.modal').addClass('show');
        });
        $('.close').on('click', function () {
            $('.modal').removeClass('show');
        });
    });

    // shop cart + - start here
    var CartPlusMinus = $('.cart-plus-minus');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    // shop sidebar menu
    $(".shop-menu>li>ul").parent("li").addClass("catmenu-item-has-children");
    $('.shop-menu li a').on('click', function (e) {
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp(300, "swing");
        } else {
            element.addClass('open');
            element.children('ul').slideDown(300, "swing");
            element.siblings('li').children('ul').slideUp(300, "swing");
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp(300, "swing");
        }
    })

    // product single thumb slider
    $(function() {
        var galleryThumbs = new Swiper('.pro-single-thumbs', {
            spaceBetween: 10,
            slidesPerView: 3,
            loop: true,
            freeMode: true,
            loopedSlides: 1,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.pro-single-next',
                prevEl: '.pro-single-prev',
            },
        });
        var galleryTop = new Swiper('.pro-single-top', {
            spaceBetween: 10,
            loop:true,
            loopedSlides: 1,
            thumbs: {
                swiper: galleryThumbs,
            },
        });
    });


    //Review Tabs
    $('ul.review-nav').on('click', 'li', function (e) {
        e.preventDefault();
        var reviewContent = $('.review-content');
        var viewRev = $(this).data('target');
        $('ul.review-nav li').removeClass('active');
        $(this).addClass('active');
        reviewContent.removeClass('review-content-show description-show').addClass(viewRev);
    });


    // countdown or date & time
    $('#countdown').countdown({
        date: '10/22/2022 17:00:00',
        offset: +2,
        day: 'Day',
        days: 'Days'
    });


    new WOW().init();
    


    //contact form js
    $(function () {
        var form = $('#contact-form');
        var formMessages = $('.form-message');
        $(form).submit(function (e) {
            e.preventDefault();
            var formData = $(form).serialize();
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData
            })
            .done(function (response) {
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');
                $(formMessages).text(response);
                $('#contact-form input, #contact-form textarea').val('');
            })
            .fail(function (data) {
                $(formMessages).removeClass('success');
                $(formMessages).addClass('error');
                if (data.responseText !== '') {
                    $(formMessages).text(data.responseText);
                } else {
                    $(formMessages).text('Oops! An error occured and your message could not be sent.');
                }
            });
        });
    });

}(jQuery));

function x_dropzone() {
    var dropzones = document.querySelectorAll(".x-dropzone:not(.x-dropzone-init)").forEach(function (dropzone) {
        dropzone.classList.add("x-dropzone-init");

        var previews = dropzone.querySelector('[xrole="previews"]');

        if (dropzone.querySelector('[xrole="input"]').hasAttribute("multiple")) {
            previews.classList.add("x-dropzone-multiple");
        } else {
            previews.classList.add("x-dropzone-single");
        }

        dropzone.querySelector('[xrole="input"]').addEventListener("change", function () {
            clear(dropzone);
            preview(dropzone, this.files);
        });

        dropzone.querySelector('[xrole="clear"]').addEventListener("click", function () {
            clear(dropzone, true);
        });

        previews.addEventListener("dragover", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "1px solid cornflowerblue";
            evt.preventDefault();
        });

        previews.addEventListener("dragenter", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "1px solid cornflowerblue";
            evt.preventDefault();
        });

        previews.addEventListener("dragleave", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "none";
            evt.preventDefault();
        });

        previews.addEventListener("drop", function (evt) {
            clear(dropzone);
            preview(dropzone, evt.dataTransfer.files);
            dropzone.querySelector('[xrole="input"]').files = evt.dataTransfer.files;
            dropzone.querySelector('[xrole="previews"]').style.border = "none";
            evt.preventDefault();
        });
    });

    function clear(dropzone1, input = false) {
        if (input === true) {
            dropzone1.querySelector('[xrole="input"]').value = "";
        }

        dropzone1.querySelector('[xrole="previews"]').innerHTML = '<div xrole="placeholder">Select or Drop Files Here</div>';
    }

    function preview(dropzone1, files) {
        var dropzone1_previews = dropzone1.querySelector('[xrole="previews"]');

        var html = "";
        for (var file of files) {
            var name = file.name.replace(/[\""]/g, '\\"');

            if (file.type.startsWith("image/")) {
                html += '<div><img src="' + URL.createObjectURL(file) + '" title="' + name + '"></div>';
            } else if (file.type.startsWith("video/")) {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGAyJZDHaAAAADGElEQVR42u2cu2sUQRzHP3u55DSeRk2lMRejaCMhCIKgpvABxlepla1YiaKFj06DqAn4HwiClWAjKYJiwBcWCoJiZUQRIYZoUMjFoJicxcxCOPfB3u5MZof5wpA7du6397mdnfk9ZuMRrBXAYWA/sB5Yhj7NAl+AR8B9YCpL40XgnDRaM6BNAwPAkizgVgIPDAGrby+BjjRwzcCooXB++wx0Nwp41XA4v30EupLCdQC/cgLYEOTFHMElHq4e8AzYFXL8G3AJeAPMK1oW9gHXG/jcJ2C3hI3UeMQvdVDDundU9XD9G2GgZDhgLGQBaIo4+W/MVzfwNOyeLGCHKsDjIEhbAEMhbQL0IUeBTlsB/Xty2I+AbAQE6AUGbQYEOAFstBmwGThuAmBNoe1+EwB/qJxwvJhf0NMAWAa+yr9Za96EK1gFriiyXSDGkdUlD7gM/Mk6djRhiC5UJ3AAWAe0JEiWnYybxRb7CqbRhigGm9dBa31RB+gAHaADdIAO0AE6QEtUTPHZLun5t6Ww8QEYQdQnlSkqmvBCQqiBDGO3cUQZTEk00QjgebIvaM4AW2JGWkUHYFmmGFRUbe+GAOwE3ss+z4GlKgH3oq4s/b3uXC3ANf6vXx5KAph0klmlcC5oX/C6B7iDSMHXqzXLZaKmOUfjAaeBVyFwmS8TcUmprPUE6NO50OtOPPVlbdC5ag7QATpAB+gAUwDqri7N6AbUvdD3ILZ3WjtE/T2gF2RArX2IziqE823PATeA7cC7gH6JN+YmiQcr8gQq4sEXAd+tBAxJ6BrwMyCyzzxlcU8R4LGIi7BNhlGbdeRk2oHXGcMNqko6NZI2nAJ2IPaCHQFWp8jmjQG3EFsglcltQnCumgNcXMC5iOOlHDBEOR9zBWAyosOeHABujTg2UURUeNaEdLgt/cK3hsL1IrLfYRoDNcUUU9pZD1grSVstm1+qwKYCoj5308IJdAiY8N8UEY912zI0HxJQlmhDlJPzDjeM+D8AgWoCziBqdXkDmwRO1TsvYUml5YinP/sRzwKVDb3PpmWaY0S2an2Hf3i3d51ioT59AAAAAElFTkSuQmCC" title="' +
                    name +
                    '"></div>';
            } else if (file.type.startsWith("audio/")) {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGAiHZHhZ7AAADbklEQVR42u2bTUgVURSAvxnnqZk/tSgos9S0Fi2kRYuiwKJIpaJFLYpahEREBZHQH20qoigI2rWKoF0UFGaWJIVBRLWpTYvKiMDEDEkl+1NbzDwYppk772dm3p3LHLg8Zu6ZM++buX/nnDsa7lIJbAI2ArXATKKTCeAz8Ai4C3wL0rgBdFhGpyUoY8BZoDQIuFnAQ0nAnOUFUJ0PXArolRQuXT4BdbkCnpMcLl36gUXZwlUDP2ICmBPkiRjBZd1cNeApsNqj/itwEngNTIU0LawHLuRw3UdgrQUrlAHBk2qLYN7bHnZz/SswUCI5oC+kDhQJbv4L+aUO6PPqkzpqyELgiRukKoCekCoBpiF7gRpVAdN9sjPtAakICNAEXFQZEGAvsFhlwBSwSwbA6RBtt8gAOBLmgKP5PEEtAsBy4Iv1G7RMyfAGx4EzIdnW8VnIRiUacBr4HbTvKEMTtUsN0AosAIqzCJbt8xvFCv0G85F6EYPK86Cya9EEMAFMABPABDABTAATwAQwK2kDDgBVAp3ZwEGgnYBy8pl4E0G4S0dt9p556FQA7216r6xzeXsTYQMedtjzyjFuc7n3DdkB91tAmfiYzR733yorYLsHnMiJvu2iOwCUyQa4G5jMIUpQiZmOdup35APoF5PRXep3AJsxd0U5xQC2IE6qih5aK3Dfca4faBD8z3rgQ1CjaJOg6WVa/KTP5Zo1UcVklhB+pO2qy7kNKq1k7ll92C6rVAIcBd46ztWFBVio2OiA43hOWIBagQCd21dSqnkTcx3HwyoBGsAynyYba8CV/J8rfB4V4GgEgHs8Jv9I/EEDuAX8CWklU2sNMHb9EWCGLIttA7iZI6AGPHDRvyKbN5EC7uQAeMhFdwL/3fYF8QeLga4sABtdmuY0cEpmj74U6MkQcKeL3ksPl0yqmEwZ8Nhmb9BDrwH4adP7DiyNQ9AJa067ZoE2C/RaMLdCdgErsrCfF2AcJNmEkADGHXBSUF8SA4YJQd2kDgwJFNbFAHC5oG7QwEx6zPNQuA4cB95ICtcEnBfUvwM4Rvy+Psu0HNGA+RZpmWLjyzjQqFvhgMsKDqCX7EtDA/OzblWaZo/bQr0K6FYArhMzU+UqRZhZ2eEYgg1ZTrPuDBO4SQXmxoEWzLB5uaT9bAzzU9duq4w7Ff4BHrC7OCMpnS8AAAAASUVORK5CYII=" title="' +
                    name +
                    '"></div>';
            } else {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGBAWzR1UsAAACBklEQVR42u3cO2sUQRwA8N9dzggaH534Ai2s/Q4qBB+dRNDCwsZSRPHRCj4KSeUXsFCxN0QxfgntjKCVEh+kiYKacBa7B3Lc7Z3ebrI3/P8wXDHDLL+duZldmP829I7tOIVpHMBW1ccy3uIZFvC7iou0cAXf0N7AsojTZeN24sUGw7rLLCbKwG3Cq5rhOuVpPrNGits1xXXKo1FGci9+1Bw4EvLmGOD+e7q2cKKgfgk38KbC7eEY7g3Z9gxWcR5rw17gY8Edm16H/W+m6um6WtDRZE2BbTweBtkc0OiX+sZZPBn0n2wa75jJR7KVKnAgMgVgITIVYF9kSsCeyNSAHeSDlIFwERfqAmxX1O8dTNUBuFxRv7twrjHgDjbWATiFT/lv2TFnwPPeesW1il6vPtQF2MCt/Nm3TODPOkzRv2M/jmPfP77JXC8C1AlY+kqc6j4YwAAGMIABDGAAAxjAAAYwgAEMYAADGMAABjCAAQxgAAMYwAAGMIABDGAAAxjAAHYDizJIJsfAsLmgbq2JzwUNjowB8GhB3VIL77C7T4OHstyl1zXFHcbdgvpFsoNs7UTL1Qb25NItia0v33GoKcs+m01wAb0vO0mMLM9gIaGp+VKPLJgdmE8ANyf7DkDPmMBlfB1D2Bdc0pUu2O9E7zaclGWAHlTNifgyYgXv8TwfuZXuBn8ALNRFvWhp3xkAAAAASUVORK5CYII=" title="' +
                    name +
                    '"></div>';
            }
        }

        dropzone1_previews.innerHTML = html;
    }
}

