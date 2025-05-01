(function($) {
    'use strict';
    $(document).ready(function() {
        try {
            var $switcher = $('.language-switcher');
            var $login = $('#login');
            if ($switcher.length && $login.length) {
                $switcher.appendTo($login);
            }
        } catch (e) {
            // Silently fail
        }
    });
})(jQuery);