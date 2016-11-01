/*
* Wise Panel Admin JS
*
*/
  
jQuery(document).ready(function($){
	"use strict";
	
	/* Color Picker */  
	$(function() {
		$('#wise_hline_color').wpColorPicker();
		$('#wise_button_color').wpColorPicker();
		$('#wise_text_color').wpColorPicker();
		$('#wise_line_color').wpColorPicker();
		$('#wise_def_preload_color').wpColorPicker();
	});

	/* Drop Accordion */
	$('.wise_options').slideUp();        
	$('.wise_section h3').click(function(){ 		
		if($(this).parent().next('.wise_options').css('display')==='none') {
			$(this).removeClass('inactive').addClass('active').removeClass('inactive').addClass('active');
		} else {
			$(this).removeClass('active').addClass('inactive').removeClass('active').addClass('inactive'); }                 
		$(this).parent().next('.wise_options').slideToggle('slow');  
	});

	/* Media Upload */
	var formID = '';
	var formID_video = '';
	var formID_audio = '';
	var formID_file = '';

	// Favicon
	$('#upload_img_button_wise_favicon').click(function() {
		formID = jQuery('#wise_favicon').attr('name');
		tb_show('Upload Favicon', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});
	
	// Preloader
	$('#upload_img_button_wise_preload').click(function() {
		formID = jQuery('#wise_preload').attr('name');
		tb_show('Upload Preloader', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Background Image
	$('#upload_img_button_wise_mainback').click(function() {
		formID = jQuery('#wise_mainback').attr('name');
		tb_show('Upload Background Image', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Header Logo
	$('#upload_img_button_wise_header_logo').click(function() {
		formID = jQuery('#wise_header_logo').attr('name');
		tb_show('Upload Header Logo', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});
	
	// Header Logo @2x
	$('#upload_img_button_wise_header_logo_hq').click(function() {
		formID = jQuery('#wise_header_logo_hq').attr('name');
		tb_show('Upload Header Logo @2x', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Headhesive Logo
	$('#upload_img_button_wise_headhesive_logo').click(function() {
		formID = jQuery('#wise_headhesive_logo').attr('name');
		tb_show('Upload Headhesive Logo', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});
	
	// Headhesive Logo @2x
	$('#upload_img_button_wise_headhesive_logo_hq').click(function() {
		formID = jQuery('#wise_headhesive_logo_hq').attr('name');
		tb_show('Upload Headhesive Logo @2x', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Custom Login Form Logo
	$('#upload_img_button_wise_login_image_url').click(function() {
		formID = jQuery('#wise_login_image_url').attr('name');
		tb_show('Upload Custom Login Form Logo', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Footer Logo
	$('#upload_img_button_wise_footer_logo_url').click(function() {
		formID = jQuery('#wise_footer_logo_url').attr('name');
		tb_show('Upload Footer Logo', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});
	
	// Footer Logo @2x
	$('#upload_img_button_wise_footer_logo_url_hq').click(function() {
		formID = jQuery('#wise_footer_logo_url_hq').attr('name');
		tb_show('Upload Footer Logo @2x', 'media-upload.php?referer=wise-settings&type=image&TB_iframe=true&post_id=0', false);
		return false;
	});

	// Send Editor
	var original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
		if( formID ) { // image
			var fileURL = jQuery(html).attr('src');
			if (typeof(fileURL)==="undefined") {
				fileURL = jQuery('img',html).attr('src');
			}
			jQuery('#' + formID).val(fileURL);
			tb_remove();
			formID = '';
		} 
		
		else if( formID_video ) { // video
			var fileURL_video = jQuery(html).attr('href');
			if (typeof(fileURL_video)==="undefined") {
				fileURL_video = jQuery('video',html).attr('href');
			}
			jQuery('#' + formID_video).val(fileURL_video);
			tb_remove();
			formID_video = '';
		} 
		
		else if( formID_audio ) { // audio
			var fileURL_audio = jQuery(html).attr('href');
			if (typeof(fileURL_audio)==="undefined") {
				fileURL_audio = jQuery('audio',html).attr('href');
			}
			jQuery('#' + formID_audio).val(fileURL_audio);
			tb_remove();
			formID_audio = '';
		}
		
		else if( formID_file ) { // file
			var fileURL_file = jQuery(html).attr('href');
			if (typeof(fileURL_file)==="undefined") {
				fileURL_file = jQuery('file',html).attr('href');
			}
			jQuery('#' + formID_file).val(fileURL_file);
			tb_remove();
			formID_file = '';
		} 
		
		else {
			original_send_to_editor(html);
		}
	}
	
}); /* End jQuery */