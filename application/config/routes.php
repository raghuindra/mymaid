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
$route['default_controller']                    = 'user';
$route['logout.html']                           = "person/logout";
$route['forgotPass.html']                       = "person/forgotPassword";
$route['reset_password.html/(:any)']            = "person/resetpassword/$1";


/* ........User Module Routing............................ */
$route['user_login.html']                       = "person/userLogin";
$route['user_register.html']                    = "person/userRegister";


/* ........Admin Module Routing................... */
$route['admin_home.html']                       = "admin";
$route['admin_login.html']                      = "person/adminLogin";



/* ........Vendor/Freelance Module Routing................... */
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
$route['vendor_myaccount.html']                 = "vendor/myAccount";

/* ........Vendor/Freelance Module Routing................... */
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


$route['home.html'] = "user";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
