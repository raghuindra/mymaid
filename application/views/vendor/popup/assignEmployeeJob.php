<?php
//print_r($response); exit;

if ($response['status']) {
    ?>

    <div class="row">
        <div class="col-xs-12">

            <div class="form-horizontal">
                <div class="box-body">                
                    
                    <div class="form-group">
                        <label for="state" class="col-sm-4 control-label">Employee: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <select id="assign_employee" name="assign_employee" required class="form-control">
                                <option value="">Select session</option>
                                <?php
                                foreach ($response['data'] as $value) {
                                    
                                    echo '<option value="' . $value->employee_id . '">' . $value->employee_name . '</option>';

                                }
                                ?>
                            </select>
                        </div>
                    </div>                   
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </div>
    <!-- /.box body-->

<?php
} else {
?>
    <div class="row">
        <div class="col-xs-12">

            <div class="form-horizontal">
                <div class="box-body">                
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-12 control-label">No Employee Available</label>
                        
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