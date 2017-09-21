<?php
$this->load->view("block/admin_topNavigation");
$this->load->view("block/admin_leftMenu");

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customers
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customers</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#companiesTab" data-toggle="tab">Customers List</a></li>
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
                                        <table id="customerList" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Customer Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Mobile No</th>   
                                                    <th>Postcode</th>     
                                                    <th>Created On</th>
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
<div style="display:none" id="customer_detail_div">

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

        /* Customer Detail List Table START */
        var customerListTable = $('#customerList').DataTable({
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
                "url": '<?php echo base_url() . 'customer_list_ajax.html'; ?>',
                "type": "POST",
                "data": {'dataTableReq':true},
                "dataSrc": 'data'
            },
            "order": [[ 0, "DESC" ]],
            "columns": [
                {"data": "person_id"},
                {"data": "person_full_name"},
                {"data": "person_email"},
                {"data": "person_address"},
                {"data": "person_city"},
                {"data": "person_state"},
                {"data": "person_mobile"},
                {"data": "person_postal_code"},
                {"data": "person_creation_date"}
            ],
            "columnDefs": [
                // {"responsivePriority": '2', "targets": [0], searchable: true, orderable: true, data: null,
                //     "render": function (data, type, row) {
                //         var string = ' <td class=""><a href="#" class="vendorDetails">' + row.person_first_name + ' ' + row.person_last_name + ' </a></td>';
                //         return string;
                //     }
                // },
                // {"responsivePriority": '2', "targets": [1], searchable: true, orderable: true, data: null,
                //     "render": function (data, type, row) {
                //         var string = ' <td class=""><a href="#" class="companyDetails">' + row.company_name + ' </a></td>';
                //         return string;
                //     }
                // },
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8], searchable: true, orderable: true},
                // {"responsivePriority": '2', "targets": [6], searchable: true, orderable: true, data: null,
                //     "render": function (data, type, row) {
                //         var string = ' <td class="">' + row.company_city + ', '+  row.company_state +' </td>';
                //         return string;
                //     }
                // },
                // {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                //     "render": function (data, type, row) {
                //         var string = ' <td class=""><a href="#" class="employee_details">Employees</a></td>';
                //         return string;
                //     }
                // }
            ]
        });
        /* /. Customer Detail List Table END*/


        /* Customer Detail Window popup */
        $(document).on('click', '.customerDetails', function (e) {
            e.preventDefault();
            var rowData = customerListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getVendorDetail(rowData, function (status) {               
                COMMON_FUN.detailPopUp('Customer Detail','customer_detail_div');
            });

        });
        /* /. New Vendor Detail Window popup */
        

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
