<link href="<?php echo css_url('pricing');?>" rel="stylesheet">

<div class="nobg loginPage home">
    <div class="">
        <div class="topNav">
            <div class="userNav">
                <ul>
                    <?php if(!$this->session->userdata('user_id'))
                    {?>
                    <li><a href="<?php echo base_url().'user_login.html';?>" title="" role="button" ><i class="icon-user"></i><span>Login</span></a></li>
                    <?php }else{  ?>
                        <li style="text-decoration: none;color:white;"> Hello, <?php echo $this->session->userdata('user_fullname');?></li>
                        <li><a href="<?php echo base_url() . $myAccountUrl; ?>" title="" role="button"><i class="icon-user"></i><span>My Account</span></a></li>
                        <li><a href="<?php echo base_url().'logout.html';?>" title="" role="button"><i class="icon-user"></i><span>Log Out</span></a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url().'vendor_login.html';?>" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
            <div class="logo-section"><a href="<?php echo base_url().'home.html';?>" title="" style="text-decoration: none;"><img src="<?php echo img_url('YellowMM_240.png');?>" /></a></div>
        </div>
        <!-- PAGE CONTENT -->

    </div>
    <div class="wrapper">
         <!-- PRICING-TABLE CONTAINER -->
        <div class="pricing-table group">
            <h1 class="">
                Pricing overview
            </h1>
            <!-- PERSONAL -->
            <div class="block personal fl">
                <h4 class="title">Basis Home Cleaning</h4>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                        <sup>RM</sup>
                        <span>14</span>
                        <sub>/Hour.</sub>
                    </p>
<!--                    <p class="hint">Perfect for freelancers</p>-->
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <ul class="features" style="height: 300px;">
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Min 4 Hour session</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Price may vary per area, check price based on postcode.</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Equipment and material provide by owner</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Work will arrive plus minus within 1 hour. Clock start from the hour cleaner arrive</li>
                </ul>
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p style='font-size: 16px;'><a href='<?php echo base_url().'home.html';?>' style='text-decoration: none;color:white;'>Book Service</a></p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PERSONAL -->
            <!-- PROFESSIONAL -->
            <div class="block professional fl">
                <h4 class="title">Move In/Move Out Cleaning</h4>
                <!-- CONTENT -->
                <div class="content" style="height: 96px;">
                    <!-- <p class="price"> 
                        <sup>RM</sup>
                        <span>250</span>
                        <sub>/House Size.</sub>     
                     </p> -->
                    <div style="margin-top: 20px;">Coming Soon</div>
<!--                     <p class="hint">Suitable for startups</p> -->
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <ul class="features" style="height: 300px;">
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Required 8 hours</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Crew based on house size.</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Price may vary per area, check price based on postcode</li>                    
                </ul>
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p style='font-size: 16px;'><a href='javascript:void(0)' style='text-decoration: none;color:white;'>Book Service</a></p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PROFESSIONAL -->
            <!-- BUSINESS -->
            <div class="block business fl">
                <h4 class="title">Deep Cleaning</h4>
                <!-- CONTENT -->
                <div class="content" style="height: 96px;">
                    <!-- <p class="price">
                        <sup>RM</sup>
                        <span>350</span>
                        <sub>/House Size.</sub>
                    </p> -->
                    <div style="margin-top: 20px;">Coming Soon</div>
<!--                    <p class="hint">For established business</p>-->
                </div>
                <!-- /CONTENT -->

                <!-- FEATURES -->
                <ul class="features" style="height: 300px;">
                   <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Required 8 hours</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Crew based on house size.</li>
                    <li style='font-size: 14px;'><span class="fontawesome-cog"></span>Price may vary per area, check price based on postcode</li>                  
                </ul>
                <!-- /FEATURES -->

                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <p style='font-size: 16px;'><a href='javascript:void(0)' style='text-decoration: none;color:white;'>Book Service</a></p>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /BUSINESS -->
            <p style='text-align: left;'>** Material & equipment provided by User for Basic Home Cleaning.</p>
        </div>
        <!-- /PRICING-TABLE -->
        
    </div>
    
    <div class="container container-home" id='refundPolicy'>
        <div class="col-lg-12">
            <h2 class="text-center">REFUND POLICY</h2>
            <div class="row" style='margin-bottom: 80px;'>
                <p style='text-align: -webkit-auto;margin-bottom: 0px'>
                    <ul style="list-style-type:disc;">
                        <li style='font-size: 15px;'>You can cancel or amend a single Event on the Website, free of charge, up to forty-eight (48) hours before the Scheduled Booking Time.<br/><br/></li>
                        <li style='font-size: 15px;'>If you cancel or amend a single Event within forty-eight (48) to twenty-four (24) hours before the Scheduled Booking Time, you will have to pay a cancellation penalty equivalent to one hour’s worth of the Booked Service Fee.<br/><br/></li>
                        <li style='font-size: 15px;'>If you cancel or amend a single Event within twenty-four (24) hours before the Scheduled Booking Time to any time thereafter, you will have to pay a cancellation penalty equivalent to the full amount of the Booked Service Fee.<br/><br/></li>
                        <li style='font-size: 15px;'>If the Cleaning Service Provider is unable to fulfil a confirmed Booking Request, we will attempt to find you a replacement Cleaning Service Provider. If we cannot find you an alternative Cleaning Service Provider, we will reschedule your Booking Request to a new time which suits you. If we cannot find a suitable time for you, you may cancel the Booking Request at no charge.<br/><br/></li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
 
</div>

       