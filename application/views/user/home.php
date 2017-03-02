<div class="nobg loginPage home">
    <div class="overlay">
        <div class="topNav">
            <div class="userNav">
                <ul>
                    <?php if(!$this->session->userdata('user_id'))
                    {?>
                        <li><a href="#" title="" role="button" data-toggle="modal" data-target="#login-modal"><i class="icon-user"></i><span>Login</span></a></li>
                    <?php }else{  ?>
                        <li style="text-decoration: none;color:white;"> Hello, <?php echo $this->session->userdata('user_fullname');?></li>
                        <li><a href="logout.html" title="" role="button"><i class="icon-user"></i><span>Log Out</span></a></li>
                    <?php } ?>
                    <li><a href="./vendor_login.html" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
                        <div class="logo-section"><a href="./home.html" title="" style="text-decoration: none;color:white;">MyMaid</a></div>
        </div>
        <!-- PAGE CONTENT -->
        <div class="container-fluid animated fadeInDown">
            <div class="tab-content ">
                <div class="row">
                    <div id="login" class="tab-pane active">
                        <div class="search-container">
                            <div class="table-outer">
                                <div class="table-inner">
                                    <div class="div-inline">
                                        <form id="search-service">
                                            <h1>Book your Maid now </h1>
                                            <h4>From $10000 per hour</h4>
                                            <hr>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label>Service</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row"><select class="form-control">
                                                        <option value="">Service 1</option>
                                                        <option value="">Service 2</option>
                                                        <option value="">Service 3</option>
                                                    </select></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row"><input type="text" placeholder="Enter your postal code" class="form-control" name="" id="" required></div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row"><button type="submit" placeholder="Find" class="form-control btn-success">Find </button> </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container container-home">
        <div class="col-lg-12">
            <h2 class="text-center">Why Helpling?</h2>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Convenient Online Booking</p>
            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Insured Cleaners</p>
            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Secure Online Payment</p>

            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Excellent Customer Service</p>

            </div>
        </div>
    </div>
    <!--Reviews  -->
    <div class="review-container">
        <div class="container">
            <h2>What our customers say</h2>
            <div class="owl-carousel owl-theme">
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 owlfix">
                    <div class="reviews">
                        <div class="outer-table">
                            <div class="inner-table">
                                <div class="content">was extremely easy to use and I usually book a cleaning when I'm commuting, using the app. And, my cleaner is fantastic! She always makes sure my house is left sparking clean! I am sold and will definitely book
                                    Helpling again!
                                </div>
                                <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-home">
        <div class="col-lg-12">
            <h2 class="text-center">About the cleaners</h2>
            <div class="col-lg-4">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Vetted cleaners</p>
            </div>
            <div class="col-lg-4">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Individual multi-level selection process</p>
            </div>
            <div class="col-lg-4">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Excellent customer reviews</p>

            </div>
        </div>
        <p class="actions text-center">
            <span class="link_to_another_page"><a class="btn btn-success btn-lg" href="/apply">Get to know your cleaners!</a></span>
        </p>
    </div>
    <div class="quick-book">
        <div class="container">
            <div class="search-container">
                <div class="table-outer">
                    <div class="table-inner">
                        <form id="search-service-1">

                            <div class="div-inline">
                                <h1>Get your cleaner in 60 seconds </h1>
                                <hr>

                                <div class="col-lg-10">
                                    <div class="row"><input type="text" placeholder="Enter your postal code" class="form-control" name="" id="" required></div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="row"><button type="submit" placeholder="Find" class="form-control btn-success">Find </button> </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container container-home">
        <div class="col-lg-12">
            <h2 class="text-center">Register to become a cleaner now!</h2>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>100% flexible</p>
            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Access to new customers</p>
            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Attractive prices</p>

            </div>
            <div class="col-lg-3">
                <div class="circle">
                    <div class="content">
                        <img src="<?php echo img_url("cleaner.png"); ?>" alt="text" />
                    </div>
                </div>
                <p>Professional support</p>

            </div>
        </div>
        <p class="actions">
            <span class="link_to_another_page"><a class="btn btn-success btn-lg" href="/apply">Become a cleaner</a></span>
        </p>
    </div>


    <!-- END BODY -->

    <!-- BEGIN # MODAL LOGIN -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Begin # Login Form -->
                <form class="form-signin" id="login_box">

                    <p class="head_login_005">Login Detail <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="" aria-hidden="true">X</span>
                        </button></p>
                    <div><input type="email" placeholder="Email id" class="form-control" name="email" required></div>
                    <div><input type="password" placeholder="Password" class="form-control" name="password" required></div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <button class="form-control btn btn-primary" value="Login" type="submit"><strong>Login</strong></button>
                        </div>
                        <div class="col-lg-8" id="sednmail-group">
                            <p><a href="#" class="forgot-pass"><strong>Forgot Password?</strong></a></p>
                            <div>
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon2" required>
                                    <span class="input-group-addon" id="sizing-addon2">Send</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><strong>Dont have Account?</strong></div>
                    <div class="row">
                        <div class="col-lg-5 col-xs-4">
                            <div class="button facebook btn btn-danger"><a class="" href="./user_register.html">Register</a> </div>
                        </div>
                        <div class="col-lg-7 col-xs-8">
                            <div class="button google"><i class="fa fa-google-plus"></i>Signup with Google</div>
                        </div>
                    </div>
                </form>
                <!-- End # Login Form -->
            </div>
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->


<script>
    $(function () {
<?php if ($this->session->flashdata('error_message') != null) { ?>
            notyfy({
                text: "<?php echo $this->session->flashdata('error_message'); ?>",
                type: "error",
                dismissQueue: true,
                layout: 'top'
            });

<?php } else if ($this->session->flashdata('success_message') != null) { ?>

            notyfy({
                text: "<?php echo $this->session->flashdata('success_message'); ?>",
                type: "success",
                dismissQueue: true,
                layout: 'top'
            });

<?php } ?>

    });

</script>        