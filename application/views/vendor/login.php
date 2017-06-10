<div class="nobg loginPage">
            <div class="overlay">
                <div class="topNav">
                    <div class="userNav">
                        <ul>
                            <li><a href="./user_login.html" title=""><i class="icon-user"></i><span>User Login</span></a></li>
                            <li><a href="./vendor_login.html" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                        </ul>
                    </div>
                                <div class="logo-section"><a href="./home.html" title="" style="text-decoration: none;color:white;">MyMaid</a></div>
                </div>
                <!-- PAGE CONTENT -->
                <div class="container animated fadeInDown">
                    <div class="tab-content ">
                        <div id="login" class="tab-pane active">
                            <form class="form-signin" id="login_box" action="vendor_login.html" method="post">
                                <p class="head_login_005">Vendor/Freelancer Login</p>
                                <input type="email" placeholder="Email id" class="form-control" name="email" id="email" required>
                                <input type="password" placeholder="Password" class="form-control" name="password" id="password" required>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <button class="form-control btn btn-primary" value="Login" type="submit"><strong>Login</strong></button>
                                    </div>
                                    <div class="col-lg-6" id="sednmail-group">
                                        <p><a href="<?php echo base_url().'forgotPass.html' ?>"><strong>Forgot Password?</strong></a></p>
                                        <div>
                                            <div class="input-group">
                                                <input type="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon2">
                                                <span class="input-group-addon" id="sizing-addon2">Send</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center"><strong>Dont have Account?</strong></div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="button facebook btn btn-danger"><a class="" href="./vendor_register.html">Register</a> </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="button google"><i class="fa fa-google-plus"></i>Signup with Google</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- END BODY -->
            </div>
        </div>