$(function() {
    $("#select-date")
        .datepicker();
    $.validator.methods.email = function(value, element) {
        return this.optional(element) || /[a-z]+@[a-z]+\.[a-z]+/.test(value);
    }
    // letters only
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");
    // matches text

    jQuery.validator.methods.matches = function(value, element, params) {
        var re = new RegExp(params);
        // window.console.log(re);
        // window.console.log(value);
        // window.console.log(re.test( value ));
        return this.optional(element) || re.test(value);
    }
    // phone validtaion

    jQuery.validator.addMethod('phone', function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, '');
        return this.optional(element) || phone_number.match(/^([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/);
    }, 'Please specify a valid phone number');
    // validations for box

    // box validations goes here
    $("#book-id")
        .validate({
            onfocusout: function(element) {
                var $el = $(element);
                if (!$el.is('select') && element.value === '' && element.defaultValue === '') {
                    // for untouched text fields, don't validate on blur
                    return;
                }
                $el.valid();
            },
            rules: {
                ct_first_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                    lettersonly: true
                },
                ct_last_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 100,
                    lettersonly: true
                },
                // cmnumber: {
                //     required: true,
                //     minlength: 10,
                //     maxlength: 15,
                //     number: true
                // },
                // cpname: {
                //     required: true,
                //     minlength: 3,
                //     maxlength: 24,
                //     lettersonly: true
                // },
                ct_city: {
                    required: true,
                    minlength: 3,
                    maxlength: 24,
                    lettersonly: true
                },
                ct_state: {
                    required: true,
                    minlength: 3,
                    maxlength: 24,
                    lettersonly: true
                },
                // holdername: {
                //     required: true,
                //     minlength: 3,
                //     maxlength: 24,
                //     lettersonly: true
                // },
                // bnkname: {
                //     required: true,
                //     minlength: 3,
                //     maxlength: 24,
                //     lettersonly: true
                // },
                // icnumber: {
                //     required: true,
                //     minlength: 3,
                //     maxlength: 24,
                //     number: true
                // },
                // ifsc: {
                //     required: true,
                //     minlength: 11,
                //     maxlength: 11,
                // },
                // accnumber: {
                //     required: true,
                //     minlength: 11,
                //     maxlength: 16,
                //     number: true
                // },
                // ofcnumber: {
                //     required: true,
                //     minlength: 10,
                //     maxlength: 13,
                //     phone: true,
                // },
                ct_user_phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 13,
                    phone: true,
                },
                ct_email: {
                    required: true,
                    email: true,
                },
                ct_zip_code: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    number: true
                }
            },
            // custom messages goes here
            messages: {
                email: {
                    required: "This is just to explain custom message"
                },
            },

        });

    // toggle content ct-partial-amount-message
    $(document)
        .off()
        .on("click", ".ser_details", function() {

            $(".ct-addon-count")
                .toggle();
            $(".ct-addon-count")
                .find("input[type='checkbox']")
                .prop("checked", false);
            if ($(this)
                .data("id") == 1) {
                $(".plumbing-service")
                    .slideUp();
                $(".home-service")
                    .slideDown();
                $(".handyman-service")
                    .slideUp();
                $(".office-service")
                    .slideUp();
            } else if ($(this)
                .data("id") == 2) {
                $(".home-service")
                    .slideUp();
                $(".plumbing-service")
                    .slideDown();
                $(".handyman-service")
                    .slideUp();
                $(".office-service")
                    .slideUp();
            } else if ($(this)
                .data("id") == 3) {
                $(".home-service")
                    .slideUp();
                $(".plumbing-service")
                    .slideUp();
                $(".handyman-service")
                    .slideDown();
                $(".office-service")
                    .slideUp();
            } else if ($(this)
                .data("id") == 4) {
                $(".home-service")
                    .slideUp();
                $(".plumbing-service")
                    .slideUp();
                $(".handyman-service")
                    .slideUp();
                $(".office-service")
                    .slideDown();
            }
        });
    $(document)
        .on("click", ".addon-checkbox", function() {
            $(this)
                .parents(".add_addon_class_selected")
                .find(".ct-addon-count")
                .toggle();
        });
    $(document)
        .on("click", ".ct-btn-group .minus", function() {
            if ($(this)
                .parents(".ct-btn-group")
                .find(".ct-btn-text")
                .val() == 0) {
                $(this)
                    .parents(".add_addon_class_selected")
                    .find(".addon-checkbox")
                    .trigger("click");
                return false;
            }
            $(this)
                .parents(".ct-btn-group")
                .find(".ct-btn-text")
                .val(parseInt($(this)
                    .parents(".ct-btn-group")
                    .find(".ct-btn-text")
                    .val()) - 1);
        });
    $(document)
        .on("click", ".ct-btn-group .add", function() {
            $(this)
                .parents(".ct-btn-group")
                .find(".ct-btn-text")
                .val(parseInt($(this)
                    .parents(".ct-btn-group")
                    .find(".ct-btn-text")
                    .val()) + 1);
        });

    $("#ct-price-scroll-new")
        .stick_in_parent();

});
