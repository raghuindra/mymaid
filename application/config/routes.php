<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                    = 'booking';
$route['logout.html']                           = "person/logout";
$route['forgotPass.html']                       = "person/forgotPassword";
$route['reset_password.html/(:any)']            = "person/resetpassword/$1";
$route['termsCondition.html']                   = "person/termsAndConditionPage";
$route['pricing.html']                          = "person/pricingPage";
$route['privacyPolicy.html']                    = "person/privacyPolicyPage";
$route['refundPolicy.html']                     = "person/refundPolicyPage";
$route['person_wallet_balance.html']            = "person/getPersonWalletBalance";
$route['request_wallet_withdrawal.html']        = "person/walletWithdrawalRequest";
$route['listWalletWithdrawalRequest.html']      = "person/listWalletWithdrawalRequest";
$route['widgets_updates.html']                  = "person/widgetsUpdates";
$route['vendors_employee_schedule.html']        = "person/vendorsEmployeeSchedule";
$route['listEmployeeSessions.html']             = "person/listEmployeeSessions";
$route['updateEmployeeSession.html']            = "person/updateEmployeeSession";
$route['getEmployeesOfCompany.html']            = "person/getEmployeesOfCompany";
$route['addEmployeeSplSession.html']            = "person/addEmployeeSplSession";
$route['listEmployeeSplSessions.html']          = "person/listEmployeeSplSessions";
$route['vendors_employee_calender.html']        = "person/employeeCalender";
$route['googlePlusLogin.html']					= "person/googlePlusLogin";
$route['employee_booked_dates.html']			= "person/employeeBookedDates";
$route['employee_off_dates.html']				= "person/employeeOffDates";
$route['remove_spl_session.html']				= "person/removeSplSession";

/* ........User Module Routing............................ */
$route['user_login.html']                       = "person/userLogin";
$route['user_register.html']                    = "person/userRegister";
$route['bookingUserLogin.html']                 = "person/bookingUserLogin";
$route['user_home.html']                        = "user";
$route['user_profile.html']						= "user/profile";
$route['user_active_orders.html']               = "user/activeOrders";
$route['listUserActiveOrder.html']              = "user/activeOrdersList";
$route['user_canceled_orders.html']             = "user/canceledOrders";
$route['listCanceledOrders.html']               = "user/canceledOrdersList";
$route['cancelUserOrder.html']                  = "user/cancelOrder";
$route['user_completed_orders.html']            = "user/completedOrders";
$route['listCompletedOrders.html']              = "user/completedOrdersList";
$route['confirmOrderCompletionByUser.html']     = "user/confirmOrderCompletion";

/* ........Booking Module Routing............................ */
$route['booking.html']                          = "booking/booking";
$route['getServices.html']                      = "booking/getServices";
$route['getServicePackages.html']               = "booking/getServicePackages";
$route['getServiceFrequencies.html']            = "booking/getServiceFrequencies";
$route['getServiceAddons.html']                 = "booking/getServiceAddons";
$route['getServiceSplRequests.html']            = "booking/getServiceSplRequests";
$route['pay_test.html']                         = "booking/payTest";
$route['booking_info.html']                     = "booking/bookingInfo";
$route['getUserDetails.html']                   = "booking/getUserDetails";
$route['pay_response.html']                     = "booking/payResponseHandler";
$route['pay_response_callback.html']			= "booking/payResponseCallBackHandler";
$route['serviceOrderDeatils.html']              = "booking/getServiceOrderDetails";
$route['employee_details.html']                 = "booking/employeeDetails";
$route['contact_us_message.html']				= "booking/contactUsMessage";
$route['get_order_invoice.html']				= "booking/getOrderInvoice";
$route['service_request.html']					= "booking/serviceRequest";
$route['checkEmployeeAvailability.html']        = "booking/checkEmployeeAvailabilityForDate";


/* ................  Admin Module Routing  ......................... */
$route['admin_home.html']                       = "admin";
$route['admin_login.html']                      = "person/adminLogin";
$route['services.html']                         = "admin/services";
$route['addService.html']                       = "admin/postAddService";
$route['editService.html']                      = "admin/postEditService";
$route['listService.html']                      = "admin/postServiceList";
$route['archiveService.html']                   = "admin/postArchiveService";
$route['packages.html']                         = "admin/packages";
$route['service_details.html/(:num)']           = "admin/serviceDetail/$1";
$route['service_details.html/(:any)']           = "admin/services";
$route['addServicePackage.html']                = "admin/createServicepackage";
$route['listServicepackage.html/(:num)']        = "admin/postServicePackageList/$1";
$route['editServicePackage.html/(:num)']        = "admin/editServicePackage/$1";
$route['archiveServicePackage.html']            = "admin/postArchiveServicePackage";
$route['listFrequencyOffer.html/(:num)']        = "admin/postFrequencyOfferList/$1";
$route['addServiceFrequencyOfferPrice.html']    = "admin/createServiceFrequencyOfferPrice";
$route['archiveServiceFrequencyOffer.html']     = "admin/postArchiveServiceFrequencyOffer";
$route['updateServiceFrequencyOffer.html']      = "admin/postUpdateServiceFrequencyOffer";
$route['listserviceAddonsPrice.html']           = "admin/postServiceAddonsPriceList";
$route['addServiceAddonPrice.html']             = "admin/createServiceAddonsPrice";
$route['updateServiceAddonPrice.html']          = "admin/postUpdateServiceAddonPrice";
$route['archiveServiceAddonPrice.html']         = "admin/postArchiveServiceAddonPrice";
$route['listserviceSplRequest.html']            = "admin/postServiceSplRequestList";
$route['addServiceSplRequest.html']             = "admin/createServiceSplRequest";
$route['updateServiceSplRequest.html']          = "admin/postUpdateServiceSplRequest";
$route['archiveServiceSplRequest.html']         = "admin/postArchiveServiceSplRequest";
$route['getServicePackagePostalPrice.html']     = "admin/postGetServicePackagePostcodePrice";
$route['getPostOffices.html']                   = "admin/postGetPostOffices";
$route['getPostcodes.html']                     = "admin/postGetpostcodes";
$route['setServicePackagePostalPrice.html']     = "admin/postSetServicePackagePostcodePrice";
$route['archiveServicePackagePostcodePrice.html'] = "admin/postArchivePostcodePrice";
$route['updateServicePackagePostcodePrice.html']= "admin/postUpdateServicePackagePostcodePrice";
$route['vendors_list.html']                     = "admin/postVendorsList";
$route['new_vendors_list.html']                 = "admin/postNewVendorsList";
$route['active_vendors_list.html']              = "admin/postActiveVendorsList";
$route['active_freelancers_list.html']          = "admin/postActiveFreelancersList";
$route['approveNewVendor.html']                 = "admin/approveNewVendor";
$route['archiveVendor.html']                    = "admin/postArchiveVendor";
$route['archiveFreelancer.html']                = "admin/postArchiveFreelancer";
$route['vendors_company_list.html']             = "admin/postVendorCompanyList";
$route['a_listEmployees.html']                  = "admin/postEmployeeList";
$route['admin_settings.html']                   = "admin/adminSettings";
$route['updateConfig.html']                     = "admin/updateConfigSettings";
$route['a_new_orders.html']                     = "admin/newOrders";
$route['a_listNewOrders.html']                  = "admin/listNewOrders";
$route['a_active_ordrers.html']                 = "admin/activeOrders";
$route['a_ActiveOrderList.html']                = "admin/listActiveOrders";
$route['a_cancelOrder.html']                    = "admin/cancelOrder";
$route['a_confirmOrderCompletion.html']         = "admin/confirmOrderCompletion";
$route['a_completed_orders.html']               = "admin/completedOrders";
$route['a_listCompletedOrders.html']            = "admin/listCompletedOrers";
$route['a_canceled_orders.html']                = "admin/canceledOrders";
$route['a_listCanceledOrders.html']             = "admin/listCanceledOrders";
$route['getCompaniesForService.html']           = "admin/getCompaniesForService";
$route['a_getEmployeesForService.html']         = "admin/getEmployeesForService";
$route['a_assignEmployeeToService.html']        = "admin/assignEmployeeToService";
$route['vendors_withdrawal_request.html']       = "admin/vendorsWithdrawalRequest";
$route['vendors_withdrawal_request_list.html']  = "admin/vendorsWithdrawalRequestList";
$route['approveWithdrawalRequest.html']         = "admin/approveWithdrawalRequest";
$route['rejectWithdrawalRequest.html']          = "admin/rejectWithdrawalRequest";
$route['customers_list.html']					= "admin/customersList";
$route['customer_list_ajax.html']				= "admin/customerListAjax";



/* ....................  Vendor/Freelance Module Routing  .............................. */
$route['vendor_home.html']                      = "vendor";
$route['vendor_login.html']                     = "person/vendorLogin";
$route['vendor_register.html']                  = "person/vendorRegister";
$route['vendor_newjobs.html']                   = "vendor/newJobList";
$route['vendor_canceledjobs.html']              = "vendor/canceledJobList";
$route['vendor_completedjobs.html']             = "vendor/completedJobList";
$route['vendor_reschedulejobs.html']            = "vendor/rescheduleJobList";
$route['vendor_activejobs.html']                = "vendor/activeJobList";
$route['vendor_wallet_pending.html']            = "vendor/walletPendingPay";
$route['vendor_wallet_request.html']            = "vendor/walletRequestPay";
$route['vendor_wallet_report.html']             = "vendor/walletReport";
$route['vendor_myaccount_company.html']         = "vendor/myAccountCompany";
$route['vendor_myaccount_employees.html']       = "vendor/myAccountEmployees";
$route['vendor_myaccount_bank.html']            = "vendor/myAccountBank";
$route['vendor_profile.html']                   = "vendor/profile";
$route['updateBankDetails.html']                = "vendor/updateBankDetails";
$route['upload_companyssm_doc.html']            = "vendor/uploadCompanySsmDoc";
$route['upload_companyid_doc.html']             = "vendor/uploadCompanyIdDoc";
$route['updateCompanyDetail.html']              = "vendor/updateCompanyDetail";
$route['upload_employeeid_doc.html']            = "vendor/uploadEmployeeIdDoc";
$route['createEmployee.html']                   = "vendor/createEmployee";
$route['listEmployees.html']                    = "vendor/listEmployees";
$route['editEmployee.html']                     = "vendor/updateEmployee";
$route['archiveEmployee.html']                  = "vendor/postArchiveEmployee";
$route['serviceLocation.html']                  = "vendor/serviceLocation";
$route['getVendorPostOffices.html']             = "vendor/getPostOffices";
$route['getVendorPostcodes.html']               = "vendor/getpostcodes";
$route['addServiceLocation.html']               = "vendor/addServiceLocation";
$route['listServiceLocation.html']              = "vendor/listServiceLocation";
$route['archiveServiceLocation.html']           = "vendor/archiveServiceLocation";
$route['listNewBookingForVendor.html']          = "vendor/listNewBookings";
$route['getEmployeesForJob.html']               = "vendor/getEmployeesForJob";
$route['assignEmployeeToJob.html']              = "vendor/assignEmployeeToJob";
$route['listActiveServiceBookings.html']        = "vendor/listActiveServiceBookings";
$route['confirmOrderCompletionByVendor.html']   = "vendor/confirmOrderCompletion";
$route['vendor_listCompletedOrders.html']       = "vendor/listCompletedOrders";
$route['listCanceledOrdersOfVendor.html']       = "vendor/listCanceledOrders";


/* ........Freelance Module Routing................... */
$route['freelance_home.html']                   = "freelance";
//$route['freelance_login.html']                  = "freelance/vendorLogin";
//$route['freelance_register.html']               = "freelance/vendorRegister";
$route['freelance_newjobs.html']                = "freelance/newJobList";
$route['freelance_canceledjobs.html']           = "freelance/canceledJobList";
$route['freelance_completedjobs.html']          = "freelance/completedJobList";
$route['freelance_reschedulejobs.html']         = "freelance/rescheduleJobList";
$route['freelance_activejobs.html']             = "freelance/activeJobList";
$route['freelance_wallet_pending.html']         = "freelance/walletPendingPay";
$route['freelance_wallet_request.html']         = "freelance/walletRequestPay";
$route['freelance_wallet_report.html']          = "freelance/walletReport";
$route['freelance_myaccount.html']              = "freelance/myAccount";


$route['home.html'] = "booking";

$route['404_override'] = 'person/pageNotFound';
$route['translate_uri_dashes'] = FALSE;
