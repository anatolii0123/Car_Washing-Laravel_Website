(function($) {
    $.fn.bootstrapValidator.i18n.momentDate = $.extend($.fn.bootstrapValidator.i18n.momentDate || {}, {
        'default': Yii.t('js', 'Please enter a valid date')
    });

    $.fn.bootstrapValidator.validators.momentDate = {
        html5Attributes: {
            message: 'message',
            format: 'format',
        },

        /**
         * Return true if the input value is valid date
         *
         * @param {BootstrapValidator} validator The validator plugin instance
         * @param {jQuery} $field Field element
         * @param {Object} options Can consist of the following keys:
         * - message: The invalid message
         * By default, it is /
         * - format: The date format. Default is MM/DD/YYYY
         * The format can be:
         */
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value === '') {
                return true;
            }

            options.format = options.format || 'MM/DD/YYYY';
            return moment(value,options.format).isValid();
        }
    };
}(window.jQuery));
