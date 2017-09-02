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
                                    <input type="text" name="ser_date" class="form-control ser_date" value="<?php echo $service_date; ?>" disabled >
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
                                    <input type="text" name="ser_session" class="form-control ser_session" 
                                           value="<?php echo $value->session_name; ?>" disabled >
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