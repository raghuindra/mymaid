<?php if (!isset($login)) { ?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright © 2017 MyMaidz.com by Advance Dreams Venture Sdn. Bhd.</strong> All rights reserved.
    </footer>
    </div>
<?php } ?>
<div style="display: none" id='loader'><img  src="<?php echo img_url('default.gif'); ?>"</div>

<!-- Google Plus Login Scripts -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript">
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      var id_token = googleUser.getAuthResponse().id_token;
      // console.log(id_token);
      // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
      // console.log('Name: ' + profile.getName());
      // console.log('Image URL: ' + profile.getImageUrl());
      // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

      var data = {'profileName':profile.getName(),'firstName':profile.getGivenName(), 'lastName':profile.getFamilyName(), 'email':profile.getEmail(), 'profileImage':profile.getImageUrl(), 'id_token':id_token};

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'googlePlusLogin.html' ?>",
            data: data,
            cache: false,
            success: function (res) {
                //var result = JSON.parse(res);
                //print_r(result);
                var auth2 = gapi.auth2.getAuthInstance();
                gapi.auth2.getAuthInstance().disconnect();
                auth2.signOut().then(function () {
                  //console.log('User signed out.');
                  location.reload();
                });

                
                // var result = JSON.parse(res);

                // if (result.status === true) {
                //     notifyMessage('success', result.message);
                //     location.reload();
                // } else {
                //     notifyMessage('error', result.message);
                // }
            }
        });
    }

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
        });
    }
</script> 

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
    <script src="<?php echo plugin_url('plugins/select2/select2.full.min.js'); ?>"></script>
    <!-- blockUI -->
    <script src="<?php echo plugin_url('plugins/blockUI/jquery.blockUI.js'); ?>"></script>

<?php } ?>


<script>
    
$(function () {
        
    $('input[type="checkbox"], input[type="radio"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '20%' // optional
    });

    $('[data-toggle="tooltip"]').tooltip({'html':true,'placement': "bottom"});

});
</script>

<script>
    $(function () {
<?php if ($this->session->flashdata('error_message') != null) { ?>
            var msg = "<?php echo $this->session->flashdata('error_message'); ?>";

            notifyMessage('error', msg);

<?php } else if ($this->session->flashdata('success_message') != null) { ?>
            var msg = "<?php echo $this->session->flashdata('success_message'); ?>";
            notifyMessage('success', msg);

<?php } ?>

    });
    
    

    function notifyMessage(type, msg) {
        noty({
            text: msg,
            type: type,
            theme: 'defaultTheme',
            dismissQueue: true,
            layout: 'topRight',
            timeout: 10000,
            template: '<div class="noty_message"><span class="noty_text" style="font-weight:bold;"></span><div class="noty_close"></div></div>',
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
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";

    function getWidgetsdata(){
        
        $.ajax({
            type: "POST",
            url: base_url +'/widgets_updates.html',
            data: {},
            cache: false,
            success: function (res) {
                var result = JSON.parse(res);

                if (result.status === true) {
                    //notifyMessage('success', result.message);

                    $(".wallet_balance").html(result.data.wallet_balance);
                    $(".w_wallet_balance").html(result.data.wallet_balance);
                    $(".w_new_orders").html(result.data.new_orders);
                    $(".w_processing_orders").html(result.data.processing_orders);
                    $(".w_completed_orders").html(result.data.completed_orders);
                } else {                       
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //notifyMessage('error', errorThrown);
            }
        });
    }

    /* AJAX call to get the Dashboard widgets. */
    getWidgetsdata();
    setInterval(function () {
        getWidgetsdata();
    }, 30000);
</script>

</body>

</html>
