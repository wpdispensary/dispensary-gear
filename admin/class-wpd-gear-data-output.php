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
add_action( 'wpd_pricingoutput_bottom', 'add_wpd_gear_price_data', 10 );
function add_wpd_gear_price_data() { ?>
<?php
if ( in_array( get_post_type(), array( 'gear' ) ) ) { ?>
	<?php if ( ! get_post_meta( get_the_ID(), '_priceeach', true ) ) { } else { ?>
		<tr class="priceeach"><td><span>Price Each:</span></td><td>$<?php echo get_post_meta( get_the_ID(), '_priceeach', true ); ?></td></tr>
	<?php } ?>
	<?php if ( ! get_post_meta( get_the_ID(), '_priceperpack', true ) ) { } else { ?>
		<tr class="priceeach"><td><span><?php echo get_post_meta( get_the_ID(), '_unitsperpack', true ); ?> per pack:</span></td><td>$<?php echo get_post_meta( get_the_ID(), '_priceperpack', true ); ?></td></tr>
	<?php } ?>
<?php }

} // function

/** Gear Vendors Output */
add_action( 'wpd_dataoutput_bottom', 'wpd_gear_vendors' );
function wpd_gear_vendors() {
	global $post;
?>
	<?php if ( in_array( get_post_type(), array( 'gear' ) ) ) { ?>
	<?php if ( ! get_the_term_list( get_the_ID(), 'vendor', true ) ) { } else { ?>
		<tr><td><span>Vendors:</span></td><td><?php echo get_the_term_list( $post->ID, 'vendor', '', ', ' ); ?></td></tr>
	<?php } ?>
	<?php } ?>
<?php }

/** Gear Categories Output */
add_action( 'wpd_dataoutput_bottom', 'wpd_gear_categories' );
function wpd_gear_categories() {
	global $post;
?>
	<?php if ( in_array( get_post_type(), array( 'gear' ) ) ) { ?>
	<?php if ( false != get_the_term_list( $post->ID, 'wpd_gear_category' ) ) { ?>
		<tr><td><span>Categories:</span></td><td><?php echo get_the_term_list( $post->ID, 'wpd_gear_category', '', ', ' ); ?></td></tr>
	<?php } else {} ?>
	<?php } ?>
<?php }
