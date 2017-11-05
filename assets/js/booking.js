$(function() {
   
     function showExistingUserDetails(){
        $(".ct-login-existing").show();
        $(".ct-new-user-details").hide();
        $('#ct-user-email').attr('required', true);
        $('#ct-user-pass').attr('required', true);
        $('#ct-email').attr('required', false);
        $('#ct-re-email').attr('required', false);
        $('#ct-preffered-pass').attr('required', false);
    }
    
    function showNewUserDetails(){
        $(".ct-login-existing").hide();
        $(".ct-new-user-details").show();
        $('#ct-user-email').attr('required', false);
        $('#ct-user-pass').attr('required', false);
        $('#ct-email').attr('required', true);
        $('#ct-re-email').attr('required', true);
        $('#ct-preffered-pass').attr('required', true);
    }
    
    
    $("#select-date")
        .datepicker({ 
        dateFormat: "yy-mm-yy", 
        minDate:0,
        onSelect: function(){
        var selected = $(this).val();
        //alert(selected);
        }
    });

    $('.date_selection').datepicker({
        autoclose: true,
        dateFormat: "dd-mm-yy", 
          minDate:0,
          onSelect: function(){
          var selected = $(this).val();
          //alert(selected);
          }
    });


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
//            if ($(this)
//                .data("id") == 1) {
//                $(".plumbing-service")
//                    .slideUp();
//                $(".home-service")
//                    .slideDown();
//                $(".handyman-service")
//                    .slideUp();
//                $(".office-service")
//                    .slideUp();
//            } else if ($(this)
//                .data("id") == 2) {
//                $(".home-service")
//                    .slideUp();
//                $(".plumbing-service")
//                    .slideDown();
//                $(".handyman-service")
//                    .slideUp();
//                $(".office-service")
//                    .slideUp();
//            } else if ($(this)
//                .data("id") == 3) {
//                $(".home-service")
//                    .slideUp();
//                $(".plumbing-service")
//                    .slideUp();
//                $(".handyman-service")
//                    .slideDown();
//                $(".office-service")
//                    .slideUp();
//            } else if ($(this)
//                .data("id") == 4) {
//                $(".home-service")
//                    .slideUp();
//                $(".plumbing-service")
//                    .slideUp();
//                $(".handyman-service")
//                    .slideUp();
//                $(".office-service")
//                    .slideDown();
//            }
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
            
            var count = parseInt($(this)
                    .parents(".ct-btn-group")
                    .find(".ct-btn-text")
                    .val());
            if (count == 0) {
                $(this)
                    .parents(".add_addon_class_selected")
                    .find(".addon-checkbox")
                    .trigger("click");
                return false;
            }
            count = count -1;
            $(this)
                .parents(".ct-btn-group")
                .find(".ct-btn-text")
                .val(count);
            

            var addonId = $(this).attr('data-ids');
            if(addonId !== '0'){
                var obj = {'addonId':addonId, 'addonCount':count};
                Booking.setAddon(addonId, obj);
                var Addon = ServiceObjects.ServiceAddonsObject;
                var price = Addon.getServiceAddon(Booking.getService(), addonId).service_addon_price_price;
                if(count >= 0){
                    Booking.deductAddonPrice(price);
                
                    $("#ct-price-scroll-new .cart_sub_total").html(Booking.getPrice());           
                    //Booking.calculateTotalPrice(price);
                    $("#ct-price-scroll-new .cart_total").html(Booking.calculateTotalPrice());
                    var addonName = Addon.getServiceAddon(Booking.getService(), addonId).service_addon_name;
                    Booking.setAddonName(addonName,count);
                }
                RenderView.showAddonNames();
                //console.log(Booking.getAddon());
                //console.log("Addon Count: "+ count);
            }
        });
        
    $(document)
        .on("click", ".ct-btn-group .add", function() {
            
            var count = parseInt($(this)
                    .parents(".ct-btn-group")
                    .find(".ct-btn-text")
                    .val());
            count = count +1;
            $(this)
                .parents(".ct-btn-group")
                .find(".ct-btn-text")
                .val(count);
        
            var addonId = $(this).attr('data-ids');
            if(addonId !== '0'){
                var obj = {'addonId':addonId, 'addonCount':count};
                Booking.setAddon(addonId, obj);
                //console.log(Booking.getAddon());
                //console.log("Addon Count: "+ count); 
                var Addon = ServiceObjects.ServiceAddonsObject;
                var price = Addon.getServiceAddon(Booking.getService(), addonId).service_addon_price_price;
                if(count >= 0){
                    Booking.addAddonPrice(price);
                
                    $("#ct-price-scroll-new .cart_sub_total").html(Booking.getPrice());           
                    //Booking.calculateTotalPrice(price);
                    $("#ct-price-scroll-new .cart_total").html(Booking.calculateTotalPrice());
                    var addonName = Addon.getServiceAddon(Booking.getService(), addonId).service_addon_name;
                    Booking.setAddonName(addonName,count);
                }
                RenderView.showAddonNames();
            }
        });
    
    //Right Price Floater DIV
    $("#ct-price-scroll-new").stick_in_parent();

    // Event to handle on user Selection radio button event
    $('.user-selection').on('click', function(){
        
        var userType = $(this).val();
        if(userType == "Existing-User"){
            showExistingUserDetails();
        }else if(userType == "New-User"){
            showNewUserDetails();
        }
        
    });
    
    //Event to handle on User selection on page load
 
    var userType = $('.user-selection').val();
    if(userType == "Existing-User"){
        showExistingUserDetails();
    }else if(userType == "New-User"){
        showNewUserDetails();
    }
    
    if(user_logged_in == "No"){
        $(".ct-new-user-details").show();
        $(".ct-login-existing").hide();
        $("#new-user").trigger('click');
    }else if(user_logged_in == "Yes"){
        showExistingUserDetails();
        $(".ct-new-user-details").hide();
        $(".ct-login-exist").hide();
        $("#existing-user").trigger('click');
    }
    

    $('.house_type').on('click', function(){
        
        
        
    });
   
    
    getUserDetails();
    //Get User Details If logged In
    function getUserDetails(){
        $.ajax({
            type: "POST",
            url: base_url+'getUserDetails.html',
            data: '',
            cache: false,
            success: function (res) {

                var result = JSON.parse(res);

                if (result.status === true) {
                    //console.log(result);
                    $(".ct-new-user-details").hide();
                    $(".ct-login-exist").hide();
                    $('#ct-user-email').attr('required', false);
                    $('#ct-user-pass').attr('required', false);

                    var info = result.data[0];
                        $("#ct-first-name").val(info.person_first_name);
                        $("#ct-last-name").val(info.person_last_name);
                        $("#ct-user-phone").val(info.person_mobile);
                        $("#ct-street-address").val(info.person_address);
                        //$("#ct-zip-code").val(info.person_postal_code);
                        $("#ct-city").val(info.person_city);
                        $("#ct-state").val(info.person_state);

                }
            }
        });
    }
    
    $("#login_existing_user").on('click', function(e){
        e.preventDefault();
        var email = $("#ct-user-email").val();
        var pass  = $("#ct-user-pass").val();
        
        $.ajax({
            type: "POST",
            url: base_url+'bookingUserLogin.html',
            data: {'email':email, 'pass':pass},
            cache: false,
            success: function (res) {

                var result = JSON.parse(res);

                if (result.status === true) {
                    notifyMessage('success', result.message);
                    $(".ct-new-user-details").hide();
                    $(".ct-login-exist").hide();

                    getUserDetails();    
                }else{
                    notifyMessage('error', result.message);
                }
            }
        });
        
        
    });
    
    
});

