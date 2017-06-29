<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Active Jobs
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
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
                            <table id="active_service_job_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Service Name</th>
<!--                                        <th>Amount </th>-->
                                        <th>Date of request</th>
                                        <th>Service date</th>
                                        <th>Service Status</th>
                                        <th>Action</th>
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
    
    /* Active Service List Datatable */
        var activeServiceJobList = $('#active_service_job_list').DataTable({
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
                "url": '<?php echo base_url() . 'listActiveServiceBookings.html'; ?>',
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
                {"data": "booking_booked_on"},
                {"data": "booking_service_date"},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '1', "targets": [0, 1, 3, 4, 5], searchable: true, orderable: true},
                {"responsivePriority": '2', "targets": [2], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td class="">+60 '+ row.person_mobile +'</td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [6], searchable: true, orderable: false, data: null,
                    "render": function (data, type, row) {

                        var string = ' <td>';

                        if(row.booking_completion_user_comfirmed === '1'){
                            string += '<div class="text-center bg-green color-palette"> <a class="badge btn-social-icon bg-green" data-toggle="tooltip" title="User Confirmed Completion"><i class="fa fa-user"></i></a></div>';
                        }

                        if(row.booking_status === '<?php echo Globals::BOOKING_CANCELLED;?>'){
                            var usrStr = '<a class="badge btn-social-icon bg-red" data-toggle="tooltip" title="User requested cancellation"><i class="fa fa-user"></i></a>';
                            string += '<div class="text-center bg-red color-palette" data-toggle="tooltip" title="Admin Confirmation Pending"> '+ usrStr +'</div><div><i>Cancellation Request</i></div></td>';
                        }

                        string += '</td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [7], searchable: true, orderable: false, data: null,
                    "render": function (data, type, row) {

                        var string = ' <td>';

                        if(row.confirm_completed && row.booking_status !== '<?php echo Globals::BOOKING_CANCELLED;?>' && row.booking_cancelled_by === null){
                            
                            string += '<div class="text-center"><a href="#" class="btn btn-social-icon orderCompleted" data-toggle="tooltip" title="Confrim Order Completion" data-id="'+row.booking_id+'"><i class="fa  fa-check-square"></i></a></div></td>';  
                        }else{ string += ' -- '; }                      

                        string += '</td>';
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            activeServiceJobList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
        
                $(document).on('click', ".orderCompleted", function(){
            
            var id = $(this).data('id');
            
            $.confirm({
                title: 'Confirm Order Completion!',
                content: 'Are you sure you want to confirm the order completion?',
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                buttons: {
                    confirm:{ 
                        btnClass: 'btn-green',
                        action:function () {
                            
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'confirmOrderCompletionByVendor.html'; ?>",
                                data: {'bookingId':id},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        activeServiceJobList.ajax.reload(); //call datatable to reload the Ajax resource
                                        
                                    } else {
                                        notifyMessage('error', result.message);
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    notifyMessage('error', errorThrown);
                                }
                            });
                        }
                    },
                    cancel:{
                        btnClass: 'btn-default bg-maroon',
                        action: function () {

                        }
                    }
                }
            });
            
        });
        
});
</script>