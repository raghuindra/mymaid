<?php
$employee = $employee_detail['data'];

if ($employee_detail['status']) {
    ?>

    <div class="row">
        <div class="col-xs-12">

            <div class="form-horizontal">
                <div class="box-body">                
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee Name: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="edit_employee_name" class="form-control" required id="edit_employee_name" placeholder="Employee Name" value="<?php echo ($employee) ? $employee[0]->employee_name : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee Passport Number: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="edit_employee_passport" class="form-control" required id="edit_employee_passport" placeholder="Passport Number"  value="<?php echo ($employee) ? $employee[0]->employee_passport_number : ''; ?>" disabled="disabled"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee Citizenship: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="edit_employee_citizenship" class="form-control" required id="edit_employee_citizenship" placeholder="Employee Citizenship (Ex: Malaysian)" value="<?php echo ($employee) ? $employee[0]->employee_citizenship : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee House Phone :</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">+60</span>
                                <input type="text" name="edit_employee_housephone" class="form-control" id="edit_employee_housephone" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" placeholder="Employee House Phone" value="<?php echo ($employee) ? $employee[0]->employee_house_phone : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee H/P Phone: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">+60</span>
                                <input type="text" name="edit_employee_hp_phone" class="form-control" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "10" required id="edit_employee_hp_phone" placeholder="Employee H/P Phone" pattern=".{8,10}" required title="8 to 10 numbers" value="<?php echo ($employee) ? $employee[0]->employee_hp_phone : ''; ?>">
                            </div>
                        </div>
                    </div>

<!--                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Employee Job Type *:</label>
                        <div class="col-sm-6">
                            <div class="btn-group" role="group" aria-label="Employee Job Type">
                                <button type="button" class="btn margin btn-primary btn-sm edit_emp_jobtype <?php //if ($employee[0]->employee_job_type == Globals::EMPLOYEE_FULLTIME) {
        //echo 'active';
    //} ?>" data-val="<?php //echo Globals::EMPLOYEE_FULLTIME; ?>"   >Full Time</button>
                                <button type="button" class="btn margin btn-primary btn-sm edit_emp_jobtype <?php //if ($employee[0]->employee_job_type == Globals::EMPLOYEE_PARTTIME) {
        //echo 'active';
    //} ?>" data-val="<?php //echo Globals::EMPLOYEE_PARTTIME; ?>" >Part Time</button>
                                <input type="hidden" name="edit_employee_jobtype" class="form-control" required id="edit_employee_jobtype"  value='<?php //echo $employee[0]->employee_job_type; ?>'>
                            </div>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label for="state" class="col-sm-4 control-label">Employee Job Session: <span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <select id="session" name="employee_session" required class="form-control">
                                <option>Select session</option>
                                <?php
                                foreach ($sessions as $key => $value) {
                                    if ($employee[0]->employee_job_session_id == $value->session_id) {
                                        echo '<option value="' . $value->session_id . '" selected>' . $value->session_name . '</option>';
                                    }else{
                                        echo '<option value="' . $value->session_id . '">' . $value->session_name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--                    <div class="form-group">
                                            <label for="fileupload" class="col-sm-4 control-label"><h3>Upload Document:</h3></label>
                    
                                        </div>
                                        <div class="form-group">
                                            <label for="fileupload" class="col-sm-3 control-label">Identity Card*:</label>
                    
                                            <div class="col-sm-9">                                                          
                                                <input type="file" id="employeeIdUpload" name="empIdFile">
                                            </div>
                                            <input type="hidden" id="employeeIdFileUpData" name="employeeIdFileUpData">
                                        </div>-->
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </div>
    <!-- /.box body-->

<?php
} else {
    echo "Invalid Employee..!!";
}
?>