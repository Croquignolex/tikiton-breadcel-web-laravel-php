Vue.component('star-ranking', {
    template:
    '<p>' +
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
                manageFilter(queryParameter, element.dataset.title)
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
            let elementDataSet = element.dataset;
            if(element.tagName !== 'FORM' && elementDataSet.validate === 'true')
            {
                validation(element) ?
                    setValidIndicator(element) :
                    setInvalidIndicator(element);
            }
        },
        toggleProductInWishList: function (event) {
            AjaxCartAndWishListProductManage(event);
        },
        toggleProductInCart: function(event) {
            AjaxCartAndWishListProductManage(event);
            refreshProductsCart(event);
        },
        removeProductFromCart: function (event) {
            AjaxCartAndWishListProductManage(event);
            refreshProductsCart(event);
        },
		removeAllProductsFromCart: function (event) {
            removeAllProductsFromCart(event);
            refreshProductsCart(event);
		},
        shouldConnect: function (event) {
            let elementDataSet = event.target.dataset;
            notification(elementDataSet.title, elementDataSet.body, 'info',
                'fa fa-lock', 'flipInX', 'flipOutX', 5000);
        },
        valueInRange: function (event) {
            let element = event.target;
            let elementValue = parseInt(element.value);
            if(elementValue < 1 || isNaN(elementValue)) element.value = '1';
            else if(elementValue > 1000) element.value = '1000';
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

function removeProductFromCartListener(event) {
    AjaxCartAndWishListProductManage(event);
    refreshProductsCart(event);
}

function removeAllProductsFromCart(event) {
    let element = event.target;
    let elementDataSet = element.dataset;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: elementDataSet.url,
        dataType: "json"
    })
	.done(function(response) {
		notification(response.title, response.body, response.type,
			response.icon, response.enter, response.exit, 5000);
	})
	.fail(function() {
		notification(elementDataSet.errortitle, elementDataSet.errormessage, 'danger', 'fa fa-remove',
			'bounceIn', 'bounceOut', 5000); ;
	});
}

function refreshProductsCart(event) {
    let element = event.target;
    let elementDataSet = element.dataset;
    let locale = elementDataSet.locale;
    let elementParent = element.parentNode;

    $.ajax({
        method: 'GET',
        url: '/cart/products',
        dataType: "json"
    })
	.done(function(response) {
		let cart = document.getElementById('cart');
		let products = response.products;
		let RefreshedCart = document.createElement('ul');
		RefreshedCart.setAttribute('class', 'header-cart-pro');
		RefreshedCart.setAttribute('id', 'cart');

		products.forEach(function (product) {
			let productName = ''; let price = ''; let discount = '';
			let imageClass = '';
			if(locale === 'fr') {
				productName = product.fr_name;
				price = 'Prix : ' + amountFormat(product.price);
			}
			else if(locale === 'en') {
				productName = product.en_name;
				price = 'Price : ' + amountFormat(product.price, 'en');
			}
            discount = amountFormat(product.price * (1 - (product.discount/100)), locale);

			if(product.stock === 0) imageClass = 'out-of-stock';

			let domCart = '';
			let li = document.createElement('li');
			let deleteFont = document.createElement('i');

			deleteFont.setAttribute('class', 'fa fa-trash delete');
			deleteFont.setAttribute('data-locale', locale);
			deleteFont.setAttribute('data-bind', product.id);
			if(elementParent.tagName === 'A')
				deleteFont.setAttribute('data-url', elementDataSet.removeurl);
			else deleteFont.setAttribute('data-url', elementDataSet.url);

			deleteFont.setAttribute('data-errortitle', elementDataSet.errortitle);
			deleteFont.setAttribute('data-errormessage', elementDataSet.errormessage);
			deleteFont.addEventListener('click', removeProductFromCartListener);

			domCart +=
				'<div class="image">' +
				'<a href="/products/' + product.slug + '">' +
				'<img alt="..." src="/img/products/' + product.image + '.jpg" class="' + imageClass + '">' +
				'</a>' +
				'</div>' +
				'<div class="content fix">' +
				'<a href="/products/' + product.slug + '">' +
				productName +
				'</a>';

			if(product.discount === 0) {
				domCart += '<span class="new">' + price + '</span>';
			}
			else{
				domCart +=
					'<span class="new">' + discount + '</span>' +
					'<span class="old">' + price + '</span>';
			}

			domCart += '</div>';

			li.innerHTML = domCart;
			li.appendChild(deleteFont);
			RefreshedCart.appendChild(li);
		});

        cart.parentNode.replaceChild(RefreshedCart, cart);
        document.getElementById('products-number').innerText = products.length;
	})
	.fail(function() {
		notification(elementDataSet.errortitle, elementDataSet.errormessage, 'danger',
			'fa fa-remove', 'bounceIn', 'bounceOut', 5000);
	});
}

function AjaxCartAndWishListProductManage(event) {
    let url = '';
    let element = event.target;
    let elementDataSet = element.dataset;
    let elementParent = element.parentNode;

    if(elementParent.tagName === 'A')
    {
        url = elementParent.classList.contains('remove')
            ? elementDataSet.removeurl : elementDataSet.addurl;
    }
    else url = elementDataSet.url;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            'product_id': elementDataSet.bind
        },
        dataType: "json"
    })
	.done(function(response) {
		notification(response.title, response.body, response.type,
			response.icon, response.enter, response.exit, 5000);

		if(elementParent.tagName === 'A')
		{
            elementParent.title = response.popup;
            element.classList.remove(response.oldClass);
            element.classList.add(response.newClass);
            elementParent.classList.remove(response.linkOldClass);
            elementParent.classList.add(response.linkNewClass);
		}
	})
	.fail(function() {
		notification(elementDataSet.errortitle, elementDataSet.errormessage, 'danger', 'fa fa-remove',
			'bounceIn', 'bounceOut', 5000);
	});
}

function amountFormat(price, locale = 'fr') {
    if(locale === 'fr')
    {
        try {
            return price.toFixed(2) + 'C$';
        }
        catch (e) {
            return price + 'C$';
        }
    }
    else if(locale === 'en')
    {
        try {
            return 'C$' + price.toFixed(2);
        }
        catch (e) {
            return 'C$' + price;
        }
    }
}