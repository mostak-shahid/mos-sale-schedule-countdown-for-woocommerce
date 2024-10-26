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
			'install_plugin_wpnonce' => esc_attr(wp_create_nonce('updates')),
		);
		wp_localize_script($this->plugin_name . '-admin-ajax', 'mos_sale_schedule_countdown_for_woocommerce_ajax_obj', $ajax_params);
	}
	
	/**
	 * Adding Woocommerce dependency to our plugin.
	 *
	 * @since    1.0.0
	 */
	public function mos_sale_schedule_countdown_for_woocommerce_woo_check()
	{

		if (current_user_can('activate_plugins')) {
			if (!is_plugin_active('woocommerce/woocommerce.php') && !file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
?>
				<div id="message" class="error">
					<p>
						<?php printf(
							esc_html__(
								'%1$s requires %2$s WooCommerce %3$s to be activated.',
								'mos-sale-schedule-countdown-for-woocommerce'
							),
							esc_html(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_NAME),
							'<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
							'</a></strong>'
						); ?>
					</p>
					<p><a id="mos_sale_schedule_countdown_for_woocommerce_wooinstall" class="install-now button" data-plugin-slug="woocommerce"><?php esc_html_e('Install Now', 'mos-sale-schedule-countdown-for-woocommerce'); ?></a></p>
				</div>
			<?php
			} elseif (!is_plugin_active('woocommerce/woocommerce.php') && file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
			?>

				<div id="message" class="error">
					<p>
						<?php printf(
							esc_html__(
								'%1$s requires %2$s WooCommerce %3$s to be activated.',
								'mos-sale-schedule-countdown-for-woocommerce'
							),
							esc_html(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_NAME),
							'<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">',
							'</a></strong>'
						); ?>
					</p>
					<p><a href="<?php echo esc_url(get_admin_url()); ?>plugins.php?_wpnonce=<?php echo esc_attr(wp_create_nonce('activate-plugin_woocommerce/woocommerce.php')); ?>&action=activate&plugin=woocommerce/woocommerce.php" class="button activate-now button-primary"><?php esc_html_e('Activate', 'mos-sale-schedule-countdown-for-woocommerce'); ?></a></p>
				</div>
			<?php
			} elseif (version_compare(get_option('woocommerce_db_version'), '2.5', '<')) {
			?>

				<div id="message" class="error">
					<p>
						<?php printf(
							esc_html__(
								'%1$s %2$s is inactive.%3$s This plugin requires WooCommerce 2.5 or newer. Please %4$supdate WooCommerce to version 2.5 or newer%5$s',
								'mos-sale-schedule-countdown-for-woocommerce'
							),
							'<strong>',
							esc_html(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_NAME),
							'</strong>',
							'<a href="' . esc_url(admin_url('plugins.php')) . '">',
							'&nbsp;&raquo;</a>'
						); ?>
					</p>
				</div>

			<?php
			}
		}
	}
	public function mos_sale_schedule_countdown_for_woocommerce_admin_menu () {
		
		add_menu_page(
			esc_html(MOS_SALE_SCHEDULE_COUNTDOWN_FOR_WOOCOMMERCE_NAME),
			esc_html__('Sale Schedule Countdown ', 'mos-sale-schedule-countdown-for-woocommerce'),
			'manage_options',
			$this->plugin_name,
			array($this, 'mos_sale_schedule_countdown_for_woocommerce_dashboard_page_html'),
			plugin_dir_url(__DIR__) . 'admin/images/menu-icon.svg',
			57
		);
		add_submenu_page(
			$this->plugin_name,
			esc_html__('Welcome', 'mos-sale-schedule-countdown-for-woocommerce'),
			esc_html__('Welcome', 'mos-sale-schedule-countdown-for-woocommerce'),
			'manage_options',
			$this->plugin_name,
			array($this, 'mos_sale_schedule_countdown_for_woocommerce_dashboard_page_html')
		);
		add_submenu_page(
			$this->plugin_name,
			esc_html__('Export', 'mos-sale-schedule-countdown-for-woocommerce'),
			esc_html__('Export', 'mos-sale-schedule-countdown-for-woocommerce'),
			'manage_options',
			$this->plugin_name . '-export',
			array($this, 'mos_sale_schedule_countdown_for_woocommerce_dashboard_page_html')
		);
		add_submenu_page(
			$this->plugin_name,
			esc_html__('Import', 'mos-sale-schedule-countdown-for-woocommerce'),
			esc_html__('Import', 'mos-sale-schedule-countdown-for-woocommerce'),
			'manage_options',
			$this->plugin_name . '-import',
			array($this, 'mos_sale_schedule_countdown_for_woocommerce_dashboard_page_html')
		);
	}
	public function mos_sale_schedule_countdown_for_woocommerce_dashboard_page_html(){
		if (!current_user_can('manage_options')) {
			return;
		}
		include_once('partials/' . $this->plugin_name . '-admin-display.php');
	}
	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function mos_sale_schedule_countdown_for_woocommerce_add_action_links($links)
	{

		/**
		 * Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 * The "plugins.php" must match with the previously added add_submenu_page first option.
		 * For custom post type you have to change 'plugins.php?page=' to 'edit.php?post_type=your_custom_post_type&page='
		 * 
		 */
		$settings_link = array(
			'<a href="' . admin_url('admin.php?page=' . $this->plugin_name) . '">' . esc_html__('Settings', 'mos-sale-schedule-countdown-for-woocommerce') . '</a>',
		);
		return array_merge($settings_link, $links);
	}
	

	/**
	 * Redirect to the welcome pages.
	 *
	 * @since    1.0.0
	 */
	public function mos_sale_schedule_countdown_for_woocommerce_do_activation_redirect()
	{
		if (get_option('mos_sale_schedule_countdown_for_woocommerce_do_activation_redirect')) {
			delete_option('mos_sale_schedule_countdown_for_woocommerce_do_activation_redirect');
			wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name));
		}
	}
	/**
	 * Add body classes to the settings pages.
	 *
	 * @since    1.0.0
	 */
	public function mos_sale_schedule_countdown_for_woocommerce_admin_body_class($classes)
	{

		$current_screen = get_current_screen();
		// var_dump($current_screen->id);
		$classes .= ' ' . $this->plugin_name . '-settings-template ';
		return $classes;
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


	// Handle export action
	public function mos_sale_schedule_countdown_for_woocommerce_export() {
		if ( isset( $_POST['mos_sale_schedule_countdown_for_woocommerce_action'] ) && $_POST['mos_sale_schedule_countdown_for_woocommerce_action'] === 'export' && check_admin_referer( 'mos_sale_schedule_countdown_for_woocommerce_export', 'mos_sale_schedule_countdown_for_woocommerce_export_nonce' ) ) {
			$mos_sale_schedule_countdown_for_woocommerce_options = mos_sale_schedule_countdown_for_woocommerce_get_option();
			$json_data = json_encode( $mos_sale_schedule_countdown_for_woocommerce_options );

			header( 'Content-Disposition: attachment; filename="mos_sale_schedule_countdown_for_woocommerce_settings.json"' );
			header( 'Content-Type: application/json' );
			echo $json_data;
			exit;
		}
	}
	// add_action( 'admin_init', 'mos_sale_schedule_countdown_for_woocommerce_export' );

	// Handle import action
	public function mos_sale_schedule_countdown_for_woocommerce_import() {
		if ( isset( $_POST['mos_sale_schedule_countdown_for_woocommerce_action'] ) && $_POST['mos_sale_schedule_countdown_for_woocommerce_action'] === 'import' && check_admin_referer( 'mos_sale_schedule_countdown_for_woocommerce_import', 'mos_sale_schedule_countdown_for_woocommerce_import_nonce' ) ) {
			if ( ! empty( $_FILES['mos_sale_schedule_countdown_for_woocommerce_import_file']['tmp_name'] ) ) {
				$json_data = file_get_contents( $_FILES['mos_sale_schedule_countdown_for_woocommerce_import_file']['tmp_name'] );
				$options = json_decode( $json_data, true );

				if ( json_last_error() === JSON_ERROR_NONE && is_array( $options ) ) {
					update_option( 'mos_sale_schedule_countdown_for_woocommerce_options', $options );
					add_settings_error( 'mos_sale_schedule_countdown_for_woocommerce_import', 'json_import_success', 'Settings imported successfully', 'updated' );
				} else {
					add_settings_error( 'mos_sale_schedule_countdown_for_woocommerce_import', 'json_import_error', 'Invalid JSON file.', 'error' );
				}
			}
		}
	}
	// add_action( 'admin_notices', 'mos_sale_schedule_countdown_for_woocommerce_import' );
	
}
