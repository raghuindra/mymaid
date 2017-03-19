<?php
$package = $package_detail[0];
//print_r($package);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-horizontal">
            <div class="box-body">
                <!-- Service Package Creation Form Start -->
                
                    <input type="hidden" name="edit_package_service_id" class="form-control" id="edit_package_service_id" value="<?php echo $package->service_package_service_id; ?>">
                    <input type="hidden" name="edit_package_id" class="form-control" id="edit_package_id" value="<?php echo $package->service_package_id; ?>">
                

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Building Type *:</label>
                    <div class="col-sm-6">
                        <select class="form-control select2" style="width: 100%;" name="edit_package_building_type" id="edit_package_building_type" required>
                            <option value="">Select building type</option>
                            <?php
                            if (isset($buildings) && !empty($buildings)) {
                                foreach ($buildings as $building) {
                                    if ($building->building_id == $package->service_package_building_id) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $building->building_id . "' " . $selected . " >" . $building->building_name . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Number of Bedrooms *:</label>
                    <div class="col-sm-6">
                        <input type="number" name="edit_package_bathrooms" class="form-control" min="1" max="50" required id="edit_package_bathrooms" placeholder="Number of bedrooms" value="<?php echo $package->service_package_bedroom; ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Number of Bathrooms *:</label>
                    <div class="col-sm-6">
                        <input type="number" name="edit_package_bedrooms" class="form-control" min="1" max="50" required id="edit_package_bedrooms" placeholder="Number of bathrooms" value="<?php echo $package->service_package_bathroom; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Building Area :</label>
                    <div class="col-sm-6">
                        <select class="form-control select2" style="width: 100%;" name="edit_package_building_area" id="edit_package_building_area">
                            <option value="">Select building area</option>
                            <?php
                            if (isset($area_sizes) && !empty($area_sizes)) {
                                foreach ($area_sizes as $area) {
                                    if ($area->area_id == $package->service_package_building_area_id) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $area->area_id . "' " . $selected . ">" . $area->area_size . " - " . $area->area_measurement . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Number of Crew/s *:</label>
                    <div class="col-sm-6">
                        <input type="number" name="edit_package_crews" class="form-control" min="1" max="100" required id="edit_package_crews" placeholder="Number of crew/s" value="<?php echo $package->service_package_min_crew_member; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Package Hours:</label>
                    <div class="col-sm-6">
                        <input type="number" name="edit_package_hours" class="form-control" min="1" max="100" id="edit_package_hours" placeholder="Number of hours" value="<?php echo $package->service_package_min_hours; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Package Price *:</label>
                    <div class="col-sm-6">
                        <input type="number" name="edit_package_price" class="form-control" min="1" max="10000" required id="edit_package_price" placeholder="Enter price" value="<?php echo $package->service_package_onetime_price; ?>">
                    </div>                                       
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Calculate Price by *:</label>
                    <div class="col-sm-6">
                        <div class="btn-group" role="group" aria-label="Calculate Price by">
                            <button type="button" class="btn margin btn-primary btn-sm edit_price_cal_type <?php if($package->service_package_price_cal_by == 'hour') { echo 'active';} ?>" data-val="hour">Per Hour</button>
                            <button type="button" class="btn margin btn-primary btn-sm edit_price_cal_type <?php if($package->service_package_price_cal_by == 'package') { echo 'active';} ?>" data-val="package">Per Package</button>
                            <input type="hidden" name="edit_package_price_cal" class="form-control" required id="edit_package_price_cal" value="<?php echo $package->service_package_price_cal_by; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Package Description:</label>
                    <div class="col-sm-6">
                        <textarea class="form-control col-sm-3" rows="3" style="max-height: 100px;max-width: 600px;" name="edit_package_description" placeholder="Enter short description about package, any information for the user"><?php echo $package->service_package_description; ?></textarea>

                    </div>                                       
                </div>
            </div>
            
        </div>
    </div>
</div>


