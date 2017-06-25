<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'controllers/Base.php';
class User extends Base {
   
    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('user_lib','page_load_lib','email_lib'));
        //$this->uLang = $this->session->userdata('user_lang');               
        $this -> lang -> load("mm", $this->uLang);
        $this->page_load_lib->validate_user(Globals::PERSON_TYPE_USER_NAME);
    }

    public function index(){

        //$this->data['content']  = "user/user_home.php";
        $this->data['content']  = "user/active_orders.php";
        $this->data['user']     = 1;
        $this -> load -> view('template', $this->data);
    }

    public function activeOrders(){
        $this->data['content']  = "user/active_orders.php";
        $this->data['user']     = 1;
        $this -> load -> view('template', $this->data);
    }

    /** Function to List the Active Orders.
    * @param null
    * @return JSON returns the JSON with Active Orders.    
    */
    public function activeOrdersList(){
        $response = $this->user_lib->_listActiveOrders(); 
        echo json_encode($response);

    }
    
    
    public function canceledOrders(){
        $this->data['content']  = "user/canceled_orders.php";
        $this->data['user']     = 1;
        $this -> load -> view('template', $this->data);
    }

    /** Function to List the Active Orders.
    * @param null
    * @return JSON returns the JSON with Active Orders.    
    */
    public function canceledOrdersList(){
        $response = $this->user_lib->_listCanceledOrders(); 
        echo json_encode($response);

    }
     
    /** Function to Cancel the Individual Order.
    * @param null
    * @return JSON returns the JSON Order cancellation status.    
    */
    public function cancelOrder(){
        if(isset($_POST['bookingId'])){
            $response = $this->user_lib->_cancelUserOrder();
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_request'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }
    
    /** Function to Show the View of Completed Orders.
    * @param null
    * @return JSON returns the View.    
    */
    public function completedOrders(){
        $this->data['content']  = "user/completed_orders.php";
        $this->data['user']     = 1;
        $this -> load -> view('template', $this->data);
    }
    
    /** Function to List the Completed Orders.
    * @param null
    * @return JSON returns the JSON with Completed Orders.    
    */
    public function completedOrdersList(){
        $response = $this->user_lib->_listCompletedOrders(); 
        echo json_encode($response);
    }
    
    /** Function to Confirm the order Completion.
    * @param null
    * @return JSON returns the JSON with order Completion status.    
    */
    public function confirmOrderCompletion(){
        if(isset($_POST['bookingId'])){
            $response = $this->user_lib->_confirmOrderCompletion();
        }else{
            $response = array(
                'status' => false,
                'message' => $this->lang->line('invalid_request'),
                'data' => array()
            );
        }
        echo json_encode($response);
    }
        
        
        
}
