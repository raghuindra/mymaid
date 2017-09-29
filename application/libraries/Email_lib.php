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
        $message .= "<p>Dear User,</p><br>";
        $message .= "<p>Your Login Credentials:</p>";
        $message .= "<p>Email: &nbsp; <b>".$info['person_email']."</b></p>";
        $message .= "<p>Password: &nbsp; <b>Same password as you provided during registration.</b></p>";
        $message .= "<p><a href='". base_url()."user_login.html'>Click here</a> to login</p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

    }
    
    public function order_cancelation_request_mail($recipient, $info){
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order cancelation Request Sent!";
        $message = "<html><body>";
        $message .= "<p>Dear User,</p><br>";
        $message .= "<p>Your request for the Order cancelation has been forwarded to admin for confirmation.</p>";
        $message .= "<p>Order Id: &nbsp; <b>".$info->booking_id."</b></p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$info->booking_service_date."</b></p>";
        $message .= "<p>Cancel Requested On: &nbsp; <b>".date('Y-m-d H:i:s')."</b></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));

    }
    
    public function order_cancelation_confirmation_mail($recipient, $info){
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order Cancelled Successfully!";
        $message = "<html><body>";
        $message .= "<p>Dear User,</p><br>";
        $message .= "<p>Your request for the Order cancelation has been confirmed by admin.</p>";
        $message .= "<p>Order Id: &nbsp; <b>".$info->booking_id."</b></p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$info->booking_service_date."</b></p>";
        $message .= "<p>Cancelation Requested On: &nbsp; <b>".date('Y-m-d H:i:s')."</b></p>";
        $message .= "<p>Cancelation Confirmed On: &nbsp; <b>".$info->booking_cancelled_approved_by_admin_on."</b></p>";
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    public function order_cancelation_confirmation_mail_to_vendor($recipient, $info){
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Order Cancelled!";
        $message = "<html><body>";
        $message .= "<p>Dear Vendor,</p><br>";
        $message .= "<p>Cancelation request for the <b>Order Id: ".$info->booking_id."</b> has been processed and approved by admin.</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Service Name: &nbsp; <b>".$info->service_name."</b></p>";
        $message .= "<p>Service Date: &nbsp; <b>".$info->booking_service_date."</b></p>";
        $message .= "<p>Cancelation Requested On: &nbsp; <b>".date('Y-m-d H:i:s')."</b></p>";
        $message .= "<p>Cancelation Confirmed On: &nbsp; <b>".$info->booking_cancelled_approved_by_admin_on."</b></p>";
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
        $subject = "Booking Information";
        $message = "<html><body>";
        $message .= "<p>Dear User,</p><br>";
        $message .= "<p>Your Service has been accepted by Company: " . $info->company_name . "</p>";
        $message .= "<p>Contact On: +60" . $info->company_mobile . " / +60" . $info->company_landphone . "</p>";
        $message .= "<p>Please log in to your account to see the service members details.</p><br>";
        $message .= "</body></html>";
        $this->ci->page_load_lib->send_np_email($sender, $recipient, $subject, $message, array('mailtype' => 'html'));

    }
    
    public function booking_cenceled_mail(){
        
    }
    
    public function booking_received_mail(){
        
    }
    
    public function withdrawal_approval_mail_to_vendor($recipient, $info, $amount){
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Wallet Withdrawal Request Approved!";
        $message = "<html><body>";
        $message .= "<p>Dear Vendor,</p><br>";
        $message .= "<p>Withdrawal request has been approved by admin.</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Amount Debited from your wallet: &nbsp; <b>".$amount."</b></p>";
        $message .= "<p>Approved Date: &nbsp; <b>".$info->vendor_wallet_withdrawal_approved_on."</b></p>";
        
        $message .= "</body></html>";
        $this -> ci -> page_load_lib-> send_np_email ($sender,$recipient,$subject,$message,array('mailtype'=>'html'));
    }
    
    
    public function withdrawal_rejection_mail_to_vendor($recipient, $amount){
        $now = date('Y-m-d H:i:s', strtotime('now'));
        $sender = $this->ci->data['config']['sender_email'];
        $subject = "Wallet Withdrawal Request Rejected!";
        $message = "<html><body>";
        $message .= "<p>Dear Vendor,</p><br>";
        $message .= "<p>Withdrawal request has been rejected by admin for the amount".$amount."</p>";
        $message .= "<p>Please contact Admin for any queries.</p>";
        $message .= "<p>Rejected Date: &nbsp; <b>".$now."</b></p>";
        
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
    
 
    
}