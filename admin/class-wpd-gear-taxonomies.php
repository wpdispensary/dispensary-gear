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
		'name'              => _x( 'Categories', 'taxonomy general name', 'wpd-gear' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wpd-gear' ),
		'search_items'      => __( 'Search Categories', 'wpd-gear' ),
		'all_items'         => __( 'All Categories', 'wpd-gear' ),
		'parent_item'       => __( 'Parent Category', 'wpd-gear' ),
		'parent_item_colon' => __( 'Parent Category:', 'wpd-gear' ),
		'edit_item'         => __( 'Edit Category', 'wpd-gear' ),
		'update_item'       => __( 'Update Category', 'wpd-gear' ),
		'add_new_item'      => __( 'Add New Category', 'wpd-gear' ),
		'new_item_name'     => __( 'New Category Name', 'wpd-gear' ),
		'not_found'         => __( 'No categories found', 'wpd-gear' ),
		'menu_name'         => __( 'Categories', 'wpd-gear' ),
	);

	register_taxonomy( 'wpd_gear_category', 'gear', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => false,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'gear/category',
			'with_front' => false,
		),
	) );

}
