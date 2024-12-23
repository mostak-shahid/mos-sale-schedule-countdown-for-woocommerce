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

		wp_enqueue_style($this->plugin_name , MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'assets/css/style.css', array(), $this->version, 'all');
		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mos-sale-schedule-countdown-for-woocommerce-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-public', MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'public/css/public-style.css', array(), $this->version, 'all' );

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
			// Countdown setup
			'css_class' => 'countdown-alt-2',
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
			'separator_days' => ','

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
		$product = wc_get_product($product_id);
		$content = get_post_meta($product_id, 'mos_sale_schedule_countdown_for_woocommerce_countdown_content', true);
		$content = apply_filters('the_content',$content);
		

		// $from = get_post_meta($product_id, '_sale_price_dates_from', true);
		// $to = get_post_meta($product_id, '_sale_price_dates_to', true);
		// $gmt_date = gmdate( 'Y-m-d H:i:s', $to );

		// Retrieve the sale price end date (Unix timestamp) from product meta
		$sale_price_dates_to = get_post_meta( $product_id, '_sale_price_dates_to', true );
		// Check if the sale price end date exists
		if ( $sale_price_dates_to && $product->is_on_sale() ) :
			// Convert the timestamp to GMT date (Y-m-d H:i:s)
			$gmt_sale_price_dates_to = gmdate( 'Y-m-d H:i:s', $sale_price_dates_to );
			?>
			<div class="mos-sale-schedule-countdown-for-woocommerce-countdown-content">
				<?php if (isset($content) && $content) :?>
					<div class="content">
						<?php echo wp_kses_post($content) ?>
					</div>
				<?php endif?>
				<div class="mssc-default-layout"><?php echo esc_html($gmt_sale_price_dates_to) ?></div>
			</div>
			<?php
		endif;
		// var_dump($gmt_date);
		// var_dump(date( 'Y-m-d', $to) . ' 23:59:59');
		// var_dump(get_date_from_gmt( date('Y-m-d H:i:s'),'Y-m-d H:i:s' ));
		// var_dump(wp_timezone_string());
		?>
		
		<?php 
	}
	// add_action('wp_footer', 'footer_content');
	function mos_sale_schedule_countdown_for_woocommerce_product_main_term() {
		echo '<hr/><br/>';
		$product = wc_get_product(get_the_ID());
		$main_term = 0;
		$terms = wc_get_product_terms(
			get_the_ID(),
			'product_cat',
			apply_filters(
				'woocommerce_breadcrumb_product_terms_args',
				array(
					'orderby' => 'parent',
					'order'   => 'DESC',
				)
			)
		);
		if ( $terms ) {
			$main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
			var_dump($main_term);
		}
		// echo $product->is_on_sale();
		// echo $main_term;
	}

}
