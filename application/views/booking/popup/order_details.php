<?php 

if($response['status']){ 
  
    //print_r($response);    
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
$can_view_contact_num = false;

if($response['other']){
    $user = $response['other'][0];
  
    if( $user_type != Globals::PERSON_TYPE_ADMIN_NAME ){ 
        if( ($user->company_person_id) && $user_id == $user->company_person_id){
            $can_view_contact_num = true;
        }
    }else if($user_type == Globals::PERSON_TYPE_ADMIN_NAME){
        $can_view_contact_num = true;
    }else if($user_type == Globals::PERSON_TYPE_USER_NAME && ($user->booking_user_id == $this->session->userdate('user_id')) ){
        $can_view_contact_num = true;
    }
}
?>
<!-- Order Detail DIV -->

<div class='row'>
    <div class='col-xs-12'>
        <div class='form-horizontal'>
            <div class='box-body'>
                <!-- Service Package Creation Form Start -->
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Order Date :</label>
                    <div class='col-sm-9' id="venRegDate">
                        <?php 
                        if( ($response['other']) ){
                            $dateObj = date_create($response['other'][0]->booking_service_date);
                            echo $date = date_format($dateObj, 'd-m-Y');                           
                        }
                        ?>
                        
                        <?php 
                            if(count($response['session']) > 1 ){
                        ?>
                            <!-- Split button -->
                            <div class="btn-group">
<!--                                <button type="button" class="btn btn-primary btn btn-social-icon"><i class="fa fa-calendar"></i></button>-->
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-calendar"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php 
                                        foreach($response['session'] as $session){
                                        $dateObj = date_create($session->booking_sessions_service_date);
                                        $date = date_format($dateObj, 'd-m-Y');
                                    ?>
<!--                                        <li role="separator" class="divider"></li>-->
                                        <li><a href="#"><?php echo $date; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Service Name :</label>
                    <div class='col-sm-9' id="venName">
                        <?php echo ($response['other'])? $response['other'][0]->service_name: '';?>
                    </div>
                </div>

                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Package :</label>
                    <div class='col-sm-9' id='venEmail'>
                        <?php echo ($response['other'])? $response['other'][0]->building_name.", ".$response['other'][0]->service_package_bedroom." Bedroom(s), ".$response['other'][0]->service_package_bathroom." Bathroom(s), ".$response['other'][0]->area_size." ".$response['other'][0]->area_measurement.", ".$response['other'][0]->service_package_min_crew_member." Crew(s)" : "";?>
                    </div>
                </div>
                
                <?php if(!empty($response['session'])){ 
                    $sessions = $response['session'];
                ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Frequency:</label>
                    <div class='col-sm-9' id='venCity'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box collapsed-box">
                                    <div class="box-header with-border">
                                        <?php if(!empty($response['other'])) { 
                                            
                                            if($response['other'][0]->booking_frequency_frequency_offer_id == 0){
                                                $frequnecy_name = "Once";
                                            }else{
                                                $frequnecy_name = $response['other'][0]->service_frequency_name;
                                            }
                                        ?>
                                        <h4 class="box-title "><?php echo $frequnecy_name; ?></h4>
                                        <?php } ?>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered addon_table">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Session</th>
                                            </tr>
                                            <?php 
                                                $i=1;
                                                foreach($sessions as $session){
                                                $dateObj = date_create($session->booking_sessions_service_date);
                                                $date = date_format($dateObj, 'd-m-Y');
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $date;?></td>
                                                    <td><?php echo $session->session_name;?></td>
                                                </tr>
                                            <?php $i++; } ?>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(!empty($response['addons']) && $response['addons'][0]->service_addon_name){ ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Addons</label>
                    <div class='col-sm-9' id='venAddress'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box collapsed-box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title ">Addons</h4>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered addon_table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Count</th>
                                            </tr>
                                            <?php 
                                                $addons = $response['addons'];
                                                foreach($addons as $addon){
                                            ?>
                                            <tr>
                                                <td><?php echo $addon->service_addon_name;?></td>
                                                <td><?php echo $addon->booking_addons_count;?></td>
                                            </tr>
                                            
                                            <?php } ?>

                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(!empty($response['spl_request']) && $response['spl_request'][0]->spl_request_name){ ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Special Request</label>
                    <div class='col-sm-9' id='venAddress1'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box collapsed-box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title ">Special Request</h4>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered spl_request_table">
<!--                                            <tr>
                                                <th>Name</th>
                                            </tr>-->
                                            <?php 
                                            $spl_requests = $response['spl_request'];
                                            foreach($spl_requests as $spl_request){
                                            ?>
                                            
                                            <tr>
                                                <td> <?php echo $spl_request->spl_request_name ; ?> </th>
                                            </tr>
                                            
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>

                <?php 
                    if($user_type == Globals::PERSON_TYPE_ADMIN_NAME || $user_type == Globals::PERSON_TYPE_USER_NAME){
                ?>
                <div class='form-group hidden'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Invoice</label>
                    <div class='col-sm-9' id='venAddress1'>
                        <div class="row">
                            <a href="#" class="btn btn-social-icon" data-toggle="tooltip" title="Invoice" id="get_invoice"><i class="fa fa-credit-card"></i></a>

                        </div>
                    </div>
                </div>
                
            </div>
            <?php } ?>
            
            <?php 
                if(!empty($response['other'])){
                    $user = $response['other'][0];
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box collapsed-box">
                        <div class="box-header with-border">
                            <h4 class="box-title ">User Detail</h4>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered addon_table">
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $user->booking_user_detail_first_name." ".$user->booking_user_detail_last_name; ?></td>                                                    
                                </tr>
                                
                                <?php if( $can_view_contact_num ){ ?>
                                    <tr>
                                        <th>Phone</th>
                                        <th><?php echo "+60".$user->booking_user_detail_phone;?></th>                                                   
                                    </tr>
                                <?php } ?>
                                    
                                <tr>
                                    <th>Street Address</th>
                                    <td><?php echo $user->booking_user_detail_address;?></td>                                                   
                                </tr>
                                <tr>
                                    <th>Postcode</th>
                                    <td><?php echo $user->booking_user_detail_pincode; ?></td>                                                   
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><?php echo $user->booking_user_detail_city; ?></td>                                                   
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td><?php echo $user->state_name;?></td>                                                   
                                </tr>
                                <tr>
                                    <th>Special note</th>
                                    <td><?php echo $user->booking_note;?></td>                                                   
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div> 
<!-- /. Order Detail DIV END-->

<?php /*
<!-- BEGIN # INVOICE MODAL -->
    <div class="modal fade" id="invoice_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog col-md-offset-4" role="document">
      
        <div class="modal-content">
        
            <div class="modal-header">
            </div>
            <div class="modal-body">
                
                <section class="content">
<div class='row'>
    <div class='col-xs-12'>
        <div class='box box-primary'>

            <div class="box-body" >

            <!-- form start -->
            <div class="form-horizontal">

            <div class='box-body'>
            <div class='form-group'>
                <div class='col-sm-12 text-center' style="text-decoration: underline;"><h3>Invoice</h3></div>
            </div>
            <div class='row'>
                <div class='form-group'>
                    <div class='col-sm-7'></div>
                    <div class='col-sm-5'>
                        <div class='row'>
                            <div class='col-sm-6'><b>Invoice:</b></div>
                            <div class='col-sm-6' style="float: left;">#<?php echo ($response['other'])? $response['other'][0]->booking_invoice_id: '';?></div>                     
                        </div>
                        <div class="row">
                            <div class='col-sm-6'><b>Booked On:</b></div>
                            <div class='col-sm-6' style="float: left;"><?php 
                                                $dateObj = date_create($response['other'][0]->booking_booked_on);
                                                $date = date_format($dateObj, 'd-m-Y');
                                    echo $date; ?>                                  
                            </div>
                        </div>                  
                    </div>              
                </div>

                <div class='form-group'>
                    <div class='col-sm-2'></div>
                    <div class='col-sm-4'>
                        ADVANCE DREAMS VENTURE SDN. BHD 160<br>
                        Jln. Kilang Lama, Pusat Perniagaan Putra,<br>
                        Kulim, Kedah 09000
                    </div>
                    <div class='col-sm-2'></div>
                    <div class='col-sm-4'>
                        <?php echo $user->booking_user_detail_address;?>.<br>
                        <?php echo $user->booking_user_detail_city." ". $user->state_name; ?><br>
                        <?php echo $user->booking_user_detail_pincode; ?><br>
                        <?php echo $user->booking_user_detail_email; ?>                 
                    </div>              
                </div>
            </div>

                <!-- Service Package Creation Form Start -->
                
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Service Name :</label>
                    <div class='col-sm-6' id="venName">
                        <?php echo ($response['other'])? $response['other'][0]->service_name: '';?>
                    </div>
                </div>

                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Package :</label>
                    <div class='col-sm-6' id='venEmail'>
                        <?php echo ($response['other'])? $response['other'][0]->building_name.", ".$response['other'][0]->service_package_bedroom." Bedroom(s), ".$response['other'][0]->service_package_bathroom." Bathroom(s), ".$response['other'][0]->area_size." ".$response['other'][0]->area_measurement: '';?>
                    </div>
                </div>
                
                <?php if(!empty($response['session'])){ 
                    $sessions = $response['session'];
                ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Frequency:</label>
                    <div class='col-sm-9' id='venCity'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <?php if(!empty($response['other'])) { 
                                            
                                            if($response['other'][0]->booking_frequency_frequency_offer_id == 0){
                                                $frequnecy_name = "Once";
                                            }else{
                                                $frequnecy_name = $response['other'][0]->service_frequency_name;
                                            }
                                        ?>
                                        <h4 class="box-title "><?php echo $frequnecy_name; ?></h4>
                                        <?php } ?>
                                        
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered addon_table">
                                            <tr>
                                                <th>Date</th>
                                                <th>Session</th>
                                            </tr>
                                            <?php 
                                                $i=1;
                                                foreach($sessions as $session){
                                                $dateObj = date_create($session->booking_sessions_service_date);
                                                $date = date_format($dateObj, 'd-m-Y');
                                            ?>
                                                <tr>
                                                    <td><?php echo $date;?></td>
                                                    <td><?php echo $session->session_name;?></td>
                                                </tr>
                                            <?php $i++; } ?>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(!empty($response['addons']) && $response['addons'][0]->service_addon_name){ ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Addons</label>
                    <div class='col-sm-9' id='venAddress'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">

                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered addon_table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Count</th>
                                            </tr>
                                            <?php 
                                                $addons = $response['addons'];
                                                foreach($addons as $addon){
                                            ?>
                                            <tr>
                                                <td><?php echo $addon->service_addon_name;?></td>
                                                <td><?php echo $addon->booking_addons_count;?></td>
                                            </tr>
                                            
                                            <?php } ?>

                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <?php if(!empty($response['spl_request']) && $response['spl_request'][0]->spl_request_name){ ?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Special Request</label>
                    <div class='col-sm-9' id='venAddress1'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">

                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered spl_request_table">
                                            <?php 
                                            $spl_requests = $response['spl_request'];
                                            foreach($spl_requests as $spl_request){
                                            ?>
                                            
                                            <tr>
                                                <td> <?php echo $spl_request->spl_request_name ; ?> </th>
                                            </tr>
                                            
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                                
            </div>
            
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'></label>
                    <div class='col-sm-9' id='venAddress'>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title ">Grand Total</h4>

                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover table-bordered addon_table">
                                            <?php if( $response['other'][0]->booking_gst_status == 1 ){ ?>
                                                <tr class="total">
                                                    <td><b>GST: </b></td>                                                   
                                                    <td>
                                                       <b><?php echo $response['other'][0]->booking_gst."%";?></b>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><b>Total: </b></td>
                                                <td><b><?php echo "MYR ".$response['other'][0]->booking_amount; ?></b></td>
                                            </tr>  

                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            <!-- </div> -->
            </div>
        </div>
    </div>
</div> 
    </section>
    <!-- /.content -->
              
            </div><!-- .modal Body Ends -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default bg-maroon" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success" id="submit_request">Yes</button> -->
            </div><!-- .modal Footer Ends -->           
        </div>
        
      </div>
    </div>
    <!-- END # INVOICE MODAL -->
*/ ?>

<?php } else{ echo "Inavlid Request..!!";}
?>