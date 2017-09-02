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


<!-- Calendar Plugin -->
<link href="<?php echo plugin_url('plugins/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo plugin_url('plugins/fullcalendar/fullcalendar.print.css'); ?>" media="print">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Employee Calender
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . $home; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Calender</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Employee Availability</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <div class="box ">

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
                                            } ?>

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
                            </div>
                            <!-- /.box-header -->
                            <div class="box box-primary">
                            <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <div class="form-horizontal">
                                        <!-- /.box-header -->
                                        <div class="box-body" id="full_calendar">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <div class="clearfix"></div>
                
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

        $("#company_spl").select2({
            placeholder: "Select Company",
            allowClear: true
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
                            $("#employee_spl").append('<option value="">Select Employee</option>');
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

var employee_id_for_calender = 0;

var Calendar = $('#full_calendar').fullCalendar({
            header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek ,basicDay'
            },
            // buttonText: {
            //     today: days.today,
            //     month: days.month,
            //     week: days.week,
            //     day: days.day
            // },
            columnFormat:{
                month: 'ddd',    // Mon
                week: 'ddd d/M', // Mon 9/7
                day: 'dddd d/M'  // Monday 9/7
            },
            // titleFormat:{
            //     month: 'MMMM YYYY',                             // September 2009
            //     week: "d MMM[ YYYY]{ '&#8212;'[ MMM] d YYYY}", // Sep 7 - 13 2009
            //     day: 'dddd, d MMM, YYYY' 
            // },
            axisFormat:"H(:mm)",
            // dayNamesShort:days.dayNamesShort,
            // dayNames:days.dayNames,
            // allDayText:days.allDay,
            // monthNamesShort:days.monthNamesShort,
            // monthNames:days.monthNames,               
            editable: false,
            droppable: false,
            eventSources: [
                {
                    url: "<?php echo base_url() .'employee_booked_dates.html';?>", // use the `url` property
                    type: 'POST',
                    data: 
                    function() { // a function that returns an object
                        return {
                            employeeId: employee_id_for_calender
                        };
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'green',    // an option!
                    textColor: 'white'  // an option!
                },
                {
                    url: "<?php echo base_url() .'employee_off_dates.html';?>", // use the `url` property
                    type: 'POST',
                    data: 
                    function() { // a function that returns an object
                        return {
                            employeeId: employee_id_for_calender
                        };
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: '#D95505',    // an option!
                    textColor: 'white'  // an option!
                }
            ],
            eventClick: function(event) {                   
                if (event.url) {
                    $.post(event.url,function(response)
                    {
                        $('.modal-body').html(response);
                        $('#modal_header').html("");
                        $('#modal-simple').modal({keyboard: true});

                    });
                    return false;
                }
            }
        });

    $(document).on('change', '#employee_spl', function(){

        employee_id_for_calender = $(this).val();       

        Calendar.fullCalendar( 'refetchEvents' );
    });

});

</script>

<!-- Calendar Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo plugin_url("plugins/fullcalendar/fullcalendar.js"); ?>"></script>


<script>

$(function(){
    
    
    	
        
});

</script>