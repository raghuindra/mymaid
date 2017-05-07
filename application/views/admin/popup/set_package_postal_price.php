<?php
//$package = $package_detail[0];
//print_r($package);
?>

<div class="row">
    <div class="col-xs-12">
        <div class="form-horizontal">
            <div class="box box-default box-solid">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title ">Add Postcode Price</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
            <div class="box-body">
                <!-- Service package Postcode Price addition Form Start -->
                <form id='setPostalcodePriceForm' name="setPostalcodePriceForm" action="" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">State *:</label>
                    <div class="col-sm-6">
                        <select class="form-control stateSelect select2" style="width: 100%;" name="stateSelect" id="stateSelect" required>
                            <option value="">Select state</option>
                            <?php if(isset($states)){
                                    if(!empty($states)){
                                        foreach($states as $state){
                                            echo "<option value='".$state->state_code."'> ".$state->state_name."</option>";
                                        }
                                    }
                                
                            }?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">City *:</label>
                    <div class="col-sm-6">
                        <select class="form-control areaSelect select2" style="width: 100%;" name="areaSelect" id="areaSelect" multiple="multiple" required>
                            <option value="">Select city</option>                      
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">City Pin codes *:</label>
                    <div class="col-sm-6">
                         <select class="form-control postcodeSelect select2" style="width: 100%;" name="postcodeSelect" id="postcodeSelect" multiple="multiple" required>
                            <option value="">Select pin codes (Multi Select)</option>                      
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label"> Price *:</label>
                    <div class="col-sm-6">
                         <input type="number" step="0.5" name="postcodePrice" class="form-control postcodePrice" min="1" max="10000" id="postcodePrice" placeholder="Enter price" required>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-default pull-right btn-lg bg-red formReset">Clear</button>
                    </div> 
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="addServicePackagePostcodePrice">Add</button>
                    </div>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box-body -->
            </div>
            <div class="clearfix"></div>                          
            <div class="box box-default box-solid">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title ">Postcode Price List</h3>

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
                    <div class="box-header with-border hidden">
                        <div class="form-group">                                             
                            <div class="col-sm-6">
                                <div class="btn-group" role="group" aria-label="Archive Un Archive condition" id="service_package_postal_price_status" data-val="<?php echo Globals::UN_ARCHIVE; ?>">
                                    <button type="button" class="btn margin btn-primary btn-sm active service_package_postal_price_status_unarchive" data-val="<?php echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                    <button type="button" class="btn margin btn-primary btn-sm service_package_postal_price_status_archive" data-val="<?php echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body col-sm-12">
                        <table id="service_package_postal_price" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Package Id</th>
                                    <th>Postcode</th>
                                    <th>Special Price</th>
                                    <th>Created On</th>
                                    <th>Updated On</th>
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
    </div>
</div>

