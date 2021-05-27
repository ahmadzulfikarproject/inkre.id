jQuery(document).ready(function ($) {
	$("#promo").modal('show');
	"use strict";
	var delay = 0;
	$('[data-aos]').each(function () {
		if ($(this).is(":visible")) {
			delay = delay + 50;
			$(this).attr('data-aos-delay', delay);
		}
		//if ($(this).visible(true, true)) {
		//delay = delay + 50;
		//$(this).attr('data-aos-delay', delay);
		//}
	});
	AOS.init({
		duration: 200,
		easing: 'slide',
		once: true,
		mirror: true, // whether elements should animate out while scrolling past them
	});
	// Loading page
	var loaderPage = function () {
		$(".site-loader").fadeOut("slow");
	};
	loaderPage();

	var siteMenuClone = function () {

		$('.js-clone-nav').each(function () {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function () {

			var counter = 0;
			$('.site-mobile-menu .has-children').each(function () {
				var $this = $(this);

				$this.prepend('<span class="arrow-collapse collapsed">');

				$this.find('.arrow-collapse').attr({
					'data-toggle': 'collapse',
					'data-target': '#collapseItem' + counter,
				});

				$this.find('> ul').attr({
					'class': 'collapse',
					'id': 'collapseItem' + counter,
				});

				counter++;

			});

		}, 1000);

		$('body').on('click', '.arrow-collapse', function (e) {
			var $this = $(this);
			if ($this.closest('li').find('.collapse').hasClass('show')) {
				$this.removeClass('active');
			} else {
				$this.addClass('active');
			}
			e.preventDefault();

		});

		$(window).resize(function () {
			var $this = $(this),
				w = $this.width();

			if (w > 768) {
				if ($('body').hasClass('offcanvas-menu')) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function (e) {
			var $this = $(this);
			e.preventDefault();

			if ($('body').hasClass('offcanvas-menu')) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		})

		// click outisde offcanvas
		$(document).mouseup(function (e) {
			var container = $(".site-mobile-menu");
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				if ($('body').hasClass('offcanvas-menu')) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		});
	};
	siteMenuClone();


	var sitePlusMinus = function () {
		$('.js-btn-minus').on('click', function (e) {
			e.preventDefault();
			if ($(this).closest('.input-group').find('.form-control').val() != 0) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(0));
			}
		});
		$('.js-btn-plus').on('click', function (e) {
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	// sitePlusMinus();


	var siteSliderRange = function () {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500,
			values: [75, 300],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
			" - $" + $("#slider-range").slider("values", 1));
	};
	// siteSliderRange();


	var siteMagnificPopup = function () {
		$('.image-popup').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 300 // don't foget to change the duration also in CSS
			}
		});

		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,

			fixedContentPos: false
		});
	};
	siteMagnificPopup();


	var siteCarousel = function () {
		if ($('.nonloop-block-13').length > 0) {
			$('.nonloop-block-13').owlCarousel({
				center: false,
				items: 1,
				loop: true,
				stagePadding: 0,
				margin: 0,
				autoplay: false,
				nav: true,
				navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
				responsive: {
					600: {
						margin: 0,
						nav: true,
						items: 2
					},
					1000: {
						margin: 0,
						stagePadding: 0,
						nav: true,
						items: 3
					},
					1200: {
						margin: 0,
						stagePadding: 0,
						nav: true,
						items: 4
					}
				}
			});
		}
		$('.properties-slider').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
		$('.blog-slider').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 2
				}
			}
		});
		$('.services-slider').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left text-light">', '<span class="icon-keyboard_arrow_right text-light">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
		$('.services-slider-2').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: false,
			navText: ['<span class="icon-keyboard_arrow_left text-light">', '<span class="icon-keyboard_arrow_right text-light">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
		$('.services-slider-3').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left text-light">', '<span class="icon-keyboard_arrow_right text-light">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
		$('.projects-slider').owlCarousel({
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
		$('.logo-slider').owlCarousel({
			animateOut: 'slideOutDown',
			animateIn: 'flipInX',
			autoplay: true,
			loop: true,
			items: 4,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: false,
			autoWidth: true,
			//autoWidth:true,
			// autoHeight:true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 6
				}
			}
		});
		$('.products-slider').owlCarousel({
			animateOut: 'slideOutDown',
			animateIn: 'flipInX',
			autoplay: false,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 4
				}
			}
		});
		$('.related-slider').owlCarousel({
			animateOut: 'slideOutDown',
			animateIn: 'flipInX',
			autoplay: false,
			loop: false,
			items: 1,
			// center: true,
			margin: 30,
			merge: true,
			stagePadding: 0,
			nav: true,
			dots: true,
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 4,
					mergeFit: false
				}
			}
		});
		$('.slide-one-item').owlCarousel({
			center: false,
			items: 1,
			loop: true,
			stagePadding: 0,
			margin: 0,
			autoplay: true,
			autoplayTimeout: 6000,
			pauseOnHover: true,
			nav: true,
			dots: false,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">']
		});
		$('.slide-page-detail').owlCarousel({
			center: false,
			items: 1,
			loop: false,
			stagePadding: 0,
			margin: 0,
			autoplay: true,
			pauseOnHover: true,
			nav: false,
			dots: true,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">']
		});
	};
	siteCarousel();

	var siteStellar = function () {
		$(window).stellar({
			responsive: false,
			parallaxBackgrounds: true,
			parallaxElements: true,
			horizontalScrolling: false,
			hideDistantElements: false,
			scrollProperty: 'scroll'
		});
	};
	siteStellar();

	var siteCountDown = function () {

		$('#date-countdown').countdown('2020/10/10', function (event) {
			var $this = $(this).html(event.strftime('' +
				'<span class="countdown-block"><span class="label">%w</span> weeks </span>' +
				'<span class="countdown-block"><span class="label">%d</span> days </span>' +
				'<span class="countdown-block"><span class="label">%H</span> hr </span>' +
				'<span class="countdown-block"><span class="label">%M</span> min </span>' +
				'<span class="countdown-block"><span class="label">%S</span> sec</span>'));
		});

	};
	siteCountDown();

	var siteDatePicker = function () {

		if ($('.datepicker').length > 0) {
			$('.datepicker').datepicker();
		}

	};
	siteDatePicker();
	// scroll
	var scrollWindow = function () {
		$(window).scroll(function () {
			var $w = $(this),
				st = $w.scrollTop(),
				navbar = $('.site-navbar'),
				sd = $('.js-scroll-wrap');

			if (st > 150) {
				if (!navbar.hasClass('scrolled')) {
					navbar.addClass('scrolled');
				}
			}
			if (st < 150) {
				if (navbar.hasClass('scrolled')) {
					navbar.removeClass('scrolled sleep');
				}
			}
			if (st > 350) {
				if (!navbar.hasClass('awake')) {
					navbar.addClass('awake');
				}

				if (sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if (st < 350) {
				if (navbar.hasClass('awake')) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if (sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();
	$(".filter-button").click(function () {
		var value = $(this).attr('data-filter');

		if (value == "all") {
			//$('.filter').removeClass('hidden');
			$('.filter').show('1000');
		} else {
			//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
			//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
			$(".filter").not('.' + value).hide('3000');
			$('.filter').filter('.' + value).show('3000');

		}
	});

	if ($(".filter-button").removeClass("active")) {
		$(this).removeClass("active");
	}
	$(this).addClass("active");

});