    
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url().'home.html'; ?>"><b>MyMaid</b>z</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset your password</p>

        <form action="<?php base_url().'reset_password.html'.'/'.$token;; ?>" method="post">
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
             <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="button" onclick="location.href='<?php echo base_url().'vendor_login.html';?>'" class="btn btn-info btn-block btn-flat">Cancel</button>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->