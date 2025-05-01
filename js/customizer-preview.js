(function($) {
    'use strict';

    // Social Links Preview
    wp.customize('gamer_heaven_social_links_repeater', function(value) {
        value.bind(function(newValue) {
            try {
                var links = JSON.parse(newValue);
                var $socialLinks = $('.social-links');
                $socialLinks.empty();

                if (!Array.isArray(links) || links.length === 0) {
                    return;
                }

                $.each(links, function(index, link) {
                    if (link.name && link.url && link.icon) {
                        $.ajax({
                            url: gamer_heaven_customizer.ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'gamer_heaven_get_icon_url',
                                icon_id: link.icon,
                                nonce: gamer_heaven_customizer.nonce
                            },
                            success: function(response) {
                                if (response.success && response.data) {
                                    var platformClass = $('<div>').text(link.name).html().toLowerCase().replace(/\s+/g, '-');
                                    var html = `
                                        <li>
                                            <a href="${$('<div>').text(link.url).html()}" class="${platformClass}">
                                                <img src="${$('<div>').text(response.data).html()}" alt="${$('<div>').text(link.name).html()}" class="social-icon">
                                                <span class="screen-reader-text">${$('<div>').text(link.name).html()}</span>
                                            </a>
                                        </li>
                                    `;
                                    $socialLinks.append(html);
                                }
                            }
                        });
                    }
                });
            } catch (e) {
                // Silent failure; invalid JSON is handled server-side
            }
        });
    });

    // Left Background Image Preview
    wp.customize('gamer_heaven_left_background_image', function(value) {
        value.bind(function(newValue) {
            var $leftImage = $('.gamer-heaven-left-background');
            if (newValue) {
                $.ajax({
                    url: gamer_heaven_customizer.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'gamer_heaven_get_icon_url',
                        icon_id: newValue,
                        nonce: gamer_heaven_customizer.nonce
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            if ($leftImage.length) {
                                $leftImage.attr('src', response.data);
                            } else {
                                $('body').append(`<img src="${$('<div>').text(response.data).html()}" class="gamer-heaven-background-image gamer-heaven-left-background" alt="">`);
                            }
                        } else {
                            $leftImage.remove();
                        }
                    }
                });
            } else {
                $leftImage.remove();
            }
        });
    });

    // Right Background Image Preview
    wp.customize('gamer_heaven_right_background_image', function(value) {
        value.bind(function(newValue) {
            var $rightImage = $('.gamer-heaven-right-background');
            if (newValue) {
                $.ajax({
                    url: gamer_heaven_customizer.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'gamer_heaven_get_icon_url',
                        icon_id: newValue,
                        nonce: gamer_heaven_customizer.nonce
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            if ($rightImage.length) {
                                $rightImage.attr('src', response.data);
                            } else {
                                $('body').append(`<img src="${$('<div>').text(response.data).html()}" class="gamer-heaven-background-image gamer-heaven-right-background" alt="">`);
                            }
                        } else {
                            $rightImage.remove();
                        }
                    }
                });
            } else {
                $rightImage.remove();
            }
        });
    });
    wp.customize( 'gamer_heaven_show_header_search', function( value ) {
        value.bind( function( newval ) {
            if ( newval ) {
                $( '.header-search' ).show();
            } else {
                $( '.header-search' ).hide();
            }
        } );
    } );
})(jQuery);