
<footer class="text-center">
    <p>Copyright © 2017 Mymaid. All rights reserved. © 2016</p>
</footer>


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

<!-- Notyfy Notifications Plugin -->
<script src="<?php echo plugin_url("notifications/notyfy/packaged/jquery.noty.packaged.js") ?>"></script>
<script src="<?php echo plugin_url("notifications/notyfy/themes/default.js") ?>"></script>

</body>
<!-- END BODY -->
</html>