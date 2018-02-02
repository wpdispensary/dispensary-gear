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
 * Gear Category Taxonomy
 *
 * Adds the Gear Category taxonomy to all custom post types
 *
 * @since    1.0.0
 */

add_action( 'init', 'wpdispensary_gearcategory', 0 );

/**
 * Gear category
 */
function wpdispensary_gearcategory() {

	$labels = array(
		'name'              => _x( 'Gear Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gear Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Gear Categories' ),
		'all_items'         => __( 'All Gear Categories' ),
		'parent_item'       => __( 'Parent Gear Category' ),
		'parent_item_colon' => __( 'Parent Gear Category:' ),
		'edit_item'         => __( 'Edit Gear Category' ),
		'update_item'       => __( 'Update Gear Category' ),
		'add_new_item'      => __( 'Add New Gear Category' ),
		'new_item_name'     => __( 'New Gear Category Name' ),
		'not_found'         => 'No gear categories found',
		'menu_name'         => __( 'Categories' ),
	);

	register_taxonomy( 'wpd_gear_category', 'gear', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'gear/category',
			'with_front' => false,
		),
	) );

}
