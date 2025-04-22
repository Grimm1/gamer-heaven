(function($) {
    $(document).ready(function() {
        console.log('Social Repeater JS Loaded');

        // Debounce function to limit rapid updates
        function debounce(func, wait) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    func.apply(context, args);
                }, wait);
            };
        }

        // Add new social link field
        $('.social-repeater-add').on('click', function() {
            console.log('Add New Link Clicked');
            var container = $(this).closest('.social-repeater-container').find('.social-repeater-fields');
            var index = container.find('.social-repeater-field').length;
            var template = `
                <div class="social-repeater-field" data-index="${index}">
                    <div class="social-repeater-row">
                        <label>
                            <span>Platform Name</span>
                            <input type="text" class="social-repeater-name" value="" />
                        </label>
                        <label>
                            <span>URL</span>
                            <input type="url" class="social-repeater-url" value="" />
                        </label>
                        <label>
                            <span>Icon</span>
                            <div class="social-repeater-icon-upload">
                                <input type="hidden" class="social-repeater-icon" value="" />
                                <img src="" class="social-repeater-icon-preview" style="max-width: 50px; display: none;" />
                                <button type="button" class="button social-repeater-upload-button">Upload Icon</button>
                                <button type="button" class="button social-repeater-remove-icon" style="display: none;">Remove Icon</button>
                            </div>
                        </label>
                        <button type="button" class="button social-repeater-remove">Remove</button>
                    </div>
                </div>
            `;
            container.append(template);
            updateSocialLinksValue($(this).closest('.social-repeater-container'));
        });

        // Remove social link field
        $(document).on('click', '.social-repeater-remove', function() {
            console.log('Remove Link Clicked');
            var container = $(this).closest('.social-repeater-container');
            $(this).closest('.social-repeater-field').remove();
            updateSocialLinksValue(container);
        });

        // Handle media upload
        $(document).on('click', '.social-repeater-upload-button', function(e) {
            e.preventDefault();
            console.log('Upload Icon Clicked');
            var button = $(this);
            var field = button.closest('.social-repeater-field');
            var input = field.find('.social-repeater-icon');
            var preview = field.find('.social-repeater-icon-preview');
            var removeButton = field.find('.social-repeater-remove-icon');

            var frame = wp.media({
                title: 'Select Icon',
                button: { text: 'Use Icon' },
                multiple: false,
                library: { type: 'image' }
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                console.log('Icon Selected:', attachment.id);
                input.val(attachment.id);
                preview.attr('src', attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url).show();
                removeButton.show();
                updateSocialLinksValue(button.closest('.social-repeater-container'));
            });

            frame.open();
        });

        // Remove icon
        $(document).on('click', '.social-repeater-remove-icon', function(e) {
            e.preventDefault();
            console.log('Remove Icon Clicked');
            var field = $(this).closest('.social-repeater-field');
            field.find('.social-repeater-icon').val('');
            field.find('.social-repeater-icon-preview').attr('src', '').hide();
            $(this).hide();
            updateSocialLinksValue($(this).closest('.social-repeater-container'));
        });

        // Update hidden input value (debounced)
        var updateSocialLinksValue = debounce(function(container) {
            console.log('Updating Social Links Value');
            var fields = container.find('.social-repeater-field');
            var data = [];
            fields.each(function() {
                var name = $(this).find('.social-repeater-name').val() || '';
                var url = $(this).find('.social-repeater-url').val() || '';
                var icon = $(this).find('.social-repeater-icon').val() || '';
                data.push({
                    name: name,
                    url: url,
                    icon: icon
                });
            });
            var valueInput = container.find('.social-repeater-value');
            if (valueInput.length) {
                var jsonData = JSON.stringify(data);
                console.log('New Value:', jsonData);
                valueInput.val(jsonData).trigger('change');
                if (wp.customize && valueInput.attr('data-customize-setting-link')) {
                    wp.customize(valueInput.attr('data-customize-setting-link')).set(jsonData);
                    console.log('Customizer Notified:', valueInput.attr('data-customize-setting-link'));
                }
            } else {
                console.error('Hidden input not found in container:', container);
            }
        }, 300);

        // Update value on input change
        $(document).on('input change', '.social-repeater-name, .social-repeater-url, .social-repeater-icon', function() {
            console.log('Input Changed:', $(this).attr('class'));
            updateSocialLinksValue($(this).closest('.social-repeater-container'));
        });
    });
})(jQuery);