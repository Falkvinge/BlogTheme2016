/*
* jQuery Settings
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. BACK TO TOP SETTINGS
2. OWL CAROUSEL SETTINGS
3. SMOOTH SCROLLING SETTINGS
4. SKIP LINKS SETTINGS
5. SUPERFISH SETTINGS
6. PRELOADER SETTINGS
7. RETINA SETTINGS
--------------------------------------------------------------*/

jQuery(document).ready(function($){
	"use strict";
	
	/*--------------------------------------------------------------
	1. BACK TO TOP SETTINGS
	--------------------------------------------------------------*/
	var offset = 300,
		offset_opacity = 1200,
		scroll_top_duration = 700,
		$back_to_top = $('.cd-top');

	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
			}, scroll_top_duration
		);
	});

	/*--------------------------------------------------------------
	2. OWL CAROUSEL SETTINGS
	--------------------------------------------------------------*/
	$('.owl-wrapper-outer').toggleClass('animated fadeIn show');
	$("#wise-defaults").owlCarousel({
	  navigation : true,
	  slideSpeed : 300,
	  paginationSpeed : 400,
	  singleItem: true,
	  autoPlay: 4000,
	  navigationText : false,
	  pagination: true
	});
	
	$('.wise-ticker').toggleClass('animated fadeIn show');
	$("#wise-ticker").owlCarousel({
	  navigation : true,
	  slideSpeed : 300,
	  singleItem: true,
	  autoPlay: 3000,
	  navigationText : false,
	  pagination: false,
	  transitionStyle: "fade"
	});

	/*--------------------------------------------------------------
	3. SMOOTH SCROLLING SETTINGS
	--------------------------------------------------------------*/
	/* Initialize smooth scroll */
	smoothScroll.init({
		selector: '[data-scroll]', /* Selector for links (must be a valid CSS selector) */
		selectorHeader: '[data-scroll-header]', /* Selector for fixed headers (must be a valid CSS selector) */
		speed: 1000, /* Integer. How fast to complete the scroll in milliseconds */
		easing: 'easeInOutCubic', /* Easing pattern to use */
		offset: 54, /* Integer. How far to offset the scrolling anchor location in pixels */
		updateURL: false, /* Boolean. If true, update the URL hash on scroll */
		callback: function ( anchor, toggle ) {} /* Function to run after scrolling */
	});
	
	/* Animate to other page */
    if ( window.location.hash ) {
        var hash = smoothScroll.escapeCharacters( window.location.hash ); /* Escape the hash */
        var toggle = document.querySelector( 'a[href*="' + hash + '"]' ); /* Get the toggle (if one exists) */
        var options = { offset: 167 }; /* Any custom options you want to use would go here */
        smoothScroll.animateScroll( hash, toggle, options );
    }
	
	/* WooCommerce Tabs */
	$('.woocommerce-product-rating a').attr('data-scroll',''); /* for WooCommerce review */
	$(".woocommerce-tabs ul li a[href^='#']").attr('data-scroll',''); /* for WooCommerce tabs */
	$(".woocommerce-tabs ul li a[href^='#']").attr('data-options','{"offset": 157}'); /* tab offset */

	/*--------------------------------------------------------------
	4. SKIP LINKS
	--------------------------------------------------------------*/
	( function() { var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1, is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1, is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;  if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) { window.addEventListener( 'hashchange', function() { var id = location.hash.substring( 1 ), element;  if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) { return; }  element = document.getElementById( id );  if ( element ) { if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) { element.tabIndex = -1; }  element.focus(); } }, false ); } })();

	/*--------------------------------------------------------------
	5. SUPERFISH SETTINGS
	--------------------------------------------------------------*/
	var sf = $('.response-nav ul'); sf.superfish('destroy'); 
	var sf = $('.main-navigation ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true }); 
	var sf = $('.headhesive-menu ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true });
	var sf = $('.secondary-menu ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true });

	/*--------------------------------------------------------------
	6. WISE PRELOADER SETTINGS
	--------------------------------------------------------------*/
	$('#stats').fadeOut('slow');
	$('#wiseload').delay(500).fadeOut('slow'); 
	$('body').delay(500).css({'overflow':'visible'});
	
	/*--------------------------------------------------------------
	7. RETINA SETTINGS
	--------------------------------------------------------------*/
	$('.home-index-thumb img').attr('data-no-retina','');
	$('.home-index-thumb-grid img').attr('data-no-retina','');
	$('.feat-home-index-thumb-cover img').attr('data-no-retina','');
	$('.widget img').attr('data-no-retina','');
	$('.site-main img').attr('data-no-retina','');
	$('#stats img').attr('data-no-retina','');
	
	/* Enable retina for ads and about logo */
	$('.ads-layout_top img').removeAttr('data-no-retina');
	$('.ads-layout_bottom img').removeAttr('data-no-retina');
	$('.widget_ads_widget img').removeAttr('data-no-retina');
	$('.about-logo img').removeAttr('data-no-retina');
	
}); /* End jQuery */