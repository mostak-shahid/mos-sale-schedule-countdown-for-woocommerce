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
});