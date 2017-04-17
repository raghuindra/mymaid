<div class="nobg loginPage home">
    <div class="overlay">
        <div class="topNav">
            <div class="userNav">
                <ul>
                    <?php if (!$this->session->userdata('user_id')) {
                        ?>
                        <li><a href="<?php echo base_url() . 'user_login.html'; ?>" title="" role="button" ><i class="icon-user"></i><span>Login</span></a></li>
                    <?php } else { ?>
                        <li style="text-decoration: none;color:white;"> Hello, <?php echo $this->session->userdata('user_fullname'); ?></li>
                        <li><a href="<?php echo base_url() . 'logout.html'; ?>" title="" role="button"><i class="icon-user"></i><span>Log Out</span></a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url() . 'vendor_login.html'; ?>" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
            <div class="logo-section"><a href="<?php echo base_url() . 'home.html'; ?>" title="" style="text-decoration: none;"><img src="<?php echo img_url('logo_100x45.png');?>" /></a></div>
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
                                        <form id="search-service" action="<?php echo base_url() . 'booking.html'; ?>" method="post">
                                            <h1>Book your Maid now </h1>
                                            <h4>From $10000 per hour</h4>
                                            <hr>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label></label>
                                                </div>
                                            </div>
                                            <!--                                            <div class="col-lg-3">
                                                                                            <div class="row"><select class="form-control">
                                                                                                    <option value="">Service 1</option>
                                                                                                    <option value="">Service 2</option>
                                                                                                    <option value="">Service 3</option>
                                                                                                </select></div>
                                                                                        </div>-->
                                            <div class="col-lg-4">
                                                <div class="row"><input type="text" placeholder="Enter your postal code" class="form-control" name="" id="" required></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row"><button type="submit" placeholder="Find" class="form-control btn-success">Find Services</button> </div>
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
    <div class="container container-home " id='aboutus'>
        <div class="col-lg-12">
            <h2 class="text-center">About Us</h2>
            <div class="row">              
                <p>“MyMaidz.com” is brainchild of 3 young entrepreneurs after realized the problem
                    faced by homeowners to keep home in tiptop condition.</p>

                <p >“MyMaidz.com” is not cleaning company or cleaning provider. “MyMaidz.com” is
                a bridge or Service now system between customer and cleaning provider, we use
                Information Technology as platform and enable customer to book cleaning
                service within 60 sec from any point of location</p>
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
            <span class="link_to_another_page"><a class="btn btn-success btn-lg" href="#">Become a cleaner</a></span>
        </p>
    </div>


    <!--==========================
      Contact Section
    ============================--> 
    <section id="contact">
        <div class="container" style="margin-bottom: 80px;">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center" style="font-size: 36px; margin-bottom: 20px;">Contact Us</h2>
                    <div class="section-title-divider"></div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <div>           
                            <p style="font-size: 14px"><b>CUSTOMER CARE LINE</b></p>
                        </div>

                        <div>

                            <p style="font-size: 14px">Email: mymaidz16@gmail.com</p>
                        </div>

                        <div>
            <!--              <i class="fa fa-phone"></i>-->
                            <p style="font-size: 14px">Tel: 0125918491</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <div>           
                            <p style="font-size: 14px"><b>Our Location</b></p>
                        </div>

                        <div>

                            <p style="font-size: 14px">
                                ADVANCE DREAMS VENTURE SDN. BHD

                                160, Jln. Kilang Lama,

                                Pusat Perniagaan Putra,

                                09000 Kulim, Kedah.
                            </p>
                        </div>

                    </div>
                </div>  
                <div class="col-md-2">
                    <div class="">
                        <div>           
                            <p style="font-size: 14px"><b>Office Operation Hours</b></p>
                        </div>

                        <div>

                            <p style="font-size: 14px">
                                9 am to 5 pm (Daily)

                                We're Closed on Public Holidays
                            </p>
                        </div>

                    </div>
                </div>    

                <div class="col-md-5">
                    <div class="form">
                        <!--            <div id="sendmessage">Your message has been sent. Thank you!</div>-->
                        <div id="errormessage"></div>
                        <form action="" method="post" role="form" class="contactForm">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                <div class="validation"></div>
                            </div>

                            <p class="actions">
                                <span class="link_to_another_page"><a class="btn btn-success btn-lg" href="#">Send Message</a></span>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- END BODY -->

    <!-- BEGIN # MODAL LOGIN -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Begin # Login Form -->
                <form class="form-signin" id="login_box" method="post" action="user_login.html">

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
                            <div class="button facebook btn btn-danger"><a class="" href="<?php echo base_url() . 'user_register.html'; ?>">Register</a> </div>
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
