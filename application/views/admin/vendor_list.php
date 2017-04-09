<?php
$this->load->view("block/admin_topNavigation");
$this->load->view("block/admin_leftMenu");
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Vendors
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Vendors</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#newVendorsTab" data-toggle="tab">New Vendors</a></li>
                        <li><a href="#activeVendorsTab" data-toggle="tab">Active Vendors</a></li>
                        <!--                        <li><a href="#resetPassTab" data-toggle="tab">Reset Password</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="newVendorsTab">              
                            <div class="box-body" style="display: block;">
                                <div class="box box-primary">
                                    <!-- /.box-header -->
                                    <!--                                        <div class="box-header with-border">
                                                                                <div class="form-group">                                             
                                                                                    <div class="col-sm-6">
                                                                                        <div class="btn-group" role="group" id="_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                                                            <button type="button" class="btn margin btn-primary btn-sm active service_spl_request_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                                                            <button type="button" class="btn margin btn-primary btn-sm service_spl_request_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->
                                    <!-- /.box-header -->
                                    <div class="box-body col-sm-12">
                                        <table id="newVendorsList" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Location</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Registered Date</th>
                                                    <th>Company Name</th>
                                                    <th>Company Telephone</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box body-->
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="activeVendorsTab">
                            <div class="form-horizontal">
                                <div class="box-body" style="display: block;">
                                    <div class="box box-primary">
                                        <!-- /.box-header -->
                                        <div class="box-header with-border">
                                            <div class="form-group">                                             
                                                <div class="col-sm-6">
                                                    <div class="btn-group" role="group" id="active_vendor_list_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active active_vendor_list_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                        <button type="button" class="btn margin btn-primary btn-sm active_vendor_list_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body col-sm-12">
                                            <table id="activeVendorsList" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Location</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Company Name</th>
                                                        <th>Company Telephone</th>
                                                        <th>Company Contact Person</th>
                                                        <th class="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box body-->
                            </div>        
                        </div>
                        <!-- /.tab-pane -->

                        <!--                        <div class="tab-pane" id="resetPassTab">
                                                    <form class="form-horizontal">
                                                        
                                                    </form>
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
                        <label for='inputEmail3' class='col-sm-4 control-label'>Employees :</label>
                        <div class='col-sm-6' id='compEmployees'>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> 

</div>
<!-- /. Vendor Company Detail Hidden Field END-->

<!-- New Vendors Tab Scripts START-->
<script>
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
            $("#venMobile").html(rowData.person_mobile);
            $("#venTelephone").html(rowData.person_telephone);
            $("#venIdentity").html(rowData.person_identity_card + " - " + rowData.person_identity_card_number);
            callback(true);

        },
        
        /* Upadte the Vendor Company Div details. */
        getCompanyDetail:  function(rowData, callback){
            console.log(rowData);
            $("#compName").html(rowData.company_name);
            $("#compEmail").html(rowData.compnay_email_id);
            $("#compReg").html(rowData.company_reg_number);
            $("#compAddress").html(rowData.company_address);
            $("#compAddress1").html(rowData.company_address1);
            $("#compCity").html(rowData.company_city);
            $("#compState").html(rowData.company_state);
            $("#compMobile").html(rowData.company_mobile);
            $("#compTelephone").html(rowData.company_landphone);
            $("#compHPphone").html(rowData.company_hp_phone);
            $("#compEmployees").html(rowData.company_emp_min+ " - "+rowData.company_emp_max);
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

        

        /* new Vendor Detail List Table START */
        var newVendorsListTable = $('#newVendorsList').DataTable({
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
                "url": '<?php echo base_url() . 'new_vendors_list.html'; ?>',
                "type": "POST",
                "data": null,
                "dataSrc": 'data'
            },
            "columns": [
                {"data": null},
                {"data": null},
                {"data": "person_mobile"},
                {"data": "person_email"},
                {"data": "person_creation_date"},
                {"data": null},
                {"data": "company_landphone"},
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
                        var string = ' <td class="">' + row.person_city + ', ' + row.person_state + ' </td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [2, 3, 4, 6], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [5], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="companyDetails">' + row.company_name + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""> <div class="text-center">'
                        string += '<a href="#" class="btn btn-social-icon vendorApprove" title="Approve" ><i class="fa fa-check-square"></i></a></div></td>';

                        return string;
                    }
                }
            ]
        });
        /* /. New Vendor Detail List Table END*/


        /* New Vendor Detail Window popup */
        $(document).on('click', '.vendorDetails', function (e) {
            e.preventDefault();
            var rowData = newVendorsListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getVendorDetail(rowData, function (status) {               
                COMMON_FUN.detailPopUp('Vendor Detail','vendor_detail_div');
            });

        });
        /* /. New Vendor Detail Window popup */
        
        /* Comapny Detail Window popup */
        $(document).on('click', '.companyDetails', function (e) {
            e.preventDefault();
            var rowData = newVendorsListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getCompanyDetail(rowData, function (status) {
                COMMON_FUN.detailPopUp('Vendor Company Detail','vendor_company_detail_div');
            }); 

        });
        /* /. Comapny Detail Window popup */

        
        /* Approve vendor Confirm PopUp */
        $(document).on('click', '.vendorApprove', function (e) {
            e.preventDefault();
            var rowData = newVendorsListTable.row($(this).closest('tr')).data();

                $.confirm({
                title: 'Confirm!',
                content: "Are you sure you want to approve vendor?",
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                buttons: {
                    confirm:{ 
                        btnClass: 'btn-green',
                        action:function () {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'approveNewVendor.html'; ?>",
                                data: {'personId': rowData.person_id},
                                cache: false,
                                success: function (res) {
                                    
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        newVendorsListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        //$('#archiveConfirmModal').modal('hide');
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
                    cancel:{
                        btnClass: 'btn-red',
                        action: function () {

                        }
                    }
                }
            });


        });
        /* /. Approve vendor Confirm PopUp */

    });

</script>
<!-- New Vendors Scripts END -->


<!-- Vendors List Scrupt START -->
<script>
    
    $(function(){
      
      /* Active Vendor Detail List Table START */
        var activeVendorsListTable = $('#activeVendorsList').DataTable({
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
                "url": '<?php echo base_url() . 'active_vendors_list.html'; ?>',
                "type": "POST",
                "data": function(d){                     
                    d.archived = $("#active_vendor_list_status").attr('data-val');
                },
                "dataSrc": 'data'
            },
            "columns": [
                {"data": null},
                {"data": null},
                {"data": "person_mobile"},
                {"data": "person_email"},
                {"data": null},
                {"data": "company_landphone"},
                {"data": "company_contact_person_name"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="actVendorDetails">' + row.person_first_name + ' ' + row.person_last_name + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [1], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class="">' + row.person_city + ', ' + row.person_state + ' </td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [2, 3, 5, 6], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [4], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="actCompanyDetails">' + row.company_name + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#active_vendor_list_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">';
                        
                        if(archived === '0'){
                            string  += '<a href="#" class="btn btn-social-icon archiveVendor" title="Archive" ><i class="fa fa-archive"></i></a></div></td>';
                        }else{
                            string  += '<a href="#" class="btn btn-social-icon unarchiveVendor" title="Un Archive"><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;                        
                    }
                }
            ]
        });
        /* /. Active Vendor Detail List Table END*/
        
        /* Archived / Un Archived Datatable list event */
        $(document).on("click",".btn-group .active_vendor_list_status_archive, .active_vendor_list_status_unarchive",function () {
            $(".btn-group#active_vendor_list_status button").removeClass('active');
            $(this).addClass('active');
            $("#active_vendor_list_status").attr('data-val',$(this).data('val'));           
            activeVendorsListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });
        
        /* Active Vendor Detail Window popup */
        $(document).on('click', '.actVendorDetails', function (e) {
            e.preventDefault();
            var rowData = activeVendorsListTable.row($(this).closest('tr')).data();

            COMMON_FUN.getVendorDetail(rowData, function (status) {
                COMMON_FUN.detailPopUp('Vendor Detail','vendor_detail_div');
            });

        });
        /* /. Active Vendor Detail Window popup */
        
        /* Active Comapny Detail Window popup */
        $(document).on('click', '.actCompanyDetails', function (e) {
            e.preventDefault();
            var rowData = activeVendorsListTable.row($(this).closest('tr')).data();
          
            COMMON_FUN.getCompanyDetail(rowData, function (status) {
                COMMON_FUN.detailPopUp('Vendor Company Detail','vendor_company_detail_div');
            });      
        
        });
        /* /. Active Comapny Detail Window popup */
        
        
        /* Archive/UnArchive Vendors START  */
        $(document).on('click', '.archiveVendor, .unarchiveVendor', function (e) {

            e.preventDefault();
            var rowData     = activeVendorsListTable.row($(this).closest('tr')).data();
            var personId    = rowData.person_id;
            
            if($(this).hasClass('unarchiveVendor')){
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
                                url: "<?php echo base_url() . 'archiveVendor.html'; ?>",
                                data: {'personId': personId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        activeVendorsListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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

        }); /* Archive/UnArchive Vendors END */
        
    });
    
</script>
<!-- Vendors List Script END -->