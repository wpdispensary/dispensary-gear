<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WPD_Gear
 * @subpackage WPD_Gear/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WPD_Gear
 * @subpackage WPD_Gear/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 */
class WPD_Gear {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WPD_Gear_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'wpd-gear';
		$this->version     = '2.0.4';

		if ( defined( 'WPD_GEAR_VERSION' ) ) {
			$this->version = WPD_GEAR_VERSION;
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WPD_Gear_Loader. Orchestrates the hooks of the plugin.
	 * - WPD_Gear_i18n. Defines internationalization functionality.
	 * - WPD_Gear_Admin. Defines all hooks for the admin area.
	 * - WPD_Gear_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpd-gear-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpd-gear-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wpd-gear-public.php';

		/**
		 * The class responsible for creating custom taxonomies
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-taxonomies.php';

		/**
		 * The class responsible for creating custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-post-type.php';

		/**
		 * The class responsible for creating custom metaboxes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-metaboxes.php';

		/**
		 * The class responsible for creating the data output
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-data-output.php';

		/**
		 * The class responsible for creating custom REST API endpoints
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-rest-api.php';

		/**
		 * The class responsible for creating custom shortcodes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-shortcodes.php';

		/**
		 * The class responsible for creating custom widgets
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-widgets.php';

		/**
		 * The class responsible for creating custom permalinks
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpd-gear-settings.php';

		/**
		 * Adding in custom helper functions that are used throughout the rest of the plugin
		 *
		 * @since    1.6
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wpd-gear-functions.php';

		$this->loader = new WPD_Gear_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WPD_Gear_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WPD_Gear_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new WPD_Gear_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WPD_Gear_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WPD_Gear_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
