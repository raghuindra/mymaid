    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image_resize_lib {

    function __construct() {
        $this->ci = &get_instance();
       
    }

    public function make_thumb($tempimage, $path) {
        $this->ci->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $tempimage;
        $config['new_image'] = $path;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 180;
        $config['height'] = 180;
        
        
        $this->ci->image_lib->initialize($config);
        
        if (!$this->ci->image_lib->resize()) {
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
     public function upload_image($filename,$ext,$path,$width='1024',$height='768',$max_size='10240',$newfilename='') 
     {
        if($newfilename==''){
        	$newfilename=md5(microtime() . rand());
        }	         
        $config = array();
        $config['upload_path']      = 'assets/uploads/'.$path;
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['file_name']        = $newfilename.".".$ext;
        $config['max_size']         = $max_size;
        $config['max_width']        = $width;
        $config['max_height']       = $height;
        
        //echo $config['upload_path'];
        $this->ci->load->library('upload', $config);		
        
        if ( ! $this->ci->upload->do_upload($filename))
        {          
            return FALSE;
        }
        else
        {              
            return TRUE;
        }
     }
     
     public function upload_file($filename,$ext,$path,$max_size='10240',$newfilename='') 
     {
        if($newfilename==''){
            $newfilename=md5(microtime() . rand());
        }	         
        $config = array();
        $config['upload_path']      = 'assets/uploads/'.$path;
        $config['allowed_types']    = 'gif|jpg|jpeg|png|doc|docx|xlsx|xls|pdf|txt|ppt|pptx|rtf';
        $config['file_name']        = $newfilename.".".$ext;
        $config['max_size']         = $max_size;
        
        //echo $config['upload_path'];
        $this->ci->load->library('upload', $config);		
        
        if ( ! $this->ci->upload->do_upload($filename))
        {          
            return FALSE;
        }
        else
        {              
            return TRUE;
        }
     }
     
     
    public function img_resize($upload, $newpath,$make_thumb=false) {
        
        $this->ci->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload['full_path'];
        $config['new_image'] = $newpath;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $upload['width'];
        $config['height'] = $upload['height'];
        
        $this->ci->image_lib->initialize($config);

        if (!$this->ci->image_lib->resize()) {
            echo $this->ci->image_lib->display_errors();
        }

        
        unset($config);
        $this->ci->image_lib->clear();
        if($make_thumb){
            $this->ci->make_thumb($upload['full_path'], $newpath."/thumb/");
        }
    }
    
     public function get_upload_error()
     {
         return $this->ci->upload->display_errors();
     }
     
     public function get_upload_data()
     {
         return $this->ci->upload->data();
     }

     public function get_resize_error()
     {
         return $this->ci->image_lib->display_errors();
     }
	 
	
     
    
}