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
		echo '<div id="message" class="updated fade"><p><strong>' . esc_html($themename) . ' settings saved.</strong></p></div>'; endif; 
?>
	<div class="wrap wise_wrap">
	<h2><img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/wise-panel/img/wise-panel.png'); ?>" alt="<?php echo esc_html__( 'Wise', 'wise-blog' ); ?>"><?php esc_html_e( 'Wise Panel', 'wise-blog' ); ?> <?php echo '&#124 '; esc_html_e( 'Theme Settings', 'wise-blog' ); ?></h2>
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
	
	<?php break; 
	case 'number' :
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
			?>" step="1" min="1" size="3">
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
				echo esc_textarea($textarea_value);
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
	<div class="wise_input clear">
		<label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
		<div class="wise-switch">
			<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; } else { $checked = "";} ?>
			<input type="checkbox" name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" value="true"  class="wise-switch-checkbox" <?php echo esc_attr($checked); ?>>
			<label class="wise-switch-label" for="<?php echo esc_attr($value['id']); ?>"></label>
		</div>
		<small><?php echo esc_attr($value['placeholder']); ?></small>
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