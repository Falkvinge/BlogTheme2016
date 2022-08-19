/*
* jQuery Settings
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. BACK TO TOP SETTINGS
2. OWL CAROUSEL SETTINGS
3. SKIP LINKS SETTINGS
4. SUPERFISH SETTINGS
5. PRELOADER SETTINGS
6. RETINA SETTINGS
7. TABS SETTINGS
8. TRIM LONG TITLES
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

	$(window).on('scroll',function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0,
			}, scroll_top_duration
		);
	});

	/*--------------------------------------------------------------
	2. OWL CAROUSEL SETTINGS
	--------------------------------------------------------------*/
	$('.owl-wrapper-outer').toggleClass('animated fadeIn show');

	/*--------------------------------------------------------------
	3. SKIP LINKS
	--------------------------------------------------------------*/
	( function() { var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1, is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1, is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;  if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) { window.addEventListener( 'hashchange', function() { var id = location.hash.substring( 1 ), element;  if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) { return; }  element = document.getElementById( id );  if ( element ) { if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) { element.tabIndex = -1; }  element.focus(); } }, false ); } })();

	/*--------------------------------------------------------------
	4. SUPERFISH SETTINGS
	--------------------------------------------------------------*/
	var sf = $('.response-nav ul'); sf.superfish('destroy'); 
	var sf = $('.main-navigation ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true }); 
	var sf = $('.headhesive-menu ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true });
	var sf = $('.secondary-menu ul.menu'); sf.superfish({ delay: 200, speed: 'slow', cssArrows: true });

	/*--------------------------------------------------------------
	5. WISE PRELOADER SETTINGS
	--------------------------------------------------------------*/
	$('#stats').fadeOut('slow');
	$('#wiseload').delay(500).fadeOut('slow'); 
	$('body').delay(500).css({'overflow':'visible'});
	
	/*--------------------------------------------------------------
	6. RETINA SETTINGS
	--------------------------------------------------------------*/
	/* Basic Elements */
	$('.site-branding img').attr('data-has-retina','');
	$('.headhesive img').attr('data-has-retina','');
	$('.about-logo img').attr('data-has-retina','');
	$('.img-footer img').attr('data-has-retina','');
	$('.cd-top img').attr('data-has-retina','');
	
	/* AD Layout */
	$('.ads-layout_sidebar img').attr('data-has-retina','');
	$('.ads-layout_top img').attr('data-has-retina','');
	$('.ads-layout_top_two img').attr('data-has-retina','');
	$('.ads-layout_bottom img').attr('data-has-retina','');
	$('.ads-layout_both img').attr('data-has-retina','');
	$('.ads-layout_none img').attr('data-has-retina','');
	
	/*--------------------------------------------------------------
	7. TABS SETTINGS
	--------------------------------------------------------------*/	
	$('.tab-sidebar').tabs({
		active: 0
	});

	/*--------------------------------------------------------------
	8. TRIM LONG TITLES
	--------------------------------------------------------------*/
	/* Wise Ticker */
	var windoWidth = $(window).width();

	if( windoWidth >= 1261 ){
		$('.wise-ticker-title a').each(function() {
			if ($(this).text().length > 98) {
				$(this).text($(this).text().substr(0, 98));
				$(this).append('...');
			}
		});
	} else if( (windoWidth <= 1260) && (windoWidth >= 964) ) {
		$('.wise-ticker-title a').each(function() {
			if ($(this).text().length > 72) {
				$(this).text($(this).text().substr(0, 72));
				$(this).append('...');
			}
		});
	} else if( (windoWidth <= 970) && (windoWidth >= 731) ) {
		$('.wise-ticker-title a').each(function() {
			if ($(this).text().length > 48) {
				$(this).text($(this).text().substr(0, 48));
				$(this).append('...');
			}
		});
	} else if( windoWidth <= 730 ) {
		$('.wise-ticker-title a').each(function() {
			$(this).text();
		});
	} else {
		return;
	}

	$(window).on('resize',function() {
		var windoWidth = $(window).width();

		if( windoWidth > 1261 ){
			$('.wise-ticker-title a').each(function() {
				if ($(this).text().length > 98) {
					$(this).text($(this).text().substr(0, 98));
					$(this).append('...');
				}
			});
		} else if( (windoWidth <= 1260) && (windoWidth >= 964) ) {
			$('.wise-ticker-title a').each(function() {
				if ($(this).text().length > 72) {
					$(this).text($(this).text().substr(0, 72));
					$(this).append('...');
				}
			});
		} else if( (windoWidth <= 970) && (windoWidth >= 731) ) {
			$('.wise-ticker-title a').each(function() {
				if ($(this).text().length > 48) {
					$(this).text($(this).text().substr(0, 48));
					$(this).append('...');
				}
			});
		} else if( windoWidth <= 730 ) {
			$('.wise-ticker-title a').each(function() {
				$(this).text();
			});
		} else {
			return;
		}	
	}); /* End resize function*/
	
}); /* End jQuery */