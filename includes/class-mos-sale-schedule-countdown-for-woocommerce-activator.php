<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.programmelab.com/
 * @since      1.0.0
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Mos_Sale_Schedule_Countdown_For_Woocommerce_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		update_option('mos_sale_schedule_countdown_for_woocommerce_options', MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_DEFAULT_OPTIONS);
		add_option('mos_sale_schedule_countdown_for_woocommerce_do_activation_redirect', true);
	}
}
