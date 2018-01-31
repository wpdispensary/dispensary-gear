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
 * Gear post type creation
 *
 * @since	   1.0.0
 */
if ( ! function_exists( 'wpd_gear' ) ) {

/** Register Custom Post Type */
function wpd_gear() {

	$labels = array(
		'name'                  => _x( 'Gear', 'Post Type General Name', 'wpd-gear' ),
		'singular_name'         => _x( 'Gear', 'Post Type Singular Name', 'wpd-gear' ),
		'menu_name'             => __( 'Gear', 'wpd-gear' ),
		'name_admin_bar'        => __( 'Gear', 'wpd-gear' ),
		'archives'              => __( 'Gear Archives', 'wpd-gear' ),
		'parent_item_colon'     => __( 'Parent Gear:', 'wpd-gear' ),
		'all_items'             => __( 'All Gear', 'wpd-gear' ),
		'add_new_item'          => __( 'Add New Gear', 'wpd-gear' ),
		'add_new'               => __( 'Add New', 'wpd-gear' ),
		'new_item'              => __( 'New Gear', 'wpd-gear' ),
		'edit_item'             => __( 'Edit Gear', 'wpd-gear' ),
		'update_item'           => __( 'Update Gear', 'wpd-gear' ),
		'view_item'             => __( 'View Gear', 'wpd-gear' ),
		'search_items'          => __( 'Search Gear', 'wpd-gear' ),
		'not_found'             => __( 'Not found', 'wpd-gear' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpd-gear' ),
		'featured_image'        => __( 'Featured Image', 'wpd-gear' ),
		'set_featured_image'    => __( 'Set featured image', 'wpd-gear' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpd-gear' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpd-gear' ),
		'insert_into_item'      => __( 'Insert into Gear', 'wpd-gear' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Gear', 'wpd-gear' ),
		'items_list'            => __( 'Gear list', 'wpd-gear' ),
		'items_list_navigation' => __( 'Gear list navigation', 'wpd-gear' ),
		'filter_items_list'     => __( 'Filter gear list', 'wpd-gear' ),
	);
	$args = array(
		'label'               => __( 'Gear', 'wpd-gear' ),
		'description'         => __( 'Display your dispensary gear', 'wpd-gear' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_rest'        => true,
		'menu_position'       => 10,
		'menu_icon'           => plugin_dir_url( __FILE__ ) . ( '../images/menu-icon.png' ),
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'gear', $args );

}
add_action( 'init', 'wpd_gear', 0 );

}

function wpd_gear_add_admin_menu() {
//create a submenu under Settings
	add_submenu_page( 'wpd-settings', 'WP Dispensary\'s Gear', 'Gear', 'manage_options', 'edit.php?post_type=gear', NULL );
}
add_action( 'admin_menu', 'wpd_gear_add_admin_menu', 10 );
