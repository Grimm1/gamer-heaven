(function($, api) {
    'use strict';

    api.bind('ready', function() {
        // Define columns to prevent nav-menu.js error (WordPress bug workaround)
        if (typeof columns === 'undefined') {
            window.columns = { available: [], selected: [] };
        }

        // Function to add checkbox to menu item settings
        function addAdminOnlyCheckbox() {
            $('.menu-item-settings').each(function() {
                var $settings = $(this);
                var itemId = $settings.find('input.edit-menu-item-id').val();
                if (!$settings.find('.field-admin-only').length && itemId) {
                    $.ajax({
                        url: gamer_heaven_customizer.ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'gamer_heaven_get_admin_only_checkbox',
                            item_id: itemId,
                            nonce: gamer_heaven_customizer.nonce
                        },
                        success: function(response) {
                            if (response.success) {
                                $settings.append(response.data);
                            }
                        }
                    });
                }
            });
        }

        // Initial load with delay
        setTimeout(addAdminOnlyCheckbox, 1000);

        // Observe changes in menu items
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    setTimeout(addAdminOnlyCheckbox, 500);
                }
            });
        });

        // Watch for menu item additions
        var menuContainer = document.querySelector('#customize-control-nav_menus');
        if (menuContainer) {
            observer.observe(menuContainer, { childList: true, subtree: true });
        }

        // Handle menu changes if nav_menus control exists
        if (api.control('nav_menus')) {
            api.control('nav_menus').bind('change', function() {
                setTimeout(addAdminOnlyCheckbox, 500);
            });
        }
    });
})(jQuery, wp.customize);