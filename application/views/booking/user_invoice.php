<?php
$user_type  = $this->session->userdata('user_type');
if($user_type == Globals::PERSON_TYPE_ADMIN_NAME){
    $this->load->view("block/admin_topNavigation");
    $this->load->view("block/admin_leftMenu");
}else if($user_type == Globals::PERSON_TYPE_VENDOR_NAME || $user_type == Globals::PERSON_TYPE_FREELANCER_NAME){
    $this->load->view("block/vendor_topNavigation");
    $this->load->view("block/vendor_leftMenu");
}else if($user_type == Globals::PERSON_TYPE_USER_NAME){
    $this->load->view("block/user_topNavigation");
    $this->load->view("block/user_leftMenu");
}


if($response['status']){ 
  
    //print_r($response);    
$user_id 	= $this->session->userdata('user_id');

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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="invoice_content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order Invoice
            <!-- <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Order Invoice</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<div class='row'>
    <div class='col-xs-12'>
        <div class='box'>
        <!-- <div class="box-header with-border">
                        <h3 class="box-title ">Add Service</h3>

                       
                    </div> -->

                            <div class="box-body" >
                        <!-- <div class="box box-primary"> -->

                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">

            <div class='box-body'>
            <div class='form-group'>
            	<div class='col-sm-12 text-center' style="text-decoration: underline;"><h3>Invoice</h3></div>
            </div>
            <div class='row'>
	            <div class='form-group'>
	            	<div class='col-sm-8'></div>
	            	<div class='col-sm-4'>
	            		<div class='row'>
		            		<div class='col-sm-4'><b>Invoice:</b></div>
		            		<div class='col-sm-6' style="float: left;">#<?php echo ($response['other'])? $response['other'][0]->booking_invoice_id: '';?></div>	            		
	            		</div>
	            		<div class="row">
	            			<div class='col-sm-4'><b>Booked On:</b></div>
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

                <?php if($response['other'][0]->service_name != 'Basic Home Cleaning') {?>
                <div class='form-group'>
                    <label for='inputEmail3' class='col-sm-3 control-label'>Package :</label>
                    <div class='col-sm-6' id='venEmail'>
                        <?php       
                        echo ($response['other'])? $response['other'][0]->building_name.", ".$response['other'][0]->service_package_bedroom." Bedroom(s), ".$response['other'][0]->service_package_bathroom." Bathroom(s), ".$response['other'][0]->area_size." ".$response['other'][0]->area_measurement: '';?>
                    </div>
                </div>
                <?php } ?>

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
</div>
<!-- /.content-wrapper -->

<!-- Script for printing the Page -->
<!-- <script type="text/javascript" src="<?php //echo js_url('printThis'); ?>"></script> -->
<!-- <script type="text/javascript" src="<?php //echo js_url('jQuery.print'); ?>"></script>
<script type="text/javascript">
	$(function(){
		$(document).on('click', '#invoice_content', function(){
			$("#invoice_content").print({
        	globalStyles: true,
        	mediaPrint: false,
        	stylesheet: null,
        	noPrintSelector: ".no-print",
        	iframe: true,
        	append: null,
        	prepend: null,
        	manuallyCopyFormValues: true,
        	deferred: $.Deferred(),
        	timeout: 750,
        	title: null,
        	doctype: '<!doctype html>'
	});
		});
	});
</script> -->
<!-- /. Order Detail DIV END-->
<?php } else{ echo "Inavlid Request..!!";}
?>

