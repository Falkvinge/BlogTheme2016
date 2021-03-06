<?php

namespace Carbon_Fields\Field;

/**
 * HTML field class.
 * Allows to create a field that displays any HTML in a container.
 */
class Html_Field extends Field {
	public $field_html;

	/**
	 * Set the field HTML or callback that returns the HTML.
	 * @param string|callable $callback_or_html HTML or callable that returns the HTML.
	 */
	public function set_html( $callback_or_html ) {
		if ( is_callable( $callback_or_html ) ) {
			$this->field_html = call_user_func( $callback_or_html );
		} else {
			$this->field_html = $callback_or_html;
		}

		return $this;
	}

	/**
	 * Returns an array that holds the field data, suitable for JSON representation.
	 * This data will be available in the Underscore template and the Backbone Model.
	 *
	 * @param bool $load  Should the value be loaded from the database or use the value from the current instance.
	 * @return array
	 */
	public function to_json( $load ) {
		$field_data = parent::to_json( $load );

		$field_data = array_merge( $field_data, array(
			'html' => $this->field_html,
		) );

		return $field_data;
	}

	/**
	 * Underscore template of this field
	 */
	public function template() {
		?>
		{{{ html }}}
		<?php
	}

	/**
	 * Whether this field is required.
	 * The HTML field is non-required by design.
	 *
	 * @return false
	 */
	public function is_required() {
		return false;
	}

	/**
	 * Retrieve field label.
	 * The label for the HTML field is hidden by design.
	 *
	 * @return string
	 */
	public function get_label() {
		return '';
	}

	/**
	 * Load the field value.
	 * Skipped, no value to be loaded.
	 */
	public function load() {
		// skip;
	}

	/**
	 * Save the field value.
	 * Skipped, no value to be saved.
	 */
	public function save() {
		// skip;
	}

	/**
	 * Delete the field value.
	 * Skipped, no value to be deleted.
	 */
	public function delete() {
		// skip;
	}
}
