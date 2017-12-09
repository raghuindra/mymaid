<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
//echo "<pre>";print_r($company_info);echo "</pre>";
$company = $company_info['data'];
$vendorId = $this->session->userdata('user_id');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Company Details
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb ">
            <li><a href="<?php echo base_url().'vendor_home.html';?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Company Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active "><a href="#company_tab_content" data-toggle="tab">Company Details</a></li>
                        
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Company Detail TAB Start -->
                        <div role="tabpanel" class="tab-pane active" id="company_tab_content">
                            <form id="comp_information_form" method="post" action="">
                                <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Company Information</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: block;">
                                        <div class="box box-primary">
                                            <div class="box-header with-border hidden">
                                                <h3 class="box-title">Basic Information</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <div class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Company Name: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="cmname" name="cmname" placeholder="Company Name" value="<?php echo ($company) ? $company[0]->company_name : ''; ?>" required <?php echo ($company && $company[0]->company_name != '') ? 'disabled' : ''; ?>> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Company Registration:  <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="cmnumber" name="cmnumber" placeholder="Company Registration" value="<?php echo ($company) ? $company[0]->company_reg_number : ''; ?>" required <?php echo ($company && $company[0]->company_reg_number != '') ? 'disabled' : ''; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Contact Person Name: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="cpname" name="cpname" placeholder="Contact Person Name" value="<?php echo ($company) ? $company[0]->company_contact_person_name : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Passport/IC Number: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="icnumber" name="icnumber" onkeypress="return isAlphaNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "12" placeholder="Passport/IC Number" value="<?php echo ($company) ? $company[0]->company_ic_number : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" required class="col-sm-3 control-label">Office Phone:</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">+60</span>
                                                                <input type="text" class="form-control isPhoneNumeric" id="ofcnumber" name="ofcnumber" placeholder="Office Phone" oninput="maxLengthCheck(this)" pattern=".{8,10}" required title="8 to 10 numbers" maxlength = "10" value="<?php echo ($company) ? $company[0]->company_landphone : ''; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">H/P Phone: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">+60</span>
                                                                <input type="text" required class="form-control isPhoneNumeric" id="hpphone" name="hpphone" placeholder="H/P Phone" oninput="maxLengthCheck(this)" maxlength = "10" pattern=".{8,10}" required title="8 to 10 numbers" value="<?php echo ($company) ? $company[0]->company_hp_phone : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="col-sm-3 control-label">Address Line 1: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="addr" name="addr" placeholder="Address Line 1" value="<?php echo ($company) ? $company[0]->company_address : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="col-sm-3 control-label">Address Line 2:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="addr2" name="addr2" placeholder="Address Line 2" value="<?php echo ($company) ? $company[0]->company_address1 : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city" class="col-sm-3 control-label">City: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" name="city" id="city" placeholder="City" value="<?php echo ($company) ? $company[0]->company_city : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="postcode" class="col-sm-3 control-label">Postcode: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" required class="form-control" id="postalcode" name="postalcode" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "6" placeholder="Postcode" value="<?php echo ($company) ? $company[0]->company_pincode : ''; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="state" class="col-sm-3 control-label">State: <span class="text-red">*</span></label>
                                                        <div class="col-sm-9">
                                                            <select id="state" name="state" required class="form-control">
                                                                <option>Select state</option>
                                                                <?php
                                                                foreach ($states as $key => $value) {
                                                                    if ($company && $company[0]->company_state == $value->state_code) {
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
                                                        <label for="email" class="col-sm-3 control-label">Email ID: <span class="text-red">*</span></label>

                                                        <div class="col-sm-9">
                                                            <input type="email" name="email" required class="form-control" id="email" placeholder="Email ID" value="<?php echo ($company) ? $company[0]->company_email_id : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-4 control-label"><h3>Upload Document:</h3></label>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-3 control-label">SSM: <span class="text-red">*</span></label>

                                                        <div class="col-sm-9">
                                                            <?php if ($company && $company[0]->company_ssm_file_path != '') { ?>
                                                                <a href="<?php echo base_url() ."assets/uploads/vendor/". $vendorId."/company/". $company[0]->company_ssm_file_path; ?>" target="_blank" >View File</a>
                                                            <?php } else { ?>
                                                                <input type="file" id="ssmFileUpload" name="ssmFile">
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-3 control-label">Identity card: <span class="text-red">*</span></label>

                                                        <div class="col-sm-9">
                                                            <?php if ($company && $company[0]->company_idcard_file_path != '') { ?>
                                                                <a href="<?php echo base_url() ."assets/uploads/vendor/". $vendorId."/company/". $company[0]->company_idcard_file_path; ?>" target="_blank" >View File</a>
                                                            <?php } else { ?>
                                                                <input type="file" id="idcardupload" name="idFile">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ssmFileUpData" required class="form-control" id="ssmFileUpData" >
                                                <input type="hidden" name="idFileUpData" required class="form-control" id="idFileUpData" >
                                            </div>
                                            <!-- /.box-body -->
                                        </div>

                                    </div>
                                    <!-- /.box -->
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <!--                                <button type="button" class="btn btn-default btn-lg bg-red">Cancel</button>-->
                                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="saveCompanyDetail">Save</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                            </form>
                        </div>
                        <!-- /. Company Detail TAB Start -->

                    </div>
                    <!-- /. Tab Content -->
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- pekeUpload -->
<script type="text/javascript" src="<?php echo plugin_url('plugins/pekeUpload/pekeUpload.js'); ?>"></script>
<script>
    $(function () {
        
        /* Company ssm File Upload  */
        $("#ssmFileUpload").pekeUpload({
            'bootstrap': true,
            'url': 'upload_companyssm_doc.html',
            'limit': 1,
            'maxSize': 1024*1000,
            'onFileError': function (file, error) {

            },
            onFileSuccess: function (file, data) {
                $("#ssmFileUpData").val(data.file);
            }

        });
        /* Company ID Card Upload  */
        $("#idcardupload").pekeUpload({
            'bootstrap': true,
            'url': 'upload_companyid_doc.html',
            'limit': 1,
            'maxSize': 1024*1000,
            'onFileError': function (file, error) {

            },
            onFileSuccess: function (file, data) {
                $('#idFileUpData').val(data.file);
            }

        });

        /* Company Details Update form handling.. */
        $("#comp_information_form").submit(function (e) {
            e.preventDefault();
            var data = $("#comp_information_form").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'updateCompanyDetail.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        setTimeout(function () {
                            location.reload()
                        }, 3000);
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });
        
        
        /* Reset Form */
        $(document).on("click", ".formReset", function(){
            resetForm($(this).closest('form'));
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, select, textarea').val('');
            $form.find(':input[type=number]').val('');
            $form.find(".select2").val(null).trigger("change");
            $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        }
               
        
        
    });

    function getUploadFileInputId(id) {
        if (id == 'idcardupload') {
            $("#idFileUpData").val('');
        } else if (id == 'ssmFileUpload') {
            $("#ssmFileUpData").val('');
        }else if(id == 'employeeIdUpload'){
            $("#employeeIdUpData").val('');
        }

    }
</script>    
