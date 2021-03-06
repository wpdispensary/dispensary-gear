<?php

/**
 * The metabox functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Gear
 * @subpackage WPD_Gear/admin
 */

/**
 * Prices metabox for the following menu types:
 * Pre-rolls, Edibles, Growers
 *
 * Adds a price metabox to all of the above custom post types
 *
 * @since    1.0.0
 */
function wpd_gear_pricing_metaboxes() {

	$screens = array( 'gear' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpd_gear_prices',
			__( 'Product Pricing', 'wpd-gear' ),
			'wpd_gear_prices',
			$screen,
			'normal',
			'default'
		);
	}
}
add_action( 'add_meta_boxes', 'wpd_gear_pricing_metaboxes' );

/**
 * Single Prices
 */
function wpd_gear_prices() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="gearpricesmeta_noncename" id="gearpricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$priceeach    = get_post_meta( $post->ID, '_priceeach', true );
	$priceperpack = get_post_meta( $post->ID, '_priceperpack', true );
	$unitsperpack = get_post_meta( $post->ID, '_unitsperpack', true );

	/** Echo out the fields */
	echo '<div class="gearbox">';
	echo '<p>' . esc_attr__( 'Price per unit:', 'wpd-gear' ) . '</p>';
	echo '<input type="text" name="_priceeach" value="' . esc_html( $priceeach ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="gearbox">';
	echo '<p>' . esc_attr__( 'Price per pack:', 'wpd-gear' ) . '</p>';
	echo '<input type="text" name="_priceperpack" value="' . esc_html( $priceperpack ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="gearbox">';
	echo '<p>' . esc_attr__( 'Units per pack:', 'wpd-gear' ) . '</p>';
	echo '<input type="number" name="_unitsperpack" value="' . esc_html( $unitsperpack ) . '" class="widefat" />';
	echo '</div>';
}

/**
 * Save the Metabox Data
 */
function wpd_gear_prices_save_meta( $post_id, $post ) {
	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( ! isset( $_POST['gearpricesmeta_noncename' ] ) || ! wp_verify_nonce( $_POST['gearpricesmeta_noncename'], plugin_basename( __FILE__ ) ) ) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$prices_meta['_priceeach']    = esc_html( $_POST['_priceeach'] );
	$prices_meta['_priceperpack'] = esc_html( $_POST['_priceperpack'] );
	$prices_meta['_unitsperpack'] = esc_html( $_POST['_unitsperpack'] );

	/** Add values of $prices_meta as custom fields */

	foreach ( $prices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpd_gear_prices_save_meta', 1, 2 ); /** Save the custom fields */

/**
 * Function to add Top Sellers metabox to "Gear" menu type
 *
 * @since    1.8.0
 */
function wpd_gear_topsellers( $array ) {
    $array[] = 'gear';
    return $array;
}
add_filter( 'wpd_top_sellers_metabox', 'wpd_gear_topsellers' );
