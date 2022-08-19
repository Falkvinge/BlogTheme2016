/*
* Wise Toggle
*
*/

jQuery(document).ready(function($){
	"use strict";
	
	/* Search Main */
	$(".search-top").on('click',function(){
		$("#search-cont").slideToggle('slow', function(){
			$(".search-top a").toggleClass("active");
		});
		return false;
	});

	/* Search Headhesive */
	$(".search-iconhead").on('click',function(){
		$("#search-conthead").toggle('slide');
		$(".search-iconhead a").toggleClass('active');
		return false;
	});

	/* reset toggle if scrolled to top */
	$(document).on('scroll',function(){
		var offsetTop = 180;
		if($(document).scrollTop() <= offsetTop)
		{
			$("#search-conthead").hide();
			$(".search-iconhead a").removeClass('active');
		}
	});

	/* Social Menu */
	$(".headhesive-social").on('click',function(){
		$("#share-top").slideToggle('slow');
		$(".headhesive-social a").toggleClass('active');
		return false;
	});

	/* reset toggle if scrolled to top */
	$(document).on('scroll',function(){
		var offsetSoc = 180;
		if($(document).scrollTop() <= offsetSoc)
		{
			$("#share-top").hide();
			$(".headhesive-social a").removeClass('active');
		}
	});

	/* Responsive Main Menu */
	$(".res-button").on('click',function(){
		$("#res-nav").slideToggle('slow', function(){
			$(".res-button a").toggleClass("active");
			$(".wise-primary-menu .sub-menu").slideUp("slow");
			$(".wise-primary-menu .menu-item-has-children a span").removeClass("active");
		});
		return false;
	});

	$(".res-close").on('click',function(){
		$(".res-button").on('click',);
		return false;
	});

	/* Responsive Secondary Menu */
	$(".res-button-top").on('click',function(){
		$("#res-nav-top").slideToggle('slow', function(){
			$(".res-button-top a").toggleClass("active");
			$(".wise-secondary-menu .sub-menu").slideUp("slow");
			$(".wise-secondary-menu .menu-item-has-children a span").removeClass("active");
		});
		return false;
	});

	$(".res-close-top").on('click',function(){
		$(".res-button-top").on('click',);
		return false;
	});

	/* Sub-menu fix */
	$(".menu-item-has-children > a").append('<span></span>');
	$(".menu li.menu-item-has-children").each(function(index) {
		$(this).attr("id", "menuid-" + index); /* add ID on each li */
		$("#menuid-" + index + " > a span").on('click',function(){
			$("#menuid-" + index + " > .sub-menu").slideToggle('slow', function(){				
				$("#menuid-" + index + " > a span").toggleClass("active");
			});		
			return false;
		});
	});
	
}); /* End jQuery */