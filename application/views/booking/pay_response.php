<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($pay_data['status']){
    $content = "Payment was successfull and your Service request has been placed successfully. Vendor will contact you soon.";
    
}else{ 
    $content = $pay_data['message'];
}
?>
<script>

    redirect_url = "<?php echo base_url() . '/get_order_invoice.html?booking_id=' .$pay_data['data']['booking_id'] ?>";
  
</script>

<script>
    $.confirm({
                title: 'Payment Status!',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                 content: "<?php echo $content;?>",
                 autoClose: 'OK|5000',
                 animationBounce: 2.0,
                 buttons: {
                     OK: {
                         btnClass: 'btn-green',
                         text: 'ok',
                         action: function () {
                             window.location.href = redirect_url;
                             
                         }
                     }
                 }
            });
    </script>