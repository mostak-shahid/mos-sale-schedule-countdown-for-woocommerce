<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.programmelab.com/
 * @since      1.0.0
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/includes
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
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Mos_Sale_Schedule_Countdown_For_Woocommerce
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	public function __construct()
	{

		if (defined('MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_VERSION')) {
			$this->version = MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mos-sale-schedule-countdown-for-woocommerce';

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
	 * - Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - Mos_Sale_Schedule_Countdown_For_Woocommerce_i18n. Defines internationalization functionality.
	 * - Mos_Sale_Schedule_Countdown_For_Woocommerce_Admin. Defines all hooks for the admin area.
	 * - Mos_Sale_Schedule_Countdown_For_Woocommerce_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		require_once(ABSPATH . 'wp-admin/includes/plugin.php');

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mos-sale-schedule-countdown-for-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mos-sale-schedule-countdown-for-woocommerce-i18n.php';
		
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-mos-sale-schedule-countdown-for-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-mos-sale-schedule-countdown-for-woocommerce-public.php';
		
		$this->loader = new Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mos_Sale_Schedule_Countdown_For_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Mos_Sale_Schedule_Countdown_For_Woocommerce_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Mos_Sale_Schedule_Countdown_For_Woocommerce_Admin($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		if (is_plugin_active('woocommerce/woocommerce.php')) {
			
			$this->loader->add_action('admin_menu', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_admin_menu');
			
			// Add Settings link to the plugin
			$plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php');
			$this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_add_action_links');

			$this->loader->add_action('admin_init', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_do_activation_redirect');

			$this->loader->add_filter('admin_body_class', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_admin_body_class');

			// Save settings by ajax
			$this->loader->add_action('wp_ajax_mos_sale_schedule_countdown_for_woocommerce_reset_settings', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_reset_settings');

			// add_action('woocommerce_product_options_pricing', 'mos_sale_schedule_countdown_for_woocommerce_product_tab_field');
			$this->loader->add_action('woocommerce_product_options_pricing', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_product_tab_field');

			// add_action('save_post', 'mos_sale_schedule_countdown_for_woocommerce_save_product_meta_data');
			$this->loader->add_action('save_post', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_save_product_meta_data', 10, 3);

			// add_action( 'upgrader_process_complete', 'mos_sale_schedule_countdown_for_woocommerce_update_completed', 10, 2 );
			$this->loader->add_action('upgrader_process_complete', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_update_completed', 10,2);

			// add_action( 'admin_init', 'mos_sale_schedule_countdown_for_woocommerce_export' );
			$this->loader->add_action('admin_init', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_export');
			// add_action( 'admin_notices', 'mos_sale_schedule_countdown_for_woocommerce_import' );
			$this->loader->add_action('admin_notices', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_import');

		} else {
			$this->loader->add_action('admin_notices', $plugin_admin, 'mos_sale_schedule_countdown_for_woocommerce_woo_check');
			add_action("wp_ajax_mos_sale_schedule_countdown_for_woocommerce_ajax_install_plugin", "wp_ajax_install_plugin");
		}
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Mos_Sale_Schedule_Countdown_For_Woocommerce_Public($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
		// Save settings by ajax
		$this->loader->add_action('woocommerce_single_product_summary', $plugin_public, 'mos_sale_schedule_countdown_for_woocommerce_show_coundown');
		$this->loader->add_action('woocommerce_single_product_summary', $plugin_public, 'mos_sale_schedule_countdown_for_woocommerce_product_main_term');

		$this->loader->add_action('wp_ajax_mos_sale_schedule_countdown_for_woocommerce_ajax_callback', $plugin_public, 'mos_sale_schedule_countdown_for_woocommerce_ajax_callback');
		$this->loader->add_action('wp_ajax_nopriv_mos_sale_schedule_countdown_for_woocommerce_ajax_callback', $plugin_public, 'mos_sale_schedule_countdown_for_woocommerce_ajax_callback');	
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
