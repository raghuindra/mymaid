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
            <li><a href="./vendor_home.html"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <li role="presentation"><a href="#employee_tab_content" data-toggle="tab">Employees</a></li>
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
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Company Name*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="cmname" name="cmname" placeholder="Company Name" value="<?php echo ($company) ? $company[0]->company_name : ''; ?>" required <?php echo ($company && $company[0]->company_name != '') ? 'disabled' : ''; ?>> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Company Registration #:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="cmnumber" name="cmnumber" placeholder="Company Registration" value="<?php echo ($company) ? $company[0]->company_reg_number : ''; ?>" required <?php echo ($company && $company[0]->company_reg_number != '') ? 'disabled' : ''; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Contact Person Name*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="cpname" name="cpname" placeholder="Contact Person Name" value="<?php echo ($company) ? $company[0]->company_contact_person_name : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">IC Number*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="icnumber" name="icnumber" placeholder="IC Number" value="<?php echo ($company) ? $company[0]->company_ic_number : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" required class="col-sm-3 control-label">Office Phone:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="ofcnumber" name="ofcnumber" placeholder="Office Phone" value="<?php echo ($company) ? $company[0]->company_landphone : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">H/P Phone*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" id="hpphone" name="hpphone" placeholder="H/P Phone" value="<?php echo ($company) ? $company[0]->company_hp_phone : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="col-sm-3 control-label">Address Line 1*:</label>
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
                                                        <label for="city" class="col-sm-3 control-label">City*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" required class="form-control" name="city" id="city" placeholder="City" value="<?php echo ($company) ? $company[0]->company_city : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="postcode" class="col-sm-3 control-label">Postcode*:</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" required class="form-control" id="postalcode" name="postalcode" placeholder="Postcode" value="<?php echo ($company) ? $company[0]->company_pincode : ''; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="state" class="col-sm-3 control-label">State*:</label>
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
                                                        <label for="email" class="col-sm-3 control-label">Email ID*:</label>

                                                        <div class="col-sm-9">
                                                            <input type="email" name="email" required class="form-control" id="email" placeholder="Email ID" value="<?php echo ($company) ? $company[0]->company_email_id : ''; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-4 control-label"><h3>Upload Document:</h3></label>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-3 control-label">SSM*:</label>

                                                        <div class="col-sm-9">
                                                            <?php if ($company && $company[0]->company_ssm_file_path != '') { ?>
                                                                <a href="<?php echo base_url() . $company[0]->company_ssm_file_path; ?>" target="_blank" >View File</a>
                                                            <?php } else { ?>
                                                                <input type="file" id="ssmFileUpload" name="ssmFile">
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-3 control-label">Identity card*:</label>

                                                        <div class="col-sm-9">
                                                            <?php if ($company && $company[0]->company_idcard_file_path != '') { ?>
                                                                <a href="<?php echo base_url() . $company[0]->company_idcard_file_path; ?>" target="_blank" >View File</a>
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

                        <!-- Employee Detail TAB Start -->
                        <div role="tabpanel" class="tab-pane active" id="employee_tab_content">
                            <div class="box box-default box-solid">
                                <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <h3 class="box-title ">Create Employee</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" >
                                    <div class="box box-primary">

                                        <div class="form-horizontal">
                                            <div class="box-body">
                                                <!-- Service Package Creation Form Start -->
                                                <form action="" name="employeeCreationForm" id="employeeCreationForm">                                                   

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee Name *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="employee_name" class="form-control" required id="employee_name" placeholder="Employee Name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee Passport Number *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="employee_passport" class="form-control" required id="employee_passport" placeholder="Passport Number" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee Citizenship *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="employee_citizenship" class="form-control" required id="employee_citizenship" placeholder="Employee Citizenship (Ex: Malaysian)">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee House Phone :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="employee_housephone" class="form-control" id="employee_housephone" placeholder="Employee House Phone">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee H/P Phone *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="employee_hp_phone" class="form-control" required id="employee_hp_phone" placeholder="Employee H/P Phone">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Employee Job Type *:</label>
                                                        <div class="col-sm-6">
                                                            <div class="btn-group" role="group" aria-label="Employee Job Type">
                                                                <button type="button" class="btn margin btn-primary btn-sm active emp_jobtype" data-val="<?php echo Globals::EMPLOYEE_FULLTIME;?>">Full Time</button>
                                                                <button type="button" class="btn margin btn-primary btn-sm emp_jobtype" data-val="<?php echo Globals::EMPLOYEE_PARTTIME;?>">Part Time</button>
                                                                <input type="hidden" name="employee_jobtype" class="form-control" required id="employee_jobtype" value="<?php echo Globals::EMPLOYEE_FULLTIME;?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                   <div class="form-group">
                                                        <label for="fileupload" class="col-sm-4 control-label"><h3>Upload Document:</h3></label>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileupload" class="col-sm-3 control-label">Identity Card*:</label>

                                                        <div class="col-sm-9">                                                          
                                                            <input type="file" id="employeeIdUpload" name="empIdFile">
                                                        </div>
                                                        <input type="hidden" id="employeeIdFileUpData" name="employeeIdFileUpData">
                                                    </div>

                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <div class="col-sm-11">
                                                            <button type="button" class="btn btn-default pull-right btn-lg bg-red formReset" >Clear</button>
                                                        </div> 
                                                        <div class="col-sm-1">
                                                            <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="CreateServicePackage">Add</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-footer -->

                                                </form>
                                                <!-- Service Package Creation Form End -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>

                                    </div>

                                </div>
                                <!-- /.box body-->

                            </div>

                            <div class="clearfix"></div>

                            <div class="box box-default box-solid">
                                <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <h3 class="box-title">Employee List</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: block;">
                                    <div class="box box-primary">
                                        <!-- /.box-header -->
                                        <div class="box-header with-border">
                                            <div class="form-group">                                             
                                                <div class="col-sm-6">
                                                    <div class="btn-group" role="group" id="employee_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active employee_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button> 
                                                        <button type="button" class="btn margin btn-primary btn-sm employee_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="form-horizontal">

                                            <div class="box-body">
                                                <table id="employee_list" class="table table-bordered table-striped tables-button-edit">
                                                    <thead>
                                                        <tr>
                                                            <th>ID </th>
                                                            <th>Name</th>
                                                            <th>Passport Number</th>
                                                            <th>Citizenship</th>
                                                            <th>H/P Phone</th>
                                                            <th>Job Type</th>
                                                            <th>Id Card</th>
                                                            <th class="">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- /.box body-->
                            </div>
                            <!-- /.box -->

                        </div>
                        <!-- /. Employee Detail TAB Start -->

                    </div>
                    <!-- /. Tab Content -->
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Employee Edit Modal -->
<div class="modal fade" id="employeeEditModal" tabindex="-1" role="dialog" aria-labelledby="employeeEditModalLabel">
    <div class="modal-dialog" role="document">
        <form id='editEmployeeForm' action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="employeeEditModalLabel">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <!-- 
                        Modal Body
                    -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" type="submit" id="saveEmployeeEdit">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.Employee Edit Modal END -->

<!-- pekeUpload -->
<script type="text/javascript" src="<?php echo plugin_url('plugins/pekeUpload/pekeUpload.js'); ?>"></script>
<script>
    $(function () {
        
        /* Company ssm File Upload  */
        $("#ssmFileUpload").pekeUpload({
            'bootstrap': true,
            'url': 'upload_companyssm_doc.html',
            'limit': 1,
            'maxSize': 10240,
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
            'maxSize': 10240,
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
        
        /* Employee List Datatable */
        var employeeListTable = $('#employee_list').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
            "ajax": {
                "url": '<?php echo base_url() . 'listEmployees.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function(d){                     
                    d.archived = $("#employee_status").attr('data-val'); 
                }
            },
            "columns": [
                {"data": "employee_id"},
                {"data": "employee_name"},
                {"data": "employee_passport_number"},
                {"data": "employee_citizenship"},
                {"data": "employee_hp_phone"},
                {"data": null},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {

                        var string = ' <td class=""> <div class="text-center">';
                            if(row.employee_job_type == <?php echo Globals::EMPLOYEE_FULLTIME;?>){
                                string += 'Full Time';
                            }else{
                                string += 'Part Time';
                            }
                            string += '</div></td>';
                        
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [6], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                       
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="<?php echo base_url();?>assets/uploads/vendor/<?php echo $vendorId;?>/company/employee/'+row.employee_idcard_path+'" target="_blank" class="btn btn-social-icon" title="IdCard">View</a></div></td>';
                        
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#employee_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="editEmployeeWindow btn btn-social-icon " title="Edit" ><i class="fa fa-edit"></i></a>';
                        if(archived == '0'){
                            string += '<a href="#" class="btn btn-social-icon employeeArchive" title="Archive" ><i class="fa fa-archive"></i></a></div></td>';
                        }else{
                            string += '<a href="#" class="btn btn-social-icon employeeUnArchive" title="UnArchive" ><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;
                    }
                }
            ]
        });
        
        /* Employee ID Card Upload  */
        $("#employeeIdUpload").pekeUpload({
            'bootstrap': true,
            'url': 'upload_employeeid_doc.html',
            'limit': 1,
            'maxSize': 1000*1024,
            'onFileError': function (file, error) {

            },
            onFileSuccess: function (file, data) {
                $('#employeeIdFileUpData').val(data.file);
            }

        });
        
        
        /* Employee Job type click event */
        $(document).on('click', ".btn-group .emp_jobtype", function () {
            $(".btn-group .emp_jobtype").removeClass('active');
            $(this).addClass('active');
            $("#employee_jobtype").val($(this).data('val'));
        });
        
        /* Archived / Un Archived Employee Datatable list */
        $(document).on("click",".btn-group .employee_status_archive, .employee_status_unarchive",function () {
            $(".btn-group#employee_status button").removeClass('active');
            $(this).addClass('active');
            $("#employee_status").attr('data-val',$(this).data('val'));           
            employeeListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });
        
        /* Employee creation form handling.. */
        $("#employeeCreationForm").submit(function (e) {
            e.preventDefault();
            var data = $("#employeeCreationForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'createEmployee.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        employeeListTable.ajax.reload(); //call datatable to reload the Ajax resource
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
               
        
        /* Edit Employee AJAX Call */
        $("#saveEmployeeEdit").click(function (e) {
            e.preventDefault();
            var data = $("#editEmployeeForm").serializeArray();
            var employeeId = $("#employeeEditModal").data('val').employee_id;
            data.push({'name': 'employeeId', 'value':employeeId});
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'editEmployee.html' ?>",
                data: data,
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        employeeListTable.ajax.reload(); //call datatable to reload the Ajax resource
                        $("#employeeEditModal").modal('hide');
                    } else {
                        notifyMessage('error', result.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });
        });

        /* Fetching the Employee Details  */
        $(document).on('click', '.editEmployeeWindow', function (e) {

            e.preventDefault();
            var rowData = employeeListTable.row($(this).closest('tr')).data();
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'editEmployee.html'; ?>",
                data: {'employeeId': rowData.employee_id},
                cache: false,
                success: function (res) {
                    $("#employeeEditModal .modal-body").html(res);
                    $("#employeeEditModal").modal('show');
                    $("#employeeEditModal").data('val',rowData);
                    
                    /* Edit Employee Job type click event */
                    $(document).on('click', ".btn-group .edit_emp_jobtype", function () {
                        $(".btn-group .edit_emp_jobtype").removeClass('active');
                        $(this).addClass('active');
                        $("#edit_employee_jobtype").val($(this).data('val'));
                    });

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });

        });
        
        /* Archive/UnArchive Employees START  */
        $(document).on('click', '.employeeArchive, .employeeUnArchive', function (e) {

            e.preventDefault();
            var rowData     = employeeListTable.row($(this).closest('tr')).data();
            var employeeId    = rowData.employee_id;
            var companyId   = rowData.employee_company_id;
            
            if($(this).hasClass('employeeUnArchive')){
                archive = <?php echo Globals::UN_ARCHIVE;?>;
                message = "Are you sure you want to un-archive?";
            }else{
                archive = <?php echo Globals::ARCHIVE;?>;
                message = "Are you sure you want to archive?";
            }

            $.confirm({
                title: 'Confirm!',
                content: message,
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                buttons: {
                    confirm: {
                        btnClass: 'btn-green',
                        action:function () {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'archiveEmployee.html'; ?>",
                                data: {'employeeId': employeeId, 'companyId':companyId,'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        employeeListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
                                    } else {
                                        notifyMessage('error', result.message);
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    notifyMessage('error', errorThrown);
                                }
                            });
                        }
                    },
                    cancel: {
                    btnClass: 'btn-red',
                    action:function () {

                        }
                    }
                }
            });

        }); /* Archive/UnArchive Employees END */
        
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
