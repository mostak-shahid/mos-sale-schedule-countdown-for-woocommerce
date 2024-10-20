<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.mdmostakshahid.com/
 * @since      1.0.0
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/public
 * @author     Md. Mostak Shahid <mostak.shahid@gmail.com>
 */
class Mos_Sale_Schedule_Countdown_For_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style($this->plugin_name . '-jquery.countdown', plugin_dir_url(__FILE__) . 'plugins/jquery-countdown/jquery.countdown.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name , MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'assets/css/style.css', array(), $this->version, 'all');
		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mos-sale-schedule-countdown-for-woocommerce-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-public', MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'admin/css/public-style.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mos_Sale_Schedule_Countdown_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script($this->plugin_name, plugin_dir_url(__DIR__) . 'assets/js/script.js', array('jquery'), $this->version, false);
		
		wp_enqueue_script($this->plugin_name . '-jquery.countdown', plugin_dir_url(__FILE__) . 'plugins/jquery-countdown/jquery.countdown.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name, MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'assets/js/script.js', array('jquery'), $this->version, false);		
		wp_enqueue_script($this->plugin_name . '-public-ajax', plugin_dir_url( __FILE__ ) . 'js/public-ajax.js', array('jquery'), $this->version, false);
		wp_enqueue_script( $this->plugin_name . '-public-script', plugin_dir_url( __FILE__ ) . 'js/public-script.js', array( 'jquery' ), $this->version, false );
		$ajax_params = array(
			'admin_url' => admin_url(),
			'ajax_url' => admin_url('admin-ajax.php'),
			'_wp_nonce' => esc_attr(wp_create_nonce('mos_sale_schedule_countdown_for_woocommerce_wp_nonce')),
			// 'install_plugin_wpnonce' => esc_attr(wp_create_nonce('updates')),
		);
		wp_localize_script($this->plugin_name . '-public-ajax', 'mos_sale_schedule_countdown_for_woocommerce_ajax_obj', $ajax_params);
	}
	public function mos_sale_schedule_countdown_for_woocommerce_ajax_callback (){
		if (isset($_POST['_wp_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wp_nonce'])), 'mos_sale_schedule_countdown_for_woocommerce_wp_nonce')) {
			// wp_send_json_success(array('variation_id' => $variation_id, 'price' => $price));
			wp_send_json_success();
		} else {
			wp_send_json_error(array('error_message' => esc_html__('Nonce verification failed. Please try again.', 'mos-sale-schedule-countdown-for-woocommerce')));
			// wp_die(esc_html__('Nonce verification failed. Please try again.', 'mos-sale-schedule-countdown-for-woocommerce'));
		}
		wp_die();
	}
	public function mos_sale_schedule_countdown_for_woocommerce_show_coundown(){
		$product_id = get_the_ID();
		$content = get_post_meta($product_id, 'mos_sale_schedule_countdown_for_woocommerce_countdown_content', true);
		$content = apply_filters('the_content',$content);
		$from = get_post_meta($product_id, '_sale_price_dates_from', true);
		$to = get_post_meta($product_id, '_sale_price_dates_to', true);
		// var_dump(date_i18n( 'Y-m-d', $from));
		?>
		<div class="mos-sale-schedule-countdown-for-woocommerce-countdown-content">
			<div class="content">
				<?php echo wp_kses_post($content) ?>
				<hr>
				<?php echo esc_html(date_i18n( 'Y-m-d', $to)) ?>T23:59:59
				<hr>
			</div>
			<div class="count-down"><?php echo esc_html(date_i18n( 'Y-m-d', $to)) ?>T23:59:59</div>
		</div>
		<?php 
	}

}
