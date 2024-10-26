<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.mdmostakshahid.com/
 * @since             1.0.0
 * @package           Mos_Sale_Schedule_Countdown_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Mos Sale Schedule Countdown For Woocommerce
 * Plugin URI:        https://https://www.mdmostakshahid.com/mos-sale-schedule-countdown-for-woocommerce/
 * Description:       Mos sale schedule countdown for woocommerce boilerplate for WordPress
 * Version:           1.0.0
 * Author:            Md. Mostak Shahid
 * Author URI:        https://www.mdmostakshahid.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mos-sale-schedule-countdown-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_VERSION', '1.0.0');
define('MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_NAME', __('Mos Sale Schedule Countdown For Woocommerce', 'mos-sale-schedule-countdown-for-woocommerce'));

define( 'MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL', plugin_dir_url( __FILE__ ) );

define('MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_DEFAULT_OPTIONS', [
	'countdown' => [
		'css_class' => 'countdown', // countdown-alt-2, countdown-alt-3
        'always_show_days' => false,
        'with_labels' => true,
        'with_seconds' => true,
        'with_separators' => false,
        'with_hh_leading_zero' => true,
        'with_mm_leading_zero' => true,
        'with_ss_leading_zero' => true,
        'label_dd' => 'days',
        'label_hh' => 'hours',
        'label_mm' => 'minutes',
        'label_ss' => 'seconds',
        'separator' => ':',
        'separator_days' => ',',
	],
	'style' => [],
    'advanced' => [
        'css' => '',
        'js' => ''
    ]
]);


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mos-sale-schedule-countdown-for-woocommerce-activator.php
 */
function mos_sale_schedule_countdown_for_woocommerce_activate()
{
	require_once MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_PATH . 'includes/class-mos-sale-schedule-countdown-for-woocommerce-activator.php';
	Mos_Sale_Schedule_Countdown_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mos-sale-schedule-countdown-for-woocommerce-deactivator.php
 */
function mos_sale_schedule_countdown_for_woocommerce_deactivate()
{
	require_once MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_PATH . 'includes/class-mos-sale-schedule-countdown-for-woocommerce-deactivator.php';
	Mos_Sale_Schedule_Countdown_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'mos_sale_schedule_countdown_for_woocommerce_activate');
register_deactivation_hook(__FILE__, 'mos_sale_schedule_countdown_for_woocommerce_deactivate');

// require MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_PATH . '/vendor/autoload.php';
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_PATH . 'includes/class-mos-sale-schedule-countdown-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function mos_sale_schedule_countdown_for_woocommerce_run()
{

	$plugin = new Mos_Sale_Schedule_Countdown_For_Woocommerce();
	$plugin->run();
}
mos_sale_schedule_countdown_for_woocommerce_run();
// var_dump(mos_sale_schedule_countdown_for_woocommerce_is_plugin_page());
// add_action('current_screen', 'mos_sale_schedule_countdown_for_woocommerce_is_plugin_page');
function mos_sale_schedule_countdown_for_woocommerce_is_plugin_page()
{
	if (function_exists('get_current_screen')) {
		$current_screen = get_current_screen();
		if (
			$current_screen->id == 'toplevel_page_mos-sale-schedule-countdown-for-woocommerce'
		) {
			return true;
		}
	}
	return false;
}
function mos_sale_schedule_countdown_for_woocommerce_get_option()
{
	$mos_sale_schedule_countdown_for_woocommerce_options_database = get_option('mos_sale_schedule_countdown_for_woocommerce_options', []);
	$mos_sale_schedule_countdown_for_woocommerce_options = array_replace_recursive(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_DEFAULT_OPTIONS, $mos_sale_schedule_countdown_for_woocommerce_options_database);
	return $mos_sale_schedule_countdown_for_woocommerce_options;
}