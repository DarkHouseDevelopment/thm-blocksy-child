(function($) {
	'use strict';

	const $body = $('body'),
				$header = $('header[role="banner"]');

	$(document).ready(function() {
		init.ready();
	});

	$(window).on('resize',function() {
		init.resize();
	});

	$(window).on('load',function() {
		init.load();
	});

	var init = {

		/**
		* Call functions when document ready
		*/
		ready: function() {
			this.menuToggle();
			// this.mobileTopPadding();
			this.fixedNavTopPadding();
			this.headerSearch();
			// this.headerScrollActions();
			this.stickyHeaderShowOnScrollUp();
			this.topBarClose();
			this.modalsInit();
			this.smoothScroll();
			this.formLabels();
		},

		/**
		* Call functions when window load.
		*/
		load: function() {
			this.formLabels();
		},

		/**
		* Call functions when window resizes.
		*/
		resize: function() {
			// this.mobileTopPadding();
		},

		// CUSTOM FUNCTIONS BELOW
		menuToggle: function() {
			var toggler = $('.menu__toggler'),
					menuOverlay = document.querySelector('.menu__overlay'),
					menu = document.querySelector('#main_menu');
			// console.log(toggler);
			
			var isMobile = false; //initiate as false
			// device detection
			if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
					|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
					isMobile = true;
			}
			
			
			$('#nav_overlay #mobile_main_menu li.menu-item-has-children > a .sub-menu-arrow').click(function(e){
				e.preventDefault();
				// $('#nav_overlay #mobile_main_menu li.menu-item-has-children .sub-menu').stop().slideUp();
				if($(this).is('.active')){
					$(this).closest('li.menu-item-has-children').removeClass('active');
					$(this).removeClass('active');
					$(this).closest('li.menu-item-has-children').find('.sub-menu').stop().slideUp();
				} else {
					$(this).closest('li.menu-item-has-children').siblings().find('a .sub-menu-arrow.active').removeClass('active');
					$(this).closest('li.menu-item-has-children').addClass('active');
					$(this).addClass('active');
					$(this).closest('li.menu-item-has-children').siblings().children('.sub-menu').stop().slideUp();
					$(this).closest('li.menu-item-has-children').children('.sub-menu').stop().slideDown();
				}
			});
			
			/*
			 * Toggles on and off the 'active' class on the menu
			 * and the toggler button.
			 */
			toggler.on('click', function(){
				// console.log('hit');
				$(this).toggleClass('active');
				$body.toggleClass('menu--is-active');
				$('html').toggleClass('menu--is-active');
				$('#nav_overlay').toggleClass('active');
			});

		},
		
		mobileTopPadding: function() {
			if($(window).width() < 768){
				var header = $('header[role="banner"]'),
						headerTop = header.offset().top,
						headerHeight = header.outerHeight(),
						paddingTop = headerTop + headerHeight;
						
				$('body').css('padding-top',paddingTop);
			} else {
				$('body').css('padding-top',0);
			}
		},
		
		headerSearch: function() {
			/*
			 * Offset the search bar 
			 */
			if($('header[role="banner"] .header-search').length){
				var header = $('header[role="banner"]'),
						headerSearch = $('header[role="banner"] .header-search'),
						headerTop = header.offset().top,
						headerHeight = header.outerHeight(),
						headerOffset = headerTop + headerHeight;
						
				headerSearch.css('top', headerOffset);
				
				/*
				 * Trigger the search box
				 */
				$('header[role="banner"] .menu-search, #nav_overlay .menu-search').on('click', function(){
					$(this).siblings('.header-search').slideToggle();
				});
			}
		},
		
		fixedNavTopPadding: function() {
			if($('header[role="banner"]').hasClass('sticky') || $('header[role="banner"]').hasClass('sticky-scroll')){
				var header = $('header[role="banner"]'),
						mainContent = $('main.content'),
						firstBlock = mainContent.children().first().hasClass('entry') ? mainContent.find('.entry-content').children().first() : mainContent.children().first(),
						firstBlockHeight = firstBlock.outerHeight(),
						firstBlockMinHeight = parseInt(firstBlock.css('min-height')),
						// headerTop = header.offset().top,
						headerTop = 0,
						headerHeight = header.outerHeight(),
						paddingTop = headerTop + headerHeight;
						
				$('.main-menu-mobile').css('padding-top',paddingTop + 20);
						
				if(firstBlock.hasClass('wp-block-cover')){
					firstBlock.css('padding-top',paddingTop);
					if($(window).width() < 768){
						firstBlock.css('min-height',(250 + paddingTop));
					} else if(firstBlockMinHeight != $(window).height()){
						firstBlock.css('min-height',(firstBlockHeight + paddingTop));
					}
					$('body').css('padding-top',0);
				} else {
					$('body').css('padding-top',paddingTop + 30);
				}
			} else {
				$('body').css('padding-top',0);
			}
		},

		headerScrollActions: function() {
			$(window).scroll(function(){
				var scroll = $(window).scrollTop();
				if( scroll > 40 ) {
					$header.addClass('is-scrolling');
				}else{
					$header.removeClass('is-scrolling');
				}
			});
		},

		stickyHeaderShowOnScrollUp: function() {
			var header = $('header[role="banner"]'),
					lastScrollTop = 0;

			if(header.hasClass('sticky') || header.hasClass('sticky-scroll')){
				var headerHeight = header.outerHeight();

				$(window).scroll(function(event){
					var st = $(this).scrollTop();
					if( st > headerHeight ) {
						header.addClass( 'is-scrolling' );
					}
					if ( st > lastScrollTop ){
						// downscroll
						header.removeClass( 'is-scrolling-up' );
					} else if( st == 0 ) {
						// at scrolltop
						header.removeClass( 'is-scrolling is-scrolling-up' );
					} else {
						// upscroll
						header.addClass( 'is-scrolling-up' );
					}
					lastScrollTop = st;
				});
			}
		},
		
		topBarClose: function() {
			var topBar = $('#top_bar'),
					closeBtn = $('#top_bar .close-top-bar');
			
			if(topBar.length){
				closeBtn.on('click', function(){
					topBar.slideUp( 'fast' );
					const d = new Date();
					d.setTime(d.getTime() + (30*24*60*60*1000));
					let expires = "expires="+ d.toUTCString();
					document.cookie = "hide_top_bar=true;"+expires+";path=/";
				});
			}
		},
		
		smoothScroll: function() {
			$('a[href*="#"]:not([href="#"])').click(function() {
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {
						var targetTop = $('header[role="banner"]').hasClass('sticky') || $('header[role="banner"]').hasClass('sticky-scroll') ? target.offset().top - $('header[role="banner"]').outerHeight() : target.offset().top;
						$('html,body').animate({
							scrollTop: targetTop
						}, 1000);
						return false;
					}
				}
			});
		},

		modalsInit: function() {
			var $modals = $('.modal-overlay'),
					$modalTriggers = $('.modal-trigger a, a.modal-trigger');

			// $modals.each(function(){
			// 	$(this).find('.modal').append('<a href="javascript:void(0);" class="close-modal"><i class="fas fa-window-close"></i></a>');
			// });
			$modalTriggers.on('click', function(e){
				e.preventDefault();
				var target = $('.modal-overlay'+$(this).attr('href')),
						modalTitle = $(this).data('modaltitle'),
						modalContent = $(this).data('modalcontent');
				
				if(target){
					target.find('h2.modal-title').text(modalTitle);
					target.find('div.modal-content').html(modalContent);
					target.addClass('active');
					$('.site-inner').addClass('blur');
					$('body,html').addClass('modal-active');
				}
			});

			$(document).keyup(function(e) {
				if (e.keyCode == 27) {
					$('.modal-overlay').removeClass('active');
					$('.site-inner').removeClass('blur');
					$('body,html').removeClass('modal-active');
				}
			});

			$('body').on('click', '.modal .close', function(){
				$(this).parents('.modal-overlay').removeClass('active');
				$('.site-inner').removeClass('blur');
				$('body,html').removeClass('modal-active');
			});
		},

		formLabels: function() {
			$('.ginput_container select, .woocommerce .form-row select').each(function(){
				if($(this).val() !== "" && $(this).find(':selected').is(':enabled')){
					$(this).parents('.gfield, .form-row').addClass('active');
				}
			});
			$('.form-field input, .form-field textarea, .woocommerce .form-row input, .woocommerce .form-row textarea').each(function(){
				if($(this).val() !== ""){
					$(this).parents('.form-field, .form-row').addClass('active');
				}
			});

			$('body').on('change', '.ginput_container select, .woocommerce .form-row select, .list-wrap select', function(){
				//console.log('select has been changed');
				$(this).parents('.gfield, .form-row').addClass('active');
			});
			//$('.ginput_container, .form-field').find('input,textarea').bind('input', function(){
			$('body').on('input', '.ginput_container input, .ginput_container textarea, .form-field input, .form-field textarea, .woocommerce .form-row input, .woocommerce .form-row textarea', function(){
				if($(this).val() !== ''){
					$(this).parents('.gfield, .form-field, .form-row').addClass('active');
				} else {
					$(this).parents('.gfield, .form-field, .form-row').removeClass('active');
				}
			});
			$('.ginput_container, .form-field, .woocommerce .form-row').find('input.datepicker').on('change', function(){
				if($(this).val() !== ''){
					$(this).parents('.gfield, .form-field, .form-row').addClass('active');
				} else {
					$(this).parents('.gfield, .form-field, .form-row').removeClass('active');
				}
			});
		},

	};

})(jQuery);
