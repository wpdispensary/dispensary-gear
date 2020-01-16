<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Gear
 * @subpackage WPD_Gear/admin
 */

/**
 * Adding featured image URL's to Gear Custom Post Type
 */
function wpd_gear_featuredimage( $data, $post, $request ) {
	$_data                       = $data->data;
	$thumbnail_id                = get_post_thumbnail_id( $post->ID );
	$thumbnail                   = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	$_data['featured_image_url'] = $thumbnail[0];
	$data->data                  = $_data;
	return $data;
}
add_filter( 'rest_prepare_gear', 'wpd_gear_featuredimage', 10, 3 );

/**
 * Adding featured image URL's to Gear Custom Post Type
 *
 * @access public
 *
 * @param object  $data
 * @param WP_Post $post    The WordPress post object.
 * @param null    $request Unused.
 *
 * @return object The featured image data.
 * @since 1.9
 */
function wpd_gear_featured_images( $data, $post, $request ) {
	$_data                             = $data->data;
	$thumbnail_id                      = get_post_thumbnail_id( $post->ID );
	$wpd_default                       = wp_get_attachment_image_src( $thumbnail_id, 'dispensary-image' );
	$wpd_thumbnail                     = wp_get_attachment_image_src( $thumbnail_id, 'wpd-thumbnail' );
	$wpd_small                         = wp_get_attachment_image_src( $thumbnail_id, 'wpd-small' );
	$wpd_medium                        = wp_get_attachment_image_src( $thumbnail_id, 'wpd-medium' );
	$wpd_large                         = wp_get_attachment_image_src( $thumbnail_id, 'wpd-large' );
	$_data['featured_image_default']   = $wpd_default[0];
	$_data['featured_image_thumbnail'] = $wpd_thumbnail[0];
	$_data['featured_image_small']     = $wpd_small[0];
	$_data['featured_image_medium']    = $wpd_medium[0];
	$_data['featured_image_large']     = $wpd_large[0];
	$data->data                        = $_data;
	return $data;
}
add_filter( 'rest_prepare_gear', 'wpd_gear_featured_images', 10, 3 );

/**
 * Add 'details' endpoint for the Gear Custom Post Type
 *
 * @since 1.9
 */
function wpd_gear_product_details( $data, $post, $request ) {

	// Display product details.
	$product_details = array(
		'thc'         => '',
		'thca'        => '',
		'cbd'         => '',
		'cba'         => '',
		'cbn'         => '',
		'cbg'         => '',
		'seed_count'  => '',
		'clone_count' => '',
		'total_thc'   => '',
		'size'        => '',
		'servings'    => '',
		'weight'      => ''
	);

	$details = apply_filters( 'wpd_gear_product_details_all', $product_details );

	$_data            = $data->data;
	$_data['details'] = get_wpd_product_details( $post->ID, $details, NULL );
	$data->data       = $_data;
	return $data;
}
add_filter( 'rest_prepare_gear', 'wpd_gear_product_details', 10, 3 );

/**
 * Add 'prices' endpoint for the Custom Post Types
 *
 * @since 2.7
 */
function wpd_gear_product_prices_all( $data, $post, $request ) {
	$_data           = $data->data;
	$_data['prices'] = get_wpd_all_prices_simple( $post->ID, TRUE );
	$data->data      = $_data;
	return $data;
}
add_filter( 'rest_prepare_gear', 'wpd_gear_product_prices_all', 10, 3 );

/**
 * Add 'categories' endpoint for the Gear Custom Post Type
 *
 * @since 1.3
 */
function wpd_gear_category_numbers( $data, $post, $request ) {

	$_data = $data->data;
	$items = wp_get_post_terms( $post->ID, 'wpd_gear_category' );

	foreach ( $items as $item => $value ) {
		$_data['categories'][$item]['id']          = $value->term_id;
		$_data['categories'][$item]['slug']        = $value->slug;
		$_data['categories'][$item]['title']       = $value->name;
		$_data['categories'][$item]['description'] = $value->description;
		$_data['categories'][$item]['count']       = $value->count;
	}

	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_gear', 'wpd_gear_category_numbers', 10, 3 );

/**
 * This adds the wpdispensary_prices metafields to the
 * API callback for gear
 *
 * @since    1.1.0
 */
function slug_register_wpd_gear_prices() {
	$productsizes = array( '_priceeach', '_priceperpack', '_unitsperpack' );
	foreach ( $productsizes as $size ) {
		register_rest_field(
			array( 'gear' ),
			$size,
			array(
				'get_callback'    => 'slug_get_wpd_gear_prices',
				'update_callback' => 'slug_update_wpd_gear_prices',
				'schema'          => null,
			)
		);
	} /** /foreach */
}
add_action( 'rest_api_init', 'slug_register_wpd_gear_prices' );

/**
 * Get Prices
 */
function slug_get_wpd_gear_prices( $object, $field_name, $request ) {
	return get_post_meta( $object['id'], $field_name, TRUE );
}

/**
 * Update Prices
 */
function slug_update_wpd_gear_prices( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}
