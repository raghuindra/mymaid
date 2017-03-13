<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('vendor_lib', 'page_load_lib'));
        $this->load->helper(array('form', 'language'));
        $this->uLang = $this->session->userdata('user_lang');
        $this->lang->load("mm", $this->uLang);
        //$this->lang->load("vendor_msg", $this->uLang);
        //$this->lang->load("vendor_leftbar", $this->uLang);
        $this->page_load_lib->validate_user('vendor');
    }

    public function index() {

        $this->data['content'] = "vendor/home.php";
        $this->data['vendor'] = 1;
        $this->load->view('template', $this->data);
    }

    public function newJobList() {
        $this->data['content'] = "vendor/newJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||new";
        $this->load->view('template', $this->data);
    }

    public function activeJobList() {

        $this->data['content'] = "vendor/activeJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||active";
        $this->load->view('template', $this->data);
    }

    public function canceledJobList() {

        $this->data['content'] = "vendor/canceledJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||cancel";
        $this->load->view('template', $this->data);
    }

    public function completedJobList() {

        $this->data['content'] = "vendor/completedJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||completed";
        $this->load->view('template', $this->data);
    }

    public function rescheduleJobList() {

        $this->data['content'] = "vendor/rescheduleJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||reschedule";
        $this->load->view('template', $this->data);
    }

    public function walletPendingPay() {

        $this->data['content'] = "vendor/walletPendingPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||pending";
        $this->load->view('template', $this->data);
    }

    public function walletRequestPay() {

        $this->data['content'] = "vendor/walletRequestPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||request";
        $this->load->view('template', $this->data);
    }

    public function walletReport() {

        $this->data['content'] = "vendor/walletReport.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||report";
        $this->load->view('template', $this->data);
    }

    public function myAccountCompany() {
        $this->data['content'] = "vendor/myaccount_company.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myaccount||company";
        $this->load->view('template', $this->data);
    }
    
    public function myAccountBank() {
        $this->data['content'] = "vendor/myaccount_bank.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myaccount||bank";
        $this->load->view('template', $this->data);
    }
   

}
