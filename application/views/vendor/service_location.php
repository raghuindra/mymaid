<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
//echo "<pre>";print_r($company_info);echo "</pre>";
//$company = $company_info['data'];
//$vendorId = $this->session->userdata('user_id');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Service Location
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb ">
            <li><a href="./vendor_home.html"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Service Location</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active "><a href="#service_location_tab_content" data-toggle="tab">Location</a></li>
                        <!--                        <li role="presentation"><a href="#employee_tab_content" data-toggle="tab">Employees</a></li>-->
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Company Detail TAB Start -->
                        <div role="tabpanel" class="tab-pane active" id="service_location_tab_content">
                            <form id="service_location_form" method="post" action="">
                                <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Add Service Locations</h3>

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
                                                        <label for="inputEmail3" class="col-sm-3 control-label">State: <span class="text-red">*</span></label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control stateSelect select2" style="width: 100%;" name="stateSelect" id="stateSelect" required>
                                                                <option value="">Select state</option>
                                                                <?php
                                                                if (isset($states)) {
                                                                    if (!empty($states)) {
                                                                        foreach ($states as $state) {
                                                                            echo "<option value='" . $state->state_code . "'> " . $state->state_name . "</option>";
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">City: <span class="text-red">*</span></label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control areaSelect select2" style="width: 100%;" name="areaSelect" id="areaSelect" multiple="multiple" required>
                                                                <option value="">Select city</option>                      
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">City Pin codes: <span class="text-red">*</span></label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control postcodeSelect select2" style="width: 100%;" name="postcodeSelect[]" id="postcodeSelect" multiple="multiple" required>
                                                                <option value="">Select pin codes (Multi Select)</option>                      
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="box-footer">
                                                        <div class="col-sm-10">
                                                            <button type="button" class="btn btn-default pull-right btn-lg bg-maroon formReset">Clear</button>
                                                        </div> 
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="addServiceLocation">Add</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>

                                            </div>
                                            <!-- /.box-body -->
                                        </div>

                                    </div>
                                    <!-- /.box -->

                                </div>
                            </form>
                            
                            <div class="clearfix"></div>

                            <div class="box box-default box-solid">
                                <!-- /.box-header -->
                                <div class="box-header with-border">
                                    <h3 class="box-title">Service Locations List</h3>

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
                                                    <div class="btn-group" role="group" id="service_location_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active service_location_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button> 
                                                        <button type="button" class="btn margin btn-primary btn-sm service_location_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="form-horizontal">

                                            <div class="box-body">
                                                <table id="service_location_list" class="table table-bordered table-striped tables-button-edit">
                                                    <thead>
                                                        <tr>
                                                            <th>ID </th>
                                                            <th>Postcode</th>
                                                            <th>Added oN</th>                               
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
                        <!-- /. Service Location TAB Start -->

                        <!-- Employee Detail TAB Start -->
                        <div role="tabpanel" class="tab-pane active" id="employee_tab_content">
                            <div class="box box-default box-solid">


                            </div>

                            <div class="clearfix"></div>

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

<!-- pekeUpload -->
<script type="text/javascript" src="<?php echo plugin_url('plugins/pekeUpload/pekeUpload.js'); ?>"></script>
<script>
    $(function () {

        $(".stateSelect").select2({
            placeholder: "Select state",
            allowClear: true
        });
        $(".areaSelect").select2({
            placeholder: "Select areas",
            allowClear: true
        }).prop("disabled", true);
        $(".postcodeSelect").select2({
            placeholder: "Select postcodes",
            allowClear: true
        }).prop("disabled", true);


        //On change of statecode load areas
        $(document).on('change', '#stateSelect', function () {

            var stateCode = $(this).val();

            if (stateCode !== '') {
                $(".areaSelect").next().block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'getVendorPostOffices.html'; ?>",
                    data: {stateCode: stateCode}, //{'servicePackageId': packageId},
                    cache: false,
                    success: function (res) {
                        var result = JSON.parse(res);
                        if (result.status) {
                            var areas = result.data;

                            $(".areaSelect").empty();
                            areas.forEach(function (area) {
                                $(".areaSelect").append('<option value="' + area.post_office + '">' + area.post_office + '</option>');
                            });
                            $(".areaSelect").prop("disabled", false);
                            $(".areaSelect").next().unblock();
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notifyMessage('error', errorThrown);
                    }
                });
            }

        });

        //On change of areas load pincodes
        $(document).on('change', '#areaSelect', function () {

            var areaCode = $(this).val();

            if (areaCode !== null && areaCode.length > 0) {
                $(".postcodeSelect").next().block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'getVendorPostcodes.html'; ?>",
                    data: {areaCode: areaCode},
                    cache: false,
                    success: function (res) {
                        var result = JSON.parse(res);
                        if (result.status) {
                            var areas = result.data;

                            $(".postcodeSelect").empty();
                            areas.forEach(function (area) {
                                $(".postcodeSelect").append('<option value="' + area.postcode + '">' + area.postcode + '</option>');
                            });
                            $(".postcodeSelect").prop("disabled", false);
                            $(".postcodeSelect").next().unblock();
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        notifyMessage('error', errorThrown);
                    }
                });
            }

        });


        /* Service Location List Datatable */
        var serviceLocationListTable = $('#service_location_list').DataTable({
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
                "url": '<?php echo base_url() . 'listServiceLocation.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    d.archived = $("#service_location_status").attr('data-val');
                }
            },
            "columns": [
                {"data": "vendor_service_location_id"},
                {"data": "vendor_service_location_postcode"},
                {"data": "vendor_service_location_added_on"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [3], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_location_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">';                               
                        if (archived == '0') {
                            string += '<a href="#" class="btn btn-social-icon serviceLocationArchive" title="Archive" ><i class="fa fa-archive"></i></a></div></td>';
                        } else {
                            string += '<a href="#" class="btn btn-social-icon serviceLocationUnArchive" title="UnArchive" ><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;
                    }
                }
            ]
        });


        /* Archived / Un Archived Service Location Datatable list */
        $(document).on("click", ".btn-group .service_location_status_archive, .service_location_status_unarchive", function () {
            $(".btn-group#service_location_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_location_status").attr('data-val', $(this).data('val'));
            serviceLocationListTable.ajax.reload(); //call datatable to reload the Ajax resource

        });

        /* Service Location creation form handling.. */
        $("#service_location_form").submit(function (e) {
            e.preventDefault();
            var data = $("#service_location_form").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addServiceLocation.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        serviceLocationListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });

        /* Reset Form */
        $(document).on("click", ".formReset", function () {
            resetForm($(this).closest('form'));
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, select, textarea').val('');
            $form.find(':input[type=number]').val('');
            $form.find(".select2").val(null).trigger("change");
            $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        }

        /* Archive/UnArchive Service Location START  */
        $(document).on('click', '.serviceLocationArchive, .serviceLocationUnArchive', function (e) {

            e.preventDefault();
            var rowData = serviceLocationListTable.row($(this).closest('tr')).data();
            var locationId = rowData.vendor_service_location_id;

            if ($(this).hasClass('serviceLocationUnArchive')) {
                archive = <?php echo Globals::UN_ARCHIVE; ?>;
                message = "Are you sure you want to un-archive?";
            } else {
                archive = <?php echo Globals::ARCHIVE; ?>;
                message = "Are you sure you want to archive?";
            }

            $.confirm({
                icon: 'fa fa-warning',
                title: 'Confirm!',
                content: message,
                content: function(){
                    var self = this;
                    //self.setContent('Checking callback flow');
                    return $.ajax({
                        url: '<?php echo base_url() . 'check_active_service_for_pincode.html'; ?>',
                        dataType: 'html',
                        method: 'post',
                        data:{'archive':archive, 'locationId': locationId}
                    }).done(function (response) {
                        var res = JSON.parse(response);
                        self.setContentAppend(res.message);
                    }).fail(function(){
                        self.setContentAppend('<br>Fail to load!');
                    }).always(function(){
                        //self.setContentAppend("sdsa");
                    });
                },
                contentLoaded: function(data, status, xhr){
                    //self.setContentAppend(data);
                },
                onContentReady: function(){
                    
                },
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                buttons: {
                    confirm: {
                        btnClass: 'btn-green',
                        action: function () {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'archiveServiceLocation.html'; ?>",
                                data: {'locationId': locationId, 'archive': archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        serviceLocationListTable.ajax.reload(); //call datatable to reload the Ajax resource

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
                        action: function () {

                        }
                    }
                }
            });

        }); /* Archive/UnArchive Service Location END */

    });


</script>    
