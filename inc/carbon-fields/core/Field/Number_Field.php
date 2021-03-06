<?php

namespace Carbon_Fields\Field;

/**
 * Number field class.
 */
class Number_Field extends Field {
	/**
	 * Underscore template of this field.
	 */
	public function template() {
		?>
		<input id="{{{ id }}}" type="number" step="1" min="1" size="3" name="{{{ name }}}" value="{{ value }}" class="maximum-text" />
		<?php
	}
}