<a href="javascript:void(0)" class="ct-back-to-top" style="display: none;"></a>
<form id="book-id">

    <div class="ct-wrapper" id="ct">
        <!-- main wrapper -->
        <div class="ct-loading-main" style="display: none;">
            <div class="loader">Loading...</div>
        </div>
        <div class="ct-main-wrapper">
            <div class="container">
                <!-- left side main booking form -->
                <div class="ct-main-left ct-sm-7 ct-md-7 ct-xs-12 mt-30 br-5 np">
                    <div class="ct-sm-12 ct-md-12 ta-c ct-location-header">
                        <h2 class="header2">MyMaidz</h2>
                        <h6 class="header6">Bengaluru, Banasawadi, 586112<span class="ct-company-phone">
                            </span></h6>

                        <a class="ct-link ct-mybookings" target="_blank" href="#">My Bookings</a>
                    </div>
                    <div class="ct-list-services ct-common-box">
                        <div class="ct-list-header">
                            <h3 class="header3">Where would you like us to provide service?</h3>
                            <!--<p class="ct-sub">Choose your service and property size</p>-->
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
                    </div>

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
                        <ul class="services-list">
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details" data-servicetitle="House Cleaning" data-id="1">
                                <input type="radio" name="service-radio" id="ct-service-1" class="make_service_disable">
                                <label class="ct-service border-c" for="ct-service-1">
                                    <div class="ct-service-img"><img class="ct-image" src="./assets/images/service_22007.jpg">
                                    </div>

                                </label>

                                <div class="service-name fl ta-c">House Cleaning</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details" data-servicetitle="Plumbing Services" data-id="2">
                                <input type="radio" name="service-radio" id="ct-service-2" class="make_service_disable">
                                <label class="ct-service border-c" for="ct-service-2">
                                    <div class="ct-service-img"><img class="ct-image" src="./assets/images/service_26571.jpg">
                                    </div>

                                </label>

                                <div class="service-name fl ta-c">Plumbing Services</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details" data-servicetitle="Handyman Services" data-id="3">
                                <input type="radio" name="service-radio" id="ct-service-3" class="make_service_disable">
                                <label class="ct-service border-c" for="ct-service-3">
                                    <div class="ct-service-img"><img class="ct-image" src="./assets/images/service_12253.jpg">
                                    </div>

                                </label>

                                <div class="service-name fl ta-c">Handyman Services</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details" data-servicetitle="Office Cleaning" data-id="4">
                                <input type="radio" name="service-radio" id="ct-service-4" class="make_service_disable">
                                <label class="ct-service border-c" for="ct-service-4">
                                    <div class="ct-service-img"><img class="ct-image" src="./assets/images/service_38708.jpg">
                                    </div>

                                </label>

                                <div class="service-name fl ta-c">Office Cleaning</div>
                            </li>
                        </ul>
                        <!--  1 end box style service selection -->
                        <div class="ct-scroll-meth-unit"></div>
                        <label class="method_not_selected_error plumbing-service show_methods_after_service_selection" id="method_not_selected_error" style="display:none">Please Select Method</label>

                        <div class="services-method-list-dropdown plumbing-service fl show_methods_after_service_selection show_single_service_method" id="ct-type-method" style="display: none;">
                            <div class="service-method-selection-main">
                                <div class="service-method-is" title="Choose Your Service">
                                    <select class="data-list">
                                        <option value="">Service Usage Methods</option>
                                        <option value="">Commercial Services</option>
                                        <option value="">Commercial Services</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="services-method-list-dropdown handyman-service fl show_methods_after_service_selection show_single_service_method" id="ct-type-method" style="display: none;">
                            <div class="service-method-selection-main">
                                <div class="service-method-is" title="Choose Your Service">
                                    <select class="data-list">
                                        <option value="">Service Usage Methods</option>
                                        <option value="">Area Based</option>
                                        <option value="">Property Based</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="services-method-list-dropdown office-service fl show_methods_after_service_selection show_single_service_method" id="ct-type-method" style="display: none;">
                            <div class="service-method-selection-main">
                                <div class="service-method-is" title="Choose Your Service">
                                    <select class="data-list">
                                        <option value="">Service Usage Methods</option>
                                        <option value="">Area Based</option>
                                        <option value="">Property Based</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label class="empty_cart_error home-service" id="empty_cart_error" style="display:none">Please select units or addons</label>
                        <!-- hrs selected  -->
                        <div class="ct-service-duration ct-md-12 ct-sm-12 s_m_units_design_1" id="ct-duration-main" style="display: none;">
                            <div class="ct-inner-box border-c">

                                <div class="fl ct-md-12 mt-5 mb-15 np duration_hrs">
                                </div>
                                <!-- end duration hrs  -->
                            </div>
                        </div>
                        <!-- 1. bedroom and bathroom counting dropdown -->
                        <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np hidden fl s_m_units_design_2 home-service" id="ct-meth-unit-type-1">
                            <div class="ct-inner-box border-c ser_design_2_units">
                                <div class="ct-bedrooms ct-btn-group ct-md-6 ct-sm-6 mb-15 ">
                                    <label> Bedroom Cleaning</label>
                                    <div class="common-selection-main">
                                        <div class="selected-is select-bedrooms" data-mnamee="ad_unit1" data-un_title="Bedroom Cleaning" data-un_id="1" title="Choose Your Bedroom Cleaning">
                                            <!-- <div class="data-list" id="ct_selected_"> -->
                                            <select class="data-list" id="ct_selected_1">
                                                <option>Bedroom Cleaning</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                            </select>
                                        </div>
                                        <!-- <div class="common-data-dropdown ct--dropdown"> -->
                                        <div class="common-data-dropdown ct-1-dropdown">
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="1" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="10" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">1</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="2" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="20" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">2</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="3" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="30" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">3</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="4" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="40" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">4</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="5" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="40" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">5</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="6" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="48" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">6</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="7" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="42" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">7</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="8" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="48" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">8</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="9" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="54" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">9</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="10" data-units_id="1" data-service_id="1" data-method_id="1" data-method_name="Bedroom Cleaning" data-un_title="Bedroom Cleaning" data-rate="45" data-type="method_units" data-mnamee="ad_unit1">
                                                <p class="ct-count">10</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="ct-bedrooms ct-btn-group ct-md-6 ct-sm-6 mb-15 ">
                                    <label> Bathroom Cleaning</label>
                                    <div class="common-selection-main">
                                        <div class="selected-is select-bedrooms" data-mnamee="ad_unit2" data-un_title="Bathroom Cleaning" data-un_id="2" title="Choose Your Bathroom Cleaning">
                                            <!-- <div class="data-list" id="ct_selected_"> -->
                                            <select class="data-list" id="ct_selected_1">
                                                <option>Bathroom Cleaning</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                                <option>2</<option>
                                            </select>
                                        </div>
                                        <!-- <div class="common-data-dropdown ct--dropdown"> -->
                                        <div class="common-data-dropdown ct-2-dropdown">
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="1" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="12" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">1</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="2" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="24" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">2</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="3" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="30" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">3</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="4" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="40" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">4</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="5" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="50" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">5</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="6" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="48" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">6</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="7" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="56" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">7</p>
                                            </div>
                                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="8" data-units_id="2" data-service_id="1" data-method_id="1" data-method_name="Bathroom Cleaning" data-un_title="Bathroom Cleaning" data-rate="64" data-type="method_units" data-mnamee="ad_unit2">
                                                <p class="ct-count">8</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 1.end dropdown list bathroom bedroom -->
                        <!-- 2. boxed bathroom bedroom  -->
                        <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np s_m_units_design_3" id="ct-meth-unit-type-2" style="display: none;">
                            <div class="ct-inner-box border-c ser_design_3_units">

                            </div>
                        </div>
                        <!-- 2. end boxed bathroom bedroom -->

                        <div class="ct-meth-unit-count ct-md-12 ct-sm-12 s_m_units_design_4" id="ct-meth-unit-type-3" style="display: none;">
                            <div class="ct-inner-box border-c ">
                                <div class="fl ct-bedrooms ct-btn-group ct-md-12 mt-5 mb-15 np">
                                    <div class="ct-inner-box border-c ser_design_4_units">

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- end service list -->


                    <!-- Module third area based -->
                    <div class="ct-list-services ct-common-box s_m_units_design_5 ser_design_5_units" style="display: none;">

                    </div>
                    <!-- end area based -->
                    <!-- end module third area based -->

                    <div class="ct-extra-services-list home-service ct-common-box add_on_lists hide_allsss_addons">
                        <div class="ct-list-header">
                            <h3 class="header3">Extra Services</h3>
                            <p class="ct-sub">For initial cleaning only. Contact us to apply to recurrings.</p>
                        </div>
                        <ul class="addon-service-list fl remove_addonsss">
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="1" id="ct-addon-1" data-mnamee="ad_unit1">
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
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="2" id="ct-addon-2" data-mnamee="ad_unit2">
                                <label class="ct-addon-ser border-c" for="ct-addon-2"><span></span>
                                    <div class="addon-price">$5.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/addons-images/ct-icon-oven.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid2" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="2" id="minus2" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="2" data-duration_value="" data-mnamee="ad_unit2" data-method_name="Oven Cleaning" data-service_id="1" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit2" data-rate="5">

                                        <button data-ids="2" id="add2" data-db-qty="4" data-mnamee="ad_unit2" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="2" data-service_id="1" data-method_id="0" data-duration_value="" data-method_name="Oven Cleaning" data-rate=""
                                                data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Oven Cleaning</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="3" id="ct-addon-3" data-mnamee="ad_unit3">
                                <label class="ct-addon-ser border-c" for="ct-addon-3"><span></span>
                                    <div class="addon-price">$5.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/addons-images/ct-icon-inside-window.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid3" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="3" id="minus3" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="3" data-duration_value="" data-mnamee="ad_unit3" data-method_name="Inside Window Cleaning" data-service_id="1" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit3" data-rate="5">

                                        <button data-ids="3" id="add3" data-db-qty="10" data-mnamee="ad_unit3" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="3" data-service_id="1" data-method_id="0" data-duration_value="" data-method_name="Inside Window Cleaning"
                                                data-rate="" data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Inside Window Cleaning</div>
                            </li>
                        </ul>
                    </div>


                    <!-- how often discount -->
                    <div class="ct-extra-services-list handyman-service service-method-selection-main ct-common-box add_on_lists hide_allsss_addons" style="display: none;">
                        <div class="ct-list-header">
                            <h3 class="header3">Extra Services</h3>
                            <p class="ct-sub">For initial cleaning only. Contact us to apply to recurrings.</p>
                        </div>
                        <ul class="addon-service-list fl remove_addonsss">
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="4" id="ct-addon-4" data-mnamee="ad_unit4">
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
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="5" id="ct-addon-5" data-mnamee="ad_unit5">
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
                    <div class="ct-extra-services-list office-service ct-common-box add_on_lists hide_allsss_addons" style="display: none;">
                        <div class="ct-list-header">
                            <h3 class="header3">Extra Services</h3>
                            <p class="ct-sub">For initial cleaning only. Contact us to apply to recurrings.</p>
                        </div>
                        <ul class="addon-service-list fl remove_addonsss">
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="6" id="ct-addon-6" data-mnamee="ad_unit6">
                                <label class="ct-addon-ser border-c" for="ct-addon-6"><span></span>
                                    <div class="addon-price">$20.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid6" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="6" id="minus6" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="6" data-duration_value="" data-mnamee="ad_unit6" data-method_name="Parking Cleaning" data-service_id="4" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit6" data-rate="20">

                                        <button data-ids="6" id="add6" data-db-qty="3" data-mnamee="ad_unit6" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="6" data-service_id="4" data-method_id="0" data-duration_value="" data-method_name="Parking Cleaning" data-rate=""
                                                data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Parking Cleaning</div>
                            </li>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="7" id="ct-addon-7" data-mnamee="ad_unit7">
                                <label class="ct-addon-ser border-c" for="ct-addon-7"><span></span>
                                    <div class="addon-price">$10.00</div>
                                    <div class="ct-addon-img"><img src="http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png"></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid7" style="display: none;">

                                    <div class="ct-btn-group">
                                        <button data-ids="7" id="minus7" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="7" data-duration_value="" data-mnamee="ad_unit7" data-method_name="Storeroom Cleaning" data-service_id="4" data-rate="" data-method_id="0" data-type="addon">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit7" data-rate="20">

                                        <button data-ids="7" id="add7" data-db-qty="5" data-mnamee="ad_unit7" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="7" data-service_id="4" data-method_id="0" data-duration_value="" data-method_name="Storeroom Cleaning"
                                                data-rate="" data-type="addon">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c">Storeroom Cleaning</div>
                            </li>
                        </ul>
                    </div>
                    <div class="ct-discount-list ct-common-box">
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
                    <div class="ct-date-time-main ct-common-box hide_allsss">
                        <div class="ct-list-header">
                            <h3 class="header3">When would you like us to come?</h3>
                            <!--<p class="ct-sub">Choose a date for your cleaning session. Time can not be guaranteed</p>-->
                        </div>
                        <div id="select-date" class="ct-md-12 ct-sm-12 ct-xs-12">
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
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User">
                                            <label for="existing-user" class=""><span></span>Existing User</label>
                                        </li>
                                        <li class="ct-new-user ct-md-6 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User">
                                            <label for="new-user" class=""><span></span>New User                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="ct-login-existing hidden">
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_login_email">
                                        <label for="ct-user-name">Your Email</label>
                                        <input type="text" class="add_show_error_class_for_login error" name="ct_user_name" id="ct-user-name" placeholder="Enter Email to Login" onkeydown="if (event.keyCode == 13) document.getElementById( & #39; login_existing_user & #39; ).click()">
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_password">
                                        <label for="ct-user-pass">Your Password                                            </label>
                                        <input type="password" class="add_show_error_class_for_login error" name="ct_user_pass" id="ct-user-pass" placeholder="Enter your Password" onkeydown="if (event.keyCode == 13) document.getElementById( & #39; login_existing_user & #39; ).click()">
                                    </div>
                                    <label class="login_unsuccessfull"></label>

                                    <div class="ct-md-12 ct-xs-12 mb-15 hide_login_btn">
                                        <a href="javascript:void(0)" class="ct-button" id="login_existing_user" title="Log In">Log In</a>
                                        <a href="javascript:void(0)" id="ct_forget_password" class="ct-link" title="Forget Password?">Forget Password</a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="color_box" data-id="#e74700" value="#e74700">

                            <form id="user_details_form" class="" method="post" novalidate="novalidate">
                                <div class="ct-new-user-details">
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-email">Preferred Email</label>
                                        <input type="text" name="ct_email" required id="ct-email" class="add_show_error_class error" placeholder="Your valid email address">
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-preffered-pass">Preferred Password</label>
                                        <input type="password" required name="ct_preffered_pass" id="ct-preffered-pass" class="add_show_error_class error" placeholder="Password">
                                    </div>
                                </div>
                                <div class="ct-peronal-details">
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-first-name">First Name</label>
                                        <input type="text" required name="ct_first_name" class="add_show_error_class error" id="ct-first-name" placeholder="Your First Name">
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-last-pass">Last Name</label>
                                        <input type="text" required class="add_show_error_class error" name="ct_last_name" id="ct-last-name" placeholder="Your Last Name ">
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-user-phone">Phone</label>
                                        <div class="intl-tel-input">
                                            <input type="tel" required id="ct-user-phone" class="add_show_error_class error" name="ct_user_phone" autocomplete="off" placeholder="917899883343"></div>
                                    </div>

                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-street-address">Street Address</label>
                                        <input type="text" required name="ct_street_address" id="ct-street-address" class="add_show_error_class error" placeholder="e.g. Central Ave">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-zip-code">Zip Code</label>
                                        <input type="text" required name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" placeholder="e.g. 90001">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-city">City</label>
                                        <input type="text" required name="ct_city" id="ct-city" class="add_show_error_class error" placeholder="eg. Los Angeles ">
                                    </div>
                                    <div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
                                        <label for="ct-state">State</label>
                                        <input type="text" required name="ct_state" id="ct-state" class="add_show_error_class error" placeholder="eg. CA ">
                                    </div>


                                    <div class="ct-md-12 ct-xs-12 ct-form-row">
                                        <label for="ct-notes">Special requests ( Notes )</label>
                                        <textarea required id="ct-notes" rows="10"></textarea>
                                    </div>

                                    <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-15">
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
                                    </div>
                                    <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-10">
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
                                    </div>
                                    <div class="ct-options-new ct-md-12 ct-xs-12 mb-10 ct-form-row">
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
                                    </div>
                                </div>

                        </div>
                        <!-- main details end -->
                    </div>
                    <!-- end personal details -->
                    <!-- payment details -->

                    <div class="ct-payment-main ct-common-box hide_allsss">
                        <!-- Promocodes -->
                        <div class="ct-discount-coupons ct-md-12">
                            <div class="ct-form-rown">
                                <div class="ct-coupon-input ct-md-6 ct-sm-12 ct-xs-12 mt-10 mb-15 np">
                                    <input id="coupon_val" type="text" name="coupon_apply" class="ct-coupon-input-text hide_coupon_textbox" placeholder="Have a promocode?" maxlength="22" onchange="myFunction()">
                                    <a href="javascript:void(0);" class="ct-apply-coupon ct-link hide_coupon_textbox" name="apply-coupon" id="apply_coupon">Apply</a>
                                    <label class="ct-error ofh coupon_invalid_error"></label>
                                    <!-- display coupon -->
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
                        </div>
                        <div class="ct-list-header">
                            <h3 class="header3">Preferred Payment Method</h3>
                        </div>

                        <div class="ct-main-payments fl">
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

                    </div>
                    <!-- end payment detials -->
                </div>
                </form>
                <!-- left side end -->


                <!-- right side cart -->
                <div class="ct-main-right ct-sm-4 ct-md-4 ct-xs-12 mt-30 mb-30 br-5 pull-right hide_allsss">

                    <!-- <div class="main-inner-container border-c  ct-price-scroll " id="ct-price-scroll"> -->
                    <div class="fl">
                        <div class="main-inner-container border-c ct-price-scroll" id="ct-price-scroll-new" style="margin-top: 0px; box-shadow: rgb(231, 71, 0) 0px 0px 10px; position: absolute;">
                            <div class="ct-step-heading">
                                <h3 class="header3">Booking Summary</h3></div>
                            <div class="ct-cart-wrapper f-l" id="">
                                <div class="ct-summary hideservice_name" style="display: none;">
                                    <div class="ct-image">
                                        <img src="./assets/images/icon-service.png" alt="">
                                    </div>
                                    <p class="ct-text sel-service"></p>
                                </div>
                                <div class="ct-summary hidedatetime_value" style="display: none;">
                                    <div class="ct-image">
                                        <img src="./assets/images/icon-calendar.png" alt="">
                                    </div>
                                    <p class="ct-text sel-datetime"><span class="cart_date" data-date_val=""></span><span class="space_between_date_time" style="display: none;"> @ </span><span class="cart_time" data-time_val=""></span></p>
                                </div>
                                <div class="ct-summary">
                                    <div class="ct-image f_dis_img">
                                        <img src="./assets/images/icon-frequency.png" alt="">
                                    </div>
                                    <p class="ct-text sel-datetime f_discount_name">Once</p>
                                </div>
                                <div class="ct-form-rown ct-addons-list-main">
                                    <div class="step_heading f-l">
                                        <h6 class="header6 ct-item-list">Your clean items</h6>
                                    </div>
                                    <div class="cart-items-main f-l">
                                        <label class="cart_empty_msg">Your cart items</label>
                                        <ul class="ct-addon-items-list cart_item_listing">
                                            <li>items</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ct-form-rown">
                                    <div class="ct-cart-label-common ofh">Sub Total</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-sub-total cart_sub_total">789</span>
                                    </div>
                                </div>
                                <div class="ct-form-rown freq_discount_display" style="display: none;">
                                    <div class="ct-cart-label-common ofh">Frequently Discount</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-frequently-discount frequent_discount">789</span>
                                    </div>
                                </div>
                                <div class="ct-form-rown coupon_display" style="display: none;">
                                    <div class="ct-cart-label-common ofh">Coupon Discount</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-coupon-discount cart_discount">798</span>
                                    </div>
                                </div>
                                <div class="ct-form-rown">
                                    <div class="ct-cart-label-common ofh">Tax</div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-tax-amount cart_tax">798</span>
                                    </div>
                                </div>
                                <div class="ct-clear"></div>
                                <div id="ct-line"></div>
                                <div class="ct-form-rown">
                                    <div class="ct-cart-label-total-amount ofh">Total</div>
                                    <div class="ct-cart-total-amount ofh">
                                        <span class="ct-total-amount cart_total">7987987</span>
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
                    <div class="main-inner-container border-c  not-scroll-custom" id="ct-not-scroll">

                        <div class="ct-cart-wrapper f-l">
                            <div class="main-inner-container">
                                <!--  partial amount pay -->
                                <div class="mb-30"></div>
                                <div class="features-list">
                                    <div class="features">
                                        <img class="feature-img" src="./assets/images/icon17.png" alt="">
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
                                    </div>
                                    <div class="features">
                                        <img class="feature-img" src="./assets/images/icon41.png" alt="">
                                        <h4 class="featureeature-tittle">Easy To Get Help</h4>
                                        <p class="feature-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </div>
                                    <div class="features">
                                        <img class="feature-img" src="./assets/images/icon51.png" alt="">
                                        <h4 class="feature-tittle">Seamless Communication</h4>
                                        <p class="feature-text">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
                                    </div>
                                    <div class="features">
                                        <img class="feature-img" src="./assets/images/icon61.png" alt="">
                                        <h4 class="feature-tittle">Cash-Free Payment</h4>
                                        <p class="feature-text"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- right side card end -->

                <!-- conditions and complete booking details -->
                <div class="ct-complete-booking-main ct-sm-7 ct-md-7 mb-30 ct-xs-12 hide_allsss">

                    <div class="ct-list-header">
                        <!--<h3 class="header3"></h3>

            <p class="ct-sub"></p> -->

                        <p class="ct-sub-complete-booking"><br></p>
                    </div>

                    <div class="ct-complete-booking ct-md-12">
                        <h5 class="ct-cancel-booking">Cancellation Policy</h5>

                        <div class="ct-cancel-policy">
                            <p>Free cancellation before redemption</p>
                            <span class="show-more-toggler ct-link">Show More</span>
                            <ul class="bullet-more">
                                <li>Full refund if cancelled within 24 hours of placing the order. If you cancel the order more than 24 hours, you can get a credit note for the amount paid. If cancelled in less than 24 hours before time of appointment/stay
                                    or in case of no-show, order will not be refunded.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bi-terms-agree ct-md-12">
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
                    <div class="ta-center fl">
                        <div class="ct-loading-main-complete_booking" style="display: none;">
                            <div class="loader-complete_booking">Loading...</div>
                        </div>
                        <button type="submit" data-currency_symbol="$" id="" class="ct-button ct-btn-big ct_remove_id">Complete Booking</button>
                    </div>
                </div>


                <a href="javascript:void(0)" class="ct-back-to-top br-2" style="display: none;"><i class="icon-arrow-up icons"></i></a>
                <!--</form>-->
            </div>
            <!-- end container -->
        </div>



    </div>
</form>
