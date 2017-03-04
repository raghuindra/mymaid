<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="balance">
            <h3>MY WALLET</h3>
            <div>Current Balance :<span>$123,567.00<span></div>
                        <button id="request-payment" type=" button " class="btn btn-block btn-danger ">Request Withdrawal</button>
                        </div>
                        <div class="clearfix "></div>
                        <ol class="breadcrumb ">
                            <li><a href="# "><i class="fa fa-dashboard "></i> Home</a></li>
                            <li class="active ">Request Payment</li>
                        </ol>
                        </section>
                        <div id="balence-show-table">
                            <!-- Content Header (Page header) -->
                            <section class="content-header ">
                                <h3>
                                    Request Payment
                                    <small class="hidden ">advanced tables</small>
                                </h3>
                            </section>

                            <!-- Main content -->
                            <section class="content ">
                                <div class="row ">
                                    <div class="col-xs-12 ">
                                        <div class="box ">
                                            <div class="box-header hidden ">
                                                <h3 class="box-title ">Data Table With Full Features</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body ">
                                                <table id="example1 " class="table table-bordered table-striped tables-button-edit ">
                                                    <thead>
                                                        <tr>
                                                            <th>ID </th>
                                                            <th>Date</th>
                                                            <th>Credit</th>
                                                            <th>Debit</th>
                                                            <th>Description</th>
                                                            <th>Balance</th>
                                                            <th class="action ">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1234</td>
                                                            <td>2/20/2017</td>
                                                            <td>1,000</td>
                                                            <td>2,00</td>
                                                            <td>Description text goes here</td>
                                                            <td> 10,000</td>
                                                            <td class="status bg-green "> <i>Success</i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1234</td>
                                                            <td>2/20/2017</td>
                                                            <td>1,000</td>
                                                            <td>2,00</td>
                                                            <td>Description text goes here</td>
                                                            <td> 10,000</td>
                                                            <td class="status bg-green "> <i>Success</i></td>
                                                        </tr>

                                                    </tbody>
                                                    <tfoot class="hidden ">
                                                        <tr>
                                                            <th>Rendering engine</th>
                                                            <th>Browser</th>
                                                            <th>Platform(s)</th>
                                                            <th>Engine version</th>
                                                            <th>CSS grade</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </section>
                            <!-- /.content -->
                        </div>
                        </div>
                        <!-- /.content-wrapper -->