/*
* Masonry Settings
*
*/

jQuery(document).ready(function($){
	"use strict";
	
	/* Latest and Featured Posts */
	var $contList = $('.index-wrapper-grid');
	$contList.imagesLoaded(function() {
		$contList.masonry({
		   itemSelector: '.index-divider-grid',
		   isAnimated: true
		});
	});

	/* Related Posts */
	var $contRel = $('#related-lists');
	$contRel.imagesLoaded(function() {
		$contRel.masonry({
		   itemSelector: '.related-post-thumb',
		   isAnimated: true
		});
	});
	
	/* Complex 3 */
	var $contCompt = $('#compsub2-1');
	$contCompt.imagesLoaded(function() {
		$contCompt.masonry({
		   itemSelector: '.index-divider-compsub',
		   isAnimated: true
		});
	});

	/* Complex 4 */
	var $contComp = $('#comp4');
	$contComp.imagesLoaded(function() {
		$contComp.masonry({
		   itemSelector: '.comp-grid-3',
		   isAnimated: true
		});
	});

	/* Footer */
	var $contFooter = $('#footer-widgets');
	$contFooter.imagesLoaded(function() {
		$contFooter.masonry({
		   itemSelector: '.widget',
		   isAnimated: true
		});
	});

	/* Sidebar with Break Point */
	var $contRight = $('.widget-area-right');
	var greatbreak = 947;
	var greatless = 662;

	if (($(document).width() < greatbreak) && ($(document).width() > greatless)) {
		$contRight.imagesLoaded(function() {
			$contRight.masonry({
			   itemSelector: '.widget',
			   isAnimated: true
			});
		});
	}
	else {
	   $contRight.masonry().masonry('destroy');
	}
	
}); /* End jQuery */