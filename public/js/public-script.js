jQuery(document).ready(function($) { 
    $('.mssc-default-layout').countDown({
        // with_separators: false,
        css_class: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.css_class,
        always_show_days: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.always_show_days,
        with_labels: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_labels,
        with_seconds: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_seconds,
        with_separators: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_separators,
        with_hh_leading_zero: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_hh_leading_zero,
        with_mm_leading_zero: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_mm_leading_zero,
        with_ss_leading_zero: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.with_ss_leading_zero,
        label_dd: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.label_dd,
        label_hh: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.label_hh,
        label_mm: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.label_mm,
        label_ss: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.label_ss,
        separator: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.separator,
        separator_days: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.separator_days,

    });
    // $('.layout-1').countDown({
    //     css_class: 'countdown-alt-1',
    // });
    // $('.layout-2').countDown({
    //     css_class: 'countdown-alt-2'
    // });   
    /*
    css_class: 'countdown',
    always_show_days: false,
    with_labels: true,
    with_seconds: true,
    with_separators: true,
    with_hh_leading_zero: true,
    with_mm_leading_zero: true,
    with_ss_leading_zero: true,
    label_dd: 'days',
    label_hh: 'hours',
    label_mm: 'minutes',
    label_ss: 'seconds',
    separator: ':',
    separator_days: ','
    */
});