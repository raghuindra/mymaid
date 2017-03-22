var ct_postalcode_status_check = ct_postalcode_statusObj.ct_postalcode_status;
/* scroll to next step */
jQuery(document)
    .ready(function() {
        jQuery('.ct-service')
            .on('click', function() {
                jQuery('html, body')
                    .stop()
                    .animate({
                        'scrollTop': jQuery('.ct-scroll-meth-unit')
                            .offset()
                            .top - 30
                    }, 800, 'swing', function() {});
            });
    });
/* forget password */
jQuery(document)
    .ready(function() {
        jQuery('#ct_forget_password')
            .click(function() {
                jQuery('#rp_user_email')
                    .val('');
                jQuery('.forget_pass_correct')
                    .hide();
                jQuery('.forget_pass_incorrect')
                    .hide();
                jQuery('.ct-front-forget-password')
                    .addClass('show-data');
                jQuery('.ct-front-forget-password')
                    .removeClass('hide-data');
                jQuery('.main')
                    .css('display', 'block');

            });
        jQuery('#ct_login_user')
            .click(function() {
                jQuery('.ct-front-forget-password')
                    .removeClass('show-data');
                jQuery('.ct-front-forget-password')
                    .addClass('hide-data');
                jQuery('.main')
                    .css('display', 'none');
            });
    });


/* card payment validations */
jQuery(document)
    .ready(function() {

        jQuery('input.cc-number')
            .payment('formatCardNumber');
        jQuery('input.cc-cvc')
            .payment('formatCardCVC');
        jQuery('input.cc-exp-month')
            .payment('restrictNumeric');
        jQuery('input.cc-exp-year')
            .payment('restrictNumeric');

    });

jQuery(document)
    .ready(function() {

        jQuery('body')
            .niceScroll();
        jQuery('.common-data-dropdown')
            .niceScroll();
        jQuery('.ct-services-dropdown')
            .niceScroll();

        var frequently_discount_id = jQuery("input[name=frequently_discount_radio]:checked")
            .data('id');
        var frequently_discount_name = jQuery("input[name=frequently_discount_radio]:checked")
            .data('name');
        if (frequently_discount_id == 0) {
            jQuery('.f_dis_img')
                .hide();
        } else {
            jQuery('.f_dis_img')
                .show();
            jQuery(".f_discount_name")
                .text(frequently_discount_name);
        }
    });

/* dropdown services list */
/* services dropdown show hide list */
jQuery(document)
    .on("click", ".service-is", function() {
        jQuery(".ct-services-dropdown")
            .toggle("blind", {
                direction: "vertical"
            }, 300);
    });

jQuery(document)
    .on("click", ".select_service", function() {
        jQuery("#ct_selected_service")
            .html(jQuery(this)
                .html());
        jQuery(".ct-services-dropdown")
            .hide("blind", {
                direction: "vertical"
            }, 300);
    });

/* select hours based service */
jQuery(document)
    .on("click", ".ct-duration-btn", function() {
        jQuery('.ct-duration-btn')
            .each(function() {
                jQuery(this)
                    .removeClass('duration-box-selected');
            });
        jQuery(this)
            .addClass('duration-box-selected');
    });


/* for show how many addon counting when checked */
jQuery(document)
    .ready(function() {
        jQuery('input[type="checkbox"]')
            .click(function() {
                if (jQuery('.addon-checkbox')
                    .is(':checked')) {
                    jQuery('.common-selection-main.addon-select')
                        .show();
                } else {
                    jQuery('.common-selection-main.addon-select')
                        .hide();
                }
            });
    });


/* addons */
jQuery(document)
    .on("click", ".ct-addon-btn", function() {
        var curr_methodname = jQuery(this)
            .data('method_name');
        jQuery('.ct-addon-btn')
            .each(function() {
                if (jQuery(this)
                    .data('method_name') == curr_methodname) {
                    jQuery(this)
                        .removeClass('ct-addon-selected');
                }
            });
        jQuery(this)
            .addClass('ct-addon-selected');
    });



/* user contact no. */
/* checkout payment method listing show hide */
jQuery(document)
    .ready(function() {
        jQuery(".cccard")
            .click(function() {
                var test = jQuery(this)
                    .val();

                jQuery(".common-payment-style")
                    .show("blind", {
                        direction: "vertical"
                    }, 300);
            });

        jQuery("input[name=payment-methods]")
            .click(function() {
                if (jQuery(this)
                    .hasClass('cccard')) {

                } else {
                    jQuery(".common-payment-style")
                        .hide();
                }
            });

    });


/* see more instructions in service popup */
jQuery(document)
    .ready(function() {
        jQuery(".show-more-toggler")
            .click(function() {
                jQuery(".bullet-more")
                    .toggle("blind", {
                        direction: "vertical"
                    }, 500);
                jQuery(".show-more-toggler:after")
                    .addClass('rotate');
            });
    });



/*  create the back to top button */
jQuery(document)
    .ready(function() {
        jQuery('body')
            .prepend('<a href="javascript:void(0)" class="ct-back-to-top"></a>');
        var amountScrolled = 500;
        jQuery(window)
            .scroll(function() {
                if (jQuery(window)
                    .scrollTop() > amountScrolled) {
                    jQuery('a.ct-back-to-top')
                        .fadeIn('slow');
                } else {
                    jQuery('a.ct-back-to-top')
                        .fadeOut('slow');
                }
            });
        jQuery('a.ct-back-to-top, a.ct-simple-back-to-top')
            .click(function() {
                jQuery('html, body')
                    .animate({
                        scrollTop: 0
                    }, 2000);
                return false;
            });
    });




/************* Code by developer side --- ****************/

jQuery(document)
    .on('keyup keydown blur', '.add_show_error_class', function(event) {
        jQuery('.ct-loading-main')
            .hide();
        var id = jQuery(this)
            .attr('id');
        var Number = /(?:\(?\+\d{2}\)?\s*)?\d+(?:[ -]*\d+)*$/;
        if (jQuery(this)
            .hasClass('error')) {
            jQuery(this)
                .removeClass('error');
            jQuery("#" + id)
                .parent()
                .removeClass('error');
            jQuery(this)
                .addClass('show-error');

            jQuery("#" + id)
                .parent()
                .addClass('show-error');
            if (jQuery('#ct-user-phone')
                .val() != '') {
                if (!jQuery('#ct-user-phone')
                    .val()
                    .match(Number)) {
                    jQuery('.intl-tel-input')
                        .parent()
                        .addClass('show-error');
                }
            }
        } else {
            jQuery(this)
                .removeClass('error');
            jQuery("#" + id)
                .parent()
                .removeClass('error');
            jQuery(this)
                .removeClass('show-error');
            jQuery("#" + id)
                .parent()
                .removeClass('show-error');
            if (jQuery('#ct-user-phone')
                .val() != '') {
                if (jQuery('#ct-user-phone')
                    .val()
                    .match(Number)) {
                    jQuery('.intl-tel-input')
                        .parent()
                        .removeClass('show-error');
                }
            }
        }
    });

jQuery(document)
    .on('keyup keydown blur', '.add_show_error_class_for_login', function(event) {
        var id = jQuery(this)
            .attr('id');
        if (jQuery(this)
            .hasClass('error')) {
            jQuery(this)
                .removeClass('error');
            jQuery("#" + id)
                .parent()
                .removeClass('error');
            jQuery(this)
                .addClass('show-error');
            jQuery("#" + id)
                .parent()
                .addClass('show-error');
        } else {
            jQuery(this)
                .removeClass('error');
            jQuery("#" + id)
                .parent()
                .removeClass('error');
            jQuery(this)
                .removeClass('show-error');
            jQuery("#" + id)
                .parent()
                .removeClass('show-error');
        }
    });

var clicked = false;

jQuery(document)
    .on('click', '#accept-conditions', function() {
        jQuery('.terms_and_condition')
            .hide();
    });

jQuery(document)
    .on('click', '#ct-user-name', function() {
        jQuery('.login_unsuccessfull')
            .hide();
    });
jQuery(document)
    .on('click', '#ct-user-pass', function() {
        jQuery('.login_unsuccessfull')
            .hide();
    });


jQuery(document)
    .on("change", ".existing-user", function() {
        if (jQuery('.existing-user')
            .is(':checked')) {
            jQuery("#ct-preffered-name")
                .val('');
            jQuery("#ct-preffered-pass")
                .val('');
            jQuery("#ct-first-name")
                .val('');
            jQuery("#ct-last-name")
                .val('');
            jQuery("#ct-email")
                .val('');
            jQuery("#ct-user-phone")
                .val('');
            jQuery("#ct-street-address")
                .val('');
            jQuery("#ct-zip-code")
                .val('');
            jQuery("#ct-city")
                .val('');
            jQuery("#ct-state")
                .val('');
            jQuery("#ct-notes")
                .val('');
        }
    });
jQuery(document)
    .on("change", ".new-user", function() {
        if (jQuery('.new-user')
            .is(':checked')) {
            jQuery("#ct-user-name")
                .val('');
            jQuery("#ct-user-pass")
                .val('');
        }
    });


/* dropdown services methods list */
/* services methods dropdown show hide list */
jQuery(document)
    .on("click", ".service-method-is", function() {
        jQuery(".ct-services-method-dropdown")
            .toggle("blind", {
                direction: "vertical"
            }, 300);
    });

jQuery(document)
    .on("click", ".select_service_method", function() {
        jQuery("#ct_selected_servic_method")
            .html(jQuery(this)
                .html());
        jQuery(".ct-services-method-dropdown")
            .hide("blind", {
                direction: "vertical"
            }, 300);
        jQuery('#ct_selected_servic_method h3')
            .removeClass('s_m_units_design');
    });



jQuery(document)
    .on('click', '.addons_servicess_2', function() {
        var id = jQuery(this)
            .data('id');
        jQuery('.add_minus_buttonid' + id)
            .show();
        var m_name = jQuery(this)
            .data('mnamee');
        var value = jQuery(this)
            .prop('checked');

        if (value == false) {
            jQuery('.qtyyy_' + m_name)
                .val('1');
            var addon_id = jQuery(this)
                .data('id');
            jQuery('#minus' + addon_id)
                .trigger('click');
        } else if (value == true) {
            var addon_id = jQuery(this)
                .data('id');
            jQuery('#add' + addon_id)
                .trigger('click');
        }
    });
/* bedroom and bathroom counting for addons */




/* new existing user */

/* ct_user_radio_group */

jQuery(document)
    .on("change", ".existing-user", function() {
        if (jQuery('.existing-user')
            .is(':checked')) {
            jQuery('.ct-login-existing')
                .show("blind", {
                    direction: "vertical"
                }, 700);
            jQuery('.ct-new-user-details')
                .hide("blind", {
                    direction: "vertical"
                }, 300);
            jQuery('.ct-peronal-details')
                .hide("blind", {
                    direction: "vertical"
                }, 300);
        }
    });
jQuery(document)
    .on("change", ".new-user", function() {
        if (jQuery('.new-user')
            .is(':checked')) {
            jQuery('.ct-new-user-details')
                .show("blind", {
                    direction: "vertical"
                }, 700);
            jQuery('.ct-login-existing')
                .hide("blind", {
                    direction: "vertical"
                }, 300);
            jQuery('.ct-peronal-details')
                .show("blind", {
                    direction: "vertical"
                }, 300);

        }
    });


/*frequently_discount*/




jQuery(document)
    .on("click", "#contact_status", function() {
        var contact_status = jQuery("#contact_status")
            .val();
        if (contact_status == 'Other') {
            jQuery(".ct-option-others")
                .show();
        } else {
            jQuery(".ct-option-others")
                .hide();
        }
    });


/******* Service method - display design according to admin selection ******/

/* service checkbox */

jQuery(document)
    .ready(function() {
        jQuery("input[name=service-radio]")
            .click(function() {
                /*  jQuery(".ct-meth-unit-count").show( "blind", {direction: "vertical"}, 700 ); */
            });
    });


/* bedrooms dropdown show hide list */
jQuery(document)
    .on("click", ".select-bedrooms", function() {
        var unit_id = jQuery(this)
            .data('un_id');
        jQuery(".ct-" + unit_id + "-dropdown")
            .toggle("blind", {
                direction: "vertical"
            }, 300);
    });

/* select on click on bedroom */
jQuery(document)
    .on("click", ".select_bedroom", function() {
        var units_id = jQuery(this)
            .data('units_id');
        jQuery('#ct_selected_' + units_id)
            .html(jQuery(this)
                .html());
        jQuery(".ct-" + units_id + "-dropdown")
            .hide("blind", {
                direction: "vertical"
            }, 300);
    });

/* bedroom counting */

jQuery(document)
    .on("click", ".select_m_u_btn", function() {
        var units_id = jQuery(this)
            .data('units_id');
        jQuery('.u_' + units_id + '_btn')
            .each(function() {
                jQuery(this)
                    .removeClass('ct-bed-selected');
            });
        jQuery(this)
            .addClass('ct-bed-selected');
    });



/*Coupon Apply*/
jQuery(document)
    .ready(function() {
        jQuery('.ct-display-coupon-code')
            .hide();
        jQuery('.coupon_display')
            .hide();
    });

jQuery(document)
    .on('click', '#coupon_val', function() {
        jQuery('.coupon_invalid_error')
            .hide();
    });

/*Reverse Coupon Code*/

/*** calendar code start ***/
/* time slots dropdown show hide list */
jQuery(document)
    .on("click", ".time-slot-is", function() {
        jQuery(".time-slots-dropdown")
            .show("blind", {
                direction: "vertical"
            }, 700);
    });
jQuery(document)
    .on("click", ".time-slot", function() {
        jQuery('.time-slot')
            .each(function() {
                jQuery(this)
                    .removeClass('selected-time-slot');
                /*
		// var selectedtime = jQuery('ct-date-selected').data('date');
        // var slot_date = jQuery('ct-time-selected').text();
		// if(selectedtime == ct_time_selected && slot_date == ct_date){
			// jQuery(this).addClass('ct-booked');
		// }
		*/
            });
        jQuery(this)
            .addClass('selected-time-slot');
        jQuery(".time-slots-dropdown")
            .hide("blind", {
                direction: "vertical"
            }, 300);
    });

jQuery(document)
    .on('click', '.ct-week', function() {
        var valuess = jQuery(this)
            .val();
        var s_date = jQuery(this)
            .data('s_date');
        var c_date = jQuery(this)
            .data('c_date');
        if (s_date >= c_date) {
            jQuery('.ct-week')
                .each(function() {
                    jQuery(this)
                        .removeClass('active');
                    jQuery('.ct-show-time')
                        .removeClass('shown');
                });
            jQuery(this)
                .addClass('active');
            jQuery('.ct-show-time')
                .addClass('shown');
        } else if (s_date < c_date || valuess == '') {
            jQuery('.time_slot_box')
                .hide();
        }
    });
/******************/



jQuery(document)
    .on("click", ".time_slotss", function() {
        jQuery('.date_time_error')
            .hide();
        jQuery('.time_slot_box')
            .hide();
        jQuery('.space_between_date_time')
            .show();
        jQuery('.hidedatetime_value')
            .show();
        jQuery('.add_date')
            .addClass('ct-date-selected');
        jQuery('.add_time')
            .addClass('ct-time-selected');

        var slot_date_to_display = jQuery(this)
            .data('slot_date_to_display');
        var slot_date = jQuery(this)
            .data('slot_date');
        var slotdb_date = jQuery(this)
            .data('slotdb_date');
        var slot_time = jQuery(this)
            .data('slot_time');
        var slotdb_time = jQuery(this)
            .data('slotdb_time');
        /*
    // jQuery('.slot_displayysss'+slot_date).html(slot_time);
    // jQuery('.slot_displayysss'+slot_date).css('font-size','16px');
    // jQuery('.slot_displayysss'+slot_date).css('color','#FFF');
    // jQuery('.selected_datess'+slot_date).css('line-height','29px');
	 */
        var ct_date_selected = jQuery(this)
            .data('ct_date_selected');
        var ct_time_selected = jQuery(this)
            .data('ct_time_selected');

        jQuery('.ct-date-selected')
            .attr('data-date', slot_date);
        jQuery('#save_selected_date')
            .val(slot_date);
        jQuery('.ct-date-selected')
            .html(ct_date_selected);
        jQuery('.ct-time-selected')
            .html(ct_time_selected);

        jQuery('.cart_date')
            .html(slot_date_to_display);
        jQuery('.cart_date')
            .attr('data-date_val', slotdb_date);
        jQuery('.cart_time')
            .html(slot_time);
        jQuery('.cart_time')
            .attr('data-time_val', slotdb_time);

    });
jQuery(document)
    .on("click", ".today_btttn", function() {
        var today_date = jQuery(this)
            .data('cur_dates');
        jQuery('.dates .selected_datess' + today_date)
            .trigger('click');
    });


/*** calendar code end ***/
/* Display Country Code on click flag on phone*/
jQuery(document)
    .on('click', '.country', function() {
        var country_code = jQuery(this)
            .data("dial-code");
        jQuery("#ct-user-phone")
            .val('+' + country_code);
    });

/** Code for area code **/


/*Reset Password*/
jQuery(document)
    .on('click', '#reset_pass', function() {

        jQuery('.ct-loading-main')
            .show();
        jQuery('.add_show_error_class')
            .each(function() {
                jQuery(this)
                    .trigger('keyup');
            });
        var front_url = fronturlObj.front_url;
        var email = jQuery('#rp_user_email')
            .val();
        var dataString = {
            email: email,
            action: "forget_password"
        };
        if (jQuery('#forget_pass')
            .valid()) {
            jQuery.ajax({
                type: "POST",
                url: front_url + "firststep.php",
                data: dataString,
                success: function(response) {
                    jQuery('.ct-loading-main')
                        .hide();
                    if (response == 'not') {
                        jQuery('.forget_pass_incorrect')
                            .css('display', 'block');
                        jQuery('.forget_pass_incorrect')
                            .css('color', 'red');
                        jQuery('.forget_pass_incorrect')
                            .html(errorobj_invalid_email_id_please_register_first);
                    } else {
                        jQuery('.forget_pass_correct')
                            .css('display', 'block');
                        jQuery('.forget_pass_correct')
                            .css('color', 'green');
                        jQuery('.forget_pass_correct')
                            .html(errorobj_your_password_send_successfully_at_your_registered_email_id);

                        jQuery('#reset_pass')
                            .unbind('click');
                        jQuery('#reset_pass')
                            .css({
                                "pointer-events": "none",
                                "cursor": "default"
                            });
                        setTimeout(function() {
                            window.location.href = front_url;
                        }, 5000);
                        event.preventDefault();
                    }
                },
            });
        }
    });
/* validation for reset_password.php */

/* validation for reset_new_password.php */

jQuery(document)
    .on('click', '#rp_user_email', function() {
        jQuery('.forget_pass_incorrect')
            .hide();
    });
jQuery(document)
    .on('click', '#rn_password', function() {
        jQuery('.mismatch_password')
            .hide();
    });
jQuery(document)
    .on('click', '#n_password', function() {
        jQuery('.mismatch_password')
            .hide();
    });
jQuery(document)
    .on('click', '#password', function() {
        jQuery('.succ_password')
            .hide();
    });
jQuery(document)
    .on('click', '#email', function() {
        jQuery('.succ_password')
            .hide();
    });

/*Reset New Password*/
