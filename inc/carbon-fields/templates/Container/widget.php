<div class="carbon-container">
	<?php if ( $this->has_fields() ) :  ?>
		<div class="container-holder carbon-grid container-<?php echo esc_attr($this->id); ?>" data-json="<?php echo urlencode( json_encode( $this->to_json( false ) ) ); ?>"></div>
	<?php else :
		esc_html_e( 'No options are available for this widget.', 'wise-blog' ); ?>
	<?php endif; ?>
</div>
