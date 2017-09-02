<?php
$this->load->view("block/user_topNavigation");
$this->load->view("block/user_leftMenu");


$profile_info   = $profile['data']; 
//$bank_info      = $bank['data'];

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'user_home.html' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<!--            <li><a href="#">Examples</a></li>-->
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo plugin_url('dist/img/avatar5.png');?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?php echo $profile_info[0]->person_first_name." ".$profile_info[0]->person_last_name; ?></h3>

                        <p class="text-muted text-center"><?php echo ucwords($this->session->userdata('user_type')); ?></p>

                        <ul class="list-group list-group-unbordered hidden">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block hidden"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary hidden">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#personalInfoTab" data-toggle="tab">Personal Info</a></li>
                        <!-- <li><a href="#bankDetailsTab" data-toggle="tab">Bank Details</a></li>
                        <li><a href="#resetPassTab" data-toggle="tab">Reset Password</a></li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="personalInfoTab">              
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputFirstName" placeholder="First Name" value="<?php echo $profile_info[0]->person_first_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputLastName" placeholder="Last Name" value="<?php echo $profile_info[0]->person_last_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-8">
                                        <input type="email" disabled class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $profile_info[0]->person_email; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Address</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputAddress" placeholder="Address" value="<?php echo $profile_info[0]->person_address; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Address 2</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputAddress2" placeholder="Address" value="<?php echo $profile_info[0]->person_address1; ?>">
                                    </div>
                                </div>                               
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">City</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputCity" placeholder="City" value="<?php echo $profile_info[0]->person_city; ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">State</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputSate" placeholder="State" value="<?php //echo $profile_info[0]->person_state; ?>">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="state" class="col-sm-2 control-label">State:</label>
                                    <div class="col-sm-8">
                                        <select id="state" disabled name="state" required class="form-control">
                                            <option>Select state</option>
                                            <?php
                                            foreach ($states as $key => $value) {
                                                if( $profile_info && ($profile_info[0]->person_state == $value->state_code) ){
                                                    echo '<option value="' . $value->state_code . '" selected>' . $value->state_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $value->state_code . '">' . $value->state_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">Mobile</label>

                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">+60</span>
                                            <input type="text" disabled class="form-control" id="inputMobile" placeholder="Mobile" value="<?php echo $profile_info[0]->person_mobile; ?>">
                                        </div>
                                    </div>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">Telephone</label>

                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">+60</span>
                                            <input type="text" disabled class="form-control" id="inputTelephone" placeholder="Telephone" value="<?php //echo $profile_info[0]->person_telephone; ?>">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">Identity Card</label>

                                    <div class="col-sm-8">
                                        <input type="text" disabled class="form-control" id="inputIdCard" placeholder="Identity Card" value="<?php echo $profile_info[0]->person_identity_card." - ".$profile_info[0]->person_identity_card_number; ?>">
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>-->
<!--                                <div class="form-group">
                                    <div class="col-sm-offset-8 col-sm-4">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>-->
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        
<!--                         <div class="tab-pane" id="bankDetailsTab">
                            <form class="form-horizontal" method="POST" id="bankDetailsForm">
                            <div class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Bank Name: <span class="text-red">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="bnkname" class="form-control" required id="bnkname" placeholder="Bank Name" value="<?php //echo ($bank_info) ? $bank_info[0]->bank_name : '';?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Beneficiary/Account Holder Name: <span class="text-red">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="holdername" class="form-control" required id="holdername" placeholder="Beneficiary/Account Holder Name" value="<?php //echo ($bank_info) ? $bank_info[0]->bank_holder_name : '';?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Bank Account Number: <span class="text-red">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="accnumber" class="form-control" required id="accnumber" placeholder="Bank Account Number" value="<?php //echo ($bank_info) ? $bank_info[0]->bank_account_number : '';?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">IFSC Code/Swift Code: <span class="text-red">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ifsc" required id="ifsc" placeholder="IFSC Code/Swift Code" value="<?php //echo ($bank_info) ? $bank_info[0]->bank_ifsc_code : '';?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Bank Address: <span class="text-red">*</span></label>
                                            <div class="col-sm-8">
                                                <textarea type="text" class="form-control" name="bnkaddress" id="bnkaddress" required placeholder="Bank Address"><?php //echo ($bank_info) ? $bank_info[0]->bank_address : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-9 col-sm-3">
                                                <button type="submit" class="btn bg-info bg-green" id="submitBankDetail">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div> -->
                        <!-- /.tab-pane -->

                        <!-- <div class="tab-pane" id="resetPassTab">
                            <form class="form-horizontal">
                                
                            </form>
                        </div> -->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Bank Details Form Scripts START-->
<script>
$(function(){
    
    /* Service Package creation form handling.. */
        // $("#bankDetailsForm").submit(function (e) {
        //     e.preventDefault();
        //     var data = $("#bankDetailsForm").serializeArray();

        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo base_url() . 'updateBankDetails.html' ?>",
        //         data: data,
        //         cache: false,
        //         success: function (res) {

        //             var result = JSON.parse(res);

        //             if (result.status === true) {
        //                 notifyMessage('success', result.message);
                        
        //             } else {
        //                 notifyMessage('error', result.message);
        //             }
        //         }
        //     });
        // });
});
</script>
<!-- Bank Details Form Scripts END -->