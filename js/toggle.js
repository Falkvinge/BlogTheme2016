/*
* Wise Toggle
*
*/

jQuery(document).ready(function($){
	"use strict";
	
	/* Search Main */
	$(".search-top").click(function(){
		$("#search-cont").slideToggle('slow', function(){
			$(".search-top a").toggleClass("active");
		});
		return false;
	});

	/* Search Headhesive */
	$(".search-iconhead").click(function(){
		$("#search-conthead").toggle('slide');
		$(".search-iconhead a").toggleClass('active');
		return false;
	});

	/* reset toggle if scrolled to top */
	$(document).scroll(function(){
		var offsetTop = 180;
		if($(document).scrollTop() <= offsetTop)
		{
			$("#search-conthead").hide();
			$(".search-iconhead a").removeClass('active');
		}
	});

	/* Social Menu */
	$(".headhesive-social").click(function(){
		$("#share-top").slideToggle('slow');
		$(".headhesive-social a").toggleClass('active');
		return false;
	});

	/* reset toggle if scrolled to top */
	$(document).scroll(function(){
		var offsetSoc = 180;
		if($(document).scrollTop() <= offsetSoc)
		{
			$("#share-top").hide();
			$(".headhesive-social a").removeClass('active');
		}
	});

	/* Responsive Main Menu */
	$(".res-button").click(function(){
		$("#res-nav").slideToggle('slow', function(){
			$(".res-button a").toggleClass("active");
		});
		return false;
	});

	$(".res-close").click(function(){
		$(".res-button").click();
		return false;
	});

	/* Responsive Secondary Menu */
	$(".res-button-top").click(function(){
		$("#res-nav-top").slideToggle('slow', function(){
			$(".res-button-top a").toggleClass("active");
		});
		return false;
	});

	$(".res-close-top").click(function(){
		$(".res-button-top").click();
		return false;
	});
	
}); /* End jQuery */