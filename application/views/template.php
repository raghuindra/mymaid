<?php
if(isset($user) && $user==1)
{
    $this->load->view("block/user_header");
    $this->load->view("".$content);
    $this->load->view("block/user_footer");
    
}else if(isset($vendor) && $vendor == 1){
    
    $this->load->view("block/vendor_header");
    $this->load->view("".$content);
    $this->load->view("block/vendor_footer");
    
}else if(isset($newVendor) && $newVendor == 1){
    
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
