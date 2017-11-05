 <style>
#ajax_loader {
 border-top: 16px solid blue;
 border-right: 16px solid green;
 border-bottom: 16px solid red;
 border-left: 16px solid yellow;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 80px;
  height: 80px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url().'home.html'; ?>"><img class="profile-user-img img-responsive" src="<?php echo img_url('YellowMM_240.png');?>" style="width:85%;" alt="MyMaidz"></a>
    </div>
    <!-- /.login-logo -->
    <form action="<?php base_url().'admin_login.html'; ?>" method="post" id="login_box">
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">               
                <!-- /.col -->
                <div class="col-xs-8">
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                    <!-- <div class=" g-signin2" data-onsuccess="onSignIn"></div> -->
                    <a href="<?php echo base_url().'forgotPass.html'; ?>">I forgot my password</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                   <!--  <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        

       <div class="social-auth-links text-center">
            <p>- OR -</p>
            <!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a> 
            <div class=" g-signin2" data-onsuccess="onSignIn"></div>
            -->
        </div>
        <div class="row">
            <div class="col-xs-7"></div>
            <div class="col-xs-5">
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                    <div class=" g-signin2" data-onsuccess="onSignIn"></div>
            </div>
        </div>
       <!--  <div class="row"><div class="col-lg-12" style="text-align: -webkit-center;">&nbsp</div></div>
        <div class="row">
          <div class="col-lg-12" style="text-align: -webkit-center;">
            <div class="g-recaptcha" data-sitekey="<?php //echo $config['captcha_site_key']; ?>"></div>
          </div>
        </div> -->
        <div class="row"><div class="col-lg-12" style="text-align: -webkit-center;"></div></div>
        <!-- /.social-auth-links-->

        
<!--        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    </form>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<div id="ajax_loader" style="position: fixed; left: 50%; top: 50%; display: none;"></div>
<script type="text/javascript">
    jQuery(function ($){
        $(document).ajaxStop(function(){
            $("#ajax_loader").hide();
         });
         $(document).ajaxStart(function(){
             $("#ajax_loader").show();
         });    
    });

    // $(function(){
    //   $("#login_box").submit(function(event) {
    //     var recaptcha = $("#g-recaptcha-response").val();
    //      if (recaptcha === "") {
    //         event.preventDefault();
    //         notifyMessage('error', 'Please check the reCaptcha.!!');
    //      }
    //    });
    // });    
</script>