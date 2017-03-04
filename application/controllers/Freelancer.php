<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancer extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('vendor_lib', 'page_load_lib'));
        $this->load->helper(array('form', 'language'));
        $this->uLang = $this->session->userdata('user_lang');
        $this->lang->load("mm", $this->uLang);
        //$this->lang->load("vendor_msg", $this->uLang);
        //$this->lang->load("vendor_leftbar", $this->uLang);
        $this->page_load_lib->validate_user('freelancer');
    }

    public function index() {

        $this->data['content'] = "freelancer/home.php";
        $this->data['vendor'] = 1;
        $this->load->view('template', $this->data);
    }

    public function newJobList() {
        $this->data['content'] = "freelancer/newJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||new";
        $this->load->view('template', $this->data);
    }

    public function activeJobList() {

        $this->data['content'] = "freelancer/activeJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||active";
        $this->load->view('template', $this->data);
    }

    public function canceledJobList() {

        $this->data['content'] = "freelancer/canceledJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||cancel";
        $this->load->view('template', $this->data);
    }

    public function completedJobList() {

        $this->data['content'] = "freelancer/completedJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||completed";
        $this->load->view('template', $this->data);
    }

    public function rescheduleJobList() {

        $this->data['content'] = "freelancer/rescheduleJob.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myjob||reschedule";
        $this->load->view('template', $this->data);
    }

    public function walletPendingPay() {

        $this->data['content'] = "freelancer/walletPendingPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||pending";
        $this->load->view('template', $this->data);
    }

    public function walletRequestPay() {

        $this->data['content'] = "freelancer/walletRequestPay.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||request";
        $this->load->view('template', $this->data);
    }

    public function walletReport() {

        $this->data['content'] = "freelancer/walletReport.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "wallet||report";
        $this->load->view('template', $this->data);
    }

    public function myAccount() {
        $this->data['content'] = "freelancer/myaccount.php";
        $this->data['vendor'] = 1;
        $this->data['active'] = "myaccount||vendor";
        $this->load->view('template', $this->data);
    }
    

}
