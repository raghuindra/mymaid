<div class="nobg loginPage">
    <div class="overlay">
        <div class="topNav">
            <div class="userNav">
                <ul>
                    <li><a href="<?php echo base_url().'user_login.html';?>" title=""><i class="icon-user"></i><span>User Login</span></a></li>
                    <li><a href="<?php echo base_url().'vendor_login.html';?>" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
            <div class="logo-section"><a href="<?php echo base_url().'home.html';?>" title="" style="text-decoration: none;color:white;"><img class="profile-user-img img-responsive" src="<?php echo img_url('YellowMM_240.png');?>" style="width:85%;" alt="MyMaidz"></a></div>
        </div>
        <!-- PAGE CONTENT -->
        <div class="container animated fadeInDown">
            <div class="tab-content ">
                <div id="login" class="tab-pane active">
                    <form class="form-signin" id="login_box" method="post" action="<?php echo base_url().'vendor_register.html'; ?>">
                        <p class="head_login_005">Sign Up New Vendor/Freelancer</p>
                        <div class="row">
                            <div class="col-lg-12" id="error_message" style="color:red">
                               <?php echo validation_errors(); ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="email" placeholder="Email id" class="form-control" name="email" id="" required value="<?php echo set_value('email'); ?>">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6"><input type="password" placeholder="Password" class="form-control" name="password" required> </div>
                            <div class="col-lg-6"><input type="password" placeholder="Confirm Password" class="form-control" name="repassword" required ></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="First Name" class="form-control" name="firstname" oninput="maxLengthCheck(this)" maxlength = "25" required value="<?php echo set_value('firstname'); ?>"> </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Last Name" class="form-control" name="lastname" oninput="maxLengthCheck(this)" maxlength = "25" required value="<?php echo set_value('lastname'); ?>"> </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="Address" class="form-control" name="address" required value="<?php echo set_value('address'); ?>"> </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Address Line 1" class="form-control" name="address1" required value="<?php echo set_value('address1'); ?>"> </div>                                   

                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Enter city" class="form-control" name="city" required value="<?php echo set_value('city'); ?>">
                            </div>

                            <div class="col-lg-12">
                                <select type="text" placeholder="Select state" name="state" id="state" class="form-control" required value="<?php echo set_value('state[]'); ?>">
                                    <option value=""> Select State </option>
                                    <?php
                                    foreach ($state as $key => $value) {
                                        echo '<option value="' . $value->state_code . '" >' . $value->state_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <input type="text" placeholder="Postal Code" class="form-control" name="pincode" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "5" required value="<?php echo set_value('pincode'); ?>"> </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon">+60</span>
                                <input type="text" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" placeholder="Mobile number" class="form-control" name="mobile" id="" pattern=".{8,10}" required title="8 to 10 numbers" required value="<?php echo set_value('mobile'); ?>"> </div></div>
                            <!-- <div class="col-lg-6">
                                <select  placeholder="Select country" name="country" id="country" class="form-control" required> 
                                </select>     -->

                            <div class="clearfix"></div>
                            <div class="col-lg-6">
                                <select placeholder="Select Id Card" class="form-control" name="idcard" required value="<?php echo set_value('idcard'); ?>"> 
                                    <option value="">Select Id Card</option>
                                    <option value="Identity Number" >Identity Number</option>
                                    <option value="Passport">Passport</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Id Card Number" onkeypress="return isAlphaNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "12" class="form-control" name="idcardnumber" required value="<?php echo set_value('idcardnumber'); ?>"> 
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 custom-radiobox">
                                <div class="col-lg-4">
                                    <input type="radio" id="radio01" name="type" class="vendor_type" checked value='1' required />
                                    <label for="radio01"><span></span>Vendor</label>
                                </div>

                                <div class="col-lg-5">
                                    <input type="radio" id="radio02" name="type" class="vendor_type" value='2' required />
                                    <label for="radio02"><span></span>Freelancer </label>
                                </div>

                            </div>
                        </div>
                        <div class="row" id="company-details">
                            <div class="col-lg-12">
                                <input type="text" placeholder="Company Name" class="form-control" name="compName" id="compName" required value="<?php echo set_value('compName'); ?>"> </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Company Registration Id" class="form-control" name="compRegister" id="compRegister" required  value="<?php echo set_value('compRegister'); ?>"> </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Company Address" class="form-control" name="compAddress" id="compAddress" required value="<?php echo set_value('compAddress'); ?>"> </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Company Pin Code" class="form-control" name="compPin" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "5" id="compPin" required value="<?php echo set_value('compPin'); ?>"> </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon">+60</span>
                                <input type="text" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" placeholder="Mobile" class="form-control" name="compMobile" id="compMobile" pattern=".{8,10}" required title="8 to 10 numbers" required value="<?php echo set_value('compMobile'); ?>"></div></div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon">+60</span>
                                <input type="text" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" placeholder="Land phone" class="form-control" name="compLandPhone" id="compLandPhone" pattern=".{8,10}" required title="8 to 10 numbers" required value="<?php echo set_value('compLandPhone'); ?>"> </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon">+60</span>
                                <input type="text" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" placeholder="FAX" class="form-control" name="compFax" id="compFax" pattern=".{8,10}" required title="8 to 10 numbers" required value="<?php echo set_value('compFax'); ?>"> </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Number of Employees Range</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input type="number" placeholder="min" class="form-control" name="compEmpMin" id="compEmpMin" required value="<?php echo set_value('compEmpMin'); ?>">
                                    </div>
                                    <div class="col-lg-1 text-center line-height-input">to</div>
                                    <div class="col-lg-4">
                                        <input type="number" placeholder="max" class="form-control" name="compEmpMax" id="compEmpMax" required value="<?php echo set_value('compEmpMax'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <button class="form-control btn btn-primary" value="Login" type="submit"><strong>Sign Up</strong></button>
                            </div>
                            <div class="col-lg-6">
                                <p><a href="<?php echo base_url().'vendor_login.html'; ?>"><strong>Already Have Account?</strong></a></p>
                            </div>
                        </div>
<!--                         <div class="text-center"><strong>Or</strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="button google"><i class="fa fa-google-plus"></i>Signup with Google</div>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>

        <!-- END BODY -->
    </div>
</div>

<script>
    $(function () {
        $('.vendor_type').click(function(){
            if($('.vendor_type').val() === 1){
                setRequired();
            }else{
                unSetRequired();
            }
        });
        

    });
    

    function setRequired() {
        $('#compName').attr('required', true);
        $('#compRegister').attr('required', true);
        $('#compAddress').attr('required', true);
        $('#compPin').attr('required', true);
        $('#compMobile').attr('required', true);
        $('#compLandPhone').attr('required', true);
        $('#compFax').attr('required', true);
        $('#compEmpMin').attr('required', true);
        $('#compEmpMax').attr('required', true);
    }

    function unSetRequired() {
        $('#compName').attr('required', false);
        $('#compRegister').attr('required', false);
        $('#compAddress').attr('required', false);
        $('#compPin').attr('required', false);
        $('#compMobile').attr('required', false);
        $('#compLandPhone').attr('required', false);
        $('#compFax').attr('required', false);
        $('#compEmpMin').attr('required', false);
        $('#compEmpMax').attr('required', false);
    }

</script>


