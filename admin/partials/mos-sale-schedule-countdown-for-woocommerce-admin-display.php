<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) die;
$mos_sale_schedule_countdown_for_woocommerce_options = mos_sale_schedule_countdown_for_woocommerce_get_option();
// echo '<pre>';
// var_dump($mos_sale_schedule_countdown_for_woocommerce_options);
// echo '</pre>';
$current_screen = get_current_screen();
var_dump($current_screen->id);
?>

<!--
<form method="post" enctype="multipart/form">
    <?php wp_nonce_field('mos_sale_schedule_countdown_for_woocommerce_action', 'mos_sale_schedule_countdown_for_woocommerce_field'); ?>
    <div class="mos-sale-schedule-countdown-for-woocommerce-settings-wrapper">
        <h3>Count down settings</h3>
        <ul>
            <li>always_show_days: false,</li>
            <li>with_labels: true,</li>
            <li>with_seconds: true,</li>
            <li>with_separators: true,</li>
            <li>with_hh_leading_zero: true,</li>
            <li>with_mm_leading_zero: true,</li>
            <li>with_ss_leading_zero: true,</li>
            <li>label_dd: 'days',</li>
            <li>label_hh: 'hours',</li>
            <li>label_mm: 'minutes',</li>
            <li>label_ss: 'seconds',</li>
            <li>separator: ':',</li>
            <li>separator_days: ','</li>
        </ul>
        <h3>Style</h3>
        <ul>
            <li>Wrapper BG</li>
            <li>Wrapper Border</li>
            <li>Wrapper Padding</li>
            <li>Wrapper Margin</li>

            <li>Unit BG</li>
            <li>Unit label text color</li>
            <li>Unit label BG</li>
            <li>Unit Counter text Color</li>
        </ul>
        <h3>Advance</h3>
        <ul>
            <li>Css panel</li>
            <li>Js panel</li>
        </ul>
        <h3>Export Settings</h3>
        <h3>Import Settings</h3>
    </div>
</form>
-->
<div class="wrap">
        
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="">
        <?php wp_nonce_field( 'mos_sale_schedule_countdown_for_woocommerce_export', 'mos_sale_schedule_countdown_for_woocommerce_export_nonce' ); ?>
        <input type="hidden" name="mos_sale_schedule_countdown_for_woocommerce_action" value="export" />
        <?php submit_button( 'Export as JSON' ); ?>
    </form>

    <h2>Import Settings</h2>
    <form method="post" enctype="multipart/form-data" action="">
        <?php wp_nonce_field( 'mos_sale_schedule_countdown_for_woocommerce_import', 'mos_sale_schedule_countdown_for_woocommerce_import_nonce' ); ?>
        <input type="file" name="mos_sale_schedule_countdown_for_woocommerce_import_file" accept=".json" required />
        <input type="hidden" name="mos_sale_schedule_countdown_for_woocommerce_action" value="import" />
        <?php submit_button( 'Import from JSON' ); ?>
    </form>
</div>