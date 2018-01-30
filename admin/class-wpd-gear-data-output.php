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
 * Action Hooks
 *
 * This is the file responsible for adding the gear data to menu
 * item pricing tables.
 *
 * @since    1.0.0
 */

/** Inventory Data - Flowers */
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

add_action( 'wpd_dataoutput_bottom', 'wpd_gear_categories' );
function wpd_gear_categories() { ?>
	<?php if ( in_array( get_post_type(), array( 'gear' ) ) ) { ?>
		<td><span>Categories:</span></td><td><?php echo get_the_term_list( $post->ID, 'gear_category', '', ', ' ); ?></td>
	<?php } ?>
<?php }