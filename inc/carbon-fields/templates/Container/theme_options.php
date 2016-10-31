<div class="wrap carbon-theme-options">
	<h2><?php echo esc_html($this->title); ?></h2>

	<?php if ( $this->errors ) :  ?>
		<div class="error settings-error">
			<?php foreach ( $this->errors as $error ) :  ?>
				<p><strong><?php echo esc_html($error); ?></strong></p>
			<?php endforeach ?>
		</div>
	<?php elseif ( $this->notifications ) :  ?>
		<?php foreach ( $this->notifications as $notification ) :  ?>
			<div class="settings-error updated">
				<p><strong><?php echo esc_html($notification); ?></strong></p>
			</div>
		<?php endforeach ?>
	<?php endif; ?>

	<form method="post" id="theme-options-form" enctype="multipart/form-data" action="">
		<?php printf( $this->get_nonce_field() ); ?>

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="postbox carbon-box" id="<?php echo esc_attr($this->id); ?>">
						<div class="inside container-holder carbon-grid theme-options-container container-<?php echo esc_attr($this->id); ?> <?php echo esc_attr($this->is_tabbed()) ? '' : 'carbon-fields-collection' ?>"></div>
					</div>
				</div>

				<div id="postbox-container-1" class="postbox-container">
					<div id="submitdiv" class="postbox">
						<h3><?php esc_html_e( 'Actions', 'wise-blog' ); ?></h3>
						
						<div id="major-publishing-actions">

							<div id="publishing-action">
								<span class="spinner"></span>

								<?php
									$filter_name  = 'carbon_' . str_replace( '-', '_', sanitize_title( $this->title ) ) . '_button_label';
									$button_label = apply_filters( $filter_name, esc_attr__( 'Save Changes', 'wise-blog' ) );
								?>

								<input type="submit" value="<?php echo esc_attr( $button_label ); ?>" name="publish" id="publish" class="button button-primary button-large">
							</div>
							
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
