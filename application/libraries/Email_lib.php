<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'libraries/Base_lib.php';

class Email_lib extends Base_lib{

    public $model;

    public function __construct() {
        parent::__construct();
        $this->getModel();
    }

    public function getModel() {
        $this->ci->load->model('email_model');
        $this->model = $this->ci->email_model;
    }
    
    public function user_registration_mail($sender, $recipient, $info){
        $subject = "Login Information";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Welcome User</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "We are so glad you decided to try out Mymaidz.com. We will ensure provide best in class
service";
        $message .= "<p>Your Login Credentials: <b>".$info['person_email']."</b></p><br/><br/>";
        //$message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
        $message .= "<p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

    }

    public function vendor_registration_mail($sender, $recipient, $info){
        $subject = "Thank You to sign up as Vendor";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Welcome Vendor/Freelancer</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>You have registered in mymaidz as vendor - <b>pending for admin approval</b>.</p>";
        $message .= "<p>Your Login Credentials:/p>";
        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
        $message .= "<p><a href='". base_url()."vendor_login.html'>Click here</a> to login</p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'alaken.adv@gmail.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 's_thiba82@yahoo.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'kkharish16@gmail.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'praveen.dexter@gmail.com',$subject,$message,array('mailtype'=>'html'));
    }

    public function vendor_registration_approval_mail($sender, $recipient){
        $subject = "Account Approved";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Welcome Vendor/Freelancer</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Congratulations your request is approved.</p>";
        $message .= "<p>Your Login Credentials:/p>";
        $message .= "<p>Email: &nbsp; <b>".$recipient."</b></p>";
        $message .= "<p><a href='". base_url()."vendor_login.html'>Click here</a> to login</p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
                      
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'alaken.adv@gmail.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 's_thiba82@yahoo.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'kkharish16@gmail.com',$subject,$message,array('mailtype'=>'html'));
        /*Admin*/$this -> ci -> page_load_lib-> send_np_email ($sender, 'praveen.dexter@gmail.com',$subject,$message,array('mailtype'=>'html'));

    }
    
    public function order_cancelation_request_mail($recipient, $info){

        $dateObj = date_create($info->booking_service_date);
        $service_date = date_format($dateObj, 'd-m-Y');

        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order cancelation Request Sent!";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear User</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Your request for the Order cancelation has been forwarded to admin for confirmation. Processing will take 3 working days.</p>";
        $message .= "<p>Order Id: &nbsp; <b>".$info->booking_id."</b></p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$service_date."</b></p>";
        $message .= "<p>Cancel Requested On: &nbsp; <b>".date('d-m-Y H:i')."</b></p>";
        $message .= "<p><b>Refund Policy</b></p>";
        $message .= "<ul><li>You can cancel or amend a single Event on the Website, free of charge, up to forty-eight (48) hours before the Scheduled Booking Time.</li>";
        $message .= "<li>If you cancel or amend a single Event within forty-eight (48) to twenty-four (24) hours before the Scheduled Booking Time, you will have to pay a cancellation penalty equivalent to one hour’s worth of the Booked Service Fee.</li>";
        $message .= "<li>If you cancel or amend a single Event within twenty-four (24) hours before the Scheduled Booking Time to any time thereafter, you will have to pay a cancellation penalty equivalent to the full amount of the Booked Service Fee.</li>";
        $message .= "<li>•  If the Cleaning Service Provider is unable to fulfil a confirmed Booking Request, we will attempt to find you a replacement Cleaning Service Provider. If we cannot find you an alternative Cleaning Service Provider, we will reschedule your Booking Request to a new time which suits you. If we cannot find a suitable time for you, you may cancel the Booking Request at no charge
.</li>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

    }
    
    public function order_cancelation_confirmation_mail($recipient, $info){

        $dateObj = date_create($info->booking_service_date);
        $service_date = date_format($dateObj, 'd-m-Y');

        $dateObj = date_create($info->booking_cancelled_approved_by_admin_on);
        $confirmed_dateTime = date_format($dateObj, 'd-m-Y H:i');

        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order Cancelled Successfully!";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear User</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Your request for the Order cancelation has been confirmed by admin.</p>";
        $message .= "<p>Order Id: &nbsp; <b>".$info->booking_id."</b></p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$service_date."</b></p>";
        $message .= "<p>Cancelation Requested On: &nbsp; <b>".date('d-m-Y H:i')."</b></p>";
        $message .= "<p>Cancelation Confirmed On: &nbsp; <b>".$confirmed_dateTime."</b></p>";
        $message .= "<p><b>Refund Policy</b></p>";
        $message .= "<ul><li>You can cancel or amend a single Event on the Website, free of charge, up to forty-eight (48) hours before the Scheduled Booking Time.</li>";
        $message .= "<li>If you cancel or amend a single Event within forty-eight (48) to twenty-four (24) hours before the Scheduled Booking Time, you will have to pay a cancellation penalty equivalent to one hour’s worth of the Booked Service Fee.</li>";
        $message .= "<li>If you cancel or amend a single Event within twenty-four (24) hours before the Scheduled Booking Time to any time thereafter, you will have to pay a cancellation penalty equivalent to the full amount of the Booked Service Fee.</li>";
        $message .= "<li>•  If the Cleaning Service Provider is unable to fulfil a confirmed Booking Request, we will attempt to find you a replacement Cleaning Service Provider. If we cannot find you an alternative Cleaning Service Provider, we will reschedule your Booking Request to a new time which suits you. If we cannot find a suitable time for you, you may cancel the Booking Request at no charge
.</li>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    public function order_cancelation_confirmation_mail_to_vendor($recipient, $info){

        $dateObj = date_create($info->booking_service_date);
        $service_date = date_format($dateObj, 'd-m-Y');

        $dateObj = date_create($info->booking_cancelled_approved_by_admin_on);
        $confirmed_dateTime = date_format($dateObj, 'd-m-Y H:i');

        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order Cancelled!";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear Vendor/Freelancer</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Cancelation request for the <b>Order Id: ".$info->booking_id."</b> has been processed and approved by admin.</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$service_date."</b></p>";
        $message .= "<p>Cancelation Requested On: &nbsp; <b>".date('d-m-Y H:i')."</b></p>";
        $message .= "<p>Cancelation Confirmed On: &nbsp; <b>".$confirmed_dateTime."</b></p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    public function order_completion_confirmation_mail_to_vendor($recipient, $info, $amount){
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Service Completion confirmed by Admin!";
        $message = "<html><body>";
        $message .= "<p>Dear Vendor,</p><br>";
        $message .= "<p>Service completion confirmed by admin for the <b>Order Id: ".$info->booking_id."</b> has been processed and approved by admin.</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Amount Credited/Debited to your wallet: &nbsp; <b>".$amount."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$info->booking_service_date."</b></p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }


    public function service_confirmation_mail_to_user($info){
        $sender = $this->ci->data['config']['sender_email'];
        $recipient = $info->person_email;
        $subject = "Booking Confirmation";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear User</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Your order has been confirmed. Your service provider detail is: </p>";
        $message .= "<p>Vendor: " . $info->company_name . "</p>";
        $message .= "<p>Contact On: +60" . $info->company_hp_phone . "</p>";
        $message .= "<p>Please log in to your account to see the service members details.</p>";
        $message .= "<p><a href='https://mymaidz.com/user_login.html
'>https://mymaidz.com/user_login.html</a>
</p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this->ci->page_load_lib->send_np_email($sender, $recipient, $subject, $message, array('mailtype' => 'html'));

    }
    
    public function booking_cenceled_mail(){
        
    }
    
    public function booking_received_mail(){
        
    }
    
    public function withdrawal_approval_mail_to_vendor($recipient, $info, $amount){

        $dateObj = date_create($info->vendor_wallet_withdrawal_approved_on);
        $approved_dateTime = date_format($dateObj, 'd-m-Y H:i');

        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Wallet Withdrawal Request Approved!";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear Vendor/Freelancer</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Withdrawal request has been approved by admin.</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Amount Debited from your wallet: &nbsp; <b>".$amount."</b></p>";
        $message .= "<p>Approved Date: &nbsp; <b>".$approved_dateTime."</b></p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    
    public function withdrawal_rejection_mail_to_vendor($recipient, $amount){
        $now = date('d-m-Y H:i', strtotime('now'));
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Wallet Withdrawal Request Rejected!";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear Vendor/Freelancer</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>Withdrawal request has been rejected by admin for the amount".$amount."</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Rejected Date: &nbsp; <b>".$now."</b></p>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    public function invoice_Inline_Mail($resposne) {
        $this->data['response'] = $resposne; 
        $message = $this->ci->load->view('booking/email_invoice.php', $this->data, true);
        $recipient = $resposne['other'][0]->booking_user_detail_email;
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Booking Information!";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

    
    }

    public function contactUsMessageIntimation($info){

        $now = date('Y-m-d H:i:s', strtotime('now'));
        $sender = $this->ci->data['config']['sender_email'];
        $recipient = $this->ci->data['config']['contactus_receiver'];
        $subject = "Contact Us Message!";
        $message = "<html><body>";
        $message .= "<p>Dear Admin,</p><br>";
        $message .= "<p> Contact Us Message from User: </p>";
        $message .= "<p> <b>Name: </b>".$info['contact_us_name']."</p>";
        $message .= "<p> <b>Email: </b>". $info['contact_us_email'] ."</p>";
        $message .= "<p> <b>Subject: </b>". $info['contact_us_subject'] ."</p>";
        $message .= "<p> <b>Message: </b>". $info['contact_us_message'] ."</p>";
        $message .= "<p>&nbsp</p>";
        $message .= "<p> <b>Sent On:</b>  <b>".$now."</b></p>";       
        $message .= "</body></html>";
        $mail = $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
        //print_r($mail); exit;

    }

    public function service_request_mail($info){
        $now = date('Y-m-d H:i:s', strtotime('now'));
        $recipient = $this->ci->data['config']['sender_email'];
        $sender = $this->ci->data['config']['contactus_receiver'];
        $subject = "Postcode Service Request!";
        $message = "<html><body>";
        $message .= "<p>Dear Admin,</p><br>";
        $message .= "<p> Service Request from User: </p>";
        $message .= "<p> <b>Name: </b>".$info['request_name']."</p>";
        $message .= "<p> <b>Email: </b>". $info['request_email'] ."</p>";
        $message .= "<p> <b>Postcode: </b>". $info['request_postcode'] ."</p>";
        if($info['request_tel_number'] != ''){
            $message .= "<p> <b>Tel Number: </b>". $info['request_tel_number'] ."</p>";
        }
        $message .= "<p>&nbsp</p>";
        $message .= "<p> <b>Sent On:</b>  <b>".$now."</b></p>";       
        $message .= "</body></html>";
        $mail = $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    public function reset_password_link_mail($recipient, $reset_token_key){
        $sender = $this->ci->data['config']['sender_email'];

        //$reset_token_key = $reset_data['pass_reset_token_key'];
        $subject = "Change your MyMaidz Password";
        $message = "<html><body>";
        $message .= "<table width='100%'><tr><td style='width:50%'>Dear Member</td><td style='width:50%'><img src='https://mymaidz.com/assets/images/YellowMM_320.png' alt='https://www.mymaidz.com' style='width:55%'/></td></tr></table><br>";
        $message .= "<p>You have requested to change your MyMaidz password. If you did not make this request, please just ignore this email. This link will be active for only 24 hours.</p>";
        $message .= "<p><a href='" . base_url() . "reset_password.html/" . $reset_token_key . "'>Click here to change your password.</a></p><br />";
        $message .= "<p>Otherwise, please copy the link below and paste it into your browser.</p>";
        $message .= "<p><span style='color:#295CC2;'>" . base_url() . "reset_password.html/" . $reset_token_key . "</span></p><br/>";
        $message .= "<p>If you have any questions, do not hesitate to contact us.</p><br/>";
        $message .= "<br/></br><p><b>Thanks</b></p>";
        $message .= "<p><b>Admin Mymaidz.com</b></p><br/>";
        $message .= "<p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>";
        $message .= "<p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>";
        $message .= "</body></html>";

        $mail = $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
 
    
}