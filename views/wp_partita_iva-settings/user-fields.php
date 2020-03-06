<h3>wp_partita_iva User Fields</h3>

<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="wp_partita_iva_user--field1"> Field 1</label>
		</th>

		<td>
			<input id="wp_partita_iva_user--field1" name="wp_partita_iva_user--field1" type="text" class="regular-text" value="<?php esc_attr_e( get_user_meta( $user->ID, 'wp_partita_iva_user--field1', true ) ); ?>" />
			<span class="description"> description.</span>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<label for="wp_partita_iva_user--field2"> Field 2</label>
		</th>

		<td>
			<input id="wp_partita_iva_user--field2" name="wp_partita_iva_user--field2" type="text" class="regular-text" value="<?php esc_attr_e( get_user_meta( $user->ID, 'wp_partita_iva_user--field2', true ) ); ?>" />
			<span class="description"> description.</span>
		</td>
	</tr>
</table>
