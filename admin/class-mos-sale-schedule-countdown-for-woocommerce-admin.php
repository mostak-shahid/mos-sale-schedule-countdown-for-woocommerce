<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.mdmostakshahid.com/
 * @since      1.0.0
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mos_Sale_Schedule_Countdown_For_Woocommerce
 * @subpackage Mos_Sale_Schedule_Countdown_For_Woocommerce/admin
 * @author     Md. Mostak Shahid <mostak.shahid@gmail.com>
 */
class Mos_Sale_Schedule_Countdown_For_Woocommerce_Admin
{

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version) 
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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
		wp_enqueue_style($this->plugin_name . '-admin', MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'admin/css/admin-style.css', array(), $this->version, 'all');
		// wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mos-sale-schedule-countdown-for-woocommerce-admin.css', array(), $this->version, 'all');			
		// wp_enqueue_style( $this->plugin_name, plugin_dir_url(__DIR__) . 'admin/css/mos-sale-schedule-countdown-for-woocommerce-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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
		
		wp_enqueue_script($this->plugin_name, MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_URL . 'assets/js/script.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-admin-ajax', plugin_dir_url(__FILE__) . 'js/admin-ajax.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-admin-script', plugin_dir_url(__FILE__) . 'js/admin-script.js', array('jquery'), $this->version, false);
		$ajax_params = array(
			'admin_url' => admin_url(),
			'ajax_url' => admin_url('admin-ajax.php'),
			'_admin_nonce' => esc_attr(wp_create_nonce('mos_sale_schedule_countdown_for_woocommerce_admin_nonce')),
			// 'install_plugin_wpnonce' => esc_attr(wp_create_nonce('updates')),
		);
		wp_localize_script($this->plugin_name . '-admin-ajax', 'mos_sale_schedule_countdown_for_woocommerce_ajax_obj', $ajax_params);
	}
	
	// add_action('woocommerce_product_options_pricing', 'mos_sale_schedule_countdown_for_woocommerce_product_tab_field');
	public function mos_sale_schedule_countdown_for_woocommerce_product_tab_field (){
		wp_nonce_field('mos_sale_schedule_countdown_for_woocommerce_action', 'mos_sale_schedule_countdown_for_woocommerce_field');
		global $post;
		$product_id = $post->ID;
		$content = get_post_meta($product_id, 'mos_sale_schedule_countdown_for_woocommerce_countdown_content', true);
		$from = get_post_meta($product_id, '_sale_price_dates_from', true);
		$to = get_post_meta($product_id, '_sale_price_dates_to', true);
		// var_dump(date_i18n( 'Y-m-d', $from));
		?>
		<fieldset class="form-field _mos_sale_schedule_countdown_for_woocommerce_countdown_content_field"  <?php echo (!$from && !$to)?'style="display:none"':'' ?>>
			<label for="mos_sale_schedule_countdown_for_woocommerce_countdown_content"><?php echo esc_html__('Countdown content','mos-sale-schedule-countdown-for-woocommerce')?></label>
			<?php 
				$editor_id = esc_html(sanitize_title('mos_sale_schedule_countdown_for_woocommerce_countdown_content'));
				$arg = array(
					'textarea_name' => esc_html('mos_sale_schedule_countdown_for_woocommerce_countdown_content'),
					'media_buttons' => false,
					'quicktags' => false,
				);
				wp_editor( $content, $editor_id, $arg ); 
			?>
		</fieldset>
		<?php
	}
	/**
	 * Save custom data
	 *
	 * @return boolean
	 */
	public function mos_sale_schedule_countdown_for_woocommerce_save_product_meta_data($post_id, $post, $update)
	{
		if (isset($_POST['mos_sale_schedule_countdown_for_woocommerce_field']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['mos_sale_schedule_countdown_for_woocommerce_field'])), 'mos_sale_schedule_countdown_for_woocommerce_action')) {

			update_post_meta($post_id, 'mos_sale_schedule_countdown_for_woocommerce_countdown_content', isset($_POST['mos_sale_schedule_countdown_for_woocommerce_countdown_content'])?wp_kses_post(wp_unslash($_POST['mos_sale_schedule_countdown_for_woocommerce_countdown_content'])):'');
		}
	}
	public function mos_sale_schedule_countdown_for_woocommerce_reset_settings (){
		if (isset($_POST['_admin_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_admin_nonce'])), 'mos_sale_schedule_countdown_for_woocommerce_admin_nonce')) {
			// wp_send_json_success(array('variation_id' => $variation_id, 'price' => $price));
			wp_send_json_success();
		} else {
			wp_send_json_error(array('error_message' => esc_html__('Nonce verification failed. Please try again.', 'mos-sale-schedule-countdown-for-woocommerce')));
			// wp_die(esc_html__('Nonce verification failed. Please try again.', 'mos-sale-schedule-countdown-for-woocommerce'));
		}
		wp_die();
	}
	function mos_sale_schedule_countdown_for_woocommerce_update_completed( $upgrader_object, $options ) {

		// If an update has taken place and the updated type is plugins and the plugins element exists
		if ( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
			foreach( $options['plugins'] as $plugin ) {
				// Check to ensure it's my plugin
				if( $plugin == plugin_basename( __FILE__ ) ) {
					// do stuff here
					$mos_sale_schedule_countdown_for_woocommerce_options = array_replace_recursive(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_DEFAULT_OPTIONS,get_option('mos_sale_schedule_countdown_for_woocommerce_options', []));
					update_option('mos_sale_schedule_countdown_for_woocommerce_options', $mos_sale_schedule_countdown_for_woocommerce_options);
				}
			}
		}
	}
	
}
