(function($, api) {
    'use strict';

    api.bind('ready', function() {
        // Ensure checkbox is added to existing menu items
        function addAdminOnlyCheckbox() {
            $('.menu-item-settings').each(function() {
                var $settings = $(this);
                var itemId = $settings.find('input.edit-menu-item-id').val();
                if (!$settings.find('.field-admin-only').length) {
                    $.post(gamer_heaven_customizer.ajaxurl, {
                        action: 'gamer_heaven_get_admin_only_checkbox',
                        item_id: itemId
                    }, function(response) {
                        if (response.success) {
                            $settings.append(response.data);
                            error_log('Gamer Heaven: Added admin-only checkbox for item ' + itemId);
                        } else {
                            console.error('Failed to load admin-only checkbox:', response.data);
                        }
                    });
                }
            });
        }

        // Initial load
        addAdminOnlyCheckbox();

        // Add checkbox to newly added menu items
        api.Menus.availableMenuItemsPanel.on('add', function() {
            setTimeout(addAdminOnlyCheckbox, 100);
        });

        // Handle checkbox changes (ensure form submission includes the value)
        $(document).on('change', '.gamer-heaven-admin-only-checkbox', function() {
            var $checkbox = $(this);
            var itemId = $checkbox.closest('.menu-item-settings').find('input.edit-menu-item-id').val();
            var isChecked = $checkbox.is(':checked');
            error_log('Gamer Heaven: Admin-only checkbox changed for item ' + itemId + ': ' + (isChecked ? 'checked' : 'unchecked'));
            // The checkbox value is automatically included in the form submission
        });
    });
})(jQuery, wp.customize);