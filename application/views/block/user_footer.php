<?php if(isset($home) && $home == 1){ ?>
<footer class="text-center">
    <p>Copyright © 2017 Mymaid. All rights reserved. © 2016</p>
</footer>
<?php } ?>

<script>
    $(function(){
<?php if($this->session->flashdata('error_message') != null ) {?>
        var msg = "<?php echo $this->session->flashdata('error_message');?>";
        
        notifyMessage('error', msg);
        
<?php }else if($this->session->flashdata('success_message') != null ) { ?>  
        var msg = "<?php echo $this->session->flashdata('success_message');?>";
        notifyMessage('success', msg);

<?php } ?>
    
    });
    
    function notifyMessage(type, msg){
        noty({
                text: msg,
                type: type,
                theme: 'defaultTheme',
                dismissQueue: true,
                layout: 'topRight',
                timeout: 6000,
                template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
                progressBar: true,
                animation: {
                open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            closeWith: ['click']
        });
    }

</script>

    <script>
       var ct_postalcode_statusObj = {
           'ct_postalcode_status': 'Y'
       };
       function myFunction() {
            var input = document.getElementById('coupon_val')
            var div = document.getElementById('display_code');
            div.innerHTML = input.value;
        }

    </script>
        
<!-- Notyfy Notifications Plugin -->
    <script src="<?php echo plugin_url("notifications/notyfy/packaged/jquery.noty.packaged.js") ?>"></script>
    <script src="<?php echo plugin_url("notifications/notyfy/themes/default.js") ?>"></script>
<?php if(!isset($home) ){ ?>
    <script src="<?php echo js_url('ct-common-jquery');?>" type="text/javascript"></script>
    <script src="<?php echo js_url('jquery-ui.min');?>" type="text/javascript"></script>
    
    <script src="<?php echo js_url('jquery.nicescroll.min');?>" type="text/javascript"></script>

    <script src="<?php echo js_url('jquery.payment.min');?>" type="text/javascript"></script>

    <script src="<?php echo js_url('jquery.validate.min');?>"></script>
    <script src="<?php echo js_url('jquery.sticky-kit.min');?>" type="text/javascript"></script>
    <script src="<?php echo js_url('booking');?>"></script>
<?php } ?>
</body>
<!-- END BODY -->
</html>