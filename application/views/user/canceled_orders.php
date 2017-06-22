<?php
$this->load->view("block/user_topNavigation");

$this->load->view("block/user_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Canceled Orders
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Canceled Orders</li>
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
                            <table id="canceled_booking_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Order id </th>
                                        <th>Vendor Company</th>
                                        <th>Company Contact</th>
                                        <th>Service Name</th>
                                        <th>Amount </th>
                                        <th>Date of request</th>
                                        <th>Service date</th>
                                        <th>Canceled date</th>
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
        var canceledBookingList = $('#canceled_booking_list').DataTable({
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
                "url": '<?php echo base_url() . 'listCanceledOrders.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    //d.archived = $("#service_location_status").attr('data-val');
                }
            },
            "columns": [
                {"data": "booking_id"},
                {"data": "company_name"},
                {"data": "company_landphone"},
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": "booking_booked_on"},
                {"data": "booking_service_date"},
                {"data": "booking_cancelled_on"}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 3, 4, 5, 6, 7], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [1], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';
                        if(row.company_name == null){
                            string += ' <td class=""> -- </td>';  
                        }else{
                            string += '<td class=""> '+ row.company_name +'</td>';
                        }
                            
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [2], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';
                        if(row.company_name === null){
                            string += ' <td class=""> -- </td>';  
                        }else{
                            string += '<td class=""> '+ row.company_landphone +'</td>';
                        }
                            
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            canceledBookingList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
    
    
        
});
</script>