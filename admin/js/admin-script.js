jQuery(document).ready(function($) {  
    $('.cancel_sale_schedule').on('click', function(e){
        e.preventDefault();
        // console.log('clicked');
        $('._mos_sale_schedule_countdown_for_woocommerce_countdown_content_field').hide();
    });  
    $('.sale_schedule').on('click', function(e){
        e.preventDefault();
        // console.log('clicked');
        $('._mos_sale_schedule_countdown_for_woocommerce_countdown_content_field').show();
    });  
    $('.count-down').countDown({
		css_class: 'countdown-alt-1',	
        label_dd: 'days',
        label_hh: 'hours',
        label_mm: 'min',
        label_ss: 'secs',
        //with_separators: true,	
	});
});