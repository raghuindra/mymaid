<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Bank Details
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb ">
            <li><a href="./vendor_home.html"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Bank Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form id="basic-bank-information">
                <div class="col-xs-12">

                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bank Information</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: block;">
                            <div class="box box-primary">
                                <div class="box-header with-border hidden">
                                    <h3 class="box-title">Bank Information</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <div class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Bank Name*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="bnkname" class="form-control" required id="bnkname" placeholder="Bank Name*">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Beneficiary/Account Holder Name*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="holdername" class="form-control" required id="holdername" placeholder="Beneficiary/Account Holder Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Bank Account Number*:</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="accnumber" class="form-control" required id="accnumber" placeholder="Bank Account Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">IFSC Code/Swift Code:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ifsc" required id="ifsc" placeholder="IFSC Code/Swift Code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Bank Address:</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control" name="accnumber" id="bnkaddress" required placeholder="Bank Address"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.box -->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-default btn-lg bg-red">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right btn-lg bg-green">Save</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
