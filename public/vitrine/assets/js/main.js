(function ($) {
	"use strict";

	/*-----  Preloader
	---------------------------------*/
	$(window).on('load', function () {
		$('#preloader').delay(350).fadeOut('slow')
		$('body').delay(350).css({'overflow':'visible'});
	});
	/*-----  Counter
	---------------------------------*/
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});

	/*-----  Toolbar Button
	----------------------------------------*/
	var $overlay = $('.global-overlay');
	$('.toolbar-btn').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);
		var target = $this.attr('href');
		var prevTarget = $this.parent().siblings().children('.toolbar-btn').attr('href');
		$(target).toggleClass('open');
		$(prevTarget).removeClass('open');
		$($overlay).addClass('overlay-open');
	});

	/*-----   Click on Documnet
	----------------------------------------*/
	var $body = $('.global-overlay');

	$body.on('click', function (e) {
		var $target = e.target;
		var dom = $('body').children();

		if (!$($target).is('.toolbar-btn') && !$($target).parents().is('.open')) {
			dom.removeClass('open');
			dom.find('.open').removeClass('open');
			$overlay.removeClass('overlay-open');
		}
	});
	
	/*------  Close Button Actions
	----------------------------------------*/
	$('.btn-close, .btn-close-2').on('click', function (e) {
		var dom = $('body').children();
		e.preventDefault();
		var $this = $(this);
		$this.parents('.open').removeClass('open');
		dom.find('.global-overlay').removeClass('overlay-open');
	});
	/*-----  Off-canvas
	----------------------------------------*/
	/*Variables*/
	var $offcanvasNav = $('.offcanvas-menu, .offcanvas-minicart_menu, .offcanvas-search_menu, .mobile-menu'),
		$offcanvasNavWrap = $(
			'.offcanvas-menu_wrapper, .offcanvas-minicart_wrapper, .offcanvas-search_wrapper, .mobile-menu_wrapper'
		),
		$offcanvasNavSubMenu = $offcanvasNav.find('.sub-menu'),
		$menuToggle = $('.menu-btn'),
		$menuClose = $('.btn-close');

	/*Close Off Canvas Sub Menu*/
	$offcanvasNavSubMenu.slideUp();

	/*Category Sub Menu Toggle*/
	$offcanvasNav.on('click', 'li a, li .menu-expand', function (e) {
		var $this = $(this);
		if (
			$this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
			($this.attr('href') === '#' || $this.attr('href') === '' || $this.hasClass('menu-expand'))
		) {
			e.preventDefault();
			if ($this.siblings('ul:visible').length) {
				$this.siblings('ul').slideUp('slow');
			} else {
				$this.closest('li').siblings('li').find('ul:visible').slideUp('slow');
				$this.closest('li').siblings('li').removeClass('menu-open');
				$this.siblings('ul').slideDown('slow');
				$this.parent().siblings().children('ul').slideUp();
			}
		}
		if ($this.is('a') || $this.is('span') || $this.attr('class').match(/\b(menu-expand)\b/)) {
			$this.parent().toggleClass('menu-open');
		} else if ($this.is('li') && $this.attr('class').match(/\b('menu-item-has-children')\b/)) {
			$this.toggleClass('menu-open');
		}
	});
	$('.btn-close').on('click', function (e) {
		e.preventDefault();
		$('.mobile-menu .sub-menu').slideUp();
		$('.mobile-menu .menu-item-has-children').removeClass('menu-open');
	});

	/*----------------------------------------*/
		/*  Offcanvas Inner Nav
	/*----------------------------------------*/
	$('.offcanvas-inner_nav li.has-sub > a, .frequently-item li.has-sub a, .pd-tab_item li.has-sub a').on('click', function () {
		$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp();
		} else {
			element.addClass('open');
			element.children('ul').slideDown();
			element.siblings('li').children('ul').slideUp();
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp();
		}
	});
	/*------- Sticky Menu Activation
	---------------------------------*/
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 300) {
			$('.header-sticky').addClass('sticky');
		} else {
			$('.header-sticky').removeClass('sticky');
		}
	});

	/*------- Slick Carousel
	----------------------------------------*/
	var $html = $('html');
	var $body = $('body');
	var $elementCarousel = $('.mgana-element-carousel');
	// Check if element exists
	$.fn.elExists = function () {
		return this.length > 0;
	};

	/*For RTL*/
	if ($html.attr('dir') == 'rtl' || $body.attr('dir') == 'rtl') {
		$elementCarousel.attr('dir', 'rtl');
	}

	if ($elementCarousel.elExists()) {
		var slickInstances = [];

		/*For RTL*/
		if ($html.attr('dir') == 'rtl' || $body.attr('dir') == 'rtl') {
			$elementCarousel.attr('dir', 'rtl');
		}

		$elementCarousel.each(function (index, element) {
			var $this = $(this);

			// Carousel Options

			var $options = typeof $this.data('slick-options') !== 'undefined' ? $this.data('slick-options') : '';

			var $spaceBetween = $options.spaceBetween ? parseInt($options.spaceBetween, 10) : 0,
				$spaceBetween_xl = $options.spaceBetween_xl ? parseInt($options.spaceBetween_xl, 10) : 0,
				$rowSpace = $options.rowSpace ? parseInt($options.rowSpace, 10) : 0,
				$rows = $options.rows ? $options.rows : false,
				$vertical = $options.vertical ? $options.vertical : false,
				$focusOnSelect = $options.focusOnSelect ? $options.focusOnSelect : false,
				$pauseOnHover = $options.pauseOnHover ? $options.pauseOnHover : false,
				$pauseOnFocus = $options.pauseOnFocus ? $options.pauseOnFocus : false,
				$asNavFor = $options.asNavFor ? $options.asNavFor : '',
				$fade = $options.fade ? $options.fade : false,
				$autoplay = $options.autoplay ? $options.autoplay : false,
				$autoplaySpeed = $options.autoplaySpeed ? parseInt($options.autoplaySpeed, 10) : 5000,
				$swipe = $options.swipe ? $options.swipe : true,
				$swipeToSlide = $options.swipeToSlide ? $options.swipeToSlide : true,
				$touchMove = $options.touchMove ? $options.touchMove : false,
				$verticalSwiping = $options.verticalSwiping ? $options.verticalSwiping : true,
				$draggable = $options.draggable ? $options.draggable : true,
				$arrows = $options.arrows ? $options.arrows : false,
				$dots = $options.dots ? $options.dots : false,
				$adaptiveHeight = $options.adaptiveHeight ? $options.adaptiveHeight : true,
				$infinite = $options.infinite ? $options.infinite : false,
				$centerMode = $options.centerMode ? $options.centerMode : false,
				$centerPadding = $options.centerPadding ? $options.centerPadding : '',
				$variableWidth = $options.variableWidth ? $options.variableWidth : false,
				$speed = $options.speed ? parseInt($options.speed, 10) : 500,
				$appendArrows = $options.appendArrows ? $options.appendArrows : $this,
				$prevArrow =
				$arrows === true ?
				$options.prevArrow ?
				'<span class="' +
				$options.prevArrow.buttonClass +
				'"><i class="' +
				$options.prevArrow.iconClass +
				'"></i></span>' :
				'<button class="tty-slick-text-btn tty-slick-text-prev"><i class="lastudioicon-left-arrow"></i></span>' :
				'',
				$nextArrow =
				$arrows === true ?
				$options.nextArrow ?
				'<span class="' +
				$options.nextArrow.buttonClass +
				'"><i class="' +
				$options.nextArrow.iconClass +
				'"></i></span>' :
				'<button class="tty-slick-text-btn tty-slick-text-next"><i class="lastudioicon-right-arrow"></i></span>' :
				'',
				$rows = $options.rows ? parseInt($options.rows, 10) : 1,
				$rtl = $options.rtl || $html.attr('dir="rtl"') || $body.attr('dir="rtl"') ? true : false,
				$slidesToShow = $options.slidesToShow ? parseInt($options.slidesToShow, 10) : 1,
				$slidesToScroll = $options.slidesToScroll ? parseInt($options.slidesToScroll, 10) : 1;

			/*Responsive Variable, Array & Loops*/
			var $responsiveSetting =
				typeof $this.data('slick-responsive') !== 'undefined' ? $this.data('slick-responsive') : '',
				$responsiveSettingLength = $responsiveSetting.length,
				$responsiveArray = [];
			for (var i = 0; i < $responsiveSettingLength; i++) {
				$responsiveArray[i] = $responsiveSetting[i];
			}

			// Adding Class to instances
			$this.addClass('slick-carousel-' + index);
			$this.parent().find('.slick-dots').addClass('dots-' + index);
			$this.parent().find('.slick-btn').addClass('btn-' + index);

			if ($spaceBetween != 0) {
				$this.addClass('slick-gutter-' + $spaceBetween);
			}
			if ($spaceBetween_xl != 0) {
				$this.addClass('slick-gutter-xl-' + $spaceBetween_xl);
			}
			var $slideCount = null;
			$this.on('init', function (event, slick) {
				$this.find('.slick-active').first().addClass('first-active');
				$this.find('.slick-active').last().addClass('last-active');
				$slideCount = slick.slideCount;
				if ($slideCount <= $slidesToShow) {
					$this.children('.slick-dots').hide();
				}
				var $firstAnimatingElements = $('.slick-slide').find('[data-animation]');
				doAnimations($firstAnimatingElements);
			});

			$this.slick({
				slidesToShow: $slidesToShow,
				slidesToScroll: $slidesToScroll,
				asNavFor: $asNavFor,
				autoplay: $autoplay,
				autoplaySpeed: $autoplaySpeed,
				speed: $speed,
				infinite: $infinite,
				rows: $rows,
				arrows: $arrows,
				dots: $dots,
				adaptiveHeight: $adaptiveHeight,
				vertical: $vertical,
				focusOnSelect: $focusOnSelect,
				pauseOnHover: $pauseOnHover,
				pauseOnFocus: $pauseOnFocus,
				centerMode: $centerMode,
				centerPadding: $centerPadding,
				variableWidth: $variableWidth,
				swipe: $swipe,
				swipeToSlide: $swipeToSlide,
				touchMove: $touchMove,
				draggable: $draggable,
				fade: $fade,
				appendArrows: $appendArrows,
				prevArrow: $prevArrow,
				nextArrow: $nextArrow,
				rtl: $rtl,    
				customPaging : function(slider, i) {
					var thumb = $(slider.$slides[i]).data();
					var number = i + 1;
					if(number < 10){
						return '<button type="button" class="dot">'+'0'+number+'</button>';
					}
					return '<button type="button" class="dot">'+number+'</button>';
				},
				responsive: $responsiveArray
			});

			$this.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
				$this.find('.slick-active').first().removeClass('first-active');
				$this.find('.slick-active').last().removeClass('last-active');
				var $animatingElements = $('.slick-slide[data-slick-index="' + nextSlide + '"]').find(
					'[data-animation]'
				);
				doAnimations($animatingElements);
			});

			function doAnimations(elements) {
				var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				elements.each(function () {
					var $el = $(this);
					var $animationDelay = $el.data('delay');
					var $animationDuration = $el.data('duration');
					var $animationType = 'animated ' + $el.data('animation');
					$el.css({
						'animation-delay': $animationDelay,
						'animation-duration': $animationDuration
					});
					$el.addClass($animationType).one(animationEndEvents, function () {
						$el.removeClass($animationType);
					});
				});
			}

			$this.on('afterChange', function (e, slick) {
				$this.find('.slick-active').first().addClass('first-active');
				$this.find('.slick-active').last().addClass('last-active');
			});

			// Updating the sliders in tab
			$('body').on('shown.bs.tab', 'a[data-toggle="tab"], a[data-toggle="pill"]', function (e) {
				$this.slick('setPosition');
			});
		});
		// Added mousewheel for specific slider
		$('.single-blog_slider, .mousewheel-slider').on('wheel', function(e) {
			e.preventDefault();
	
			if (e.originalEvent.deltaY < 0) {
				$(this).slick('slickNext');
			} else {
				$(this).slick('slickPrev');
			}
		});
	}

	/*---- Autoplay Video Slider
	------------------------------------- */
	var slideWrapper = $(".autoplay-video_slider"),
	iframes = slideWrapper.find('.embed-player'),
	lazyImages = slideWrapper.find('.slide-image'),
	lazyCounter = 0;

	// POST commands to YouTube or Vimeo API
	function postMessageToPlayer(player, command) {
		if (player == null || command == null) return;
		player.contentWindow.postMessage(JSON.stringify(command), "*");
	}

	// When the slide is changing
	function playPauseVideo(slick, control) {
		var currentSlide, slideType, startTime, player, video;

		currentSlide = slick.find(".slick-current");
		slideType = currentSlide.attr("class").split(" ")[1];
		player = currentSlide.find("iframe").get(0);
		startTime = currentSlide.data("video-start");

		if (slideType === "vimeo") {
			switch (control) {
				case "play":
					if ((startTime != null && startTime > 0) && !currentSlide.hasClass('started')) {
						currentSlide.addClass('started');
						postMessageToPlayer(player, {
							"method": "setCurrentTime",
							"value": startTime
						});
					}
					postMessageToPlayer(player, {
						"method": "play",
						"value": 1
					});
					break;
				case "pause":
					postMessageToPlayer(player, {
						"method": "pause",
						"value": 1
					});
					break;
			}
		} else if (slideType === "youtube") {
			switch (control) {
				case "play":
					postMessageToPlayer(player, {
						"event": "command",
						"func": "mute"
					});
					postMessageToPlayer(player, {
						"event": "command",
						"func": "playVideo"
					});
					break;
				case "pause":
					postMessageToPlayer(player, {
						"event": "command",
						"func": "pauseVideo"
					});
					break;
			}
		} else if (slideType === "video") {
			video = currentSlide.children("video").get(0);
			if (video != null) {
				if (control === "play") {
					video.play();
				} else {
					video.pause();
				}
			}
		}
	}

	// Resize player
	function resizePlayer(iframes, ratio) {
		if (!iframes[0]) return;
		var win = $(".autoplay-video_slider"),
			width = win.width(),
			playerWidth,
			height = win.height(),
			playerHeight,
			ratio = ratio || 16 / 9;

		iframes.each(function () {
			var current = $(this);
			if (width / ratio < height) {
				playerWidth = Math.ceil(height * ratio);
				current.width(playerWidth).height(height).css({
					left: (width - playerWidth) / 2,
					top: 0
				});
			} else {
				playerHeight = Math.ceil(width / ratio);
				current.width(width).height(playerHeight).css({
					left: 0,
					top: (height - playerHeight) / 2
				});
			}
		});
	}

	// DOM Ready
	$(function () {
		// Initialize
		slideWrapper.on("init", function (slick) {
			slick = $(slick.currentTarget);
			setTimeout(function () {
				playPauseVideo(slick, "play");
			}, 1000);
			resizePlayer(iframes, 16 / 9);
		});
		slideWrapper.on("beforeChange", function (event, slick) {
			slick = $(slick.$slider);
			playPauseVideo(slick, "pause");
		});
		slideWrapper.on("afterChange", function (event, slick) {
			slick = $(slick.$slider);
			playPauseVideo(slick, "play");
		});
		slideWrapper.on("lazyLoaded", function (event, slick, image, imageSource) {
			lazyCounter++;
			if (lazyCounter === lazyImages.length) {
				lazyImages.addClass('show');
				// slideWrapper.slick("slickPlay");
			}
		});

		//start the slider
		slideWrapper.slick({
			fade: true,
			autoplay: false,
			draggable: false,
			swipeToSlide: true,
			swipe: true,
			autoplaySpeed: 10000,
			lazyLoad: "progressive",
			pauseOnHover: false,
			pauseOnFocus: false,
			speed: 20,
			arrows: false,
			dots: true,
			cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)"
		});
	});

	// Resize event
	$(window).on("resize.slickVideoPlayer", function () {
		resizePlayer(iframes, 16 / 9);
	});

	/*------ Product View
	-----------------------------------------------*/
	function porductViewMode() {
		$(window).on({
			load: function () {
				var activeChild = $('.product-view-mode a.active');
				var firstChild = $('.product-view-mode').children().first();
				var window_width = $(window).width();

				if (window_width < 575) {
					$('.product-view-mode a').removeClass('active');
					$('.product-view-mode').children().first().addClass('active');
					$('.shop-product-wrap').removeClass('gridview-3 gridview-4 gridview-5').addClass('gridview-2');
				}
			},
			resize: function () {
				var ww = $(window).width();
				var activeChild = $('.product-view-mode a.active');
				var firstChild = $('.product-view-mode').children().first();
				var defaultView = $('.product-view-mode').data('default');

				if (ww < 1200 && ww > 575) {
					if (activeChild.hasClass('grid-5')) {
						$('.product-view-mode a.grid-5').removeClass('active');
						if (defaultView == 4) {
							$('.product-view-mode a.grid-4').addClass('active');
							$('.shop-product-wrap')
								.removeClass('gridview-2 gridview-3 gridview-5')
								.addClass('gridview-4');
						} else if (defaultView == 'list') {
							$('.product-view-mode a.list').addClass('active');
							$('.shop-product-wrap')
								.removeClass('gridview-2 gridview-3 gridview-4 gridview-5')
								.addClass('listview');
						} else {
							$('.product-view-mode a.grid-3').addClass('active');
							$('.shop-product-wrap')
								.removeClass('gridview-2 gridview-4 gridview-5')
								.addClass('gridview-3');
						}
					}
				}

				if (ww < 768 && ww > 575) {
					if (activeChild.hasClass('grid-4')) {
						$('.product-view-mode a.grid-4').removeClass('active');
						if (defaultView == 'list') {
							$('.product-view-mode a.list').addClass('active');
							$('.shop-product-wrap')
								.removeClass('gridview-2 gridview-3 gridview-4 gridview-5')
								.addClass('listview');
						} else {
							$('.product-view-mode a.grid-3').addClass('active');
							$('.shop-product-wrap')
								.removeClass('gridview-2 gridview-4 gridview-5')
								.addClass('gridview-3');
						}
					}
				}
				if (activeChild.hasClass('list')) {} else {
					if (ww < 576) {
						$('.product-view-mode a').removeClass('active');
						$('.product-view-mode').children().first().addClass('active');
						$('.shop-product-wrap').removeClass('gridview-3 gridview-4 gridview-5').addClass('gridview-2');
					} else {
						if (activeChild.hasClass('grid-2')) {
							if (ww < 1200) {
								$('.product-view-mode a:not(:first-child)').removeClass('active');
							} else {
								$('.product-view-mode a').removeClass('active');
								$('.product-view-mode a:nth-child(2)').addClass('active');
								$('.shop-product-wrap')
									.removeClass('gridview-2 gridview-4 gridview-5')
									.addClass('gridview-3');
							}
						}
					}
				}
			}
		});
		$('.product-view-mode a').on('click', function (e) {
			e.preventDefault();

			var shopProductWrap = $('.shop-product-wrap');
			var viewMode = $(this).data('target');

			$('.product-view-mode a').removeClass('active');
			$(this).addClass('active');
			if (viewMode == 'listview') {
				shopProductWrap.removeClass('grid');
			} else {
				if (shopProductWrap.not('.grid')) shopProductWrap.addClass('grid');
			}
			shopProductWrap.removeClass('gridview-2 gridview-3 gridview-4 gridview-5 listview').addClass(viewMode);
		});
	}
	porductViewMode();

	/*-----------------------
        Shop filter active 
    ------------------------- */
    $('.filter-btn').on('click', function(e) {
        e.preventDefault();
		$('.filter-body').slideToggle();
	})

	/*--------------------------------
	Price Slider Active
	-------------------------------- */
	var sliderrange = $('#slider-range');
	var amountprice = $('#amount');
	$(function () {
		sliderrange.slider({
			range: true,
			min: 80,
			max: 1900,
			values: [0, 2000],
			slide: function (event, ui) {
				amountprice.val('$' + ui.values[0] + ' - $' + ui.values[1]);
			}
		});
		amountprice.val('$' + sliderrange.slider('values', 0) + ' - $' + sliderrange.slider('values', 1));
	});

	/*----------------------------------------*/
	/*  Cart Plus Minus Button
	/*----------------------------------------*/
	/*$('.cart-plus-minus').append(
		'<div class="dec qtybutton"><i class="lastudioicon-i-delete-2"></i></div><div class="inc qtybutton"><i class="lastudioicon-i-add-2"></i></div>'
	);*/
	$('.qtybutton').on('click', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
			}
		}
		$button.parent().find('input').val(newVal);
	});
	/*----------------------------------------*/
	/*  Light Gallery
	/*----------------------------------------*/
	$('.lightgallery').lightGallery({
		selector: '.gallery-item'
	});
	/*----------------------------------------*/
	/*  Masonary
	/*----------------------------------------*/
    $('.portfolio-masonary').imagesLoaded(function() {

        // filter items on button click
        $('.portfolio-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });

        // init Isotope
        var $grid = $('.portfolio-masonary').isotope({
            itemSelector: '.prt_gride',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.prt_gride',
            }
        });
    });
	/*---------------------------------
	Sticky Sidebar Activation
	-----------------------------------*/
	$('#sticky-sidebar').theiaStickySidebar({
		// Settings
		additionalMarginTop: 100
	});

	/*------ Parallax
	------------------------------------- */
	! function () {
		$('.parallax').jarallax({
			speed: 1.1
		});
	}();

	/*------ Popup Video
	-------------------------------------------------*/
	$('.popup-vimeo').magnificPopup({
		type: 'iframe',
		disableOn: function () {
			if ($(window).width() < 600) {
				return false;
			}
			return true;
		}
	});
	/*------ Bootstraps 4 Tooltip
	-------------------------------------------------*/
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});

	/*------ MailChimp
    -----------------------------------*/
    $('#mc-form').ajaxChimp({
        language: 'en',
        callback: mailChimpResponse,
        // ADD YOUR MAILCHIMP URL BELOW HERE!
        url: 'http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef'
    });
    function mailChimpResponse(resp) {
        if (resp.result === 'success') {
            $('.mailchimp-success').html('' + resp.msg).fadeIn(900);
            $('.mailchimp-error').fadeOut(400);
        } else if (resp.result === 'error') {
            $('.mailchimp-error').html('' + resp.msg).fadeIn(900);
        }
	}
	/*------  WOW
	------------------------------------- */
	new WOW().init();

	/*------  Language Currency Dropdown
	------------------------------------- */
	var headerActionToggle = $('.drop-toggle');
	var headerActionDropdown = $('.drop-dropdown');
		// Toggle Header Cart
		headerActionToggle.on("click", function() {
			var $this = $(this);
			headerActionDropdown.slideUp();
			if($this.siblings('.drop-dropdown').is(':hidden')){
				$this.siblings('.drop-dropdown').slideDown();
			} else {
				$this.siblings('.drop-dropdown').slideUp();
			}
		});
	// Prevent closing Header Cart upon clicking inside the Header Cart
	$('.drop-dropdown').on('click', function(e) {
		e.stopPropagation();
	});
	
	/*--------------------------------
    Scroll To Top
	-------------------------------- */
	function scrollToTop() {
		var $scrollUp = $('.scroll-to-top'),
			$lastScrollTop = 0,
			$window = $(window);

		$window.on('scroll', function () {
			var topPos = $(this).scrollTop();
			if (topPos > $lastScrollTop) {
				$scrollUp.removeClass('show');
			} else {
				if ($window.scrollTop() > 200) {
					$scrollUp.addClass('show');
				} else {
					$scrollUp.removeClass('show');
				}
			}
			$lastScrollTop = topPos;
		});

		$scrollUp.on('click', function (evt) {
			$('html, body').animate({
				scrollTop: 0
			}, 600);
			evt.preventDefault();
		});
	}
	scrollToTop();
	/*----------------------------------------*/
	/*  Countdown
	/*----------------------------------------*/
	$('[data-countdown]').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime('<div class="single-countdown"><span class="single-countdown_time">%D</span><span class="single-countdown_text">Days</span></div><div class="single-countdown"><span class="single-countdown_time">%H</span><span class="single-countdown_text">Hours</span></div><div class="single-countdown"><span class="single-countdown_time">%M</span><span class="single-countdown_text">Min</span></div><div class="single-countdown"><span class="single-countdown_time">%S</span><span class="single-countdown_text">Sec</span></div>'));
		});
	});

	/*--------------------------
          Ajax Contact Form JS
	---------------------------*/
		 var form = $('#contact-form');
		 var formMessages = $('.form-message');
 
		 $(form).submit(function (e) {
			 e.preventDefault();
			 var formData = form.serialize();
			 $.ajax({
				 type: 'POST',
				 url: form.attr('action'),
				 data: formData
			 }).done(function (response) {
				 // Make sure that the formMessages div has the 'success' class.
				 $(formMessages).removeClass('alert alert-danger');
				 $(formMessages).addClass('alert alert-success fade show');
 
				 // Set the message text.
				 formMessages.html("<button type='button' class='close' data-dismiss='alert'>&times;</button>");
				 formMessages.append(response);
 
				 // Clear the form.
				 $('#contact-form input,#contact-form textarea, #contact-form select').val('');
			 }).fail(function (data) {
				 // Make sure that the formMessages div has the 'error' class.
				 $(formMessages).removeClass('alert alert-success');
				 $(formMessages).addClass('alert alert-danger fade show');
 
				 // Set the message text.
				 if (data.responseText !== '') {
					 formMessages.html("<button type='button' class='close' data-dismiss='alert'>&times;</button>");
					 formMessages.append(data.responseText);
				 } else {
					 $(formMessages).text('Oops! An error occurred and your message could not be sent.');
				 }
			 });
		 });

	/*------------------------------------
	Svg Icon
	------------------------------------- */
	document.addEventListener('DOMContentLoaded', function () {

		var icon1 = document.querySelectorAll('.icon1');
		var icon2 = document.querySelectorAll('.icon2');
		var icon3 = document.querySelectorAll('.icon3');
		var icon4 = document.querySelectorAll('.icon4');
		var icon5 = document.querySelectorAll('.icon5');
		var icon6 = document.querySelectorAll('.icon6');
		var icon7 = document.querySelectorAll('.icon7');
		var icon8 = document.querySelectorAll('.icon8');
		var icon9 = document.querySelectorAll('.icon9');
		var icon10 = document.querySelectorAll('.icon10');

		//icon 1
		for (i = 0; i < icon1.length; ++i) {
			icon1[i].innerHTML = '<svg class="mgana-svg" xmlns="http://www.w3.org/2000/svg" width="70" height="78" viewBox="0 0 86 78"><g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M1 71.097h58.21v-5.903H1zm56-6.641v-4.379c0-1.656-1.374-3-3.07-3H6.282c-1.696 0-3.071 1.344-3.071 3v4.38m50.105-8.117v-.636a3.045 3.045 0 0 0-3.039-3.054H9.197a3.046 3.046 0 0 0-3.04 3.054v.636m39.79-4.427v-2.348c0-1.557-1.37-2.817-3.06-2.817h-7.142c-1.69 0-3.06 1.26-3.06 2.817v2.348m-19.895 0v-2.348c0-1.556 1.37-2.817 3.06-2.817h7.142c1.69 0 3.06 1.26 3.06 2.817v2.348"/><path d="M53.316 57.078V34.942H6.158v22.135m47.158 14.02V77H47.42v-5.903m-41.262 0V77h5.895v-5.903M63.632 77H85V50.437H63.632zm0-14.388H85m-14-6.641h6.632M71 68.515h6.632m2.21-18.078v-3.69H68.79v3.69m9.485-28.777l4.514 13.282H65.105L69.62 21.66zm-3.959 13.282V46.01M6.158 24.612h47.158V1H6.158z"/><path d="M20.62 1c.184.697.275 1.424.275 2.166 0 4.911-4.083 8.902-9.138 8.902A9.16 9.16 0 0 1 5.421 9.56m27.263 6.338l9.597-8.995 11.035 10.33m-13.263 6.641l-.064-.059-11.02-10.271-11.022 10.271"/></g></svg>';
		}
		//icon 2
		for (i = 0; i < icon2.length; ++i) {
			icon2[i].innerHTML = '<svg class="mgana-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="77" viewBox="0 0 91 77"><defs><path id="a" d="M0 76h89V0H0z"/></defs><g fill="none" fill-rule="evenodd" transform="translate(1)"><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M80.174 55.155c0-1.528 1.207-2.767 2.697-2.767h2.696c1.49 0 2.697 1.239 2.697 2.767v19.37h-8.09v-19.37zm-42.662 0c0-1.528-1.207-2.767-2.697-2.767H32.12c-1.49 0-2.698 1.239-2.698 2.767v19.37h8.091v-19.37zm41.926.185V44.8a2.744 2.744 0 0 0-2.746-2.742H40.994a2.744 2.744 0 0 0-2.746 2.742v10.54m0 19.553h41.19m0-12.913c0-1.63-1.23-2.95-2.747-2.95H40.995c-1.516 0-2.747 1.32-2.747 2.95m0 5.535h41.19M22.066 59.03l-3.49 16.232H4.96L1.471 59.03zm-13.24 0c0-15.646 2.942-30.253 2.942-30.253s2.943 14.607 2.943 30.252m-.001-10.411l8.092-16.89s-1.77 22.9-6.053 27.301M8.826 48.618l-8.09-16.89s1.77 22.9 6.05 27.301"/><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M37.512 23.612H87.53V.738H37.512z" mask="url(#b)"/><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M81.645 24.35l-.07-16.233h-5.08V24.35" mask="url(#b)"/><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M76.496 24.35V8.117h-5.884V24.35" mask="url(#b)"/><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M71.347 24.35l-.07-16.233h-5.079V24.35m-16.631-.738c-5.065-5.21-2.655-12.544-2.655-12.544h10.622s2.41 7.334-2.655 12.544m.286-12.544l1.471-5.165m-6.619 5.165l-1.472-5.165m3.31 5.165V5.165" mask="url(#b)"/></g></svg>';
		}
		//icon 3
		for (i = 0; i < icon3.length; ++i) {
			icon3[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="56" viewBox="0 0 100 56"><defs><path id="a" d="M0 56h100V0H0z"/></defs><g fill="none" fill-rule="evenodd"><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M54.65 19.895s3.438-1.745 3.438-7.369H41.912c0 5.624 3.437 7.369 3.437 7.369m1.71-7.369C47.059 6.323 50 1.474 50 1.474s2.94 4.849 2.94 11.052"/><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M52.206 7.597l6.618-3.176s-.728 5.83-3.118 8.105m-11.42 0c-2.395-2.274-3.11-8.105-3.11-8.105l6.618 3.192"/><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.647 26.526h64.706v-6.631H17.647zM75 43.474h19.118v-6.632H75zm-69.118 0H25v-6.632H5.882zm61.03-16.948v28.737h-6.618V26.526m-27.206 0v28.737h6.618V26.526m-.735 13.632h21.323m33.824 3.316l2.941 11.789M5.882 43.474L2.941 55.263m75.735-11.789l-2.941 11.789M21.324 43.474l2.941 11.789m69.853-18.421l5.147-19.895M5.882 36.842L.735 16.947" mask="url(#b)"/></g></svg>';
		}
		//icon 4
		for (i = 0; i < icon4.length; ++i) {
			icon4[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="76" viewBox="0 0 83 76"><defs><path id="a" d="M0 76h83V0H0z"/></defs><g fill="none" fill-rule="evenodd"><path fill="#FFF" d="M69.66 53.864a1.48 1.48 0 0 1-1.482 1.476c-.818 0-1.482-.661-1.482-1.476s.664-1.476 1.482-1.476a1.48 1.48 0 0 1 1.483 1.476m7.41 0a1.48 1.48 0 0 1-1.482 1.476c-.818 0-1.482-.661-1.482-1.476s.664-1.476 1.482-1.476c.819 0 1.482.661 1.482 1.476m-17.044 0c0 .815.663 1.476 1.482 1.476a1.48 1.48 0 0 0 1.482-1.476 1.48 1.48 0 0 0-1.482-1.476c-.819 0-1.482.661-1.482 1.476"/><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M.741 75.262H27.42V18.447H.74zm27.419 0h26.68V49.437H28.16m27.42 25.825h26.68V49.437H55.58m0 8.116h26.679M62.25 64.194h13.339M34.83 56.816h13.34M21.491 43.534v13.282m16.304-41.321h13.339m12.598 0h13.339M40.759 49.437v-5.963c0-1.597 1.327-2.891 2.964-2.891s2.965 1.294 2.965 2.89m-2.224 3.012v2.952m-8.151-2.952v2.952m25.937 0v-8.854h13.34v8.854m-.001-5.903h2.965m-17.045 0h-2.964M32.607 21.398H82.26V.738H32.607zM57.063.738v20.66" mask="url(#b)"/></g></svg>';
		}
		// icon 5
		for (i = 0; i < icon5.length; ++i) {
			icon5[i].innerHTML = '<svg class="mgana-svg" xmlns="http://www.w3.org/2000/svg" width="28" height="23" viewBox="0 0 28 23"><path fill="currentColor" d="M8.519 11.352c1.086.445 1.938 1.15 2.555 2.114.617.965.926 2.115.926 3.45 0 1.78-.568 3.24-1.704 4.378C9.16 22.43 7.753 23 6.074 23c-1.778 0-3.234-.569-4.37-1.706C.568 20.156 0 18.697 0 16.916c0-.89.111-1.756.333-2.597.223-.84.655-2.102 1.297-3.784L5.556 0h5.925L8.52 11.352zm16 0c1.086.445 1.938 1.15 2.555 2.114.617.965.926 2.115.926 3.45 0 1.78-.568 3.24-1.704 4.378C25.16 22.43 23.753 23 22.074 23c-1.778 0-3.234-.569-4.37-1.706C16.568 20.156 16 18.697 16 16.916c0-.89.111-1.756.333-2.597.223-.84.655-2.102 1.297-3.784L21.556 0h5.925L24.52 11.352z"></path></svg>';
		}
		// icon 6
		for (i = 0; i < icon6.length; ++i) {
			icon6[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="77" viewBox="0 0 97 77"><defs><path id="a" d="M0 75.262h95V.214H0z"/></defs><g fill="none" fill-rule="evenodd"><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M88.707 75.058h6.354V1.488h-6.354zm-86.768 0h6.354V1.488H1.94zM68.95 16.182v58.876H44.926V56.566M68.752 66.039h19.884M68.752 53.495h19.884M68.752 40.214h19.884M8.364 26.932h80.272M8.364 15.864h80.272M31.93 10.699h56.706"/><g transform="translate(1)"><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M31.045 15.811v-5.159a2.975 2.975 0 0 0-2.974-2.976H7.353m.002 48.219h60.564m-19.428 6.747v5.557m5.084-30.065a5.85 5.85 0 0 0-5.848-5.852 5.85 5.85 0 0 0-5.85 5.852h11.698zm0 0l8.793 3.077-8.524 9.922M47.5 55.895v-4.762h10.904v4.762"/><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.212 48.256h23.69V34.96h-23.69zm14.868 0v7.639m-6.047-7.639v7.639M43.931 74.25H7.355m60.564 0h19.726" mask="url(#b)"/></g></g></svg>';
		}
		// icon 7
		for (i = 0; i < icon7.length; ++i) {
			icon7[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="70" height="57" viewBox="0 0 90 57"><g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M89 24.31a3.235 3.235 0 0 0-3.227-3.242h-4.638a3.235 3.235 0 0 0-3.227 3.243v25.743H89V24.311zm-88 0a3.235 3.235 0 0 1 3.227-3.242h4.638a3.235 3.235 0 0 1 3.227 3.243v25.743H1V24.311zm11.092 25.372h65.076M12.092 39.277h65.076"/><path d="M12.092 36.676v-4.19a3.238 3.238 0 0 1 3.234-3.243h58.609a3.238 3.238 0 0 1 3.233 3.243v4.19m0-12.636V4.293C77.168 2.474 75.721 1 73.935 1H15.326c-1.786 0-3.234 1.474-3.234 3.292V24.04M45 1v28.243m41.782 20.811V56h-7.395v-5.946m-76.169 0V56h7.395v-5.946"/></g></svg>';
		}
		// icon 8
		for (i = 0; i < icon8.length; ++i) {
			icon8[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="70" height="78" viewBox="0 0 50 78"><path fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M40.138 77c0-5.705-4.634-10.33-10.351-10.33h-8.836C15.234 66.67 10.6 71.295 10.6 77h29.538zm-3.39-76L49 35.68H1L13.252 1zm-8.794 35.417V66.67m-5.908-30.253V66.67m16.985-30.99v14.019m3.323 3.689a3.69 3.69 0 0 0-3.692-3.689 3.69 3.69 0 1 0 0 7.379 3.69 3.69 0 0 0 3.692-3.69z"/></svg>';
		}
		// icon 9
		for (i = 0; i < icon9.length; ++i) {
			icon9[i].innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="70" height="78" viewBox="0 0 90 78"><g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M23.924 50.437h42.152v-5.903H23.924zm40.338 26.362l-10.698-26.01m5.154 26.01l-10.7-26.01m16.244 26.01h-5.544m-32.241 0l10.699-26.01m-5.153 26.01l10.698-26.01m-16.244 26.01h5.546m4.473-12.712h16.269M72.908 76.064V64.332H88.8v11.732m-71.708 0V64.332H1.2v11.732m87.601-11.732V41.431M1.199 64.332V41.431"/><path d="M88.8 57.743H72.909v6.589M1.2 57.743h15.892v6.589M44.905 5.791V1.153M45 44.534V22.398"/><g><path d="M83.557 22.787c-10.02-10.585-24.012-16.59-38.655-16.59S16.27 12.203 6.25 22.788h77.308z"/><path d="M59.285 22.787S53.403 6.977 44.902 6.229c-8.5.748-14.382 16.558-14.382 16.558"/></g></g></svg>';
		}
		// icon 10	
		for (i = 0; i < icon10.length; ++i) {
			icon10[i].innerHTML = '<svg viewBox="0 0 308 90" width="308" height="90" xmlns="http://www.w3.org/2000/svg"><path d="M149.314 33.9c1.778-2.113 4.629-3.693 7.438-3.329-1.682 1.847-4.204 4.115-7.1 6.221-1.346-.608-1.481-1.53-.338-2.892m-19.022-13.678c3.04-4.81 7.737-12.09 13.89-13.233-2.068 6.89-8.228 13.113-13.32 17.713-1.74 1.573-3.959 3.481-6.426 5.27 1.933-3.26 3.827-6.54 5.856-9.75M91.228 39.438c-.555 1.915-2.431 3.279-4.015 4.25-3.674 2.252-8.962 3.194-13.152 2.197-.968-.23-1.92-.29-1.388-1.391.646-1.33 1.477-2.546 2.36-3.725.774-1.034 1.7-1.902 2.684-2.703.397.276 1.006.442 1.269.497 4.274.896 8.414.866 12.42.166-.058.258-.117.5-.178.709m-.73-5.708c.89.548 1.154 1.708 1.147 2.903-3.247.746-6.6 1.007-10.064.594 2.102-2.221 6.481-4.989 8.916-3.497M304.523.432c.87-.362 4.101.877 2.711 1.536-18.58 8.832-38.092 15.309-57.801 21.046-8.999 2.62-17.763 5.798-26.716 8.529-6.02 1.832-12.417 3.444-18.73 2.765-7.305 3.854-15.765 5.924-23.838 3.562-3.934 1.646-8.421 1.727-12.442-.311-.902-.456-1.577-.958-2.093-1.487-4.62 2.661-9.916 4.319-14.624 3.552-9.371 5.81-21.449 9.482-26.611.657-15.079 12.147-25.23 30.747-32.77 48.252-.507 1.179-4.01.527-3.634-.585 6.47-19.009 18.002-35.082 28.848-51.662-3.335 1.13-6.831 1.494-10.343.46-.283-.083-1.253-.467-1.073-.948.317-.848.53-1.718.735-2.59-3.681 2.044-7.488 3.713-11.425 4.775-.066.635-.196 1.28-.477 1.938-3.254 7.603-17.97 10.516-24.342 5.554-.237-.184-.409-.387-.244-.682 2.373-4.262 5.477-7.252 9.521-9.467 2.702-2.416 6.694-3.772 10.103-3.553 2.655.166 4.645 1.828 5.277 4.061 4.434-1.416 8.682-3.647 12.762-6.205.507-.322 3.412-.17 3.006.894-.637 1.671-.9 3.428-1.445 5.12 3.104.489 6.457-.446 9.693-2.051.404-.624.81-1.246 1.21-1.872 5.675-8.88 12.816-26.854 25.622-26.064.255.019 1.558.228 1.358.762-3.303 8.872-10.31 16.534-17.528 22.406-2.163 1.759-4.578 3.545-7.155 5.03-.609.986-1.214 1.971-1.853 2.94-1.67 2.545-3.35 5.087-5.027 7.633a84.485 84.485 0 018.286-7.46c.81-.637 3.143-.228 3.535.795 3.314 8.551 12.569 5.625 20.266.654a12.305 12.305 0 01-3.736-2.943c-.228-.267-.319-.592-.093-.893 4.222-5.743 10.77-7.872 17.347-5.045.43.184 1.26.771.803 1.333-1.57 1.904-4.055 4.168-7.031 6.341 1.846-.308 3.679-1.004 5.247-1.77 1.595-.781 3.129-1.695 4.61-2.687.324-2.545 2.937-5.133 5.64-6.65 1.1-.62 2.945-.279 3.813.608.271.278.54.555.812.831.226.228.306.585.094.854-1.52 1.932-3.622 3.9-6.037 5.653.14.663.573 1.296 1.468 1.858 3.706 2.323 8.314-.26 10.986-2.986.977-.997 5.425-.125 4.362 1.307l-1.584 2.13c5.258.742 10.744-1.034 15.532-3.495-.45-.622-.157-1.28 1.488-1.3.208-.003.65-.008 1.016-.072.265-.157.543-.304.799-.46.785-.477 4.142-.192 4.233 1.02 6.333-.203 12.797-2.66 18.555-4.74 8.268-2.983 16.658-5.313 25.074-7.844 18.226-5.477 36.26-11.698 53.84-19.034zM78.154-13.975c.553-.163 2.382.512 1.301.896-2.44.866-4.283 4.134-5.643 6.137-2.707 3.997-5.093 8.212-7.433 12.429-4.82 8.69-9.424 17.494-14.22 26.2a3749.305 3749.305 0 0016.93-5.497c4.41-6.295 8.893-12.54 13.49-18.688.469-.626 2.846-.13 2.355.695-3.253 5.458-6.708 10.809-10.216 16.13 2.207-.734 4.414-1.463 6.616-2.208.66-.222 2.81.55 1.546 1.067a308.267 308.267 0 01-9.922 3.829c-4.269 6.424-8.614 12.804-12.833 19.233-4.788 7.298-9.516 14.64-14.033 22.108a180.923 180.923 0 00-4.455 7.84c-.317.594-1.962 3.177-2.06 3.054.718.96-1.927.937-2.42.28-2.146-2.881 2.378-8.495 3.741-10.796 4.483-7.568 9.388-14.893 14.28-22.198a1230.751 1230.751 0 0111.9-17.453 597.184 597.184 0 01-16.522 5.488c-.6 1.076-1.188 2.16-1.798 3.232-5.174 9.1-10.468 19.141-18.046 26.54-3.448 3.362-10.569 7.632-14.274 2.036-.75-1.126 1.886-.875 2.384-.475 5.673 4.58 15.861-11.055 26.497-29.688C30.82 40.737 16.25 45.08 2.04 50.346c-.722.267-2.952-.626-1.628-1.118 15.338-5.714 30.92-10.81 46.52-15.853 12.044-21.32 24.397-45.353 31.222-47.35z" fill="currentColor" fill-rule="evenodd"></path></svg>';
		}



	});

	var icons = document.querySelectorAll('.svg-icons');

	for (var i = 0; i < icons.length; i++) {

		icons[i].addEventListener('click', function () {

			this.classList.toggle('active');

		}, false);

	}
			
	/*----------------------------------------*/
	/*  Nice Select
	/*----------------------------------------*/
	$(document).ready(function () {
		$('.nice-select').niceSelect();
	});
	/*----------------------------------------*/
	/* Toggle Function Active
	/*----------------------------------------*/
	// showlogin toggle
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});
	// showlogin toggle
	$('#showcoupon').on('click', function () {
		$('#checkout_coupon').slideToggle(900);
	});
	// showlogin toggle
	$('#cbox').on('click', function () {
		$('#cbox-info').slideToggle(900);
	});

	// Ship box toggle
	$('#ship-box').on('click', function () {
		$('#ship-box-info').slideToggle(1000);
	});
		
})(jQuery);

