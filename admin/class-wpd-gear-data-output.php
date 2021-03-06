<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Gear
 * @subpackage WPD_Gear/admin
 */

/**
 * Function to add "Gear" to data output
 */
function wpd_gear_priceoutput( $array ) {
    $array[] = 'gear';
    return $array;
}
add_filter( 'wpd_original_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_content_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_before_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_title_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_top_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_bottom_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_end_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_dataoutput_after_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_before_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_title_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_top_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_bottom_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_end_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricingoutput_after_array', 'wpd_gear_priceoutput' );
add_filter( 'wpd_pricing_table_placement_array', 'wpd_gear_priceoutput' );

/**
 * Function to add vendor taxonomy to "Gear" menu type
 *
 * @since    1.2.0
 */
function wpd_gear_vendor( $array ) {
    $array[] = 'gear';
    return $array;
}
add_filter( 'wpd_vendor_tax_type', 'wpd_gear_vendor' );

/**
 * Action Hooks
 *
 * This is the file responsible for adding the gear data to menu
 * item pricing tables.
 *
 * @since    1.0.0
 */

/** Gear Price Output */
function add_wpd_gear_price_data() {
	if ( in_array( get_post_type(), array( 'gear' ) ) ) {
		if ( get_post_meta( get_the_ID(), '_priceeach', true ) ) { ?>
			<tr class="priceeach"><td><span><?php esc_attr_e( 'Price', 'wpd-gear' ); ?></span></td><td><?php echo wpd_currency_code(); ?><?php echo get_post_meta( get_the_ID(), '_priceeach', true ); ?></td></tr>
		<?php } ?>
		<?php if ( get_post_meta( get_the_ID(), '_priceperpack', true ) ) { ?>
			<tr class="priceeach"><td><span><?php echo get_post_meta( get_the_ID(), '_unitsperpack', true ); ?> <?php esc_attr_e( 'per pack', 'wpd-gear' ); ?></span></td><td><?php echo wpd_currency_code(); ?><?php echo get_post_meta( get_the_ID(), '_priceperpack', true ); ?></td></tr>
		<?php }
	}
}
add_action( 'wpd_pricingoutput_bottom', 'add_wpd_gear_price_data', 10 );

/** Gear Vendors Output */
function wpd_gear_vendors() {
	global $post;

	if ( in_array( get_post_type(), array( 'gear' ) ) ) {
		if ( ! is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
			if ( get_the_term_list( get_the_ID(), 'vendor', true ) ) { ?>
				<tr><td><span><?php esc_attr_e( 'Vendors', 'wpd-gear' ); ?></span></td><td><?php echo get_the_term_list( $post->ID, 'vendor', '', ', ' ); ?></td></tr>
			<?php }
		}
	}
}
add_action( 'wpd_dataoutput_bottom', 'wpd_gear_vendors' );

/** Gear Categories Output */
function wpd_gear_categories() {
	global $post;
	
	if ( in_array( get_post_type(), array( 'gear' ) ) ) {
		if ( ! is_plugin_active( 'wpd-ecommerce/wpd-ecommerce.php' ) ) {
			if ( false != get_the_term_list( $post->ID, 'wpd_gear_category' ) ) { ?>
				<tr><td><span><?php esc_attr_e( 'Categories', 'wpd-gear' ); ?></span></td><td><?php echo get_the_term_list( $post->ID, 'wpd_gear_category', '', ', ' ); ?></td></tr>
			<?php }
		}
	}
}
add_action( 'wpd_dataoutput_bottom', 'wpd_gear_categories' );
