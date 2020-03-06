<?php
/*
 * Basic Section
 */
?>

<?php if ( 'wp_partita_iva_field-1' == $field['label_for'] ) : ?>

	<input id="<?php esc_attr_e( 'wp_partita_iva_settings[basic][field-1]' ); ?>" name="<?php esc_attr_e( 'wp_partita_iva_settings[basic][field-1]' ); ?>" class="regular-text" value="<?php esc_attr_e( $settings['basic']['field-1'] ); ?>" />
	<span class="">  value</span>

<?php endif; ?>


<?php
/*
 * Advanced Section
 */
?>

<?php if ( 'wp_partita_iva_field-2' == $field['label_for'] ) : ?>

	<textarea id="<?php esc_attr_e( 'wp_partita_iva_settings[advanced][field-2]' ); ?>" name="<?php esc_attr_e( 'wp_partita_iva_settings[advanced][field-2]' ); ?>" class="large-text"><?php echo esc_textarea( $settings['advanced']['field-2'] ); ?></textarea>
	<p class="description">This is an  of a longer explanation.</p>

<?php elseif ( 'wp_partita_iva_field-3' == $field['label_for'] ) : ?>

	<p>Another </p>

<?php endif; ?>
