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
 * Gear Shortcode Fuction
 */
function wpdispensary_gear_shortcode( $atts ) {
	// Get permalink base for Gear.
	$wpd_gear_slug = get_option( 'wpd_gear_slug' );

	// If custom base is empty, set default.
	if ( '' == $wpd_gear_slug ) {
		$wpd_gear_slug = 'gear';
	}

	// Capitalize first letter of new slug.
	$wpd_gear_slug_cap = ucfirst( $wpd_gear_slug );

	// Shortcode attributes.
	extract( shortcode_atts(
		array(
			'posts'    => '100',
			'class'    => '',
			'name'     => 'show',
			'info'     => 'show',
			'title'    => $wpd_gear_slug_cap,
			'image'    => 'show',
			'imgsize'  => 'dispensary-image',
			'orderby'  => '',
			'meta_key' => '',
			'viewall'  => '',
		),
		$atts,
		'wpd_gear'
	) );

	// Variables.
	$order    = '';
	$ordernew = '';

	// Order by.
	if ( '' !== $orderby ) {
		$order    = $orderby;
		$ordernew = 'ASC';
	}

	// Query for shortcode posts.
	$wpdquery = new WP_Query(
		array(
			'post_type'      => 'gear',
			'posts_per_page' => $posts,
			'orderby'        => $order,
			'order'          => $ordernew,
			'meta_key'       => $meta_key,
		)
	);

	if ( 'show' === $viewall ) {
		$gearlink = get_bloginfo( 'url' ) . '/gear/';
		$viewgear = '<span class="wp-dispensary-view-all"><a href="' . apply_filters( 'wpd_gear_shortcode_view_all', $gearlink ) . '">' . __( '(view all)', 'wp-dispensary' ) . '</a></span>';
	} else {
		$viewgear = '';
	}

	$wpdposts = '<div class="wpdispensary"><h2 class="wpd-title">' . $title . $viewgear . '</h2>';

	while ( $wpdquery->have_posts() ) : $wpdquery->the_post();

		/** Check shortcode options input by user */

		if ( 'show' == $name ) {
			$showname = '<h2 class="wpd-producttitle"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
		} else {
			$showname = '';
		}

		if ( 'gear' == get_post_type() ) {
			if ( 'show' == $info ) {
				$showinfo = get_wpd_gear_prices_simple( get_the_ID(), TRUE );
			} else {
				$showinfo = '';
			}
		}

		if ( '' === $imgsize ) {
			$imagesize = 'dispensary-image';
		} else {
			$imagesize = $imgsize;
		}

		if ( 'show' === $image ) {
			$showimage = get_wpd_product_image( get_the_ID(), $imagesize );
		} else {
			$showimage = '';
		}

		/** Shortcode display */

		ob_start();
			do_action( 'wpd_shortcode_inside_top' );
			$wpd_sc_inside_top = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_top_gear' );
			$wpd_sc_top_gear = ob_get_contents();
		ob_end_clean();

		$wpdposts .= '<div class="wpdshortcode wpd-gear ' . $class .'">' . $wpd_sc_top_gear . $wpd_sc_inside_top . $showimage;

		ob_start();
			do_action( 'wpd_shortcode_bottom_gear' );
			$wpd_sc_bottom_gear = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action( 'wpd_shortcode_inside_bottom' );
			$wpd_sc_inside_bottom = ob_get_contents();
		ob_end_clean();

		$wpdposts .= $showname . $showinfo . $wpd_sc_inside_bottom . $wpd_sc_bottom_gear . '</div>';

	endwhile;

	wp_reset_postdata();

	return $wpdposts . '</div>';
}
add_shortcode( 'wpd-gear', 'wpdispensary_gear_shortcode' );
