<?php 
//print_r($config);

?>
<style>
    .text-red{
        color: red;
    }
    .error_message{
        margin-left: 15px;
    }

    .services-list li label, .addon-service-list li label {
    
    text-align:center;    
    /*font-family: Arial, Helvetica, sans-serif;*/
    font-size: 14px;
    /*color: #ffffff;*/
    padding: 10px 20px;
/*    background: -webkit-gradient(
        linear, left top, left bottom,
        from(#ffcb69),
        color-stop(0.50, #f0a733),
        color-stop(0.92, #f2a324),
        to(#ffb730));*/
        -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    border: 1px solid #965F06;
    -moz-box-shadow:
        0px 1px 1px rgba(000,000,000,0.5),
        inset 1px 2px 0px rgba(255,255,255,0.4);
    -webkit-box-shadow:
        0px 1px 1px rgba(000,000,000,0.5),
        inset 1px 2px 0px rgba(255,255,255,0.4);
    box-shadow:
        0px 1px 1px rgba(000,000,000,0.5),
        inset 1px 2px 0px rgba(255,255,255,0.4);
    /*text-shadow:
        1px 1px 2px rgba(000,000,000,0.7),
        0px 1px 0px rgba(255,255,255,0.4);*/
}
</style>
<a href="javascript:void(0)" class="ct-back-to-top" style="display: none;"></a>
<div id="postcodeSearch" style="display: none;" data-val="<?php echo $this->session->userdata('service_location_search'); ?>"></div>
<!--<form id="book-id">-->
<form id="paymentForm" name="frmPayment" method="post" >

    <div class="ct-wrapper" id="ct">
        <!-- main wrapper -->
        <div class="ct-loading-main" style="display: none;">
            <div class="loader">Loading...</div>
        </div>
        <div class="ct-main-wrapper"  style="background-color: #D2D6DE;">
            <div class="container">
                <!-- left side main booking form -->
                <div class="ct-main-left ct-sm-7 ct-md-7 ct-xs-12 mt-30 br-5 np" style="box-shadow: 0 5px 20px #000;">
                    <div class="ct-sm-12 ct-md-12 ta-c ct-location-header">
                        <h2 class="header2"><a href="<?php echo base_url();?>" style="text-decoration: none;">MyMaidz</a></h2>
                        <!-- <h6 class="header6 hidden">Bengaluru, Banasawadi, 586112<span class="ct-company-phone">
                            </span></h6> -->

                        <!-- <a class="ct-link ct-mybookings" target="_blank" href="#">My Bookings</a> -->
                    </div>
                    <!--                    <div class="ct-list-services ct-common-box">
                                            <div class="ct-list-header">
                                                <h3 class="header3">Where would you like us to provide service?</h3>
                                                <p class="ct-sub">Choose your service and property size</p>
                                            </div>
                                            <div class="ct-address-area-main">
                    
                                                <div class="ct-postal-code">
                                                    <h6 class="header6">Zip or Postal Code</h6>
                    
                                                    <div class="ct-md-3 ct-sm-6 ct-xs-12">
                                                        <input required type="number" class="ct-postal-input" name="ct_postal_code" id="ct_postal_code" placeholder="90001">
                                                        <label class="postal_code_error error" style="display: inline;">Please enter postal code</label>
                                                        <label class="postal_code_available" style="display: none;"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                    <!-- end area based -->
                    <div class="ct-list-services ct-common-box fl hide_allsss">
                        <div class="ct-list-header">
                            <h3 class="header3">Choose service</h3>

                            <p class="ct-sub" style="display: none;">Choose your service and property size</p>
                            <label class="service_not_selected_error" id="service_not_selected_error"></label>
                        </div>
                        <input id="total_cart_count" type="hidden" name="total_cart_count" value="1">
                        <!-- area based select cleaning -->
                        
                        <!-- 1.box style services selection radio selection -->
                        <ul class="services-list" id="booking_service_list">

                        </ul>
                        <!--  1 end box style service selection -->

                    </div>
                    <!-- end service list -->


                    <div class="fl hide_allsss ct-list-services ct-common-box service_package_list_div" >
                        <div class="ct-list-header">
                            <h3 class="header3">Choose Package</h3>

                            <p class="ct-sub" style="display: none;">Choose your service and property size</p>
                            <label class="service_not_selected_error" id="service_not_selected_error"></label>
                        </div>

                        <!-- Start Package Div Section -->
                        <div class="packageDiv">
                            <!-- 1.box style services Package selection radio selection -->
                            <!-- <ul class="services-list">

                            </ul> -->

                        </div>
                        <!-- end Package Div Section -->
                    </div>
                    <!-- end module third area based -->

                    <!-- Choose Bulding Type Div only for Basic Home Clenaing -->
                    <div class="ct-user-info-main ct-common-box building_type_div hide_allsss" style="border: 1px solid RGBA(0, 0, 0, 0.13);margin-bottom: 20px; display: none; border-radius: 15px;">
                        <div class="ct-list-header">
                            <h3 class="header3">Choose House Type</h3>

                            <!-- <p class="ct-sub" >Please provide your address and contact details</p>
 -->                           
                        </div>

                        <div class="ct-main-details">
                            <div class="">
                                <div class="ct-custom-radio">
                                    <ul class="ct-radio-list ">
                                        <li class="ct-md-4 ct-sm-6 ct-xs-12" style="margin-bottom: 10px;">
                                            <input id="apartment" type="radio" class="house_type input-radio" name="house_type[]" value="APARTMENT">
                                            <label for="apartment" class=""><span></span>Apartment / Condo</label>
                                        </li>
                                        <li class="ct-md-4 ct-sm-6 ct-xs-12" style="margin-bottom: 10px;">
                                            <input id="semi_d" type="radio" class="house_type input-radio" name="house_type[]" value="Semin - D">
                                            <label for="semi_d" class=""><span></span>Semin - D</label>
                                        </li>
                                        
                                        <li class="ct-md-4 ct-sm-6 ct-xs-12" style="margin-bottom: 10px;">
                                            <input id="pent_house" type="radio" class="house_type input-radio" name="house_type[]" value="Pent-House">
                                            <label for="pent_house" class=""><span></span>Pent-House</label>
                                        </li>
                                        <li class="ct-md-4 ct-sm-6 ct-xs-12" style="margin-bottom: 10px;">
                                            <input id="link_house" type="radio" class="house_type input-radio" name="house_type[]" value="Link-House">
                                            <label for="link_house" class=""><span></span>Link-House</label>
                                        </li>
                                        <li class="ct-md-4 ct-sm-6 ct-xs-12" style="margin-bottom: 10px;">
                                            <input id="bunglow" type="radio" class="house_type input-radio" name="house_type[]" value="Bunglow">
                                            <label for="bunglow" class=""><span></span>Bunglow</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ct-extra-services-list service-method-selection-main ct-common-box add_on_lists hide_allsss_addons" style="border-color: white;">
                            <div class="ct-list-header">
                                <h3 class="header3" style="display:none;"></h3>
                                <p class="ct-sub" style="display:none;"></p>
                            </div>
                                <ul class="addon-service-list fl remove_addonsss">
                                    <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                        <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-id="4" id="ct-addon-4" data-mnamee="ad_unit4">
                                        <label class="ct-addon-ser border-c" for="ct-addon-4">
                                            
                                            <div class="ct-addon-img"><img src=<?php echo base_url()."/assets/images/bedroom.png"; ?>></div>

                                        </label>
                                        <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid4" style="display: none;">

                                            <div class="ct-btn-group">
                                                <button data-ids="0" id="minus4" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="0" data-duration_value="" data-mnamee="ad_unit4" data-method_name="Damaged Flooring" data-service_id="0" data-rate="" data-method_id="0" data-type="addon">-</button>

                                                <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit4" data-rate="10">

                                                <button data-ids="0" id="add4" data-db-qty="5" data-mnamee="ad_unit4" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="0" data-service_id="0" data-method_id="0" data-duration_value="" data-method_name="Damaged Flooring" data-rate=""
                                                        data-type="addon">+</button>
                                            </div>
                                        </div>
                                        <div class="addon-name fl ta-c">Bedrooms</div>
                                    </li>
                                    <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                        <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-id="5" id="ct-addon-5" data-mnamee="ad_unit5">
                                        <label class="ct-addon-ser border-c" for="ct-addon-5">
                                            
                                            <div class="ct-addon-img"><img src=<?php echo base_url()."/assets/images/bathroom.png"; ?>></div>

                                        </label>
                                        <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid5" style="display: none;">

                                            <div class="ct-btn-group">
                                                <button data-ids="0" id="minus1" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="0" data-duration_value="" data-mnamee="ad_unit5" data-method_name="Door jams" data-service_id="0" data-rate="" data-method_id="0" data-type="addon">-</button>

                                                <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit5" data-rate="10">

                                                <button data-ids="0" id="add1" data-db-qty="0" data-mnamee="ad_unit5" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="0" data-service_id="0" data-method_id="0" data-duration_value="" data-method_name="Door jams" data-rate="" data-type="addon">+</button>
                                            </div>
                                        </div>
                                        <div class="addon-name fl ta-c">Bathrooms</div>
                                    </li>
                                </ul>
                        </div>
                    </div>

                    <div >&nbsp;</div>
                    <!-- /. Choose Building Type. END-->

                    <!-- Service Addons Div -->
                    <div id="service_addons_div">


                    </div>
                    <!-- /. Service Addons Div -->

                    <!-- how often discount -->
                    <div class="ct-extra-services-list service-method-selection-main ct-common-box add_on_lists hide_allsss_addons" style="display:none;">
                        <div class="ct-list-header">
                            <h3 class="header3">Extra Services</h3>
                            <p class="ct-sub" style="display:none;"></p>
                        </div>
                        <ul class="addon-service-list fl remove_addonsss">
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-id="4" id="ct-addon-4" data-mnamee="ad_unit4">
                                <label class="ct-addon-ser border-c" for="ct-addon-4"><span></span>
                                    <div class="addon-price">$10.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid4" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="4" id="minus4" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="4" data-duration_value="" data-mnamee="ad_unit4" data-method_name="Damaged Flooring" data-service_id="3" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit4" data-rate="10">

                                        <button data-ids="4" id="add4" data-db-qty="5" data-mnamee="ad_unit4" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="4" data-service_id="3" data-method_id="0" data-duration_value="" data-method_name="Damaged Flooring" data-rate=""
                                                data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Damaged Flooring</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-id="5" id="ct-addon-5" data-mnamee="ad_unit5">
                                <label class="ct-addon-ser border-c" for="ct-addon-5"><span></span>
                                    <div class="addon-price">$10.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid5" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="5" id="minus5" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="5" data-duration_value="" data-mnamee="ad_unit5" data-method_name="Door jams" data-service_id="3" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit5" data-rate="10">

                                        <button data-ids="5" id="add5" data-db-qty="3" data-mnamee="ad_unit5" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="5" data-service_id="3" data-method_id="0" data-duration_value="" data-method_name="Door jams" data-rate=""
                                                data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Door jams</div>
                            </li>
                        </ul>
                    </div>

                    <!-- Service Spl Request Div -->
                    <div id="service_spl_request_div">


                    </div>
                    <!-- /. Service Spl Request Div -->

                    <div id="service_frequency_price_div">

                    </div>

                    <div class="ct-discount-list ct-common-box" style="display: none;">
                        <div class="ct-list-header">
                            <h3 class="header3">How often would you like us provide service?</h3>

                            <p class="ct-sub" style="display: none;">Recurring discounts apply from the second cleaning onward.</p>
                            <label class="freq_disc_empty_cart_error error plumbing-service" style="color:red">Please select units or addons</label>
                        </div>

                        <ul class="ct-discount-often">
                            <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                <div class="discount-text f-l"><span class="discount-price"> -Save 10%- </span>
                                </div>
                                <input type="radio" name="frequently_discount_radio" checked="" data-id="4" class="cart_frequently_discount" id="discount-often-4" data-name="Monthly">
                                <label class="ct-btn-discount border-c" for="discount-often-4">
                                    <span class="float-left">Monthly</span>
                                    <span class="ct-discount-check float-right"></span>
                                </label>
                            </li>
                            <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                <div class="discount-text f-l"><span class="discount-price"> -Save 12.5%- </span>
                                </div>
                                <input type="radio" name="frequently_discount_radio" checked="" data-id="3" class="cart_frequently_discount" id="discount-often-3" data-name="Bi-Weekly">
                                <label class="ct-btn-discount border-c" for="discount-often-3">
                                    <span class="float-left">Bi-Weekly</span>
                                    <span class="ct-discount-check float-right"></span>
                                </label>
                            </li>
                            <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                <div class="discount-text f-l"><span class="discount-price"> -Save 15%- </span>
                                </div>
                                <input type="radio" name="frequently_discount_radio" checked="" data-id="2" class="cart_frequently_discount" id="discount-often-2" data-name="Weekly">
                                <label class="ct-btn-discount border-c" for="discount-often-2">
                                    <span class="float-left">Weekly</span>
                                    <span class="ct-discount-check float-right"></span>
                                </label>
                            </li>
                            <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                <div class="discount-text f-l"><span class="discount-price"> -ZERO- </span>
                                </div>
                                <input type="radio" name="frequently_discount_radio" checked="" data-id="1" class="cart_frequently_discount" id="discount-often-1" data-name="Once">
                                <label class="ct-btn-discount border-c" for="discount-often-1">
                                    <span class="float-left">Once</span>
                                    <span class="ct-discount-check float-right"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <!-- how often discount end -->
                    <!-- date time selection -->
                    <div class="ct-date-time-main ct-common-box hide_allsss ">
                        <div class="ct-list-header">
                            <h3 class="header3">When would you like us to come?</h3>
                            <p class="ct-sub" style="display: none;">Choose a date and session for your cleaning session.</p>
                        </div>
<!--                        <div id="select-date" class="ct-md-12 ct-sm-12 ct-xs-12">
                        </div>-->
                        <div class="date_session_div" id="date_session_div">
                            <div class="row">
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                    <label for="ct-first-name">Service Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right add_show_error_class error date_selection" id="service_date_0" required>
                                    </div>
                                      <!-- /.input group -->
                                    
                                </div>

                                <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                    <label for="ct-session">Session</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                        <select placeholder="Select session" name="ct_session" id="service_session_0" class="add_show_error_class error session_selection" required >
                                            
                                            <?php
                                            foreach ($sessions as $key => $value) {
                                                echo '<option value="' . $value->session_id . '" >' . $value->session_name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='text-red error_message' style='clear:both'> </div>
                            </div>
                        </div>

                    </div>
                    <!-- date and time slots end  -->

                    <!-- personal details -->

                    <div class="ct-user-info-main ct-common-box existing_user_details hide_allsss">
                        <div class="ct-list-header">
                            <h3 class="header3">Your Personal Details</h3>

                            <p class="ct-sub" style="display: none;">Please provide your address and contact details</p>

                            <!--<div class="client_logout">-->
                            <div class="ct-logged-in-user client_logout" style="display: none;">
                                <p class="welcome_msg_after_login pull-left">You are logged in as <span class="fname"></span> <span class="lname"></span></p>
                                <a href="javascript:void(0)" class="ct-link ml-10" id="logout" data-id="" title="Log Out">Log Out</a>
                            </div>
                            <!--</div>-->
                        </div>

                        <div class="ct-main-details">
                            <div class="ct-login-exist" id="ct-login">
                                <div class="ct-custom-radio">
                                    <ul class="ct-radio-list hide_radio_btn_after_login">
                                        <li class="ct-exiting-user ct-md-6 ct-sm-6 ct-xs-12">
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing-User">
                                            <label for="existing-user" class=""><span></span>Existing User</label>
                                        </li>
                                        <li class="ct-new-user ct-md-6 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" <?php
                                            if ($this->session->userdata('user_id') == null) {
                                                echo "checked='checked'";
                                            }
                                            ?> class="input-radio new-user user-selection" name="user-selection" value="New-User">
                                            <label for="new-user" class=""><span></span>New User                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ct-login-existing">
                                    <form id="existing_user_form" name="existing_user_form" method="post" action="">
                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_login_email">
                                            <label for="ct-user-name">Your Email</label>
                                            <input type="email" class="add_show_error_class_for_login error" required name="ct_user_email" id="ct-user-email" placeholder="Enter Email to Login" >
                                        </div>
                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_password">
                                            <label for="ct-user-pass">Your Password                                            </label>
                                            <input type="password" class="add_show_error_class_for_login error" required name="ct_user_pass" id="ct-user-pass" placeholder="Enter your Password" >
                                        </div>
                                        <label class="login_unsuccessfull"></label>

                                        <div class="ct-md-12 ct-xs-12 mb-15 hide_login_btn">
                                            <a href="#" class="ct-button" id="login_existing_user" title="Log In">Log In</a>
                                            <a href="<?php echo base_url() . 'forgotPass.html'; ?>" id="ct_forget_password" class="ct-link" title="Forget Password?">Forget Password</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <input type="hidden" id="color_box" data-id="#e74700" value="#e74700">

                            <div id="user_details_div" class="" novalidate="novalidate">
                                <div class="ct-new-user-details">
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-email">Preferred Email</label>
                                        <input type="email" name="ct_email" required id="ct-email" class="add_show_error_class error" placeholder="Your valid email address">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-email">Re-enter Email</label>
                                        <input type="email" name="ct_re_email" required id="ct-re-email" class="add_show_error_class error" placeholder="Your valid email address">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-preffered-pass">Preferred Password</label>
                                        <input type="password" required name="ct_preffered_pass" id="ct-preffered-pass" class="add_show_error_class error" placeholder="Password">
                                    </div>
                                </div>
                                <div class="ct-peronal-details">
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-first-name">First Name</label>
                                        <input type="text" required name="ct_first_name" class="add_show_error_class error" id="ct-first-name" placeholder="Your First Name" >
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-last-pass">Last Name</label>
                                        <input type="text" required class="add_show_error_class error" name="ct_last_name" id="ct-last-name" placeholder="Your Last Name ">
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-user-phone">Phone</label>

                                        <div class="input-group">
                                            <span class="input-group-addon">+60</span>
                                            <input type="tel" required id="ct-user-phone" class="add_show_error_class error" name="ct_user_phone" autocomplete="off" placeholder="" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10"></div>

                                    </div>

                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-street-address">Street Address</label>
                                        <input type="text" required name="ct_street_address" id="ct-street-address" class="add_show_error_class error" placeholder="e.g. Central Ave">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-zip-code">Postcode</label>
                                        <input type="text" required name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" placeholder="e.g. 90001"  onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "5" value="<?php echo $this->session->userdata('service_location_search'); ?>" disabled="">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-city">City</label>
                                        <input type="text" required name="ct_city" id="ct-city" class="add_show_error_class error" placeholder="eg. Los Angeles ">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-state">State</label>
                                        <select placeholder="Select state" name="ct_state" id="ct-state" class="add_show_error_class error" required >
                                            <option value=""> Select State </option>
                                            <?php
                                            foreach ($state as $key => $value) {
                                                echo '<option value="' . $value->state_code . '" >' . $value->state_name . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="ct-md-12 ct-xs-12 ct-form-row">
                                        <label for="ct-notes">Special requests ( Notes )</label>
                                        <textarea id="ct-notes" rows="10"></textarea>
                                    </div>

                                    <!--                                    <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-15">
                                                                            <label>Do you have a vacuum cleaner?</label>
                                                                            <ul class="ct-radio-list">
                                                                                <li>
                                                                                    <input id="vaccum-yes" type="radio" checked="checked" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-Yes">
                                                                                    <label for="vaccum-yes"><span></span>Yes</label>
                                                                                </li>
                                                                                <li>
                                                                                    <input id="vaccum-no" type="radio" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-No">
                                                                                    <label for="vaccum-no"><span></span>No</label>
                                                                                </li>
                                                                            </ul>
                                                                        </div>-->
                                    <!--                                    <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-10">
                                                                            <label>Do you have parking?</label>
                                                                            <ul class="ct-radio-list">
                                                                                <li>
                                                                                    <input id="parking-yes" type="radio" checked="checked" class="input-radio p_status" name="parking" value="Parking-Yes">
                                                                                    <label for="parking-yes"><span></span>Yes</label>
                                                                                </li>
                                                                                <li>
                                                                                    <input id="parking-no" type="radio" class="input-radio p_status" name="parking" value="Parking-No">
                                                                                    <label for="parking-no"><span></span>No</label>
                                                                                </li>
                                    
                                                                            </ul>
                                                                        </div>-->
                                    <!--                                    <div class="ct-options-new ct-md-12 ct-xs-12 mb-10 ct-form-row">
                                                                            <label>How will we get in?</label>
                                    
                                                                            <div class="ct-option-select">
                                                                                <select class="ct-option-select" id="contact_status">
                                                                                    <option value="I&#39;ll be at home">I'll be at home</option>
                                                                                    <option value="Please call me">Please call me</option>
                                                                                    <option value="The key is with the doorman">The key is with the doorman</option>
                                                                                    <option value="Other">Other</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="ct-option-others ct-md-12 pt-10 np ct-xs-12 hidden">
                                                                                <input type="text" name="other_contact_status" class="add_show_error_class error" id="other_contact_status" placeholder="Enter your Other option">
                                                                            </div>
                                                                        </div>-->
                                </div>
                            </div>
                        </div>
                        <!-- main details end -->

                                        <!-- conditions and complete booking details -->
                <div class="ct-complete-booking-main ct-sm-12 ct-md-12 mb-30 ct-xs-12 hide_allsss">

                    <div class="ct-list-header">
                        <!--<h3 class="header3"></h3>

                        <p class="ct-sub"></p> -->

                        <p class="ct-sub-complete-booking"><br></p>
                    </div>

                    <div class="bi-terms-agree ct-sm-12 ct-md-12 ct-xs-12">
                        <div class="ct-custom-checkbox">
                            <ul class="ct-checkbox-list">
                                <li>
                                    <input type="checkbox" name="accept-conditions" class="input-radio" id="accept-conditions">
                                    <label for="accept-conditions" class="">
                                        <span></span>
                                        I have read and accepted the                                                                                     <a href="javascript:void(0)" class="ct-link">Terms &amp; Conditions</a>
                                        and                                            <a href="javascript:void(0)" class="ct-link">Privacy Policy Link</a>.
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <label class="terms_and_condition"></label>
                    </div>
                    <div class="ta-center fl ct-sm-12 ct-md-12 ct-xs-12">
                        <button type="submit" data-currency_symbol="$" id="submitBooking" class="ct-button ct-btn-xbig ct_remove_id ct-sm-12 ct-md-12 ct-xs-12">Complete Booking</button>
                    </div>
                </div>

                    </div>
                    <!-- end personal details -->
                    <!-- payment details -->
                    <!--
                                        <div class="ct-payment-main ct-common-box hide_allsss">
                    <!-- Promocodes -->
                    <!--                        <div class="ct-discount-coupons ct-md-12">
                                                <div class="ct-form-rown">
                                                    <div class="ct-coupon-input ct-md-6 ct-sm-12 ct-xs-12 mt-10 mb-15 np">
                                                        <input id="coupon_val" type="text" name="coupon_apply" class="ct-coupon-input-text hide_coupon_textbox" placeholder="Have a promocode?" maxlength="22" onchange="myFunction()">
                                                        <a href="javascript:void(0);" class="ct-apply-coupon ct-link hide_coupon_textbox" name="apply-coupon" id="apply_coupon">Apply</a>
                                                        <label class="ct-error ofh coupon_invalid_error"></label>
                                                         display coupon 
                                                        <div class="ct-display-coupon-code" style="display: none;">
                                                            <div class="ct-form-rown">
                                                                <div class="ct-column ct-md-7 ct-xs-12 ofh">
                                                                    <label>Applied Promocode</label>
                                                                </div>
                                                                <div class="ct-coupon-value-main ct-md-5 ct-xs-12">
                                                                    <span class="ct-coupon-value border-2" id="display_code"></span>
                                                                    <img id="ct-remove-applied-coupon" src="./assets/images/ct-close.png" class="reverse_coupon" title="Remove applied coupon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                    <!--                        <div class="ct-list-header">
                                                <h3 class="header3">Preferred Payment Method</h3>
                                            </div>-->

                    <!--                        <div class="ct-main-payments fl">
                                                <div class="payments-container f-l" id="ct-payments">
                                                    <label class="ct-error-msg">Please select one payment method</label>
                                                    <label class="ct-error-msg ct-paypal-error" id="paypal_error"></label>
                    
                                                    <div class="ct-custom-radio ct-payment-methods f-l">
                                                        <ul class="ct-radio-list ct-all-pay-methods">
                                                            <li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
                                                                <input required type="radio" name="payment-methods" value="pay at venue" class="input-radio payment_gateway" id="pay-cash" checked="checked">
                                                                <label for="pay-cash" class="locally-radio"><span></span>Pay locally</label>
                                                            </li>
                    
                    
                                                        </ul>
                                                    </div>
                                                </div>
                    
                    
                                                <div id="ct-pay-methods" class="payment-method-container f-l">
                    
                                                    <div class="card-type-center f-l">
                                                        <div class="common-payment-style hidden">
                                                            <div class="payment-inner">
                                                                <div id="card-payment-fields" style="">
                                                                    <div class="ct-md-12 ct-xs-12 ct-header-bg">
                                                                        <h4 class="header4">Card details</h4>
                                                                        <img src="./assets/images/card-images.png" class="ct-stripe-image float-right" alt="Stripe">
                                                                    </div>
                                                                    <div class="ct-md-12">
                                                                        <label id="ct-card-payment-error" class="ct-error-msg ct-payment-error">Invalid card numberExpiry date or CSV</label> </div>
                                                                    <div class="ct-md-9 ct-sm-9 ct-xs-12 ct-card-details">
                                                                        <div class="ct-form-row ct-md-12 ct-xs-12">
                                                                            <label>Card number</label>
                                                                            <i class="icon-credit-card icons"></i>
                                                                            <input class="cc-number ct-card-number" maxlength="20" size="20" data-stripe="number" type="tel">
                                                                            <span class="card" aria-hidden="true"></span>
                    
                                                                        </div>
                    
                                                                        <div class="ct-form-row ct-md-8 ct-sm-8 ct-xs-12 ct-exp-mnyr">
                                                                            <label>Expiry (MM/YYYY)</label>
                                                                            <i class="icon-calendar icons"></i>
                                                                            <input data-stripe="exp-month" class="cc-exp-month ct-exp-month" maxlength="2" type="tel">/
                    
                                                                            <input data-stripe="exp-year" class="cc-exp-year ct-exp-year" maxlength="4" type="tel">
                                                                        </div>
                                                                        <div class="ct-form-row ct-md-4 ct-sm-4 ct-xs-12 ct-stripe-cvc">
                                                                            <label>CVC</label>
                                                                            <i class="icon-lock icons"></i>
                                                                            <input type="password" maxlength="4" size="4" data-stripe="cvc" class="cc-cvc ct-cvc-code">
                    
                                                                        </div>
                                                                    </div>
                                                                    <div class="ct-md-3 ct-sm-3 ct-xs-12 ct-lock-image">
                                                                        <div class="ct-lock-img"></div>
                                                                    </div>
                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                            </div>
                    
                                        </div>-->
                    <!-- end payment detials -->
                </div>
                <!--                </form>-->
                <!-- left side end -->


                <!-- right side cart -->
                <div class="ct-main-right ct-sm-4 ct-md-4 ct-xs-12 mt-30 mb-30 br-5 pull-right hide_allsss"  style="background-color: #D2D6DE;">

                    <!-- <div class="main-inner-container border-c  ct-price-scroll " id="ct-price-scroll"> -->
                    <div class="fl" style="
    border-color: #D2D6DE;">
                        <div class="main-inner-container border-c ct-price-scroll" id="ct-price-scroll-new" style="margin-top: 0px; box-shadow: 0 5px 20px #000; position: absolute;">
                            <div class="ct-step-heading">
                                <h3 class="header3">Booking Summary</h3></div>
                            <div class="ct-cart-wrapper f-l" id="">
                                <div class="ct-summary service_name">
                                    <div class="ct-image">
                                        <img src="./assets/images/icon-service.png" alt="">
                                    </div>
                                    <p class="ct-text sel-service" style="font-weight: bold;"></p>
                                    <div class="cart-items-main f-l">
                                        <label class="package_detail">Your cart items</label>

                                    </div>
                                </div>
                                <div class="ct-form-rown ct-addons-list-main" style="display:none;">
                                    <div class="step_heading f-l">
                                        <h6 class="header6 ct-item-list"></h6>
                                    </div>
                                    <div class="cart-items-main f-l">
                                        <label class="cart_empty_msg addons" style="font-weight: bold;">Addons: <span class="addons_names" style="font-weight: normal;"></span></label>

                                        <label class="cart_empty_msg spl_req" style="display:none;font-weight: bold;">Special Request: <span class="spl_req_names" style="font-weight: normal;"></span></label>                                        
                                    </div>
                                </div>
                                <div class="step_heading f-l">
                                    <h6 class="header6 ct-item-list"></h6>
                                </div>
                                <div class="ct-summary datetime_value">
                                    <div class="ct-image">
                                        <img src="./assets/images/icon-calendar.png" alt="">
                                    </div>
                                    <p class="ct-text sel-datetime"><span class="cart_session" ></span><span class="cart_date" data-date_val=""></span><!-- <span class="space_between_date_time" style=""> @ </span> --><span class="cart_time" data-time_val=""></span></p>
                                </div>
                                <div class="ct-summary frequency_value">
                                    <div class="ct-image f_dis_img">
                                        <img src="./assets/images/icon-frequency.png" alt="">
                                    </div>
                                    <p class="ct-text sel-datetime f_discount_name">Once</p>
                                </div>
                                <h6 class="header6 ct-item-list"></h6>

                                <div class="ct-form-rown sub_total_display" style="display: none;">
                                    <div class="ct-cart-label-common ofh">Sub Total</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-sub-total cart_sub_total"></span>
                                    </div>
                                </div>
                                <div class="ct-form-rown freq_discount_display" style="display: none;">
                                    <div class="ct-cart-label-common ofh">Frequently Discount</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-frequently-discount frequent_discount">XXXX</span>
                                    </div>
                                </div>
                                <div class="ct-form-rown coupon_display" style="display: none;">
                                    <div class="ct-cart-label-common ofh">Coupon Discount</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-coupon-discount cart_discount">XXXX</span>
                                    </div>
                                </div>
                                <?php  if( $config['status']['gst'] == 1 ){ ?>
                                    <div class="ct-form-rown tax_display" style="display: none;">
                                        <div class="ct-cart-label-common ofh">GST</div>
                                        <div class="ct-cart-amount-common ofh">
                                            <span class="ct-tax-amount cart_tax"></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="ct-clear"></div>
                                <div id="ct-line"></div>
                                <div class="ct-form-rown total_price_display" style="display: none;">
                                    <div class="ct-cart-label-total-amount ofh">Total</div>
                                    <div class="ct-cart-total-amount ofh">
                                        <span class="ct-total-amount cart_total">XXXX</span>
                                    </div>
                                </div>

                                <div class="ct-clear"></div>
                                <!-- discount coupons -->
                            </div>
                            <!-- cart wrapper end here -->


                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- features -->
                    
                    <div class="main-inner-container not-scroll-custom" id="ct-not-scroll" style="
    border-color: #D2D6DE;">

                        <div class="ct-cart-wrapper f-l" style="
    border-color: #D2D6DE;">
                            <div class="main-inner-container" style="
    border-color: #D2D6DE;">
                                
                                
                                <div class="features-list" style="background-color: #D2D6DE;color: #D2D6DE;">
                                    <!-- <div class="features">
                                        <!-- <img class="feature-img" src="./assets/images/icon17.png" alt=""> 
                                        <h4 class="feature-tittle">Saves You Time</h4>
                                        <p class="feature-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="features">
                                         <img class="feature-img" src="./assets/images/icon21.png" alt=""> 
                                        <h4 class="feature-tittle">Safety First</h4>
                                        <p class="feature-text">contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</p>
                                    </div>
                                    <div class="features">
                                         <img class="feature-img" src="./assets/images/icon31.png" alt=""> 
                                        <h4 class="feature-tittle">Only The Best Quality</h4>
                                        <p class="feature-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                    </div> -->
                                    <div class="features" style="
    border-color: #D2D6DE;">
                                        <!-- <img class="feature-img" src="./assets/images/icon41.png" alt=""> -->
                                        <h4 class="featureeature-tittle">Easy To Get Help</h4>
                                        <p class="feature-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </div>
                                    <div class="features" style="
    border-color: #D2D6DE;">
                                        <!-- <img class="feature-img" src="./assets/images/icon51.png" alt=""> -->
                                        <h4 class="feature-tittle">Seamless Communication</h4>
                                        <p class="feature-text">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
                                    </div>
                                    <div class="features" style="
    border-color: #D2D6DE;">
                                        <!-- <img class="feature-img" src="./assets/images/icon61.png" alt=""> -->
                                        <h4 class="feature-tittle">Cash-Free Payment</h4>
                                        <p class="feature-text"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> 
                </div>
                <!-- right side card end -->


                <a href="javascript:void(0)" class="ct-back-to-top br-2" style="display: none;"><i class="icon-arrow-up icons"></i></a>
                <!--</form>-->
            </div>
            <!-- end container -->
        </div>



    </div>
    <input type="hidden" name="TransactionType" value="SALE">
    <input type="hidden" name="PymtMethod" value="ANY">
    <input type="hidden" name="ServiceID" value="ADV">
    <input type="hidden" name="PaymentID" value="<?php echo $payId = md5(uniqid("booking12345674238472984MyMaidz", true)); ?>">
    <input type="hidden" name="OrderNumber" value="IJKLMN">
    <input type="hidden" name="PaymentDesc" value="Booking No: IJKLMN, Sector:
           KUL-BKI, First Flight Date: 26 Sep 2012">
    <input type="hidden" name="MerchantName" value="Advance Dreams Venture Sdn Bhd">
    <input type="hidden" name="MerchantReturnURL"
           value="https://test.mymaidz.com/pay_response.html">
    <input type="hidden" name="MerchantCallbackURL"
           value="https://test.mymaidz.com/pay_callback.html">
    <input type="hidden" name="Amount" value="1.00">
    <input type="hidden" name="CurrencyCode" value="MYR">
    <input type="hidden" name="CustIP" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
    <input type="hidden" name="CustName" value="Jason">
    <input type="hidden" name="CustEmail" value="Jasonabc@gmail.com">
    <input type="hidden" name="CustPhone" value="60121235678">
    <input type="hidden" name="HashValue" value='<?php echo hash("sha512", "adv12345ADV" . $payId . "https://test.mymaidz.com/pay_response.html1.00MYR192.168.2.35780"); ?>'>
    <input type="hidden" name="MerchantTermsURL"
           value="https://test.mymaidz.com/pay_response.html">
    <input type="hidden" name="LanguageCode" value="en">
    <input type="hidden" name="PageTimeout" value="780">
</form>


<div id="service_html" style="display:none;">
    <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details" data-id="">
        <input type="radio" name="service-radio" class="make_service_disable" >
        <label class="ct-service border-c" style="border-radius: 10px;">
            <div class="ct-service-img"><img class="ct-image" src="./assets/images/service_22007.jpg">
            </div>

        </label>

        <div class="service-name fl ta-c">House Cleaning</div>
    </li>
</div>

<div id="service_temp_html" style="display:none;"></div>

<!-- Service Package View Generator-->
<div id="service_package_html" style="display: none;">

    <!-- 1.box style services Package selection radio selection -->
    <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class" data-servicetitle="" >
        <input type="radio" name="package-radio" id="ct-pk-service-1" class="make_service_disable">
        <label class="ct-service border-c" for="ct-pk-service-1" style="border-radius: 10px;">
            <div class="ct-service-img">
                <div class="row">
                    <div class="col-xs-12 text-center spring-body">
                        <img src="./assets/images/icon-small-house.png" class="icon-md mt-sm ng-scope" height="40">
                        <p class="p-header">Small Apartment / Studio</p>
<!--                        <p class="p-content">Up to 1,000 sqft</p>
                        <p class="p-content">Up to 3 bedrooms and 2 bathrooms</p>
                        <p class="p-content">2 cleaning crew</p>-->
                    </div>
                </div>
            </div>

        </label>

        <div class="service-name fl ta-c"></div>
    </li>

</div>
<div id="package_temp_html" style="display:none;"></div>

<div id="addon_service_html" style="display: none;">

    <div class="ct-extra-services-list  ct-common-box add_on_lists ">
        <div class="ct-list-header">
            <h3 class="header3">Extra Services</h3>
<!--            <p class="ct-sub">For initial cleaning only. Contact us to apply to recurrings.</p>-->
        </div>
        <ul class="addon-service-list fl ">

            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-id="1" id="ct-addon-1" data-mnamee="ad_unit1">
                <label class="ct-addon-ser border-c" for="ct-addon-1"><span></span>
                    <div class="addon-price">$5.00</div>
                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/addons-images/ct-icon-fridge.png"></div>

                </label>
                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid1" style="display: none;">

                    <div class="ct-btn-group">
                        <button data-ids="1" id="minus1" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="1" data-duration_value="" data-mnamee="ad_unit1" data-method_name="Fridge Cleaning" data-service_id="1" data-rate="" data-method_id="0" data-type="addon">-</button>

                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit1" data-rate="5">

                        <button data-ids="1" id="add1" data-db-qty="5" data-mnamee="ad_unit1" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="1" data-service_id="1" data-method_id="0" data-duration_value="" data-method_name="Fridge Cleaning" data-rate=""
                                data-type="addon">+</button>
                    </div>
                </div>
                <div class="addon-name fl ta-c">Fridge Cleaning</div>
            </li>


        </ul>
    </div>

</div>

<div id="service_frequency_price_html" style="display: none;">
    <div class="ct-discount-list ct-common-box">
        <div class="ct-list-header">
            <h3 class="header3">How often would you like us provide service?</h3>

            <p class="ct-sub" style="display: none;">Recurring discounts apply from the second cleaning onward.</p>
            <label class="freq_disc_empty_cart_error error plumbing-service" style="color:red">Please select units or addons</label>
        </div>

        <ul class="ct-discount-often">

        </ul>
    </div>
</div>
<div id="frequency_temp_html" style="display:none;"></div>

<div id="service_spl_request_html" style="display: none;">
    <div class="ct-extra-services-list service-method-selection-main ct-common-box add_on_lists hide_allsss_addons" >
        <div class="ct-list-header">
            <h3 class="header3">Special Request Services</h3>
            <p class="ct-sub" style="display: none;">For initial cleaning only. Contact us to apply to recurrings.</p>
        </div>
        <ul class="addon-service-list fl remove_addonsss">
            <!--            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                            <input type="checkbox" name="spl-request-checkbox" class="addon-checkbox addons_servicess_2" data-id="4" id="ct-spl-req-12" data-mnamee="ad_unit4">
                            <label class="ct-addon-ser border-c" for="ct-spl-req-12"><span></span>
                                <div class="addon-price">RM 0.00</div>
                                <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>
            
                            </label>
            
                            <div class="addon-name fl ta-c">Damaged Flooring</div>
                        </li>
                        <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                            <input type="checkbox" name="spl-request-checkbox" class="addon-checkbox addons_servicess_2" data-id="5" id="ct-spl-req-13" data-mnamee="ad_unit5">
                            <label class="ct-addon-ser border-c" for="ct-spl-req-13"><span></span>
                                <div class="addon-price">RM 0.00</div>
                                <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>
            
                            </label>
            
                            <div class="addon-name fl ta-c">Door jams</div>
                        </li>-->
        </ul>
    </div>
</div>
<div id="service_spl_request_temp_html" style="display: none;"></div>

<div id="payment_form_div" style="display:none">

    <form id="paymentGatewayForm" name="frmPayment" method="post" action='<?php //echo $eghl_url; ?>'>
        <input type="hidden" id="TransactionType" name="TransactionType" value='<?php //echo $TransactionType; ?>'>
        <input type="hidden" id="PymtMethod" name="PymtMethod" value='<?php //echo $PymtMethod; ?>'>
        <input type="hidden" id="ServiceID" name="ServiceID" value='<?php //echo $ServiceID; ?>'>
        <input type="hidden" id="PaymentID" name="PaymentID" value='<?php //echo $PaymentID; ?>'>
        <input type="hidden" id="OrderNumber" name="OrderNumber" value='<?php //echo $OrderNumber; ?>'>
        <input type="hidden" id="PaymentDesc" name="PaymentDesc" value='<?php //echo $PaymentDesc; ?>'>
        <input type="hidden" id="MerchantName" name="MerchantName" value='<?php //echo $MerchantName; ?>'>
        <input type="hidden" id="MerchantReturnURL" name="MerchantReturnURL" value='<?php //echo $MerchantReturnURL; ?>'>
        <input type="hidden" id="MerchantCallbackURL" name="MerchantCallbackURL" value='<?php //echo $MerchantCallbackURL; ?>'>
        <input type="hidden" id="Amount" name="Amount" value='<?php //echo $Amount; ?>'>
        <input type="hidden" id="CurrencyCode" name="CurrencyCode" value='<?php //echo $CurrencyCode; ?>'>
        <input type="hidden" id="CustIP" name="CustIP" value='<?php //echo $CustIP; ?>'>
        <input type="hidden" id="CustName" name="CustName" value='<?php //echo $CustName; ?>'>
        <input type="hidden" id="CustEmail" name="CustEmail" value='<?php //echo $CustEmail; ?>'>
        <input type="hidden" id="CustPhone" name="CustPhone" value='<?php //echo $CustPhone; ?>'>
        <input type="hidden" id="HashValue" name="HashValue" value='<?php //echo $HashValue; ?>'>
        <input type="hidden" id="MerchantTermsURL" name="MerchantTermsURL" value='<?php //echo $MerchantTermsURL; ?>'>
        <input type="hidden" id="LanguageCode" name="LanguageCode" value='<?php //echo $LanguageCode; ?>'>
        <input type="hidden" id="PageTimeout" name="PageTimeout" value='<?php //echo $PageTimeout; ?>'>
        <input type="submit" id="PaymentGateway" name="PaymentGateway" value="Pay">
    </form>

</div>

<script>
    base_url = "<?php echo base_url(); ?>";
    gst = <?php echo $config['gst']; ?>;
    gst_status = <?php echo $config['status']['gst'];?>;
    home_url = "<?php echo base_url() . 'home.html' ?>";
    user_logged_in = "<?php if ($this->session->userdata('user_id') == null) {
                                                echo "No";
                                            } else {
                                                echo "Yes";
                                            } ?>";

</script>

<script type="text/javascript" src="<?php echo js_url('user/booking'); ?>"></script>


