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
 * WP Dispensary Gear Widget
 *
 * @since       1.0.0
 */
class wpd_gear_widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function __construct() {
		// Get permalink base for Gear.
		$wpd_gear_slug = get_option( 'wpd_gear_slug' );

		// If custom base is empty, set default.
		if ( '' == $wpd_gear_slug ) {
			$wpd_gear_slug = 'gear';
		}

		// Capitalize first letter of new slug.
		$wpd_gear_slug_cap = ucfirst( $wpd_gear_slug );

		parent::__construct(
			'wpd_gear_widget',
			__( 'Dispensary ' . $wpd_gear_slug_cap, 'wpd-gear' ),
			array(
				'description' => __( 'Your most recent ' . $wpd_gear_slug, 'wpd-gear' ),
				'classname'   => 'wp-dispensary-widget',
			)
		);

	}

	/**
	 * Widget definition
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::widget
	 * @param       array $args Arguments to pass to the widget.
	 * @param       array $instance A given widget instance.
	 * @return      void
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['id'] ) ) {
			$args['id'] = 'wpd_gear_widget';
		}

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $args['id'] );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		do_action( 'wpd_gear_widget_before' );

		if ( ! 'on' == $instance['featuredimage'] ) {
			echo '<ul class="wpdispensary-list">';
		}

		if ( 'on' === $instance['order'] ) {
			$randorder = 'rand';
		} else {
			$randorder = '';
		}

		global $post;

		$wpd_gear_widget = new WP_Query(
			array(
				'post_type' => 'gear',
				'showposts' => $instance['limit'],
				'orderby'   => $randorder,
			)
		);

		while ( $wpd_gear_widget->have_posts() ) :

			do_action( 'wpd_gear_widget_inside_loop_before' );

			$wpd_gear_widget->the_post();

			$do_not_duplicate = $post->ID;

			if ( 'on' === $instance['featuredimage'] ) {

				echo "<div class='wpdispensary-widget'>";

				do_action( 'wpd_gear_widget_inside_top' );

				wpd_product_image( $post->ID, $instance['imagesize'] );

				if ( 'on' === $instance['gearname'] ) {
					echo "<span class='wpdispensary-widget-title'><a href='" . esc_url( get_permalink( $post->ID ) ) . "'>" . get_the_title( $post->ID ) . "</a></span>";
				}
				if ( 'on' === $instance['gearcategory'] ) {
					echo '<span class="wpdispensary-widget-categories">' . get_the_term_list( $post->ID, 'wpd_gear_category' ) . '</a></span>';
				}

				do_action( 'wpd_gear_widget_inside_bottom' );

				echo '</div>';

			} else {

				if ( 'on' === $instance['gearname'] ) {
					echo '<li>';
					echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="wpdispensary-widget-link">' . get_the_title( $post->ID ) . '</a>';
					echo '</li>';
				}

			}

			do_action( 'wpd_gear_widget_inside_loop_after' );

		endwhile; // End loop.

		wp_reset_postdata();

		if ( ! 'on' == $instance['featuredimage'] ) {
			echo '</ul>';
		}

		do_action( 'wpd_gear_widget_after' );

		echo $args['after_widget'];
	}


	/**
	 * Update widget options
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::update
	 * @param       array $new_instance The updated options.
	 * @param       array $old_instance The old options.
	 * @return      array $instance The updated instance options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['limit']         = strip_tags( $new_instance['limit'] );
		$instance['order']         = $new_instance['order'];
		$instance['featuredimage'] = $new_instance['featuredimage'];
		$instance['imagesize']     = $new_instance['imagesize'];
		$instance['gearname']      = $new_instance['gearname'];
		$instance['gearcategory']  = $new_instance['gearcategory'];

		return $instance;
	}


	/**
	 * Display widget form on dashboard
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::form
	 * @param       array $instance A given widget instance.
	 * @return      void
	 */
	public function form( $instance ) {
		// Get custom permalink base for Gear.
		$wpd_gear_slug = get_option( 'wpd_gear_slug' );

		// If custom base is empty, set default.
		if ( '' == $wpd_gear_slug ) {
			$wpd_gear_slug = 'gear';
		}

		// Capitalize first letter of new slug.
		$wpd_gear_slug_cap = ucfirst( $wpd_gear_slug );

		$defaults = array(
			'title'         => 'Recent ' . $wpd_gear_slug_cap,
			'limit'         => '5',
			'order'         => '',
			'featuredimage' => '',
			'imagesize'     => 'wpdispensary-widget',
			'gearname'      => '',
			'gearcategory'  => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'wpd-gear' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $instance['title'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Amount of ' . $wpd_gear_slug . ' to show:', 'wpd-gear' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" type="number" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" min="1" max="999" value="<?php echo esc_html( $instance['limit'] ); ?>" />
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['order'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Randomize output?', 'wpd-gear' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['gearname'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'gearname' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gearname' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'gearname' ) ); ?>"><?php esc_html_e( 'Display ' . $wpd_gear_slug . ' name?', 'wpd-gear' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['gearcategory'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'gearcategory' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gearcategory' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'gearcategory' ) ); ?>"><?php esc_html_e( 'Display ' . $wpd_gear_slug . ' category?', 'wpd-gear' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['featuredimage'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'featuredimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featuredimage' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'featuredimage' ) ); ?>"><?php esc_html_e( 'Display featured image?', 'wpd-gear' ); ?></label>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'imagesize' ) ); ?>"><?php esc_html_e( 'Image size:', 'wpd-gear' ); ?></label>
		<?php
			$terms = array( 'wpdispensary-widget', 'dispensary-image', 'wpd-small', 'wpd-medium', 'wpd-large' );
		if ( $terms ) {
			printf( '<select name="%s" id="' . esc_html( $this->get_field_id( 'imagesize' ) ) . '" name="' . esc_html( $this->get_field_name( 'imagesize' ) ) . '" class="widefat">', esc_attr( $this->get_field_name( 'imagesize' ) ) );
			foreach ( $terms as $term ) {
				if ( esc_html( $term ) != $instance['imagesize'] ) {
					$imagesizeinfo = '';
				} else {
					$imagesizeinfo = 'selected="selected"';
				}
				printf( '<option value="%s" ' . esc_html( $imagesizeinfo ) . '>%s</option>', esc_html( $term ), esc_html( $term ) );
			}
			print( '</select>' );
		}
		?>
	</p>

	<?php
	}
}

/**
 * Register the new widget
 *
 * @since       1.0.0
 * @return      void
 */
function wpd_gear_register_widget() {
	register_widget( 'wpd_gear_widget' );
}
add_action( 'widgets_init', 'wpd_gear_register_widget' );
