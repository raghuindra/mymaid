<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Completed Orders
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Completed Orders</li>
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
<!--                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>order id </th>
                                    <th>customer Name</th>
                                    <th>service type</th>
                                    <th>amount </th>
                                    <th>date of request</th>
                                    <th>service time</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1234</td>
                                    <td>Shiva</td>
                                    <td>Cleaning</td>
                                    <td>65,000</td>
                                    <td>2/20/2017</td>
                                    <td> 10:11 PM</td>
                                    <td><button class="label label-success">Approved</button><button class="label label-warning">Pending</button><button class="label label-primary">Approved</button><button class="label label-danger">Denied</button></td>
                                </tr>
                                <tr>
                                    <td>1234</td>
                                    <td>Shiva</td>
                                    <td>Cleaning</td>
                                    <td>65,000</td>
                                    <td>2/20/2017</td>
                                    <td> 10:11 PM</td>
                                    <td><button class="label label-success">Approved</button><button class="label label-warning">Pending</button><button class="label label-primary">Approved</button><button class="label label-danger">Denied</button></td>
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
                    </div>-->


                    <div class="form-horizontal">

                        <div class="box-body">
                            <table id="Completed_order_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Service Name</th>
<!--                                        <th>Amount</th>-->
                                        <th>Service Date</th>
                                        <th>Completion Status</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>

                            </table>
                        </div>

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

<script>


$(function(){
    
    /* Service Location List Datatable */
        var CompletedOrderList = $('#Completed_order_list').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
            "ajax": {
                "url": '<?php echo base_url() . 'vendor_listCompletedOrders.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    //d.archived = $("#service_location_status").attr('data-val');
                }
            },
            "columns": [
                {"data": "booking_id"},
                {"data": "customer_name"},
                {"data": "person_mobile"},
                {"data": "service_name"},
                {"data": "booking_service_date"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '1', "targets": [0, 1, 2, 3, 4], searchable: true, orderable: true},                
                {"responsivePriority": '1', "targets": [5], searchable: true, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';
                        var userStr = '';
                                              
                        if(row.booking_completion_admin_confirmed === '1'){
                            if(row.booking_completion_user_comfirmed === '1'){
                                userStr ='<a class="badge btn-social-icon bg-green" data-toggle="tooltip" title="User Confirmed Completed"><i class="fa fa-user"></i></a>';
                            }
                            string += '<td><div class="text-center bg-green color-palette"> '+userStr;  
                            string += '<a class="badge btn-social-icon bg-green" data-toggle="tooltip" title="Admin Confirmed"><i class="fa fa-bank"></i></a></div>';
                            string +='<div class"text-center bg-green color-palette"><i>Approved</i></div></td>';
                        }else{
                            if(row.booking_completion_user_comfirmed === '1'){
                                userStr ='<a class="badge btn-social-icon bg-yellow" data-toggle="tooltip" title="User Confirmed Completed"><i class="fa fa-user"></i></a>';
                            }
                            string += '<td><div class="text-center bg-yellow color-palette" data-toggle="tooltip" title="Admin Confirmation Pending"> '+ userStr +'</div><div class="text-center bg-yellow color-palette"><i>Processing</i></div></td>';
                        }
                            
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            CompletedOrderList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
    
    
        
});
</script>