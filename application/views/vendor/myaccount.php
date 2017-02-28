<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="hidden">
            Basic Information
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb hidden">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Basic Information</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form id="basic-bank-information">
                <div class="col-xs-12">
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Basic Information</h3>

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
                                    <h3 class="box-title">Basic Information</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <div class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Company Name	*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" required class="form-control" id="cmname" name="cmname" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Company Registration #:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="cmnumber" name="cmnumber" placeholder="Company Registration" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Contact Person Name*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" required class="form-control" id="cpname" name="cpname" placeholder="Contact Person Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">IC Number*:</label>
                                            <div class="col-sm-10">
                                                <input type="number" required class="form-control" id="icnumber" name="icnumber" placeholder="IC Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" required class="col-sm-2 control-label">Office Phone:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="ofcnumber" name="ofcnumber" placeholder="Office Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">H/P Phone*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" required class="form-control" id="hpphone" name="hpphone" placeholder="H/P Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Address Line 1*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" required class="form-control" id="addr" name="addr" placeholder="Address Line 1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Address Line 2:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="addr2" name="addr2" placeholder="Address Line 2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">City*:</label>
                                            <div class="col-sm-10">
                                                <input type="text" required class="form-control" name="city" id="city" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Postcode*:</label>
                                            <div class="col-sm-10">
                                                <input type="number" required class="form-control" id="postalcode" name="postalcode" placeholder="Postcode">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Country*:</label>
                                            <div class="col-sm-10">
                                                <select required id="country" name="country" class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">State*:</label>
                                            <div class="col-sm-10">
                                                <select id="state" name="state" required class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Email ID*:</label>

                                            <div class="col-sm-10">
                                                <input type="email" name="email" required class="form-control" id="email" placeholder="Email ID">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-4 control-label"><h3>Upload Document:</h3></label>

                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">SSM:</label>

                                            <div class="col-sm-10">
                                                <input type="file" id="exampleInputFile1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Identity card:</label>

                                            <div class="col-sm-10">
                                                <input type="file" id="exampleInputFile1">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.box -->

                    </div>
                    <div class="clearfix"></div>
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
