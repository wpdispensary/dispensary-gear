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
		'name'                  => sprintf( esc_html__( '%s', 'Post Type General Name', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'singular_name'         => sprintf( esc_html__( '%s', 'Post Type Singular Name', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'menu_name'             => sprintf( esc_html__( '%s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'name_admin_bar'        => sprintf( esc_html__( '%s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'archives'              => sprintf( esc_html__( '%s Archives', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'parent_item_colon'     => sprintf( esc_html__( 'Parent %s:', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'all_items'             => sprintf( esc_html__( 'All %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'add_new'               => __( 'Add New', 'wpd-gear' ),
		'new_item'              => sprintf( esc_html__( 'New %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'edit_item'             => sprintf( esc_html__( 'Edit %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'update_item'           => sprintf( esc_html__( 'Update %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'view_item'             => sprintf( esc_html__( 'View %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'search_items'          => sprintf( esc_html__( 'Search %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'not_found'             => __( 'Not found', 'wpd-gear' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpd-gear' ),
		'featured_image'        => __( 'Featured Image', 'wpd-gear' ),
		'set_featured_image'    => __( 'Set featured image', 'wpd-gear' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpd-gear' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpd-gear' ),
		'insert_into_item'      => sprintf( esc_html__( 'Insert into %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'uploaded_to_this_item' => sprintf( esc_html__( 'Uploaded to this %s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'items_list'            => sprintf( esc_html__( '%s list', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'items_list_navigation' => sprintf( esc_html__( '%s list navigation', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'filter_items_list'     => sprintf( esc_html__( 'Filter %s list', 'wpd-gear' ), $wpd_gear_slug ),
	);
	$args = array(
		'label'               => sprintf( esc_html__( '%s', 'wpd-gear' ), $wpd_gear_slug_cap ),
		'description'         => sprintf( esc_html__( 'Display the %s from your menu', 'wpd-gear' ), $wpd_gear_slug ),
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

	add_submenu_page( 'wpd-settings', sprintf( esc_html__( 'WP Dispensary\'s %s' ), $wpd_gear_slug_cap ), sprintf( esc_html__( '%s' ), $wpd_gear_slug_cap ), 'manage_options', 'edit.php?post_type=gear', NULL );
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
