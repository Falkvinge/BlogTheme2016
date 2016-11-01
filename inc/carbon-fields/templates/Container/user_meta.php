<h3><?php echo esc_html($this->title); ?></h3>
<table class="form-table">
	<tr class="carbon-table-row">
		<th></th>
		<td>
			<div id="<?php echo esc_attr($this->id); ?>" class="container-holder carbon-user-container container-<?php echo esc_attr($this->id); ?> <?php echo esc_attr($this->is_tabbed()) ? '' : 'carbon-fields-collection' ?>" data-profile-role="<?php echo esc_attr($profile_role); ?>"></div>
			<?php printf( $this->get_nonce_field() ); ?>
		</td>
	</tr>
</table>
