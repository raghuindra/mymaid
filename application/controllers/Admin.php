<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
   
        public $data = array();
        public $uLang = 'en';
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('admin_lib', 'page_load_lib'));
            $this -> load -> helper(array('form', 'language'));
            $this->uLang = $this->session->userdata('user_lang');               
            $this -> lang -> load("admin", $this->uLang);
            $this->page_load_lib->validate_user('admin');
        }
        
	public function index(){

            $this->data['content']  = "admin/home.php";
            $this->data['admin']     = 1;
            $this -> load -> view('template', $this->data);
	}
        
        public function services(){
            $this->data['content']  = "admin/serviceList.php";
            $this->data['admin']     = 1;
            $this -> load -> view('template', $this->data);
        }
        
        public function postAddService(){
            
            if(isset($_POST['serviceName'])){
                $response = $this->admin_lib->_addService();
                echo json_encode($response);
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_data')
                );
                //$this->session->set_flashdata('error_message', $this->lang->line('inavlid_data'));
                echo json_encode($response);
            }
        }
        
        public function postServiceList(){
            $response = $this->admin_lib->_getServiceList();
            
            echo json_encode($response);
        }
        
        public function postEditService(){
            if(isset($_POST['serviceName'])){
                $response = $this->admin_lib->_editService();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_data'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        public function packages(){
            $this->load->model('admin_model');
            $this->data['service_names']    = $this->admin_model-> get_tb('mm_services','service_id,service_name,service_archived',array('service_archived'=>0))->result();
            $this->data['buildings']        = $this->admin_model-> get_tb('mm_building','building_id,building_name',array('building_status'=>1))->result();
            $this->data['area_sizes']       = $this->admin_model-> get_tb('mm_area','area_id,area_size,area_measurement',array('area_status'=>1))->result();
            //echo "<pre>";print_r($this->data['buildings']); echo "<pre/>";
            $this->data['content']      = "admin/packages.php";
            $this->data['admin']        = 1;
            $this -> load -> view('template', $this->data);
            
        }
        
        
        public function serviceDetail($serviceId){
            $db = get_instance()->db->conn_id;
            $serveId  = mysqli_real_escape_string($db,trim($serviceId));
            
            $service_detail = $this->admin_model-> get_tb('mm_services','service_id,service_name,service_archived',array('service_archived'=>0, 'service_id'=>$serveId))->result();
            //echo "<pre>";print_r($service_detail); echo "<pre/>";
            if(!empty($service_detail)){
                $this->data['buildings']        = $this->admin_model-> get_tb('mm_building','building_id,building_name',array('building_status'=>1))->result();
                $this->data['area_sizes']       = $this->admin_model-> get_tb('mm_area','area_id,area_size,area_measurement',array('area_status'=>1))->result();
                $this->data['service_detail']   = $service_detail;
            }else{
                redirect('services.html', 'refresh');
            }
            
            $this->data['content']      = "admin/service_detail.php";
            $this->data['admin']        = 1;
            $this -> load -> view('template', $this->data);
            
        }
        
        public function createServicepackage(){

            if(isset($_POST['package_service_id'])){
                $response = $this->admin_lib->_createServicePackage();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_data'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        public function postServicePackageList($serviceId){
            $db = get_instance()->db->conn_id;
            $serveId  = mysqli_real_escape_string($db,trim($serviceId));
                        //echo "<pre>";print_r($service_detail); echo "<pre/>";            
            $response = $this->admin_lib->_getServicePackageList($serviceId);
            
            echo json_encode($response);
        }
        
        
        public function postArchiveService(){
            if(isset($_POST['serviceId'])){
                $response = $this->admin_lib->_archiveService();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
                       
        }

        public function editServicePackage($packageId){
            
            $db = get_instance()->db->conn_id;
            $packId  = mysqli_real_escape_string($db,trim($packageId));
            
            if(isset($_POST['edit_package_id'])){
                $response = $this->admin_lib->_updateServicePackage($packageId);
                echo json_encode($response);
            }else{
                               
                $this->admin_lib->_getServicePackageDetail($packageId);
                $this->data['buildings']        = $this->admin_model-> get_tb('mm_building','building_id,building_name',array('building_status'=>1))->result();
                $this->data['area_sizes']       = $this->admin_model-> get_tb('mm_area','area_id,area_size,area_measurement',array('area_status'=>1))->result();
                $this -> load -> view('admin/popup/edit_package', $this->data);
            }
        }
        
        public function postArchiveServicePackage(){
            if(isset($_POST['servicePackageId'])){
                $response = $this->admin_lib->_archiveServicePackage();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('inavlid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        
}