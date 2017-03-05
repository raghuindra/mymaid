    
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url().'home.html'; ?>"><b>MyMaid</b>z</a>
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
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Request</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->