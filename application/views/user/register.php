<?php 

?>
<div class="nobg loginPage">
    <div class="overlay">
        <div class="topNav">
            <div class="userNav">
                <ul>
                    <li><a href="./user_login.html" title=""><i class="icon-user"></i><span>User Login</span></a></li>
                    <li><a href="./vendor_login.html" title=""><i class="icon-comments"></i><span>Vendor Login</span></a></li>
                </ul>
            </div>
            <div class="logo-section">Logo</div>
        </div>
        <!-- PAGE CONTENT -->
        <div class="container animated fadeInDown">
            <div class="tab-content ">
                <div id="login" class="tab-pane active">
                    <form class="form-signin" id="login_box">
                        <p class="head_login_005">Sign Up</p>
                        <input type="email" placeholder="Email id" class="form-control" name="email" required>
                        <div class="row">
                            <div class="col-lg-6"><input type="password" placeholder="Password" class="form-control" name="password" required></div>
                            <div class="col-lg-6"><input type="password" placeholder="Confirm Password" class="form-control" name="repassword" required></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="First Name" class="form-control" name="firstName" required> </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Last Name" class="form-control" name="lastName" required> </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="Address" class="form-control" name="address" required> </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Address Line 1" class="form-control" name="address1" required> </div>                                   
                            
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Enter city" class="form-control" name="city" required>
                            </div>
                            
                            <div class="col-lg-12">
                                <select type="text" placeholder="Select state" name="state" id="state" class="form-control" required>
                                    <option value=""> Select State </option>
                                    <?php
                                        foreach ($state as $key => $value) {                                          
                                            echo '<option value="'.$value->state_code.'">'.$value->state_name.'</option>';											
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-lg-6">
                                <input type="number" placeholder="Postal Code" class="form-control" name="pincode" required> </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Mobile number" class="form-control" name="mobile" id="" required> </div>
                            <!-- <div class="col-lg-6">
                                <select  placeholder="Select country" name="country" id="country" class="form-control" required> 
                                </select>     -->

                            <div class="clearfix"></div>
                            <div class="col-lg-6">
                                <select placeholder="Select Id Card" class="form-control" name="idcard" required> 
                                    <option value="">Select Id Card</option>
                                    <option value="Govt Id Card">Govt Id Card</option>
                                    <option value="passport">Passport</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Id Card Number" class="form-control" name="idcardnumber" required> </div>
                           
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <button class="form-control btn btn-primary" value="Login" type="submit"><strong>Sign Up</strong></button>
                            </div>
                            <div class="col-lg-6">
                                <p><a href="./user_login.html"><strong>Already Have Account?</strong></a></p>
                            </div>
                        </div>
                        <div class="text-center"><strong>Or</strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="button google"><i class="fa fa-google-plus"></i>Signup with Google</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- END BODY -->
</div>
</div>