<?php

namespace Carbon_Fields\Field;

/**
 * Broken field class.
 */
class Broken_Field extends Field {

	public function template() {
		esc_attr_e( 'This field is misconfigured', 'wise-blog' );

		parent::template();
	}
}
