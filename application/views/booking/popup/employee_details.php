<?php 
//print_r($response); exit;
if($response['status']){ 
  

?>
<!-- Order Detail DIV -->

<div class='row'>
    <div class='col-xs-12'>
        <div class='form-horizontal'>
            
            <?php 
                if(!empty($response['data'])){
                    //$user = $response['data'][0];
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <?php foreach($response['extra'] as $session=>$date){?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title ">Service On:
                                <?php 
                                $dateObj = date_create($date);
                            echo $date = date_format($dateObj, 'd-m-Y');?></h4>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered addon_table">
                                
                                <?php foreach($response['data'] as $employee) {
                                    if($employee->booking_sessions_id == $session){
                                ?>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $employee->employee_name; ?></td>                                                    
                                </tr>  
                                <?php }} ?>
<!--
                                <tr>
                                    <th>House Phone</th>
                                    <td><?php //echo "+60 ".$user->employee_house_phone;?></td>                                                   
                                </tr>
                                <tr>
                                    <th>H/P Phone</th>
                                    <td><?php //echo "+60 ".$user->employee_hp_phone; ?></td>                                                   
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td><?php //echo $user->employee_citizenship; ?></td>                                                   
                                </tr>
-->
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div> 

<!-- /. Order Detail DIV END-->
<?php } else{ echo "NO Data Found..!!";}
?>