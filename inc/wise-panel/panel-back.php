<?php
/*
* Wise Panel Backend
*
*/

function wise_admin() { 
	global $themename, $shortname, $options;
	$i = 0;
	echo '<div id="wiseload"><div id="stats" class="animated bounce infinite"></div></div>'; // Wise Preloader
	if ( isset($_REQUEST['reset']) ) :		
		echo '<div id="message" class="updated fade"><p><strong>' . esc_html($themename) . ' settings reset.</strong></p></div>'; endif;
	if ( isset($_REQUEST['saved']) ) :
		echo '<div id="message" class="updated fade"><p><strong>' . esc_html($themename) . ' settings saved.</strong></p></div>';
		
		global $wp_filesystem, $wise_default_location, $wise_style_css, $wise_font_awesome, $wise_tabs_css, $wise_bbpress_css, $wise_owl_carousel, $wise_woocommerce_css, $wise_animate_css, $wise_pre_colors_css, $wise_column_layout, $wise_prism_css, 
		$wise_headhesive_js, $wise_superfish_js, $wise_tab_js, $wise_sticky_js, $wise_owl_js, $wise_masonry_js, $wise_retina_js, $wise_alert_js, $wise_settings_js, $wise_smooth_scroll_js, $wise_homeToggle_js, $wise_prism_js;

		if (empty($wp_filesystem)) { // Initialize WP Filesystem
			require_once ( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		/* Minified CSS */
		// all.min.css
		$str_all = wp_remote_fopen($wise_style_css); // style.css
		$str_all .= wp_remote_fopen(wise_google_fonts_settings()); // google-fonts.css
		$str_all .= wp_remote_fopen($wise_font_awesome); // font-awesome.css
		$str_all .= wp_remote_fopen($wise_tabs_css); // tab.css
		$str_all .= wp_remote_fopen($wise_owl_carousel); // owl.carousel.css
		$str_all .= wp_remote_fopen($wise_column_layout); // column.layout.css
		$str_all .= wp_remote_fopen($wise_bbpress_css); // bbpress.css			
		$str_all .= wp_remote_fopen($wise_woocommerce_css); // woocommerce.css
		$str_all .= wp_remote_fopen($wise_pre_colors_css); // predefined colors
		$str_all .= wp_remote_fopen($wise_animate_css); // animate.css
		$str_all .= wp_remote_fopen($wise_prism_css); // prism.css
		
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'css/all.min.css', wise_minify($str_all), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
						
		/* Minified JavaScript */
		// headhesive.min.js
		$str_headhesive = wp_remote_fopen($wise_headhesive_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/headhesive.min.js', wise_minify($str_headhesive), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
		// superfish.min.js
		$str_superfish = wp_remote_fopen($wise_superfish_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/superfish.min.js', wise_minify($str_superfish), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
		// sticky-kit.min.js
		$str_stickykit = wp_remote_fopen($wise_sticky_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/sticky-kit.min.js', wise_minify($str_stickykit), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
		// retina.min.js
		$str_retina = wp_remote_fopen($wise_retina_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/retina.min.js', wise_minify($str_retina), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
					
		// all-settings.min.js
		$str_settings = wp_remote_fopen($wise_settings_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/all-settings.min.js', wise_minify($str_settings), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}

		// alert.min.js
		$str_alert = wp_remote_fopen($wise_alert_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/alert.min.js', wise_minify($str_alert), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}

		// tab.min.js
		$str_tab = wp_remote_fopen($wise_tab_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/tab.min.js', wise_minify($str_tab), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
		// masonry.min.js
		$str_masonry = wp_remote_fopen($wise_masonry_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/masonry.min.js', wise_minify($str_masonry), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
		// toggle.min.js
		$str_toggle = wp_remote_fopen($wise_homeToggle_js);
		if ( ! $wp_filesystem->put_contents( $wise_default_location . 'js/toggle.min.js', wise_minify($str_toggle), 0755) ) { // FS_CHMOD_FILE permissions
			return true;
		}
		
	endif;
 
?>
	<div class="wrap wise_wrap">
	<h2><img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/wise-panel/img/wise-panel.png'); ?>" alt="Wise"><?php esc_html_e( 'Wise Panel', 'wise-blog' ); ?> <?php echo '&#124 '; esc_html_e( 'Theme Settings', 'wise-blog' ); ?></h2>
		<div class="wise_opts">
			<form method="post">
				<?php foreach ($options as $value) {
					switch ( $value['type'] ) {			 
					case "open" :
				?>
				 
				<?php break;
					case "close" :
				?>
		</div>
	</div>
	<br>
	 
	<?php break; 
	case "title" :
	?>
	 
	<?php break; 
	case 'text' :
	?>

	<div class="wise_input wise_text">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
		<input name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>" placeholder="<?php echo esc_attr($value['placeholder']); ?>" value="<?php
			if ( get_option( $value['id'] ) != "") {
				$text_value = stripslashes( get_option($value['id']) );
			} else {
				$text_value = $value['def'];
			}
				echo esc_attr($text_value);
			?>">		
		<div class="clearfix"></div>	 
	</div>

	<?php
	break;
	 
	case 'textarea' :
	?>

	<div class="wise_input wise_textarea">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
		<textarea name="<?php echo esc_attr($value['id']); ?>" placeholder="<?php echo esc_attr($value['placeholder']); ?>" type="<?php echo esc_attr($value['type']); ?>" cols=""rows=""><?php
				if ( get_option( $value['id'] ) != "") {
					$textarea_value = stripslashes( get_option($value['id']) );
				} else { 
					$textarea_value = $value['def'];
				}				
				// Like WordPress Text Widget which only allows valid user to input unfiltered html
				if ( current_user_can( 'unfiltered_html' ) ) {
					echo $textarea_value;
				} else {
					echo wp_kses_post($textarea_value);
				}
			?></textarea>
		<div class="clearfix"></div>	 
	</div>
	  
	<?php
	break;

	case 'upload' :
		?>
		<div class="wise_input wise_text">
			<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
			<input name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="text" placeholder="<?php echo esc_attr($value['placeholder']); ?>" value="<?php
				if ( get_option( $value['id'] ) != "") {
					$upload_value = stripslashes( get_option($value['id']) );
				} else {
					$upload_value = $value['def'];
				}
					echo esc_url($upload_value);
				?>">
			<input id="upload_img_button_<?php echo esc_attr($value['id']); ?>" type="button" value="<?php esc_attr_e( 'Upload', 'wise-blog' ); ?>" class="button-secondary">
			<div class="clearfix"></div>
		</div>		
		<?php
	break;
	 
	case 'select' :
	?>

	<div class="wise_input wise_select">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>	
		<select name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>">
			<option value="" disabled selected><style="color: gray;"><?php echo '&mdash; ' . esc_attr($value['placeholder']) . ' &mdash;'; ?></style></option>
		<?php foreach ($value['options'] as $option) { ?>			
			<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo esc_attr($option); ?></option><?php } ?>
		</select>	
		<div class="clearfix"></div>		
	</div>

	<?php
	break;
	 
	case "checkbox" :
	?>

	<div class="wise_input wise_checkbox">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; } else { $checked = "";} ?>
		<input type="checkbox" name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_attr($checked); ?>>
		<small><?php echo esc_attr($value['placeholder']); ?></small>
		<div class="clearfix"></div>
	</div>

	<?php
	break;

	case 'color' :
	?>

	<div class="wise_input wise_text <?php echo esc_attr($value['id']); ?>">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
		<input name="<?php echo esc_attr($value['id']); ?>" type="text" id="<?php echo esc_attr($value['id']); ?>" value="<?php
			if ( get_option( $value['id'] ) != "") {
				$color_value = stripslashes( get_option($value['id']) );
			} else {
				$color_value = $value['def'];
			}
				echo esc_attr($color_value);
			?>">
		<small class="th-color"><?php echo esc_attr($value['placeholder']); ?></small><div class="clearfix"></div>
	</div>

	<?php break; 
	case "section" :
	$i++;
	?>

	<div class="wise_section">
		<div class="wise_title"><h3><?php echo esc_attr($value['name']); ?></h3></div>
		<div class="wise_options">					 
			<?php break;			 
				} 
				}
			?>
			
			<div class="wise_buttons">
				<script>
				function showPre() {
					var preID = document.getElementById('wiseload');
					preID.style.display = "block";
					preID.fadeOut('slow');
				}
				</script>
				<div class="save-button button-2">
					<input name="save<?php echo esc_attr($i); ?>" type="submit" value="Save changes" onclick="showPre()">
					<input type="hidden" name="action" value="save">
				</div>
				</form>					
				<form method="post">
					<div class="reset-button button-2">
					<input name="reset" type="submit" value="Warning: Reset" onclick="showPre()">
					<input type="hidden" name="action" value="reset">
					</div>
				</form>
			</div><!-- .wise_buttons -->

		</div> <!-- .wise_option -->
		
	</div>
	<?php wise_panel_fields();
} // End Wise Admin Backend
?>