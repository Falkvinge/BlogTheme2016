<tr class="carbon-table-row <?php echo esc_attr($this->is_tabbed()) ? '' : 'carbon-fields-collection' ?>">
	<td></td>
	<td>
		<div id="<?php echo esc_attr($this->id); ?>" class="container-holder carbon-term-container <?php echo ! empty( $_GET['tag_ID'] ) ? 'edit-term-container' : 'add-term-container'; ?> container-<?php echo esc_attr($this->id); ?>"></div> 
		<?php echo $this->get_nonce_field(); ?>
	</td>
</tr>
