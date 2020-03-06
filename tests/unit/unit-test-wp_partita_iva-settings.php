<?php

require_once( WP_PLUGIN_DIR . '/simpletest-for-wordpress/WpSimpleTest.php' );
require_once( dirname( dirname( __DIR__ ) ) . '/classes/wp_partita_iva-settings.php' );

/**
 * Unit tests for the wp_partita_iva_Settings class
 *
 * Uses the SimpleTest For WordPress plugin
 *
 * @link http://wordpress.org/extend/plugins/simpletest-for-wordpress/
 */
if ( ! class_exists( 'UnitTestwp_partita_iva_Settings' ) ) {
	class UnitTestwp_partita_iva_Settings extends UnitTestCase {
		public function __construct() {
			$this->wp_partita_iva_Settings = wp_partita_iva_Settings::get_instance();
		}

		/*
		 * validate_settings()
		 */
		public function test_validate_settings() {
			// Valid settings
			$this->wp_partita_iva_Settings->init();
			$valid_settings = array(
				'basic'    => array(
					'field-1' => 'valid data'
				),

				'advanced' => array(
					'field-2' => 5
				)
			);

			$clean_settings = $this->wp_partita_iva_Settings->validate_settings( $valid_settings );

			$this->assertEqual( $valid_settings['basic']['field-1'], $clean_settings['basic']['field-1'] );
			$this->assertEqual( $valid_settings['advanced']['field-2'], $clean_settings['advanced']['field-2'] );


			// Invalid settings
			$this->wp_partita_iva_Settings->init();
			$invalid_settings = array(
				'basic'    => array(
					'field-1' => 'invalid data'
				),

				'advanced' => array(
					'field-2' => - 5
				)
			);

			$clean_settings = $this->wp_partita_iva_Settings->validate_settings( $invalid_settings );
			$this->assertNotEqual( $invalid_settings['basic']['field-1'], $clean_settings['basic']['field-1'] );
			$this->assertNotEqual( $invalid_settings['advanced']['field-2'], $clean_settings['advanced']['field-2'] );
		}

		/*
		 * __set()
		 */
		public function test_magic_set() {
			// Test that fields are validated
			$this->wp_partita_iva_Settings->init();
			$this->wp_partita_iva_Settings->settings = array( 'db-version' => array() );
			$this->assertEqual( $this->wp_partita_iva_Settings->settings['db-version'], WordPress_Partita_IVA::VERSION );

			// Test that values gets written to database
			$this->wp_partita_iva_Settings->settings = array( 'db-version' => '5' );
			$this->wp_partita_iva_Settings->init();
			$this->assertEqual( $this->wp_partita_iva_Settings->settings['db-version'], '5' );
			$this->wp_partita_iva_Settings->settings = array( 'db-version' => WordPress_Partita_IVA::VERSION );

			// Test that setting deep values triggers error
			$this->expectError( new PatternExpectation( '/Indirect modification of overloaded property/i' ) );
			$this->wp_partita_iva_Settings->settings['db-version'] = WordPress_Partita_IVA::VERSION;
		}
	} // end UnitTestwp_partita_iva_Settings
}

?>