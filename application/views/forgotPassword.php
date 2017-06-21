    
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url().'home.html'; ?>"><img class="profile-user-img img-responsive" src="<?php echo img_url('YellowMM_240.png');?>" style="width:85%;" alt="MyMaidz"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Request Password Reset Link</p>

        <form action="<?php base_url().'forgotPass.html'; ?>" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="id">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="button" onclick="location.href='<?php echo base_url().'vendor_login.html';?>'" class="btn btn-info btn-block btn-flat">Back</button>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Request</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->