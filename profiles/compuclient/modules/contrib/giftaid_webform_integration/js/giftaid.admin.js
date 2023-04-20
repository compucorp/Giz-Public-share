(function ($) {
    Drupal.behaviors.giftaidBehaviour = {
        attach: function (context, settings) {
            var eligibilityFieldName = Drupal.settings.giftaidWebformIntegration.eligibilityFieldName;

            function checkAddressFields() {
                var addressFieldName = "";
                var fieldPartWeNeed = "";
                var fieldsNotEnabled = [];
                if ($('[name=contact_1_number_of_address]').val() == '0') {
                    var msg = "You need to enable home address fields to make gift aid work.";
                    return msg;
                } else {
                    var addressTypeElements = $("[name$=address_location_type_id]");
                    for (var i = 0; i < addressTypeElements.length; i++) {
                        var element = $('[name=' + addressTypeElements[i].name + ']');
                        var addressType = element.find(":selected").text();
                        if (addressType == 'Home') {
                            addressFieldName = addressTypeElements[i].name;
                            break;
                        }
                    }

                    if (addressFieldName !== "") {
                        var fieldNamePartWeNeed = addressFieldName.replace('address_location_type_id', '');
                        var fieldNamesToCheck = [
                            'address_street_address',
                            'address_city',
                            'address_postal_code',
                            'address_state_province_id'
                        ];

                        for (var i = 0; i < fieldNamesToCheck.length; i++) {
                            var fullFieldName = fieldNamePartWeNeed + fieldNamesToCheck[i];
                            if ($('[name=' + fullFieldName + ']').prop('checked') == false) {
                                fieldsNotEnabled.push(fieldNamesToCheck[i]);
                            }
                        }

                        if (fieldsNotEnabled.length === 0) {
                            return true;
                        } else {
                            var msg = "You must enable " + fieldsNotEnabled.join(', ') + " fields";
                            return msg;
                        }
                    } else {
                        var msg = "You need to enable home address fields to make gift aid work.";
                        return msg;
                    }

                }
            }

            function checkRequiredFields() {
                if ($('[name=' + eligibilityFieldName + ']').prop('checked') == true) {
                    var msg = checkAddressFields();
                    if (msg !== true) {
                        if (!$('.giftaid-address-alert').length) {
                            $('[name=' + eligibilityFieldName + ']')
                                    .closest(".form-wrapper")
                                    .before('<div class="messages error giftaid-address-alert">' + msg + '</div>')
                        } else {
                            $('.giftaid-address-alert').html(msg);
                        }
                    } else if ($('.giftaid-address-alert').length) {
                        $('.giftaid-address-alert').remove();
                    }
                } else if ($('[name=' + eligibilityFieldName + ']').prop('checked') == false) {
                    if ($('.giftaid-address-alert').length) {
                        $('.giftaid-address-alert').remove();
                    }
                }
            }

            $("input[type=checkbox]").click(checkRequiredFields);
            checkRequiredFields();
        },
    };
})(jQuery);