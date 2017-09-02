<?php
//print_r($response); exit;

if ($response['status']) {
    ?>
<form name="assign_job_form" class="assign_job_form" method="post" id="assign_job_form">
    <div class="row">
        <div class="col-xs-12">

            <div class="form-horizontal">
                <div class="box-body">                
                    
                    <div class="form-group">
                        <label for="state" class="col-sm-4 control-label">Company: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <select id="assign_company" name="assign_company" required class="form-control assign_company">
                                <option value="">Select company</option>
                                <?php
                                foreach ($response['data'] as $value) {
                                    
                                    echo '<option value="' . $value->company_id . '">' . $value->company_name . '</option>';

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php echo "<b class='text-red'>*Note:</b> Please assign '".$response['extra']['crew_count']."' employee/s for each service date..!" ?>
                </div>
            </div>
            <div id="employee_service_rows"></div>
        </div>

    </div>
    <!-- /.box body-->
    <input type="hidden" name="ser_booking_id" value="<?php echo $response['extra']['booking_id']; ?>" />
    <input type="hidden" name="ser_crew_count" value="<?php echo $response['extra']['crew_count']; ?>" />

</form>
<?php
} else {
?>
    <div class="row">
        <div class="col-xs-12">

            <div class="form-horizontal">
                <div class="box-body">                
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-12 control-label">No data Available</label>
                        
                    </div>                        
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </div>
    <!-- /.box body-->
<?php
}
?>
