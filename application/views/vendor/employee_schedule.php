<?php
$home = "#";

if (($this->session->userdata('user_type') !== null) && $this->session->userdata('user_type') == Globals::PERSON_TYPE_ADMIN_NAME) {
    $this->load->view("block/admin_topNavigation");
    $this->load->view("block/admin_leftMenu");
    $home = "admin_home.html";
} else if (($this->session->userdata('user_type') !== null) && ( $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME ) ) {
    $this->load->view("block/vendor_topNavigation");
    $this->load->view("block/vendor_leftMenu");
    $home = "vendor_home.html";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Employee Schedule
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . $home; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Schedule</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Employee Default Session</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <div class="box box-primary">

                            <!-- /.box-header -->
                            <div class="box-header with-border">
                                <div class="form-group">                                             
                                    <div class="col-sm-4">
                                        <?php
                                        if (($this->session->userdata('user_type') !== null) && ( $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME) ) {
                                            ?>
                                            <select type="text" placeholder="Select Company" name="company" id="company" class="form-control hidden">
                                                <?php
                                                echo '<option value="' . $this->session->userdata('company_id') . '" >' . $this->session->userdata('company_name') . '</option>';
                                                ?>
                                            </select>
                                            <?php
                                        } else {
                                            ?>
                                            <select type="text" placeholder="Select Company" name="company" id="company" class="form-control">
                                                <?php
                                                foreach ($vendors_company as $key => $value) {
                                                    echo '<option value="' . $value->company_id . '" >' . $value->company_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="employee_schedule" class="table table-bordered table-striped tables-button-edit responsive">
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Monday</th>
                                                <th>Tuesday</th>
                                                <th>Wednesday</th>
                                                <th>Thursday</th>
                                                <th>Friday</th>
                                                <th>Saturday</th>
                                                <th>Sunday</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <div class="clearfix"></div>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Special Session</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <div class="box-header with-border">
                                <div class="form-group">
                                    <div class="row">

                                        
                                            <?php 
                                                if (($this->session->userdata('user_type') !== null) && ( $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME )) {
                                                ?>
                                                <div class="col-sm-4" style="display:none;">
                                                <select type="text" placeholder="Select Company" name="company_spl" id="company_spl" class="form-control hidden" >
                                                 <?php
                                                    echo '<option value="' . $this->session->userdata('company_id') . '" >' . $this->session->userdata('company_name') . '</option>';
                                                    ?>
                                                </select>
                                                </div>
                                            <?php  }else{ ?>
                                                <div class="col-sm-4">
                                                <select type="text" placeholder="Select Company" name="company_spl" id="company_spl" class="form-control">                                              
                                                    <option value="">Select Company</option>
                                                    <?php
                                                    foreach ($vendors_company as $key => $value) {
                                                        echo '<option value="' . $value->company_id . '" >' . $value->company_name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            <?php    
                                            }
                                            
                                            ?>
                                            
                                        

                                        <div class="col-sm-4">
                                            
                                            <select type="text" placeholder="Select Employee" name="employee_spl" id="employee_spl" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php 
                                                if (($this->session->userdata('user_type') !== null) && ( $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME )) {
                                                    foreach($employees as $employee){
                                                        echo "<option value='".$employee->employee_id."'>".$employee->employee_name."</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Date range -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Date range:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="dateRange">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <!-- /.Date range -->
                                    <!-- Session -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Session:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <select name="session_spl" id="session_spl" placeholder="Select Session" class="form-control select2">
                                                    <option value="">Select Session</option>
                                                    <?php
                                                    foreach ($sessions as $session) {
                                                        echo "<option value='$session->session_id'>$session->session_name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <!-- /.Session -->


                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">

                                            <label class="">Day(s) Off:</label>
                                            <input type="checkbox" class="" name="dayOff" id="dayOff">

                                        </div>
                                    </div>                                   
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn pull-right btn-lg bg-green" id="addEmployeeSplSession">Add</button>
                                    </div> 
                                    <div class="col-sm-4"></div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="employee_spl_schedule" class="table table-bordered table-striped tables-button-edit responsive">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>Employee</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Session</th>
                                                <th>Day(s) Off</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.box -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php 
    if(($this->session->userdata('user_type') !== null) && ( $this->session->userdata('user_type') == Globals::PERSON_TYPE_VENDOR_NAME || $this->session->userdata('user_type') == Globals::PERSON_TYPE_FREELANCER_NAME )) {
?>
<script>
    $(function (){
        $("#employee_spl").select2({
            placeholder: "Select Employee",
            allowClear: true
        });     
        
    });
</script>
<?php
    }else{
  ?>
<script>
    $(function (){
        $("#employee_spl").select2({
            placeholder: "Select Employee",
            allowClear: true
        }).prop("disabled", true);     
        
    });
</script>
<?php        
    }
?>

<script>
    $(function () {

        //Date range picker
        $('#dateRange').daterangepicker();

        $("#company_spl").select2({
            placeholder: "Select Company",
            allowClear: true
        });

        $('#dayOff').on('change', function () {
            if ($(this).is(':checked')) {
                $('#session_spl').attr('disabled', true);
                $('#session_spl option:eq(0)').prop('selected', true);
            } else {
                $('#session_spl').attr('disabled', false);
            }
        });

        var employeeScheduleTable = $('#employee_schedule').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
//            "buttons": [
//                'excel', 'pdf'
//            ],
            //"dom": 'Bfrtip',
            //"select": true,
            "ajax": {
                "url": '<?php echo base_url() . 'listEmployeeSessions.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    d.companyId = $("#company").val();
                },
            },
            "columns": [
                {"data": "employee_name"},
                {"data": null},
                {"data": null},
                {"data": null},
                {"data": null},
                {"data": null},
                {"data": null},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [1], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_monday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_monday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_monday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_monday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_monday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [2], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_tuesday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_tuesday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_tuesday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_tuesday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_tuesday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [3], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_wednesday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_wednesday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_wednesday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_wednesday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_wednesday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [4], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_thursday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_thursday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_thursday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_thursday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_thursday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_friday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_friday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_friday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_friday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_friday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [6], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_saturday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_saturday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_saturday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_saturday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_saturday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        string += '<select name="employee_session_sunday" class="employee_session">\n\
                                        <option value="1" ';
                        string += (row.employee_session_sunday === "1") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_FULL_DAY_NAME ?></option><option value="2" ';
                        string += (row.employee_session_sunday === "2") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_MORNING_NAME ?></option><option value="3" ';
                        string += (row.employee_session_sunday === "3") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_AFTERNOON_NAME ?></option><option value="4" ';
                        string += (row.employee_session_sunday === "4") ? "selected" : "";
                        string += '><?php echo Globals::SESSION_EVENING_NAME ?></option></select></div>';
                        string += '</td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [8], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""> <div class="text-center">';
                        string += '<a href="#" class="btn bg-green updateSession" data-toggle="tooltip" title="Update" data-id="' + row.employee_id + '">Update</a></div></td>';
                        return string;
                    }
                }
            ]
        });

        //Reload the datatable on change of Company Selection
        $(document).on('change', '#company', function () {
            employeeScheduleTable.ajax.reload(); //call datatable to reload the Ajax resource   
        });

        /**
         * Upadte the Employee Sessions
         */
        $(document).on('click', '.updateSession', function (e) {
            e.preventDefault();
            var rowData = employeeScheduleTable.row($(this).closest('tr')).data();
            var sessionArray = [];
            $(this).closest('tr').find("select[class='employee_session']").each(function () {
                sessionArray.push(this.value);
            });
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'updateEmployeeSession.html'; ?>",
                data: {'employeeId': rowData.employee_id, 'sessions': sessionArray},
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        //employeeScheduleTable.ajax.reload(); //call datatable to reload the Ajax resource

                    } else {
                        notifyMessage('error', result.message);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });
        });
        /* Upadte the Employee Sessions END */

        /*
         * Get Employee On Selection of Company
         * 
         */
        $(document).on('change', '#company_spl', function () {

            var companyId = $(this).val();
            console.log(companyId);
            if (companyId !== '') {
                $('#employee_spl').next().block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'getEmployeesOfCompany.html'; ?>",
                    data: {'companyId': companyId},
                    cache: false,
                    success: function (res) {
                        var result = JSON.parse(res);

                        if (result.status === true) {
                            //notifyMessage('success', result.message);
                            //employeeScheduleTable.ajax.reload(); //call datatable to reload the Ajax resource
                            var employees = result.data;
                            $("#employee_spl").empty();
                            employees.forEach(function (area) {
                                $("#employee_spl").append('<option value="' + area.employee_id + '">' + area.employee_name + '</option>');
                            });
                            $("#employee_spl").prop("disabled", false);
                            $("#employee_spl").next().unblock();
                        } else {
                            notifyMessage('error', result.message);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notifyMessage('error', errorThrown);
                    }
                });

            } else {
                $('#employee_spl').next().block();
                $("#employee_spl").empty();
            }
        });

        /* Add Employee Special Session AJAX Call */
        $("#addEmployeeSplSession").click(function () {
            var employee = $("#employee_spl").val().trim();
            var date = $("#dateRange").val().split('-');
            var session = $("#session_spl").val();
            var dayOff = 0;
            if ($("#dayOff").is(':checked')) {
                dayOff = 1;
            } else {
                dayOff = 0;
            }
            console.log(dayOff);
            var dateFrom = date[0].trim();
            var dateTo = date[1].trim();
            console.log(dateFrom + "-" + dateTo);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addEmployeeSplSession.html' ?>",
                data: {'employeeId': employee, 'fromdate': dateFrom, 'toDate': dateTo, 'session': session, 'dayOff': dayOff},
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        employeeSplScheduleTable.ajax.reload(); //call datatable to reload the Ajax resource   
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });


        /*
         * Employee Special Session Table 
         */
        var employeeSplScheduleTable = $('#employee_spl_schedule').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
//            "buttons": [
//                'excel', 'pdf'
//            ],
            //"dom": 'Bfrtip',
            //"select": true,
            "ajax": {
                "url": '<?php echo base_url() . 'listEmployeeSplSessions.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    d.company_spl = '';
                },
            },
            "columns": [
                {"data": "company_name"},
                {"data": "employee_name"},
                {"data": "employee_session_spl_date_from"},
                {"data": "employee_session_spl_date_to"},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [4], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        switch (row.employee_session_spl_session_id) {
                            case '<?php echo Globals::SESSION_FULL_DAY; ?>':
                                string += '<?php echo Globals::SESSION_FULL_DAY_NAME ?>';
                                break;
                            case '<?php echo Globals::SESSION_MORNING ?>':
                                string += '<?php echo Globals::SESSION_MORNING_NAME; ?>';
                                break;
                            case '<?php echo Globals::SESSION_AFTERNOON; ?>':
                                string += '<?php echo Globals::SESSION_AFTERNOON_NAME; ?>';
                                break;
                            case '<?php echo Globals::SESSION_EVENING; ?>':
                                string += '<?php echo Globals::SESSION_EVENING_NAME; ?>'
                                break;
                        }
                        string += '</div></td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [5], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><div class="text-center">';
                        if (row.employee_session_spl_off_status === '1') {
                            string += '<a href="#" class="badge bg-maroon color-palette" data-toggle="tooltip" title="Employee is Off">Off</a>';
                        } else {
                            string += '<a href="#" class="badge bg-teal color-palette" data-toggle="tooltip" title="Employee is Available">No</a>';
                        }
                        string += '</div></td>';

                        return string;
                    }
                }
            ]
        });

        //Reload the Employee Spl Session datatable on change of Company Selection
        $(document).on('change', '#company_spl', function () {
            //employeeSplScheduleTable.ajax.reload(); //call datatable to reload the Ajax resource   
        });



    });

</script>