<?php if (!isset($login)) { ?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="http://mymaid.com">My Maid</a>.</strong> All rights reserved.
    </footer>
    </div>
<?php } ?>


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);

    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart();
    });

</script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo plugin_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo plugin_url('plugins/iCheck/icheck.min.js'); ?>"></script>

<?php if (!isset($login)) { ?>
    <!-- PACE -->
    <script src="<?php echo plugin_url('plugins/pace/pace.min.js'); ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo plugin_url('plugins/morris/morris.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo plugin_url('plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo plugin_url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo plugin_url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo plugin_url('plugins/knob/jquery.knob.js'); ?>"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo plugin_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo plugin_url('plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo plugin_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo plugin_url('plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo plugin_url('plugins/fastclick/fastclick.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo plugin_url('dist/js/app.min.js'); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo plugin_url('dist/js/pages/dashboard.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo plugin_url('dist/js/demo.js'); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo plugin_url('plugins/select2/select2.full.min.js');?>"></script>

<?php } ?>

   
    <script>
        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    
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

</html>
