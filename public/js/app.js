Vue.component('star-ranking', {
    template:   '<p>' +
					'<i class="fa" v-for="rating in ratings" @click="set(rating)" @mouseover="hover(rating)" @mouseout="out"' +
					' :class="{ \'fa-star-o\': (value < rating), \'fa-star\': (value >= rating) }"' +
					' :title="rating + \'/5\'" data-toggle="tooltip" data-placement="bottom"></i>' +
					'<input type="hidden" :value="selectedValue" name="ranking">' +
				'</p>',

    data: function() {
        return {
            selectedValue : 0,
            value: 0,
            ratings: [1, 2, 3, 4, 5]
        };
    },

    methods: {
        hover: function(_rating) {
            this.value = _rating;
        },
        out: function() {
            this.value = this.selectedValue;
        },
        set: function(_rating) {
            this.value = _rating;
            this.selectedValue = _rating;
        }
    }
});

new Vue({
    el: '#app',
    data: {},
    methods: { 
        productFilterByValue: function (queryParameter, event) {
            manageFilter(queryParameter, event.target.value);
        },
        productFilterByTitle: function (queryParameter, event) {
            let element = event.target;
            if(element.className !== 'active_filter')
                manageFilter(queryParameter, element.title)
        },
        validateFormElements: function (event) {
            let element = event.target;
            if(element.tagName === 'FORM')
            {
                if(!isFormValidation(element))
                    event.preventDefault();
            }
        },
        validateFormElement: function (event) {
            let element = event.target;
            if(element.tagName !== 'FORM')
            {
                validation(element) ?
                    setValidIndicator(element) :
                    setInvalidIndicator(element);
            }
        },
		addOrRemoveProductFromWishList: function (event) {
        	let element = event.target;

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				method: 'POST',
				url: element.dataset.url,
				data: {
					'product_id': element.dataset.bind
				},
				dataType: "json"
			})
			.done(function(response) {
				let icon;
				let enter = 'lightSpeedIn';
				let exit = 'lightSpeedOut';
				if(response.type === 'success')
				{
					icon = 'fa fa-heart';
                    element.classList.remove('fa-heart-o');
                    element.classList.add('fa-heart');
				}
				else if(response.type === 'info')
				{
					icon = 'fa fa-heart-o';
                    element.classList.remove('fa-heart');
                    element.classList.add('fa-heart-o');
				}
				else if(response.type === 'danger')
				{
					icon = 'fa fa-remove';
                    enter = 'bounceIn';
                    exit = 'bounceOut';
				}
				notification(response.title, response.body, response.type,
					icon, enter, exit, 5000);
			})
			.fail(function(response) {
                notification(element.dataset.errortitle, element.dataset.errormessage,
					'danger', 'fa fa-remove', 'bounceIn', 'bounceOut', 5000);
			});

        }
    }
});

(function ($) {
"use strict";
	$(document).ready(function($){
		/*----- Mobile Menu -----*/
		$('.mobile-menu nav').meanmenu({
			meanScreenWidth: "990",
			meanMenuContainer: ".mobile-menu",
		});
		/*----- main slider -----*/
		$('#mainSlider').nivoSlider({
			directionNav: false,
			animSpeed: 500,
			slices: 18,
			pauseTime: 5000,
			pauseOnHover: false,
			controlNav: true,
			prevText: '<i class="fa fa-angle-left nivo-prev-icon"></i>',
			nextText: '<i class="fa fa-angle-right nivo-next-icon"></i>'
		});

		/*Owl Carousel for Weekly Featured Products*/
		$(".feature-pro-slider, .related-pro-slider").owlCarousel({
			loop: true,
			nav: true,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:1,},
				480:{items:2,},
				750:{items:3,},
				950:{items:4,},
				1170:{items:4,},
			}
		});
		/*Owl Carousel for Weekly Featured Products*/
		$(".tab-pro-slider").owlCarousel({
			loop: true,
			nav: true,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:1,},
				480:{items:2,},
				750:{items:3,},
				950:{items:4,},
				1170:{items:4,},
			}
		});
		/*Owl Carousel for Weekly Featured Products*/
		$(".tab-pro-slider-2").owlCarousel({
			loop: true,
			nav: true,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:1,},
				480:{items:2,},
				750:{items:3,},
			}
		});
		$(".trendy-product-slider").owlCarousel({
			loop: true,
			nav: false,
			margin: 20,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:2,},
				480:{items:2,},
				750:{items:4,},
				950:{items:2,},
				1170:{items:2,},
			}
		});
		/*Owl Carousel for blog*/
		$(".blog-slider").owlCarousel({
			loop: true,
			nav: true,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:1,},
				750:{items:2,},
				1170:{items:3,},
			}
		});
		$('.funfact').appear(function() {
			$('.timer').countTo({
				speed: 3000
			});
		});
		/*Owl Carousel for Testimonial*/
		$(".testimonial-slider").owlCarousel({
			items:1,
			loop: true,
			nav: true,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		});
		/*Owl Carousel for Brand*/
		$(".brand-slider").owlCarousel({
			loop: true,
			nav: false,
			margin: 30,
			dots: false,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{items:2,},
				750:{items:4,},
				950:{items:5,},
			}
		});
		/*----- Scroll Up -----*/
		$.scrollUp({
			scrollText: '<i class="fa fa-chevron-up"></i>',
			easingType: 'linear',
			scrollSpeed: 900,
			animation: 'fade'
		});
		$('#portfolio').mixItUp();
		/*-- Work PopUp --*/
		$('.port-wrap .hover').magnificPopup({
			type:'image',
			gallery: {
			  enabled: true
			},
			mainClass: 'mfp-with-zoom',
		});
		/*----- Cart Plus Minus Button -----*/
		$(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
		$(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
		$(".qtybutton").on("click", function() {
			var $button = $(this);
			var oldValue = $button.parent().find("input").val();
			if ($button.text() == "+") {
			  var newVal = parseFloat(oldValue) + 1;
			} else {
			   // Don't allow decrementing below zero
			  if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
				} else {
				newVal = 0;
			  }
			  }
			$button.parent().find("input").val(newVal);
		});
		/*----- Check Out Accordion -----*/
		$(".panel-heading a").on("click", function(){
			$(".panel-heading a").removeClass("active");
			$(this).addClass("active");
		});
		/*----- Simple Lens -----*/
		$('.simpleLens-lens-image').simpleLens({
			loading_image: '../../img/loader.gif'
		});
		$('.newslater-container .close').on("click", function(){
			$('#popup-newslater').addClass('hidden');
		});
	});
})(jQuery);