<?php
//print_r($response); exit;

if ($response['status']) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo "<b class='text-red'>*Note:</b> Please assign '".$response['message']."' employee/s for each service date..!" ?>
        </div>
</div>
    <div class="row">
        <div class="col-xs-12">
            <form name="assign_job_form" class="assign_job_form" method="post" id="assign_job_form">
                <input type="hidden" name="ser_booking_id" value="<?php echo $response['extra'][0]->booking_sessions_booking_id; ?>" />
                <input type="hidden" name="ser_crew_count" value="<?php echo $response['message']; ?>" />

                <?php
 //print_r($response); exit;

$employees = $response['data'];

    foreach ($response['extra'] as $value) {
        $sessionId = $value->booking_sessions_id;
        $dateObj = date_create($value->booking_sessions_service_date);
        $service_date = date_format($dateObj, 'd-m-Y');
        //print_r($employees[$sessionId]); exit;
?>

                    <div class="serviceDateRow">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="">Date:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="ser_date" class="form-control ser_date" value="<?php echo $service_date; ?>" disabled>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="">Session:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" name="ser_session" class="form-control ser_session" value="<?php echo $value->session_name; ?>" disabled>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="">Employee:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                                                                
                                        <?php 
                                            if(!empty($employees[$sessionId])){
                                                //echo "<option value=''>Select Employee</option>";
                                                echo '<select name="ser_employee[]" placeholder="Select Employee" class="form-control select2 ser_employee" required multiple="multiple" data-minCount="'.$response['message'].'">';
                                                foreach($employees[$sessionId] as $employee){
                                                    echo "<option value=".$employee['employee_id'].">".$employee['employee_name']."</option>";
                                                }
                                            }else{
                                                echo '<select name="ser_employee[]" placeholder="No Employee Available" class="form-control select2 ser_employee" required multiple="multiple" data-minCount="'.$response['message'].'">';
                                            }
                                            echo '</select>';
                                        ?>
                                    
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <input type="hidden" name="ser_session_id[]" value="<?php echo $sessionId; ?>" />
                    
                    <?php }?>              
            </form>
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