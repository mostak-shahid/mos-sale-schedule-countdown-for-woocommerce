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

function wpdocs_custom_timezone_string() {
    $timezone_string = get_option( 'timezone_string' );
    $offset  = (float) get_option( 'gmt_offset' );
    $hours   = (int) $offset;
    $minutes = ( $offset - $hours );
    $sign      = ( $offset < 0 ) ? '-' : '+';
    $abs_hour  = abs( $hours );
    $abs_mins  = abs( $minutes * 60 );
    $tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );
    $timezone = $timezone_string ? $timezone_string . ' [' . $tz_offset . ']' : $tz_offset;

    // return $timezone;
    return $tz_offset;
}

// Usage
echo esc_html( wpdocs_custom_timezone_string() );

$time_zone = '-06:00';
$newtimestamp = strtotime('2011-11-17 00:00:00 ' . wpdocs_custom_timezone_string());
echo date('Y-m-d H:i:s', $newtimestamp);