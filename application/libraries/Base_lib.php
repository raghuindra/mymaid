<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Base_lib {

    public $_status = false;
    public $_message = "";
    public $_rdata = array();
    public $model;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->model('mm_model');
        $this->model = $this->ci->mm_model;
    }

    public function getResponse() {
        return array(
            'status' => $this->_status,
            'message' => $this->_message,
            'data' => $this->_rdata
        );
    }

    public function resetResponse() {
        $this->_message = "";
        $this->_status = FALSE;
        $this->_rdata = array();
    }

    function move_file($source, $destination, $file) {
        if (file_exists($source . $file)) {
            if (copy($source . $file, $destination . $file)) {
                unlink($source . $file);
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function copy_file($source, $destination, $file) {
        if (file_exists($source . $file)) {
            if (copy($source . $file, $destination . $file)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function sendSMS($mobile, $message, $createdDate = false, $updatedDate = false, $from = 'MyMaidz', $updatedBy = "MyMaidz") {
        if ($createdDate === false) {
            $createdDate = date('Y-m-d H:i:s');
        }
        if ($updatedDate == false) {
            $updatedDate = $createdDate;
        }

        $this->model->sendMessage($mobile, $message, $from, $createdDate, $updatedBy, $updatedDate);
    }

    function calculateCutoffAmount($wholeAmt) {
        $cutoff = $this->ci->data['config']['profit_cutoff'];
        $profit = (float) $wholeAmt * (float) ($cutoff / 100);
        $vendor_amt = number_format((float) ($wholeAmt - $profit), 2, '.', '');
        return array('admin_share' => $profit, 'vendor_share' => $vendor_amt, 'cutoff' => $cutoff);
    }

    function updateVendorWallet($amount, $service_id, $transaction_type, $person_id, $msg='') {
        $wallet = array();
        $wallet['vendor_wallet_vendor_id'] = $person_id;
        $wallet['vendor_wallet_transaction_for'] = "service_order";
        $wallet['vendor_wallet_transaction_for_id'] = $service_id;
        $wallet['vendor_wallet_transaction_type'] = $transaction_type;
        $wallet['vendor_wallet_transaction_amount'] = $amount;
        $wallet['vendor_wallet_note'] = $msg;
        $this->model->insert_tb('mm_vendor_wallet', $wallet);

        if($transaction_type == Globals::WALLET_CREDIT){
            $this->model->update_person_wallet_credit($person_id, $amount);
            
        }else if($transaction_type == Globals::WALLET_DEBIT){
            $this->model->update_person_wallet_debit($person_id, $amount);
 
        }
        
    }
    
    function updateUserWallet($amount, $service_id, $transaction_type, $person_id, $msg='') {
        $wallet = array();
        $wallet['user_wallet_user_id'] = $person_id;
        $wallet['user_wallet_transaction_for'] = "service_order";
        $wallet['user_wallet_transaction_for_id'] = $service_id;
        $wallet['user_wallet_transaction_type'] = $transaction_type;
        $wallet['user_wallet_transaction_amount'] = $amount;
        $wallet['user_wallet_note'] = $msg;
        $this->model->insert_tb('mm_user_wallet', $wallet);

        if($transaction_type == Globals::WALLET_CREDIT){
            $this->model->update_person_wallet_credit($person_id, $amount);
            
        }else if($transaction_type == Globals::WALLET_DEBIT){
            $this->model->update_person_wallet_debit($person_id, $amount);
 
        }
        
    }
    
    function updateAdminWallet($amount, $service_id, $transaction_type, $person_id, $msg='') {
        $wallet = array();
        $wallet['admin_wallet_admin_id'] = $person_id;
        $wallet['admin_wallet_transaction_for'] = "service_order";
        $wallet['admin_wallet_transaction_for_id'] = $service_id;
        $wallet['admin_wallet_transaction_type'] = $transaction_type;
        $wallet['admin_wallet_transaction_amount'] = $amount;
        $wallet['admin_wallet_note'] = $msg;
        return $this->model->insert_tb('mm_admin_wallet', $wallet);
    }

}
