jQuery(document).ready(function($) {   
    $(document).on('click', '#mos_sale_schedule_countdown_for_woocommerce_wooinstall', function(e) {
        // console.log('clicked');
        e.preventDefault();
        var current = $(this);
        var plugin_slug = current.attr("data-plugin-slug");
        current.addClass('updating-message').text('Installing...');
        var data = {
            action: 'mos_sale_schedule_countdown_for_woocommerce_ajax_install_plugin',
            _ajax_nonce: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.install_plugin_wpnonce,
            slug: plugin_slug,
        };

        $.post(mos_sale_schedule_countdown_for_woocommerce_ajax_obj.ajax_url, data, function(response) {
            current.removeClass('updating-message');
            current.addClass('updated-message').text('Installing...');
            current.attr("href", response.data.activateUrl);
        })
        .fail(function() {
            current.removeClass('updating-message').text('Install Failed');
        })
        .always(function() {
            current.removeClass('install-now updated-message').addClass('activate-now button-primary').text('Activating...');
            current.unbind(e);
            current[0].click();
        });
    }); 
    $('body').on('click', '.button-reset', function(reset){
        // console.log('clicked');
        reset.preventDefault();
        let text = "Are You Sure?\nAre you sure you want to proceed with the changes.";
        if (confirm(text) == true) {
            let name= $(this).data('name');
            if(name) {
                var dataJSON = {
                    action: 'mos_sale_schedule_countdown_for_woocommerce_reset_settings',
                    _admin_nonce: mos_sale_schedule_countdown_for_woocommerce_ajax_obj._admin_nonce,
                    name: name,
                };
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: mos_sale_schedule_countdown_for_woocommerce_ajax_obj.ajax_url,
                    data: dataJSON,
                    // beforeSend: function() {
                    //     $('.some-class').addClass('loading');
                    // },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {}
                        // on success
                        // code...
                    },
                    error: function(xhr, status, error) {
                        console.log('Status: ' + xhr.status);
                        console.log('Error: ' + xhr.responseText);
                    },
                    complete: function() {}
                });
            }
        }        
    });
});
