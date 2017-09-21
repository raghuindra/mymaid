<?php
$this->load->view("block/admin_topNavigation");
$this->load->view("block/admin_leftMenu");

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vendors Companies
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Vendors Companies</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#companiesTab" data-toggle="tab">Companies</a></li>
                        <!--  <li><a href="#activeVendorsTab" data-toggle="tab">Active Vendors</a></li>  -->
                        <!--  <li><a href="#resetPassTab" data-toggle="tab">Reset Password</a></li>  -->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="companiesTab">              
                            <div class="box-body" style="display: block;">
                                <div class="box box-primary">
                                    <!-- /.box-header -->
                                    <!-- /.box-header -->

                                    <div class="box-body col-sm-12">
                                        <table id="vendorCompanyList" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Vendor Name</th>
                                                    <th>Company Name</th>
                                                    <th>Contact Person Name</th>
                                                    <th>Email</th>
                                                    <th>Registration No</th>
                                                    <th>Telephone</th>
                                                    <th>Location</th>        
                                                    <th>Employees</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box body-->
                            
                            <div class="clearfix"></div>
                            
                            <!-- Employee Detail Table START -->
                            <div class="box box-default box-solid">
                                <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <h3 class="box-title employee_box_heading">Employee List </h3>

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
                                                            <th>Default<br>Job Session</th>
                                                            <th>Id Card</th>
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
                            <!-- Employee Detail Table END -->
                        </div>
                        <!-- /.tab-pane -->

<!--                    <div class="tab-pane" id="activeVendorsTab">
       
                        </div>-->
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

<!--  Modal Window START-->
<div class="modal fade" id="modalWindow" tabindex="-1" role="dialog" aria-labelledby="modalWindowLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalWindowTitle"></h4>
            </div>
            <div class="modal-body" id='modalWindowBody'>
                <!-- 
                    Modal Body
                -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>               
            </div>
        </div>
    </div>
</div>
<!-- /. Modal Window END -->

<!-- Vendor Detail Hidden Field -->
<div style="display:none" id="vendor_detail_div">

    <div class='row'>
        <div class='col-xs-12'>
            <div class='form-horizontal'>
                <div class='box-body'>
                    <!-- Service Package Creation Form Start -->
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Registration Date :</label>
                        <div class='col-sm-6' id="venRegDate">

                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Name :</label>
                        <div class='col-sm-6' id="venName">

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Email :</label>
                        <div class='col-sm-6' id='venEmail'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Address :</label>
                        <div class='col-sm-6' id='venAddress'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Address1 :</label>
                        <div class='col-sm-6' id='venAddress1'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>City :</label>
                        <div class='col-sm-6' id='venCity'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>State :</label>
                        <div class='col-sm-6' id='venState'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Mobile :</label>
                        <div class='col-sm-6' id='venMobile'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Telephone :</label>
                        <div class='col-sm-6' id='venTelephone'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Identity :</label>
                        <div class='col-sm-6' id='venIdentity'>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> 

</div>
<!-- /. Vendor Detail Hidden Field END-->

<!-- Vendor Company Detail Hidden Field -->
<div style="display:none" id="vendor_company_detail_div">

    <div class='row'>
        <div class='col-xs-12'>
            <div class='form-horizontal'>
                <div class='box-body'>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Company Name :</label>
                        <div class='col-sm-6' id="compName">

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Email :</label>
                        <div class='col-sm-6' id='compEmail'>

                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Registration No :</label>
                        <div class='col-sm-6' id='compReg'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Address :</label>
                        <div class='col-sm-6' id='compAddress'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Address1 :</label>
                        <div class='col-sm-6' id='compAddress1'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>City :</label>
                        <div class='col-sm-6' id='compCity'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>State :</label>
                        <div class='col-sm-6' id='compState'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Mobile :</label>
                        <div class='col-sm-6' id='compMobile'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Telephone :</label>
                        <div class='col-sm-6' id='compTelephone'>

                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>H/P Phone :</label>
                        <div class='col-sm-6' id='compHPphone'>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Company SSM Document :</label>
                        <div class='col-sm-6' id=''>
                            <a href='' id='compSSMDocument' target='_blank'>View</a>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-4 control-label'>Company ID Card :</label>
                        <div class='col-sm-6' id=''>
                        <a href='' id='compIdcard' target='_blank'>View</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div> 

</div>
<!-- /. Vendor Company Detail Hidden Field END-->

<!-- Vendor Company List Tab Scripts START-->
<script>

    var base_url = '<?php echo base_url(); ?>';

    var COMMON_FUN = {
        /* Upadte the vendor detail Div details. */
        getVendorDetail: function (rowData, callback) {

            $("#venRegDate").html(rowData.person_creation_date);
            $("#venName").html(rowData.person_first_name + " " + rowData.person_last_name);
            $("#venEmail").html(rowData.person_email);
            $("#venAddress").html(rowData.person_address);
            $("#venAddress1").html(rowData.person_address1);
            $("#venCity").html(rowData.person_city);
            $("#venState").html(rowData.person_state);
            $("#venMobile").html( (rowData.person_mobile) ? "+60 "+rowData.person_mobile: '');
            $("#venTelephone").html( (rowData.person_telephone) ? "+60 "+rowData.person_telephone: '');
            $("#venIdentity").html(rowData.person_identity_card + " - " + rowData.person_identity_card_number);
            callback(true);

        },
        
        /* Upadte the Vendor Company Div details. */
        getCompanyDetail:  function(rowData, callback){
            //console.log(rowData);
            $("#compName").html(rowData.company_name);
            $("#compEmail").html(rowData.company_email_id);
            $("#compReg").html(rowData.company_reg_number);
            $("#compAddress").html(rowData.company_address);
            $("#compAddress1").html(rowData.company_address1);
            $("#compCity").html(rowData.company_city);
            $("#compState").html(rowData.state_name);
            $("#compMobile").html( (rowData.company_mobile) ? "+60 "+rowData.company_mobile: '' );
            $("#compTelephone").html( (rowData.company_landphone) ? "+60 "+rowData.company_landphone: '');
            $("#compHPphone").html( (rowData.company_hp_phone) ? "+60 "+rowData.company_hp_phone: '' );
            
            if(rowData.company_idcard_file_path != null && rowData.company_idcard_file_path != ''){
                $("#compIdcard").attr('href', base_url+'assets/uploads/vendor/'+rowData.company_person_id+'/company/'+rowData.company_idcard_file_path);
                $("#compIdcard").text('View');
            }else{
                $("#compIdcard").attr('href','javascript:void(0)');
                $("#compIdcard").text('No Document');
            }

            if(rowData.company_ssm_file_path != null && rowData.company_ssm_file_path != ''){
                $("#compSSMDocument").attr('href', base_url+'assets/uploads/vendor/'+rowData.company_person_id+'/company/'+rowData.company_ssm_file_path);
                $("#compSSMDocument").text('View');
            }else{
                $("#compSSMDocument").attr('href','javascript:void(0)');
                $("#compSSMDocument").text('No Document');
            }
            
            callback(true);
            
        },
        
        /* JConfirm for the Vendor/Company Detail */
        detailPopUp: function(title, divId){
            $.confirm({
                    title: title,
                    content: $("#"+divId).html(),
                    'useBootstrap': true,
                    'type': 'blue',
                    'typeAnimated': true,
                    'animation': 'scaleX',
                    'closeIcon': true,
                    'columnClass': 'col-md-6 col-md-offset-3',
                    buttons: {                        
                        cancel:{
                            btnClass: 'btn-red',
                            action: function () {

                            }
                        }
                    }
                });
        }
    }
    
    $(function () {
        // variable for company employee listing
        var company_id = 0;
        var vendor_id = 0;
        /* new Vendor Detail List Table START */
        var vendorCompanyListTable = $('#vendorCompanyList').DataTable({
            // dom: 'Bfrtip',
            // buttons: [
            //    'excel'
            // ],
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": '<?php echo base_url() . 'vendors_company_list.html'; ?>',
                "type": "POST",
                "data": {'dataTableReq':true},
                "dataSrc": 'data'
            },
            "columns": [
                {"data": null},
                {"data": "company_name"},
                {"data": "company_contact_person_name"},
                {"data": "company_email_id"},
                {"data": "company_reg_number"},
                {"data": "company_landphone"},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="vendorDetails">' + row.person_first_name + ' ' + row.person_last_name + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [1], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="companyDetails">' + row.company_name + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [1, 2, 3, 4, 5], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [6], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class="">' + row.company_city + ', '+  row.company_state +' </td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="employee_details">Employees</a></td>';
                        return string;
                    }
                }
            ]
        });
        /* /. New Vendor Detail List Table END*/


        /* New Vendor Detail Window popup */
        $(document).on('click', '.vendorDetails', function (e) {
            e.preventDefault();
            var rowData = vendorCompanyListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getVendorDetail(rowData, function (status) {               
                COMMON_FUN.detailPopUp('Vendor Detail','vendor_detail_div');
            });

        });
        /* /. New Vendor Detail Window popup */
        
        /* Comapny Detail Window popup */
        $(document).on('click', '.companyDetails', function (e) {
            e.preventDefault();
            var rowData = vendorCompanyListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getCompanyDetail(rowData, function (status) {
                COMMON_FUN.detailPopUp('Vendor Company Detail','vendor_company_detail_div');
            }); 

        });
        /* /. Comapny Detail Window popup */
        
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
                "url": '<?php echo base_url() . 'a_listEmployees.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function(d){                     
                    d.companyId = company_id; 
                }
            },
            "columns": [
                {"data": "employee_id"},
                {"data": "employee_name"},
                {"data": "employee_passport_number"},
                {"data": "employee_citizenship"},
                {"data": "employee_hp_phone"},
                {"data": "session_name"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4,5], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [6], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                       var string = '';
                        if(row.employee_idcard_path != '' && row.employee_idcard_path != null){
                            string = ' <td class=""> <div class="text-center">'
                                + '<a href="<?php echo base_url();?>assets/uploads/vendor/'+vendor_id+'/company/employee/'+row.employee_idcard_path+'" target="_blank" class="btn btn-social-icon" title="IdCard">View</a></div></td>';
                       }
                        return string;
                    }
                }
            ]
        });
        
        /* Get Employee list of Company*/
        $(document).on('click', '.employee_details', function(e){
            e.preventDefault();
            var rowData = vendorCompanyListTable.row($(this).closest('tr')).data();
            
            company_id = rowData.company_id;
            vendor_id = rowData.company_person_id;
            
            $('.employee_box_heading').html('Employee List of Company: <b>'+ rowData.company_name +'</b>');
            employeeListTable.ajax.reload(); //call datatable to reload the Ajax resource
        });
        

    });

</script>
<!-- Vendor Company List Scripts END -->

<link rel="stylesheet" href="<?php echo plugin_url('plugins/datatables/export/buttons.dataTables.min.css');?>">
<script src="<?php echo plugin_url('plugins/datatables/export/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/buttons.flash.min.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/jszip.min.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/pdfmake.min.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/vfs_fonts.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo plugin_url('plugins/datatables/export/buttons.print.min.js'); ?>"></script>
