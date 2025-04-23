(function($, api) {
    'use strict';

    api.bind('ready', function() {
        console.log('Gamer Heaven: Customizer menu script loaded at ' + new Date().toISOString());

        // Ensure columns is defined to prevent nav-menu.js error
        if (typeof columns === 'undefined') {
            window.columns = { available: [], selected: [] };
            console.warn('Gamer Heaven: Defined fallback columns to prevent nav-menu.js error');
        }

        // Function to add checkbox to menu item settings
        function addAdminOnlyCheckbox() {
            $('.menu-item-settings').each(function() {
                var $settings = $(this);
                var itemId = $settings.find('input.edit-menu-item-id').val();
                if (!$settings.find('.field-admin-only').length && itemId) {
                    console.log('Gamer Heaven: Attempting to add checkbox for item ' + itemId);
                    $.ajax({
                        url: gamer_heaven_customizer.ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'gamer_heaven_get_admin_only_checkbox',
                            item_id: itemId
                        },
                        success: function(response) {
                            if (response.success) {
                                $settings.append(response.data);
                                console.log('Gamer Heaven: Added admin-only checkbox for item ' + itemId);
                            } else {
                                console.error('Gamer Heaven: Failed to load admin-only checkbox for item ' + itemId + ': ' + response.data);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Gamer Heaven: AJAX error for item ' + itemId + ': ' + error);
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
                console.log('Gamer Heaven: nav_menus control changed');
                setTimeout(addAdminOnlyCheckbox, 500);
            });
        } else {
            console.warn('Gamer Heaven: nav_menus control not found');
            // Fallback: Re-check after delay
            setTimeout(function() {
                if (api.control('nav_menus')) {
                    api.control('nav_menus').bind('change', function() {
                        console.log('Gamer Heaven: nav_menus control changed (delayed)');
                        setTimeout(addAdminOnlyCheckbox, 500);
                    });
                }
            }, 2000);
        }

        // Log checkbox state changes
        $(document).on('change', '.gamer-heaven-admin-only-checkbox', function() {
            var $checkbox = $(this);
            var itemId = $checkbox.closest('.menu-item-settings').find('input.edit-menu-item-id').val();
            console.log('Gamer Heaven: Admin-only checkbox changed for item ' + itemId + ': ' + ($checkbox.is(':checked') ? 'checked' : 'unchecked'));
        });
    });
})(jQuery, wp.customize);