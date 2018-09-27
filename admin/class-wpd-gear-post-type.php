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
if ( ! function_exists( 'wpdispensary_gear' ) ) {

/** Register Custom Post Type */
function wpdispensary_gear() {

	// Get permalink base for Gear.
	$wpd_gear_slug = get_option( 'wpd_gear_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_gear_slug ) {
		$wpd_gear_slug = 'gear';
	}

	// Capitalize first letter of new slug.
	$wpd_gear_slug_cap = ucfirst( $wpd_gear_slug );

	/**
	 * Defining variables
	 */
	$rewrite = array(
		'slug'       => $wpd_gear_slug,
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);

	$labels = array(
		'name'                  => _x( $wpd_gear_slug_cap, 'Post Type General Name', 'wpd-gear' ),
		'singular_name'         => _x( $wpd_gear_slug_cap, 'Post Type Singular Name', 'wpd-gear' ),
		'menu_name'             => __( $wpd_gear_slug_cap, 'wpd-gear' ),
		'name_admin_bar'        => __( $wpd_gear_slug_cap, 'wpd-gear' ),
		'archives'              => __( $wpd_gear_slug_cap . ' Archives', 'wpd-gear' ),
		'parent_item_colon'     => __( 'Parent ' . $wpd_gear_slug_cap . ':', 'wpd-gear' ),
		'all_items'             => __( 'All ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'add_new_item'          => __( 'Add New ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'add_new'               => __( 'Add New', 'wpd-gear' ),
		'new_item'              => __( 'New ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'edit_item'             => __( 'Edit ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'update_item'           => __( 'Update ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'view_item'             => __( 'View ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'search_items'          => __( 'Search '. $wpd_gear_slug_cap, 'wpd-gear' ),
		'not_found'             => __( 'Not found', 'wpd-gear' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpd-gear' ),
		'featured_image'        => __( 'Featured Image', 'wpd-gear' ),
		'set_featured_image'    => __( 'Set featured image', 'wpd-gear' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpd-gear' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpd-gear' ),
		'insert_into_item'      => __( 'Insert into ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'uploaded_to_this_item' => __( 'Uploaded to this ' . $wpd_gear_slug_cap, 'wpd-gear' ),
		'items_list'            => __( $wpd_gear_slug_cap . ' list', 'wpd-gear' ),
		'items_list_navigation' => __( $wpd_gear_slug_cap . ' list navigation', 'wpd-gear' ),
		'filter_items_list'     => __( 'Filter ' . $wpd_gear_slug . ' list', 'wpd-gear' ),
	);
	$args = array(
		'label'               => __( $wpd_gear_slug_cap, 'wpd-gear' ),
		'description'         => __( 'Display the ' . $wpd_gear_slug . ' from your menu', 'wpd-gear' ),
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
add_action( 'init', 'wpdispensary_gear', 0 );

}

function wpd_gear_add_admin_menu() {

	// Get permalink base for Gear.
	$wpd_gear_slug = get_option( 'wpd_gear_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_gear_slug ) {
		$wpd_gear_slug = 'gear';
	}

	// Capitalize first letter of new slug.
	$wpd_gear_slug_cap = ucfirst( $wpd_gear_slug );

	add_submenu_page( 'wpd-settings', 'WP Dispensary\'s ' . $wpd_gear_slug_cap, $wpd_gear_slug_cap, 'manage_options', 'edit.php?post_type=gear', NULL );
}
add_action( 'admin_menu', 'wpd_gear_add_admin_menu', 8 );

/**
 * Function to add admin screen thumbnails to "Gear" menu type
 *
 * @since    1.3.0
 */
function wpd_gear_admin_screen_thumbnails( $array ) {
    $array[] = 'gear';
    return $array;
}
add_filter( 'wpd_admin_screen_thumbnails', 'wpd_gear_admin_screen_thumbnails' );
