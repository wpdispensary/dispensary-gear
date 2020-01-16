<?php

/**
 * The Class responsible for defining the custom permalink settings.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.4.0
 *
 * @package    WPD_Gear
 * @subpackage WPD_Gear/admin
 */
class WPD_Gear_Permalink_Settings {
	/**
	 * Initialize class.
	 */
	public function __construct() {
		$this->init();
		$this->settings_save();
	}

	/**
	 * Call register fields.
	 */
	public function init() {
		add_filter( 'admin_init', array( &$this, 'register_fields' ) );
	}

	/**
	 * Add setting to permalinks page.
	 */
	public function register_fields() {
		register_setting( 'permalink', 'wpd_gear_slug', 'esc_attr' );
		add_settings_field( 'wpd_gear_slug_setting', '<label for="wpd_gear_slug">' . esc_html__( 'Gear Base', 'wpd-gear' ) . '</label>', array( &$this, 'fields_html' ), 'permalink', 'optional' );
	}

	/**
	 * HTML for permalink setting.
	 */
	public function fields_html() {
		$value = get_option( 'wpd_gear_slug' );
		wp_nonce_field( 'wpd-gear-slug', 'wpd_gear_slug_nonce' );
		echo '<input type="text" class="regular-text code" id="wpd_gear_slug" name="wpd_gear_slug" placeholder="gear" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * Save permalink settings.
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ||
			 isset( $_POST['category_base'] ) &&
			 isset( $_POST['wpd_gear_slug'] ) &&
			 wp_verify_nonce( wp_unslash( $_POST['wpd_gear_slug_nonce'] ), 'wpd-gear' ) ) {
				$wpd_gear_slug = sanitize_title( wp_unslash( $_POST['wpd_gear_slug'] ) );
				update_option( 'wpd_gear_slug', $wpd_gear_slug );
		}
	}
}
$wpd_gear_permalink_settings = new WPD_Gear_Permalink_Settings();
