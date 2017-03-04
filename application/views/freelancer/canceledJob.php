<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cancelled Jobs
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Active Jobs</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header hidden">
                        <h3 class="box-title">Data Table With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped tables-button-edit">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Client Name</th>
                                    <th>Postcode</th>
                                    <th>Date </th>
                                    <th>Service time</th>
                                    <th>service</th>
                                    <th>Reason</th>
                                    <th class="action">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1234</td>
                                    <td>Shiva</td>
                                    <td>560043</td>
                                    <td>2/20/2017</td>
                                    <td>10:25 AM</td>
                                    <td>Basic Home Cleaning</td>
                                    <td> text</td>
                                    <td class="status bg-green"> <i>Pending</i></td>
                                </tr>
                                <tr>
                                    <td>1234</td>
                                    <td>Shiva</td>
                                    <td>560043</td>
                                    <td>2/20/2017</td>
                                    <td>10:25 AM</td>
                                    <td>Basic Home Cleaning</td>
                                    <td> text</td>
                                    <td class="status bg-red"> <i>Cancel</i></td>

                                </tr>

                            </tbody>
                            <tfoot class="hidden">
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
<!-- /.content-wrapper -->