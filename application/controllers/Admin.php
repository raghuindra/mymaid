<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';
class Admin extends Base {
   
        public $data = array();
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('admin_lib', 'admin_vendor_lib'));              
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
                    'message' => $this->lang->line('invalid_data')
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
                    'message' => $this->lang->line('invalid_data'),
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
                $this->data['service_frequency']= $this->admin_model-> getFrequencyOffersForService($serviceId);
                $this->data['service_addons']   = $this->admin_model-> getAddonsForService($serviceId);
                $this->data['spl_request']      = $this->admin_model-> get_serviceSplRequest($serviceId);
                
                // echo "<pre>"; print_r($this->data['service_frequency']); exit;
                
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
                    'message' => $this->lang->line('invalid_data'),
                    'data' => array()
                );
            } print_r($response);
            echo json_encode($response);
        }
        
        public function postServicePackageList($serviceId){
            $db = get_instance()->db->conn_id;
            $serveId  = mysqli_real_escape_string($db,trim($serviceId));
                        //echo "<pre>";print_r($service_detail); echo "<pre/>";            
            $response = $this->admin_lib->_getServicePackageList($serveId);
            
            echo json_encode($response);
        }
        
        
        public function postArchiveService(){
            if(isset($_POST['serviceId'])){
                $response = $this->admin_lib->_archiveService();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
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
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        
        public function createServiceFrequencyOfferPrice(){
           
            if(isset($_POST['add_frequency_service_id'])){
                $response = $this->admin_lib->_createServiceFrequencyOfferPrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }

        public function postFrequencyOfferList($serviceId){
            
            $db = get_instance()->db->conn_id;
            $serveId  = mysqli_real_escape_string($db,trim($serviceId));
            
            $response = $this->admin_lib->_getFrequencyOfferList($serveId);
            
            echo json_encode($response);
            
        }
        
        public function postArchiveServiceFrequencyOffer(){
            if(isset($_POST['frequencyId'])){
                $response = $this->admin_lib->_archiveServiceFrequencyOffer();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        public function postUpdateServiceFrequencyOffer(){
            if(isset($_POST['offerVal'])){
                $response = $this->admin_lib->_updateServiceFrequencyOffer();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        
        public function postServiceAddonsPriceList(){
            if(isset($_POST['serviceId'])){
                $response = $this->admin_lib->_getServiceAddonsPriceList();
            }else{
               $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                ); 
            }
            echo json_encode($response);
        }
        
        
        public function createServiceAddonsPrice(){
           
            if(isset($_POST['add_addons_price_service_id'])){
                $response = $this->admin_lib->_createServiceAddonsPrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        public function postArchiveServiceAddonPrice(){
            if(isset($_POST['addonPriceId'])){
                $response = $this->admin_lib->_archiveServiceAddonPrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        public function postUpdateServiceAddonPrice(){
            if(isset($_POST['priceVal'])){
                $response = $this->admin_lib->_updateServiceAddonPrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        /* Service Special Request List */
        public function postServiceSplRequestList(){
            if(isset($_POST['serviceId'])){
                $response = $this->admin_lib->_getServiceSplRequestList();
            }else{
               $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                ); 
            }
            echo json_encode($response);
        }
        
        /* Create Service Special Request */
        public function createServiceSplRequest(){

            if(isset($_POST['add_spl_request_id'])){
                $response = $this->admin_lib->_createServiceSplRequest();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        /* Upadte Service Special Request */
        public function postUpdateServiceSplRequest(){

            if(isset($_POST['serviceSplReqId'])){
                $response = $this->admin_lib->_updateServiceSplRequestPrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        /* Archive/Unarchive Service Special Request */
        public function postArchiveServiceSplRequest(){

            if(isset($_POST['serviceSplReqId'])){
                $response = $this->admin_lib->_archiveServiceSplRequest();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        
        /* Get the distinct price for a Service package of a service based on Postcode  */
        public function postGetServicePackagePostcodePrice(){
            
            if(isset($_POST['packageId'])){               
                $this->data['states'] = $this->admin_lib->_getPostalStates();
                //print_r($this->data['states']);
                $this -> load -> view('admin/popup/set_package_postal_price', $this->data);
            }else if(isset($_POST['archived'])){
                $response =  $this->admin_lib->_getServicePackagePostalPriceList();
                echo json_encode($response);
            }
                                 
        }
        
        /* Get City name based on sate code selection */
        public function postGetPostOffices(){
            if(isset($_POST['stateCode'])){
               $response =  $this->admin_lib->_getPostOffices();
            }else{
               $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                ); 
            }
            echo json_encode($response);
        }
        
        /* get the Postcodes based on AreaCodes And which not available in Postcode Price list already. */
        public function postGetpostcodes(){
            if(isset($_POST['areaCode'])){
               $response =  $this->admin_lib->_getpostcodes();
            }else{
               $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                ); 
            }
            echo json_encode($response);
        }
        
        /* Set the ditinct price for a Service package of a service based on Postcode  */
        public function postSetServicePackagePostcodePrice(){
            //print_r($_POST);exit;
            if(isset($_POST['packageId'])){
                
                $response = $this->admin_lib->_setServicePackagePostalPrice();
                
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
                                 
        }
        
        /* Postcpde Price Archive/UnArchive */
        public function postArchivePostcodePrice(){
            
            if(isset($_POST['postcodePriceId'])){
                $response = $this->admin_lib->_archiveServicePackagePostcodePrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        /* Postcpde Price Updating */
        public function postUpdateServicePackagePostcodePrice(){
            
            if(isset($_POST['priceVal'])){
                $response = $this->admin_lib->_updateServicePackagePostcodePrice();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        /** Function to list New/Active/Inactive vendors.
         * @param null
         * @return JSON returns the Data to view    
         */
        public function postVendorsList(){
            
            //$this->data['new_vendors']      = $this->admin_vendor_lib->_getNewVendors();
            //$this->data['active_vendors']   = $this->admin_vendor_lib->_getActiveVendors();
            
            $this->data['content']          = "admin/vendor_list.php";
            $this->data['admin']            = 1;
            $this -> load -> view('template', $this->data);
            
        }
        
        /** Function to list New vendors.
         * @param null
         * @return JSON returns the Data to view    
         */
        public function postNewVendorsList(){
           
            $response = $this->admin_vendor_lib->_getNewVendors();

            echo json_encode($response);
            
        }
        
        /** Function to list Active vendors(Archived/UnArchived).
         * @param null
         * @return JSON returns the Data to view    
         */
        public function postActiveVendorsList(){
            
            if(isset($_POST['archived'])){
                $response = $this->admin_vendor_lib->_getActiveVendors();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        /** Function to approve New Vendor.
         * @param null
         * @return JSON returns the Data to view    
         */
        public function approveNewVendor(){
            
            if(isset($_POST['personId'])){
                $response = $this->admin_vendor_lib->_approveNewVendor();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
            
        }
        
        /** Function to Archive/Un archive Vendor.
         * @param null
         * @return JSON returns the Data to view    
         */
        public function postArchiveVendor(){
            if(isset($_POST['personId'])){
                $response = $this->admin_vendor_lib->_archiveVendor();
            }else{
                $response = array(
                    'status' => false,
                    'message' => $this->lang->line('invalid_request'),
                    'data' => array()
                );
            }
            echo json_encode($response);
        }
        
        
        /** Function to get Vendor company list.
         * @param null
         * @return JSON returns the Data to view    
         */
        public function postVendorCompanyList(){
            if(isset($_POST['dataTableReq'])){
                $response = $this->admin_vendor_lib->_vendorCompanyList();
            
                echo json_encode($response); 
            }else{
                $this->data['content']          = "admin/vendor_company_list.php";
                $this->data['admin']            = 1;
                $this -> load -> view('template', $this->data);
            }
            
        }
        
        
}