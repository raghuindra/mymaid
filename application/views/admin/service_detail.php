<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Service:
            <medium class=""><?php echo $service_detail[0]->service_name; ?></medium>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="./services.html"><i class="fa fa-dashboard"></i> Services</a></li>
            <li class="active">Service Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active "><a href="#packages_tab_content" data-toggle="tab">Service Packages</a></li>
                        <li role="presentation"><a href="#frequency_tab_content" data-toggle="tab">Frequency Discount</a></li>
                        <li role="presentation"><a href="#addons_tab_content" data-toggle="tab">Service Add-ons</a></li>
                        <li role="presentation"><a href="#specialrequest_tab_content" data-toggle="tab">Service Special Requests</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Service Packages TAB Start -->
                        <div role="tabpanel" class="tab-pane active" id="packages_tab_content">
                            <div class="box box-default box-solid">
                                <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <h3 class="box-title ">Create Service Package</h3>

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
                                                <form action="" name="servicePackageCreationForm" id="servicePackageCreationForm">
                                                    <div class="form-group">
                                                        <input type="hidden" name="package_service_id" class="form-control" id="package_service_id" value="<?php echo $service_detail[0]->service_id; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Building Type *:</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control select2" style="width: 100%;" name="package_building_type" id="package_building_type" required>
                                                                <option selected="selected" value="">Select building type</option>
                                                                <?php
                                                                if (isset($buildings) && !empty($buildings)) {
                                                                    foreach ($buildings as $building) {
                                                                        echo "<option value='" . $building->building_id . "'>" . $building->building_name . "</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Number of Bedrooms *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="package_bathrooms" class="form-control" min="1" max="50" required id="package_bathrooms" placeholder="Number of bedrooms" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Number of Bathrooms *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="package_bedrooms" class="form-control" min="1" max="50" required id="package_bedrooms" placeholder="Number of bathrooms">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Building Area :</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control select2" style="width: 100%;" name="package_building_area" id="package_building_area">
                                                                <option selected="selected" value="">Select building area</option>
                                                                <?php
                                                                if (isset($area_sizes) && !empty($area_sizes)) {
                                                                    foreach ($area_sizes as $area) {
                                                                        echo "<option value='" . $area->area_id . "'>" . $area->area_size . " - " . $area->area_measurement . "</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Number of Crew/s *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="package_crews" class="form-control" min="1" max="100" required id="package_crews" placeholder="Number of crew/s">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Package Hours:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="package_hours" class="form-control" min="1" max="100" id="package_hours" placeholder="Number of hours">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Package Price *:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="package_price" class="form-control" min="1" max="10000" required id="package_price" placeholder="Enter price">
                                                        </div>                                       
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Calculate Price by *:</label>
                                                        <div class="col-sm-6">
                                                            <div class="btn-group" role="group" aria-label="Calculate Price by">
                                                                <button type="button" class="btn margin btn-primary btn-sm active price_cal_type" data-val="hour">Per Hour</button>
                                                                <button type="button" class="btn margin btn-primary btn-sm price_cal_type" data-val="package">Per Package</button>
                                                                <input type="hidden" name="package_price_cal" class="form-control" required id="package_price_cal" value="hour">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Package Description:</label>
                                                        <div class="col-sm-6">
                                                            <textarea class="form-control col-sm-3" rows="3" style="max-height: 100px;max-width: 600px;" name="package_description" placeholder="Enter short description about package, any information for the user"></textarea>

                                                        </div>                                       
                                                    </div>

                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <div class="col-sm-11">
                                                            <button type="button" class="btn btn-default pull-right btn-lg bg-red">Clear</button>
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
                                    <h3 class="box-title">Service Package List</h3>

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
                                                    <div class="btn-group" role="group" id="service_package_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active service_package_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button> 
                                                        <button type="button" class="btn margin btn-primary btn-sm service_package_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="form-horizontal">

                                            <div class="box-body">
                                                <table id="servicepackage_list" class="table table-bordered table-striped tables-button-edit responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>ID </th>
                                                            <th>Building Type</th>
                                                            <th>Bedrooms</th>
                                                            <th>Bathrooms</th>
                                                            <th>Package Area</th>
                                                            <th>Package Hours</th>
                                                            <th>Package Crew's</th>
                                                            <th>Package Price</th>
                                                            <th class="action">Action</th>
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
                        <!-- Service Packages TAB End -->

                        <!-- Service Frequency Price Settings TAB START -->
                        <div role="tabpanel" class="tab-pane fade" id="frequency_tab_content">
                            <div class="box-body" >
                                <div class="box box-primary">

                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <!-- Service Package Creation Form Start -->
                                            <form action="" name="serviceFrequencyOfferCreationForm" id="serviceFrequencyOfferCreationForm">
                                                <div class="form-group">
                                                    <input type="hidden" name="add_frequency_service_id" class="form-control" id="add_frequency_service_id" value="<?php echo $service_detail[0]->service_id; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Frequency *:</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control select2" style="width: 100%;" name="add_service_frequency" id="add_service_frequency" required>
                                                            <option selected="selected" value="">Select frequency</option>
                                                            <?php
                                                            if (isset($service_frequency) && !empty($service_frequency)) {
                                                                foreach ($service_frequency as $freq) {
                                                                    echo "<option value='" . $freq->service_frequency_id . "'>" . $freq->service_frequency_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Discount(%) *:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="add_frequency_discount" class="form-control" min="1" max="10000" required id="frequency_discount" placeholder="Enter discount percentage">
                                                    </div>                                       
                                                </div>

                                                <!-- /.box-footer -->
                                                <div class="box-footer">
                                                    <div class="col-sm-11">
                                                        <button type="button" class="btn btn-default pull-right btn-lg bg-red">Clear</button>
                                                    </div> 
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="CreateServiceFrequencyOffer">Add</button>
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
                            <!-- /.box-body -->
                            <div class="clearfix"></div>                          

                            <div class="box-body" style="display: block;">
                                <div class="box box-primary">
                                        <!-- /.box-header -->
                                        <div class="box-header with-border">
                                            <div class="form-group">                                             
                                                <div class="col-sm-6">
                                                    <div class="btn-group" role="group" id="service_frequency_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active service_frequency_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                        <button type="button" class="btn margin btn-primary btn-sm service_frequency_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body col-sm-12">
                                            <table id="frequency_discount_list" class="table table-bordered table-striped dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Frequency</th>
                                                        <th>Offer Percentage</th>
                                                        <th>Added On</th>
                                                        <th>Updated On</th>
                                                        <th>Updated By</th>
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
                        <div role="tabpanel" class="tab-pane fade" id="addons_tab_content">.dsdfjhsj.</div>
                        <div role="tabpanel" class="tab-pane fade" id="specialrequest_tab_content">...dsahdfjhskj</div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">


            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Package Edit Modal -->
<div class="modal fade" id="servicePackageEditModal" tabindex="-1" role="dialog" aria-labelledby="servicePackageEditModalLabel">
    <div class="modal-dialog" role="document">
        <form id='editServicePackageForm' action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="servicePackageEditModalLabel">Edit Service Package</h4>
                </div>
                <div class="modal-body">
                    <!-- 
                        Modal Body
                    -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" type="submit" id="saveServicePackageEdit">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="archiveConfirmModal" tabindex="-1" role="dialog" aria-labelledby="archiveConfirmModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="archiveConfirmModalLabel">Archive Service Package</h4>
            </div>
            <div class="modal-body">
                <!-- 
                    Modal Body
                -->
                Are you sure you want to archive?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" type="submit" id="archiveConfirm">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirm Modal END -->

<!-- Service Package Tab Scripts START-->
<script>
    $(function () {

        /* Price calulation type click event */
        $(".btn-group .price_cal_type").click(function () {
            $(".btn-group button").removeClass('active');
            $(this).addClass('active');
            $("#package_price_cal").val($(this).data('val'));
        });
                 

        /* Service Package creation form handling.. */
        $("#servicePackageCreationForm").submit(function (e) {
            e.preventDefault();
            var data = $("#servicePackageCreationForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addServicePackage.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        servicePackageListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });


        var servicePackageListTable = $('#servicepackage_list').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
            "serverSide":false,
            "ajax": {
                "url": '<?php echo base_url() . 'listServicepackage.html/' . $service_detail[0]->service_id; ?>',
                "type": "POST",
                "data": function(d){                     
                    d.archived = $("#service_package_status").attr('data-val'); 
                },
                "dataSrc": 'data'
            },
            "columns": [
                {"data": "service_package_id"},
                {"data": "building_name"},
                {"data": "service_package_bedroom"},
                {"data": "service_package_bathroom"},
                {"data": "area_size"},
                {"data": "service_package_min_hours"},
                {"data": "service_package_min_crew_member"},
                {"data": "service_package_onetime_price"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 5, 6], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [4], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class="">' + row.area_size + ' ' + row.area_measurement + ' </td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [7], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class="">' + row.service_package_onetime_price + ' / ' + row.service_package_price_cal_by + ' </td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [8], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_package_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="editModalWindow btn btn-social-icon " title="Edit" data-service="' + row.service_package_service_id + '" data-id = "' + row.service_package_id + '"><i class="fa fa-edit"></i></a>';
                        if(archived == '0'){
                              string  += '<a href="#" class="btn btn-social-icon servicePackageArchive" title="Archive" data-service="' + row.service_package_service_id + '" data-id = "' + row.service_package_id + '"><i class="fa fa-archive"></i></a></div></td>';
                          }else{
                              string  += '<a href="#" class="btn btn-social-icon servicePackageUnArchive" title="Un Archive" data-service="' + row.service_package_service_id + '" data-id = "' + row.service_package_id + '"><i class="fa fa-folder-open"></i></a></div></td>';
                          }
                        return string;
                    }
                }
            ]
        });

        /* Archive / Un Archive Datatable list event */
        $(".btn-group .service_package_status_archive, .service_package_status_unarchive").click(function () {
            $(".btn-group#service_package_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_package_status").attr('data-val',$(this).data('val'));           
            servicePackageListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });

        /* Edit Service Package AJAX Call */
        $("#saveServicePackageEdit").click(function (e) {
            e.preventDefault();
            var data = $("#editServicePackageForm").serializeArray();
            var package_id = $("#edit_package_id").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'editServicePackage.html/' ?>" + package_id,
                data: data,
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        servicePackageListTable.ajax.reload(); //call datatable to reload the Ajax resource
                        $("#servicePackageEditModal").modal('hide');
                    } else {
                        notifyMessage('error', result.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });
        });

        /* Fetching the Service Package Details  */
        $(document).on('click', '.editModalWindow', function (e) {

            e.preventDefault();
            var packageId = $(this).data('id');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'editServicePackage.html/'; ?>" + packageId,
                //data: null, //{'servicePackageId': packageId},
                cache: false,
                success: function (res) {
                    $("#servicePackageEditModal .modal-body").html(res);
                    $("#servicePackageEditModal").modal('show');

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });

        });

        /* Archive/UnArchive the Service Package  */
        $(document).on('click', '.servicePackageArchive, .servicePackageUnArchive', function (e) {

            e.preventDefault();
            var packageId = $(this).data('id');
            var serviceId = $(this).data('service');
            if($(this).hasClass('servicePackageUnArchive')){
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
                    confirm:{ 
                        btnClass: 'btn-green',
                        action:function () {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'archiveServicePackage.html'; ?>",
                                data: {'servicePackageId': packageId, 'serviceId': serviceId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        servicePackageListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        $('#archiveConfirmModal').modal('hide');
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

        }); /* Archive the Service Package  END */
              

    });

</script>
<!-- Service Package Tab Scripts END-->

<!-- AJAX Response Event Handlers List-->
<script>
    $(function () {

        /* Price calulation type click event for Edit Package */
        $(document).on('click', ".btn-group .edit_price_cal_type", function () {
            $(".btn-group .edit_price_cal_type").removeClass('active');
            $(this).addClass('active');
            $("#edit_package_price_cal").val($(this).data('val'));
        });

    });
</script>

<!-- Frequency Settings Script START-->
<script>
    $(function () {

        //$("#add_frequency_select2").select2();

        var frequencyListTable = $('#frequency_discount_list').DataTable({
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
                "url": '<?php echo base_url() . 'listFrequencyOffer.html/' . $service_detail[0]->service_id; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function(d){                     
                    d.archived = $("#service_frequency_status").attr('data-val'); 
                }
            },
            "columns": [
                {"data": "service_frequency_name"},
                {"data": "service_frequency_offer_value"},
                {"data": "service_frequency_offer_created_on"},
                {"data": "service_frequency_offer_updated_on"},
                {"data": "service_frequency_offer_created_by"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_frequency_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="editFrequencyOfferWindow btn btn-social-icon " title="Edit" data-service="' + row.service_frequency_offer_service_id + '" data-freqid = "' + row.service_frequency_offer_frequency_id + '" data-id="' + row.service_frequency_offer_id + '"><i class="fa fa-edit"></i></a>';
                        if(archived == '0'){
                            string += '<a href="#" class="btn btn-social-icon frequencyPriceArchive" title="Archive" data-service="' + row.service_frequency_offer_service_id + '" data-freqid = "' + row.service_frequency_offer_frequency_id + '" data-id = "' + row.service_frequency_offer_id + '"><i class="fa fa-archive"></i></a></div></td>';
                        }else{
                            string += '<a href="#" class="btn btn-social-icon frequencyPriceUnArchive" title="Archive" data-service="' + row.service_frequency_offer_service_id + '" data-freqid = "' + row.service_frequency_offer_frequency_id + '" data-id = "' + row.service_frequency_offer_id + '"><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;
                    }
                }
            ]
        });

        /* Archived / Un Archived Datatable list event */
        $(".btn-group .service_frequency_status_archive, .service_frequency_status_unarchive").click(function () {
            $(".btn-group#service_frequency_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_frequency_status").attr('data-val',$(this).data('val'));           
            frequencyListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });

        /* Service Frequency Offer Price creation form handling.. */
        $("#serviceFrequencyOfferCreationForm").submit(function (e) {
            e.preventDefault();
            var data = $("#serviceFrequencyOfferCreationForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addServiceFrequencyOfferPrice.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        frequencyListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });


        $(document).on('click', '.editFrequencyOfferWindow', function(e){
            e.preventDefault();      
            var thisClick = $(this);
            var rowData = frequencyListTable.row($(this).closest('tr')).data();
            console.log(rowData);
            $.confirm({
                title: 'Update Offer Discount!',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'content': '' +
                    '<div class="form-group">' +
                    '<label>Frequency</label>' +
                    '<input type="text" disabled placeholder="Your name" value="'+rowData.service_frequency_name+'" class="name form-control" />' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label>Discount(%)</label>' +
                    '<input type="text" placeholder="Offer Discount" class="discount form-control" value="'+rowData.service_frequency_offer_value+'"required />' +
                    '</div>',
                buttons: {
                    update: {
                        btnClass: 'btn-green',
                        action:function () {
                                var offerVal = this.$content.find('.discount').val();
                                if(offerVal <=0){ $.alert('provide a valid discount'); return false;}
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'updateServiceFrequencyOffer.html'; ?>",
                                data: {'freqOfferId': rowData.service_frequency_offer_id, 'serviceId': rowData.service_frequency_offer_service_id, 'frequencyId':rowData.service_frequency_offer_frequency_id, 'offerVal':offerVal},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        frequencyListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
                                    } else {
                                        notifyMessage('error', result.message);
                                        $(thisClick).trigger('click');
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
                            //close window
                        }
                    }
                }
            });
        
        });

        /* Archive/UnArchive the Service Frequency Offer  */
        $(document).on('click', '.frequencyPriceUnArchive, .frequencyPriceArchive', function (e) {

            e.preventDefault();
            var freqOfferId = $(this).data('id');
            var serviceId = $(this).data('service');
            var freqId = $(this).data('freqid');
            
            if($(this).hasClass('frequencyPriceUnArchive')){
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
                                url: "<?php echo base_url() . 'archiveServiceFrequencyOffer.html'; ?>",
                                data: {'freqOfferId': freqOfferId, 'serviceId': serviceId, 'frequencyId':freqId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        frequencyListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        $('#archiveConfirmModal').modal('hide');
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

        }); /* Archive/UnArchive the Service Frequency Offer  END */


    });

</script>