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
                                                <table id="servicepackage_list" class="table table-bordered table-striped tables-button-edit">
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
                                                        <button type="button" class="btn btn-default pull-right btn-lg bg-red formReset">Clear</button>
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
                        <!-- Service Frequency Price Settings TAB ENDS -->
                        
                        
                        <!-- Service Addons Price Settings TAB START -->
                        <div role="tabpanel" class="tab-pane fade" id="addons_tab_content">
                            <div class="box-body" >
                                <div class="box box-primary">

                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <!-- Service Addon Price Creation Form Start -->
                                            <form action="" name="serviceAddonPriceCreationForm" id="serviceAddonPriceCreationForm">
                                                <div class="form-group">
                                                    <input type="hidden" name="add_addons_price_service_id" class="form-control" id="add_addons_price_service_id" value="<?php echo $service_detail[0]->service_id; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Frequency *:</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control select2" style="width: 100%;" name="add_addons_price_addon_id" id="add_addons_price_addon_id" required>
                                                            <option selected="selected" value="">Select frequency</option>
                                                            <?php
                                                            if (isset($service_addons) && !empty($service_addons)) {
                                                                foreach ($service_addons as $addon) {
                                                                    echo "<option value='" . $addon->service_addon_id . "'>" . $addon->service_addon_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Price *:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="add_addon_price" class="form-control" min="1" max="10000" required id="addon_price" placeholder="Enter addon price">
                                                    </div>                                       
                                                </div>

                                                <!-- /.box-footer -->
                                                <div class="box-footer">
                                                    <div class="col-sm-11">
                                                        <button type="button" class="btn btn-default pull-right btn-lg bg-red formReset">Clear</button>
                                                    </div> 
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="CreateServiceAddonPrice">Add</button>
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
                                                    <div class="btn-group" role="group" id="service_addons_price_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active service_addons_price_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                        <button type="button" class="btn margin btn-primary btn-sm service_addons_price_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body col-sm-12">
                                            <table id="service_addons_price_list" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Addon</th>
                                                        <th>Addon Price</th>
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
                        <!-- Service Addons Price Settings TAB END -->
                        
                        
                        <!-- Service Special Request Settings TAB START -->
                        <div role="tabpanel" class="tab-pane fade" id="specialrequest_tab_content">
                            
                            <div class="box-body" >
                                <div class="box box-primary">

                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <!-- Service Special Request Creation Form Start -->
                                            <form action="" name="serviceSplRequestCreationForm" id="serviceSplRequestCreationForm">
                                                <div class="form-group">
                                                    <input type="hidden" name="add_service_spl_service_id" class="form-control" id="add_service_spl_service_id" value="<?php echo $service_detail[0]->service_id; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Special Request *:</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control select2" style="width: 100%;" name="add_spl_request_id" id="add_spl_request_id" required>
                                                            <option selected="selected" value="">Select special request</option>
                                                            <?php
                                                            if (isset($spl_request) && !empty($spl_request)) {
                                                                foreach ($spl_request as $request) {
                                                                    echo "<option value='" . $request->spl_request_id . "'>" . $request->spl_request_name . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Price (if required):</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="add_service_spl_request_price" class="form-control" min="1" max="10000"  id="add_service_spl_request_price" placeholder="Enter special request price if required else free">
                                                    </div>                                       
                                                </div>

                                                <!-- /.box-footer -->
                                                <div class="box-footer">
                                                    <div class="col-sm-11">
                                                        <button type="button" class="btn btn-default pull-right btn-lg bg-red formReset">Clear</button>
                                                    </div> 
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="CreateServiceSplRequest">Add</button>
                                                    </div>
                                                </div>
                                                <!-- /.box-footer -->

                                            </form>
                                            <!-- Service Special Request Creation Form End -->
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
                                                    <div class="btn-group" role="group" id="service_spl_request_status" aria-label="Archive Un Archive condition" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active service_spl_request_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                        <button type="button" class="btn margin btn-primary btn-sm service_spl_request_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body col-sm-12">
                                            <table id="service_spl_request_list" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Addon</th>
                                                        <th>Addon Price</th>
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
                        <!-- Service Special Request Settings TAB ENDS -->
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
<!-- /.Package Edit Modal ENDs -->

<!-- Postal Code Modal -->
<div class="modal fade bs-example-modal-md" id="postalCodeModal" tabindex="-1" role="dialog" aria-labelledby="postalCodeModalLabel">
    <div class="modal-dialog modal-md" role="document">        
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="postalCodeModalLabel">Set Package Price by Postcode</h4>
                </div>
                <div class="modal-body">
                    <!-- 
                        Modal Body
                    -->
                </div>
<!--                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" type="submit" id="setPostalcodePrice">Save changes</button>
                </div>-->
            </div>
    </div>
</div>
<!-- /. Postal code Modal Ends -->

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


        servicePackageListTable = $('#servicepackage_list').DataTable({
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
                                + '<a href="#" class="editModalWindow btn btn-social-icon " title="Edit" data-service="' + row.service_package_service_id + '" data-id = "' + row.service_package_id + '"><i class="fa fa-edit"></i></a>'
                                + '<a href="#" class="btn btn-social-icon pincodePrice" title="Pincode Price" data-service="' + row.service_package_service_id + '" data-id = "' + row.service_package_id + '"><i class="fa fa-globe"></i></a>';
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
    
    $(document).on("click", ".formReset", function(){
        resetForm($(this).closest('form'));
    });
    
    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find(':input[type=number]').val('');
        $form.find(".select2").val(null).trigger("change");
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    }


</script>
<!-- Service Package Tab Scripts END-->

<!-- AJAX Response Event Handlers List-->
<script>
    $(function () {

        /* Price calculation type click event for Edit Package */
        $(document).on('click', ".btn-group .edit_price_cal_type", function () {
            $(".btn-group .edit_price_cal_type").removeClass('active');
            $(this).addClass('active');
            $("#edit_package_price_cal").val($(this).data('val'));
        });

    });
</script>


    <!-- JQUERY Events for the form loaded from AJAX(Pincode Price) STARTs -->
<script>
    $(function(){
        var service_package_postal_price;
         var postcodeDatatableObject = {
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
                "url": "<?php echo base_url() . 'getServicePackagePostalPrice.html'; ?>",
                "type": "POST",
                "data": function(d){                     
                    d.archived = $("#service_package_postal_price_status").attr('data-val');
                    d.package_id = $("#postalCodeModal").data('val').service_package_id;
                },
                "dataSrc": 'data'
            },
            "columns": [
                {"data": "postcode_service_price_package_id"},
                {"data": "postcode_service_price_postcode"},
                {"data": "postcode_service_price_price"},
                {"data": "postcode_service_price_created_on"},
                {"data": "postcode_service_price_updated_on"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_package_postal_price_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="btn btn-social-icon editPostcodePrice" title="Edit" data-package="' + row.postcode_service_price_package_id + '" data-id = "' + row.postcode_service_price_id + '"><i class="fa fa-edit"></i></a>';
                                
                        if(archived === '0'){
                              string  += '<a href="#" class="btn btn-social-icon servicePackagePostcodePriceArchive" title="Archive" data-package="' + row.postcode_service_price_package_id + '" data-id = "' + row.postcode_service_price_id + '"><i class="fa fa-archive"></i></a></div></td>';
                          }else{
                              string  += '<a href="#" class="btn btn-social-icon servicePackagePostcodePriceUnArchive" title="Un Archive" data-package="' + row.postcode_service_price_package_id + '" data-id = "' + row.postcode_service_price_id + '"><i class="fa fa-folder-open"></i></a></div></td>';
                          }
                        return string;
                    }
                }
            ]
        };
        
        /* Archived / Un Archived Datatable list event */
        $(document).on("click",".btn-group .service_package_postal_price_status_archive, .service_package_postal_price_status_unarchive",function () {
            $(".btn-group#service_package_postal_price_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_package_postal_price_status").attr('data-val',$(this).data('val'));           
            service_package_postal_price.ajax.reload(); //call datatable to reload the Ajax resource
            
        });
        
        /* Load the Pincode Price setting modal window START */           
        $(document).on('click', '.pincodePrice', function(e){
        var thisClick = $(this);
        var rowData = servicePackageListTable.row($(this).closest('tr')).data();
        console.log(rowData);
        $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'getServicePackagePostalPrice.html'; ?>",
                data: {'packageId': rowData.service_package_id},
                cache: false,
                success: function (res) {
                    $("#postalCodeModal .modal-body").html(res);
                    $("#postalCodeModal").modal('show');
                    $("#postalCodeModal").data('val',rowData);
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
                    service_package_postal_price = $('#service_package_postal_price').DataTable(postcodeDatatableObject);
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    notifyMessage('error', errorThrown);
                }
            });
            
        });       
        /* Load the Pincode Price setting modal window END */ 
              
            
        //On change of statecode load areas
        $(document).on('change', '#stateSelect', function(){

            var stateCode = $(this).val();
            
            if(stateCode !== ''){
                $(".areaSelect").next().block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'getPostOffices.html'; ?>",
                    data: {stateCode:stateCode}, //{'servicePackageId': packageId},
                    cache: false,
                    success: function (res) {
                        var result = JSON.parse(res);
                        if(result.status){
                            var areas = result.data;

                            $(".areaSelect").empty();
                            areas.forEach(function(area){
                                $(".areaSelect").append('<option value="'+area.post_office+'">'+area.post_office+'</option>');
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
        $(document).on('change', '#areaSelect', function(){

            var areaCode = $(this).val(); console.log(areaCode);
            var rowdata  = $("#postalCodeModal").data('val');
            var packageId  = rowdata.service_package_id;
            
            if(areaCode!== null &&  areaCode.length > 0){
                $(".postcodeSelect").next().block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'getPostcodes.html'; ?>",
                    data: {areaCode:areaCode, packageId: packageId}, //{'servicePackageId': packageId},
                    cache: false,
                    success: function (res) {
                        var result = JSON.parse(res);
                        if(result.status){ 
                            var areas = result.data;

                            $(".postcodeSelect").empty();
                            areas.forEach(function(area){
                                $(".postcodeSelect").append('<option value="'+area.postcode+'">'+area.postcode+'</option>');
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
            
        /* Postcode Price creation form handling.. */
        $(document).on("submit","#setPostalcodePriceForm", function (e) {
            e.preventDefault();
            var rowdata  = $("#postalCodeModal").data('val');
            var data = {
                stateSelect: $(".stateSelect").val(),
                areaSelect: $(".areaSelect").val(),
                postcodeSelect: $(".postcodeSelect").val(),
                postcodePrice: $(".postcodePrice").val(),          
                packageId: rowdata.service_package_id,
                serviceId: rowdata.service_package_service_id
            }
                console.log(data); 
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'setServicePackagePostalPrice.html' ?>",
                data: data,
                cache: false,
                success: function (res) {
console.log(res);
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        service_package_postal_price.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });
              
        /* Postcode Price Edit popup window START */
        $(document).on('click', '.editPostcodePrice', function(e){
            e.preventDefault();      
            var thisClick = $(this);
            var rowData = service_package_postal_price.row($(this).closest('tr')).data();
            //console.log(rowData);
            $.confirm({
                title: 'Update Offer Discount!',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'content': '' +
                    '<div class="form-group">' +
                    '<label>Frequency</label>' +
                    '<input type="text" disabled placeholder="postcode" value="'+rowData.postcode_service_price_postcode+'" class="name form-control" />' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label>Postcode Price</label>' +
                    '<input type="number" step="0.5" placeholder="Postcode price" class="postcodePrice form-control" value="'+rowData.postcode_service_price_price+'"required />' +
                    '</div>',
                buttons: {
                    update: {
                        btnClass: 'btn-green',
                        action:function () {
                                var priceVal = this.$content.find('.postcodePrice').val();
                                if( priceVal <= 0){ $.alert('provide a valid price'); return false;}
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'updateServicePackagePostcodePrice.html'; ?>",
                                data: {'postcodePriceId': rowData.postcode_service_price_id, 'packageId': rowData.postcode_service_price_package_id, 'postcode':rowData.postcode_service_price_postcode, 'priceVal':priceVal},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        service_package_postal_price.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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
        /* Postcode Price Edit popup window END */
   
        /* Archive/UnArchive the Service Package Postcode Price START  */
        $(document).on('click', '.servicePackagePostcodePriceArchive, .servicePackagePostcodePriceUnArchive', function (e) {

            e.preventDefault();
            var postCodePriceId = $(this).data('id');
            var packageId = $(this).data('package');
            
            if($(this).hasClass('servicePackagePostcodePriceUnArchive')){
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
                                url: "<?php echo base_url() . 'archiveServicePackagePostcodePrice.html'; ?>",
                                data: {'packageId': packageId, 'postcodePriceId':postCodePriceId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        service_package_postal_price.ajax.reload(); //call datatable to reload the Ajax resource
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
                    cancel: {
                    btnClass: 'btn-red',
                    action:function () {

                        }
                    }
                }
            });

        }); /* Archive/UnArchive the Service Package Postcode Price  END */
        
    });
</script>
<!-- JQUERY Events for the form loaded from AJAX(Pincode Price) ENDs -->

<!-- Frequency Settings Script START-->
<script>
    $(function () {

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
            //console.log(rowData);
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
<!-- Frequency Settings Script END-->


<!-- Service Addons Settings Script START-->
<script>

$(function () {
    
      var addonsPriceListTable = $('#service_addons_price_list').DataTable({
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
                "url": "<?php echo base_url() . 'listserviceAddonsPrice.html'; ?>",
                "type": "POST",
                "dataSrc": 'data',
                "data": function(d){                     
                    d.archived = $("#service_addons_price_status").attr('data-val');
                    d.serviceId = '<?php echo $service_detail[0]->service_id;?>';
                }
            },
            "columns": [
                {"data": "service_addon_name"},
                {"data": "service_addon_price_price"},
                {"data": "service_addon_price_created_on"},
                {"data": "service_addon_price_updated_on"},
                {"data": "service_addon_price_updated_by"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_addons_price_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="editServiceAddonPriceWindow btn btn-social-icon " title="Edit" data-service="' + row.service_addon_price_service_id + '" data-addonid = "' + row.service_addon_price_addon_id + '" data-id="' + row.service_addon_price_id + '"><i class="fa fa-edit"></i></a>';
                        if(archived == '0'){
                            string += '<a href="#" class="btn btn-social-icon serviceAddonPriceArchive" title="Archive" data-service="' + row.service_addon_price_service_id + '" data-addonid = "' + row.service_addon_price_addon_id + '" data-id = "' + row.service_addon_price_id + '"><i class="fa fa-archive"></i></a></div></td>';
                        }else{
                            string += '<a href="#" class="btn btn-social-icon serviceAddonPriceUnArchive" title="Archive" data-service="' + row.service_addon_price_service_id + '" data-addonid = "' + row.service_addon_price_addon_id + '" data-id = "' + row.service_addon_price_id + '"><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;
                    }
                }
            ]
        });

        /* Archived / Un Archived Datatable list event */
        $(".btn-group .service_addons_price_status_archive, .service_addons_price_status_unarchive").click(function () {
            $(".btn-group#service_addons_price_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_addons_price_status").attr('data-val',$(this).data('val'));           
            addonsPriceListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });

        /* Service Addon Price creation form handling.. */
        $("#serviceAddonPriceCreationForm").submit(function (e) {
            e.preventDefault();
            var data = $("#serviceAddonPriceCreationForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addServiceAddonPrice.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        addonsPriceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });


        $(document).on('click', '.editServiceAddonPriceWindow', function(e){
            e.preventDefault();      
            var thisClick = $(this);
            var rowData = addonsPriceListTable.row($(this).closest('tr')).data();
            //console.log(rowData);
            $.confirm({
                title: 'Update Addon Price!',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'content': '' +
                    '<div class="form-group">' +
                    '<label>Addon</label>' +
                    '<input type="text" disabled placeholder="Your name" value="'+rowData.service_addon_name+'" class="name form-control" />' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label>Price</label>' +
                    '<input type="text" placeholder="Offer Discount" class="price form-control" value="'+rowData.service_addon_price_price+'"required />' +
                    '</div>',
                buttons: {
                    update: {
                        btnClass: 'btn-green',
                        action:function () {
                                var priceVal = this.$content.find('.price').val();
                                if(priceVal <=0){ $.alert('provide a price'); return false;}
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'updateServiceAddonPrice.html'; ?>",
                                data: {'addonPriceId': rowData.service_addon_price_id, 'serviceId': rowData.service_addon_price_service_id, 'addonId':rowData.service_addon_price_addon_id, 'priceVal':priceVal},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        addonsPriceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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

        /* Archive/UnArchive the Service Addon Price  */
        $(document).on('click', '.serviceAddonPriceUnArchive, .serviceAddonPriceArchive', function (e) {

            e.preventDefault();
            var addonPriceId = $(this).data('id');
            var serviceId = $(this).data('service');
            var addonId = $(this).data('addonid');
            
            if($(this).hasClass('serviceAddonPriceUnArchive')){
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
                                url: "<?php echo base_url() . 'archiveServiceAddonPrice.html'; ?>",
                                data: {'addonPriceId': addonPriceId, 'serviceId': serviceId, 'addonId':addonId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        addonsPriceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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

        }); /* Archive/UnArchive the Service Addon Price  END */

    
    
});

</script>
<!-- Service Addons Settings Script END-->


<!-- Service Special Request Script START-->
<script>

$(function () {
    
      var splRequestListTable = $('#service_spl_request_list').DataTable({
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
                "url": "<?php echo base_url() . 'listserviceSplRequest.html'; ?>",
                "type": "POST",
                "dataSrc": 'data',
                "data": function(d){                     
                    d.archived = $("#service_spl_request_status").attr('data-val');
                    d.serviceId = '<?php echo $service_detail[0]->service_id;?>';
                }
            },
            "columns": [
                {"data": "spl_request_name"},
                {"data": "service_spl_request_price"},
                {"data": "service_spl_request_created_on"},
                {"data": "service_spl_request_updated_on"},
                {"data": "service_spl_request_updated_by"},
                {"data": null},
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [5], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        var archived = $("#service_spl_request_status").attr('data-val');
                        var string = ' <td class=""> <div class="text-center">'
                                + '<a href="#" class="editServiceSplRequestWindow btn btn-social-icon " title="Edit" data-service="' + row.service_spl_request_service_id + '" data-splreqid = "' + row.service_spl_request_spl_request_id + '" data-id="' + row.service_spl_request_id + '"><i class="fa fa-edit"></i></a>';
                        if(archived == '0'){
                            string += '<a href="#" class="btn btn-social-icon serviceSplRequestArchive" title="Archive" data-service="' + row.service_spl_request_service_id + '" data-splreqid = "' + row.service_spl_request_spl_request_id + '" data-id = "' + row.service_spl_request_id + '"><i class="fa fa-archive"></i></a></div></td>';
                        }else{
                            string += '<a href="#" class="btn btn-social-icon serviceSplRequestUnArchive" title="Archive" data-service="' + row.service_spl_request_service_id + '" data-splreqid = "' + row.service_spl_request_spl_request_id + '" data-id = "' + row.service_spl_request_id + '"><i class="fa fa-folder-open"></i></a></div></td>';
                        }
                        return string;
                    }
                }
            ]
        });

        /* Archived / Un Archived Datatable list event */
        $(".btn-group .service_spl_request_status_archive, .service_spl_request_status_unarchive").click(function () {
            $(".btn-group#service_spl_request_status button").removeClass('active');
            $(this).addClass('active');
            $("#service_spl_request_status").attr('data-val',$(this).data('val'));           
            splRequestListTable.ajax.reload(); //call datatable to reload the Ajax resource
            
        });

        /* Service Addon Price creation form handling.. */
        $("#serviceSplRequestCreationForm").submit(function (e) {
            e.preventDefault();
            var data = $("#serviceSplRequestCreationForm").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'addServiceSplRequest.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        splRequestListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });


        $(document).on('click', '.editServiceSplRequestWindow', function(e){
            e.preventDefault();      
            var thisClick = $(this);
            var rowData = splRequestListTable.row($(this).closest('tr')).data();
            console.log(rowData);
            $.confirm({
                title: 'Update Spl Request!',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'content': '' +
                    '<div class="form-group">' +
                    '<label>Addon</label>' +
                    '<input type="text" disabled placeholder="Your name" value="'+rowData.spl_request_name+'" class="name form-control" />' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label>Price</label>' +
                    '<input type="text" placeholder="Offer Discount" class="price form-control" value="'+rowData.service_spl_request_price+'"required />' +
                    '</div>',
                buttons: {
                    update: {
                        btnClass: 'btn-green',
                        action:function () {
                                var priceVal = this.$content.find('.price').val();
                                if(priceVal <=0){ $.alert('provide a price'); return false;}
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'updateServiceSplRequest.html'; ?>",
                                data: {'serviceSplReqId': rowData.service_spl_request_id, 'serviceId': rowData.service_spl_request_service_id, 'splReqId':rowData.service_spl_request_spl_request_id, 'priceVal':priceVal},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        splRequestListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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

        /* Archive/UnArchive the Service Spl Request  */
        $(document).on('click', '.serviceSplRequestUnArchive, .serviceSplRequestArchive', function (e) {

            e.preventDefault();
            var serviceSplReqId = $(this).data('id');
            var serviceId = $(this).data('service');
            var splReqId = $(this).data('splreqid');
            
            if($(this).hasClass('serviceSplRequestUnArchive')){
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
                                url: "<?php echo base_url() . 'archiveServiceSplRequest.html'; ?>",
                                data: {'serviceSplReqId': serviceSplReqId, 'serviceId': serviceId, 'splReqId':splReqId, 'archive':archive},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        splRequestListTable.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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

        }); /* Archive/UnArchive the Service Spl Request  END */

    
    
});

</script>
<!-- Service Special Request Script END-->