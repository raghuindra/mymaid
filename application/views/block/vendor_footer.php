
<footer class="text-center">
    <p>Copyright © 2017 Mymaid. All rights reserved. © 2016</p>
</footer>

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
<script src="<?php echo js_url('app_utils');?>"></script>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
</body>
<!-- END BODY -->
</html>