<?php
$this->load->view("block/admin_topNavigation");
$this->load->view("block/admin_leftMenu");
//print_r($config); exit;

?>

<link rel="stylesheet" href="<?php echo css_url('demo'); ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Vendors</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#configsTab" data-toggle="tab">Configs</a></li>
<!--                        <li><a href="#activeVendorsTab" data-toggle="tab">Active Vendors</a></li>-->
                        <!--                        <li><a href="#resetPassTab" data-toggle="tab">Reset Password</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="configsTab">              
                            <div class="box-body" style="display: block;">
                                <div class="box box-primary">

                                    <!-- form start -->
                                    <form id="configForm" name="configForm" mothod="post">
                                            <div class="form-horizontal">
                                                <div class="box-body">
                                                    
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Sender EMail: <span class="text-red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="email" name="senderEmail" class="form-control" required id="senderEmail" placeholder="Sender Email" value="<?php echo ($config) ? $config['sender_email'] : '';?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">GST: <span class="text-red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="gst" class="form-control" required id="gst" placeholder="GST" value="<?php echo ($config) ? $config['gst'] : '';?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label><input type="checkbox" name="gstStatus" class="gstStatus" <?php  echo ($config['status']['gst'] == '1') ? 'checked' : '';  ?> ><span id="status">Off</span></label>
                                                            
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Vendor Margin: <span class="text-red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="number" maxlength = "6" name="profit_cutoff" class="form-control" step="0.01" required id="profit_cutoff" placeholder="0.00" value="<?php echo ($config) ? $config['profit_cutoff'] : '';?>">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Freelancer Margin: <span class="text-red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="number" maxlength = "6" name="freelance_profit_cutoff" class="form-control" step="0.01" required id="freelance_profit_cutoff" placeholder="0.00" value="<?php echo ($config) ? $config['freelance_profit_cutoff'] : '';?>" >
                                                        </div>

                                                    </div>

                                                    <div class="box-footer">
                                                        <div class="col-sm-10">
                                                            <button type="button" class="btn btn-default pull-right btn-lg bg-maroon formReset">Clear</button>
                                                        </div> 
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="addServiceLocation">Update</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>

                                            </div>
                                </form>
                                            <!-- form ends -->

                                </div>
                            </div>
                            <!-- /.box body-->
                        </div>
                        <!-- /.tab-pane -->

<!--                        <div class="tab-pane" id="activeVendorsTab">
                            <div class="form-horizontal">
                                <div class="box-body" style="display: block;">
                                    <div class="box box-primary">
                                         /.box-header 
                                        <div class="box-header with-border">
                                            <div class="form-group">                                             
                                                <div class="col-sm-6">
                                                    <div class="btn-group" role="group" id="active_vendor_list_status" aria-label="Archive Un Archive condition" data-val="<?php //echo Globals::UN_ARCHIVE; ?>">
                                                        <button type="button" class="btn margin btn-primary btn-sm active active_vendor_list_status_unarchive" data-val="<?php //echo Globals::UN_ARCHIVE; ?>">Un Archived</button>                                   
                                                        <button type="button" class="btn margin btn-primary btn-sm active_vendor_list_status_archive" data-val="<?php //echo Globals::ARCHIVE; ?>">Archived</button>                                                                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         /.box-header 
                                        <div class="box-body col-sm-12">
                                            <table id="activeVendorsList" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Location</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Company Name</th>
                                                        <th>Company Telephone</th>
                                                        <th>Company Contact Person</th>
                                                        <th class="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                                 /.box body
                            </div>        
                        </div>-->
                        <!-- /.tab-pane -->

                        <!--                        <div class="tab-pane" id="resetPassTab">
                                                    <form class="form-horizontal">
                                                        
                                                    </form>
                                                </div>-->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--  Modal Window START-->
<div class="modal fade" id="modalWindow" tabindex="-1" role="dialog" aria-labelledby="modalWindowLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalWindowTitle"></h4>
            </div>
            <div class="modal-body" id='modalWindowBody'>
                <!-- 
                    Modal Body
                -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>               
            </div>
        </div>
    </div>
</div>
<!-- /. Modal Window END -->



<!-- Checkbox Script plugin -->
<script src="<?php echo js_url('jquery.checkbox');?>"></script>

<!-- Admin Settings Scripts START-->
<script>

    
    $(function () {
        
        $(".gstStatus").checkbox({
                checked: "<?php echo img_url('cb3-0.png'); ?>",
                check: "<?php echo img_url('cb3-1.png'); ?>",
                onChange: function(i) {
                        if (i.is(":checked")) {
                                $("#status").html("Enabled")
                        }
                        else {
                                $("#status").html("Disabled");
                        } 
                },
                onLoad: function(i) {
                        if (i.is(":checked")) {
                                $("#status").html("Enabled")
                        }
                        else {
                                $("#status").html("Disabled");
                        }	
                }
        });
        
        $(document).on("click", ".formReset", function(){
            resetForm($(this).closest('form'));
        });
       
        /* Postcode Price creation form handling.. */
        $(document).on("submit","#configForm", function (e) {
            e.preventDefault();
            var data  = $("#configForm").serializeArray();
            
            var form = $(this);    
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'updateConfig.html' ?>",
                data: data,
                cache: false,
                success: function (res) {

                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        
                    } else {
                        notifyMessage('error', result.message);
                    }
                }
            });
        });

    });

</script>
<!-- New Vendors Scripts END -->

