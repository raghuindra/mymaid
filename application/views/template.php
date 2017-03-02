<?php
if(isset($user))
{
    $this->load->view("block/user_header");
    $this->load->view("".$content);
    $this->load->view("block/user_footer");
    
}else if(isset($oldvendor)){
    
    $this->load->view("block/vendor_header");
    $this->load->view("".$content);
    $this->load->view("block/vendor_footer");
    
}else if( isset($vendor) || isset($admin) ){
    
    $this->load->view("block/header");
    $this->load->view("".$content);
    $this->load->view("block/footer");
    
}
else{
    $this->load->view("block/header");
    $this->load->view("".$content);
    $this->load->view("block/footer");
}
?>
