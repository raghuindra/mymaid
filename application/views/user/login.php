
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

<div class="nobg loginPage">
    <div class="overlay">
        <div class="topNav">
            <div class="userNav">
                <ul>
<!--                    <li><a href="./user_login.html" title=""><i class="icon-user"></i><span>User Login</span></a></li>-->
                    <li><a href="<?php echo base_url().'vendor_login.html'; ?>" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
            <div class="logo-section"><a href="<?php echo base_url().'home.html';?>" title="" style="text-decoration: none;color:white;"><img class="profile-user-img img-responsive" src="<?php echo img_url('YellowMM_240.png');?>" style="width:85%;" alt="MyMaidz"></a></div>
        </div>
        <!-- PAGE CONTENT -->
        <div class="container animated fadeInDown">
            <div class="tab-content ">
                <div id="login" class="tab-pane active">
                    <form class="form-signin" id="login_box" action="./user_login.html" method="post">
                        <p class="head_login_005">Login Detail</p>
                        <input type="email" placeholder="Email id" class="form-control" name="email" required>
                        <input type="password" placeholder="Password" class="form-control" name="password" required>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <button class="form-control btn btn-primary" value="Login" type="submit"><strong>Login</strong></button>
                            </div>
                            <div class="col-lg-3"><b></b></div>
                            <div class="col-lg-5">                            
                                <div class=" g-signin2" data-onsuccess="onSignIn"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="sednmail-group">
                                    <p><a href="<?php echo base_url().'forgotPass.html' ?>"><strong>Forgot Password?</strong></a></p>
                            </div>
                        </div>                       
                        <div class="row">
                            <div class="col-lg-6">
                                        <div class=""><strong>Dont have Account?</strong></div>
                                    </div>
                            <div class="col-lg-6">
                                <div class="button facebook btn btn-danger" style="height: 40px;width: 120px;margin-top: 0px; float:right;"><a class="" href="<?php echo base_url().'user_register.html'; ?>">Register</a> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- END BODY -->
    </div>
</div>

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
</script>

