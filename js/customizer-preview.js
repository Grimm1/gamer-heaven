(function($) {
    // Social Links Preview
    wp.customize('gamer_heaven_social_links_repeater', function(value) {
        value.bind(function(newValue) {
            console.log('Customizer: Social Links Updated', newValue);
            try {
                var links = JSON.parse(newValue);
                var $socialLinks = $('.social-links');
                $socialLinks.empty();

                if (!Array.isArray(links) || links.length === 0) {
                    console.log('Customizer: No valid links to display');
                    return;
                }

                $.each(links, function(index, link) {
                    if (link.name && link.url && link.icon) {
                        $.ajax({
                            url: gamer_heaven_customizer.ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'gamer_heaven_get_icon_url',
                                icon_id: link.icon
                            },
                            success: function(response) {
                                if (response.success && response.data) {
                                    var platformClass = link.name.toLowerCase().replace(/\s+/g, '-');
                                    var html = `
                                        <li>
                                            <a href="${link.url}" class="${platformClass}">
                                                <img src="${response.data}" alt="${link.name}" class="social-icon">
                                                <span class="screen-reader-text">${link.name}</span>
                                            </a>
                                        </li>
                                    `;
                                    $socialLinks.append(html);
                                    console.log('Customizer: Icon Added:', link.name, response.data);
                                } else {
                                    console.warn('Customizer: Invalid Icon URL for ID:', link.icon);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Customizer: AJAX Error for Icon ID:', link.icon, error);
                            }
                        });
                    } else {
                        console.log('Customizer: Skipping incomplete link:', link);
                    }
                });
            } catch (e) {
                console.error('Customizer: JSON Parse Error', e, newValue);
            }
        });
    });

    // Left Background Image Preview
    wp.customize('gamer_heaven_left_background_image', function(value) {
        value.bind(function(newValue) {
            console.log('Customizer: Left Background Image Updated', newValue);
            var $leftImage = $('.gamer-heaven-left-background');
            if (newValue) {
                $.ajax({
                    url: gamer_heaven_customizer.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'gamer_heaven_get_icon_url',
                        icon_id: newValue
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            if ($leftImage.length) {
                                $leftImage.attr('src', response.data);
                            } else {
                                $('body').append(`<img src="${response.data}" class="gamer-heaven-background-image gamer-heaven-left-background" alt="Bottom Left Background">`);
                            }
                            console.log('Customizer: Left Background Image Added', response.data);
                        } else {
                            console.warn('Customizer: Invalid Left Background Image ID:', newValue);
                            $leftImage.remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Customizer: AJAX Error for Left Background Image ID:', newValue, error);
                    }
                });
            } else {
                $leftImage.remove();
                console.log('Customizer: Left Background Image Removed');
            }
        });
    });

    // Right Background Image Preview
    wp.customize('gamer_heaven_right_background_image', function(value) {
        value.bind(function(newValue) {
            console.log('Customizer: Right Background Image Updated', newValue);
            var $rightImage = $('.gamer-heaven-right-background');
            if (newValue) {
                $.ajax({
                    url: gamer_heaven_customizer.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'gamer_heaven_get_icon_url',
                        icon_id: newValue
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            if ($rightImage.length) {
                                $rightImage.attr('src', response.data);
                            } else {
                                $('body').append(`<img src="${response.data}" class="gamer-heaven-background-image gamer-heaven-right-background" alt="Bottom Right Background">`);
                            }
                            console.log('Customizer: Right Background Image Added', response.data);
                        } else {
                            console.warn('Customizer: Invalid Right Background Image ID:', newValue);
                            $rightImage.remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Customizer: AJAX Error for Right Background Image ID:', newValue, error);
                    }
                });
            } else {
                $rightImage.remove();
                console.log('Customizer: Right Background Image Removed');
            }
        });
    });
})(jQuery);