<?php
if(isset($user) && $user==1)
{
    $this->load->view("block/user_header");
    $this->load->view("".$content);
    $this->load->view("block/user_footer");
}else{
    $this->load->view("block/header");
    $this->load->view("".$content);
    $this->load->view("block/footer");
}
?>
