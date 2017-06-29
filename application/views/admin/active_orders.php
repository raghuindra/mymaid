<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Active Orders
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Active Orders</li>
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

                    <div class="form-horizontal">

                        <div class="box-body">
                            <table id="active_orders_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Company Name</th>
                                        <th>Company Contact</th>
                                        <th>Service Name</th>
                                        <th>Amount</th>
                                        <th>Service date</th>
                                        <th>Booking Status</th>
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
    
    /* Active Orders List Datatable */
        var activeOrderList = $('#active_orders_list').DataTable({
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
                "url": '<?php echo base_url() . 'a_ActiveOrderList.html'; ?>',
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
                {"data": "company_name"},
                {"data": "company_landphone"},
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": "booking_service_date"},
                {"data": null},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 2, 5, 6, 7], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [2], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {

                        var string = '<td class=""> +60 '+ row.person_mobile +'</td>';
        
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [3], searchable: true, orderable: true, data: null,
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
                {"responsivePriority": '1', "targets": [4], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';
                        if(row.company_name === null){
                            string += ' <td class=""> -- </td>';  
                        }else{
                            string += '<td class=""> +60 '+ row.company_landphone +'</td>';
                        }
                            
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [8], searchable: true, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='<td class="bg-aqua">';
                        if(row.booking_status === "<?php echo Globals::BOOKING_CONFIRMED;?>" && row.company_name !== null){
                            string += '<div class="text-center bg-yellow color-palette"><i>Confirmed</i></div> ';  
                        }else if(row.booking_status === "<?php echo Globals::BOOKING_COMPLETED;?>" && row.company_name !== null){
                            string += '<div class="text-center bg-green color-palette">';
                           
                            if(row.booking_completion_user_confirmed === '1'){
                                string +='<a class="badge btn-social-icon bg-green" data-toggle="tooltip" title="User Confirmed Completed"><i class="fa fa-user"></i></a>';
                            }
                            if(row.booking_completion_company_confirmed === '1'){
                                string +='<a class="badge btn-social-icon bg-green" data-toggle="tooltip" title="vendor Confirmed Completed"><i class="fa fa-bank"></i></a>';
                            }
                            string +='<div><i>Completed</i></div></div>';
                        }else if(row.booking_status === "<?php echo Globals::BOOKING_CANCELLED;?>" && row.booking_cancelled_by !== null ){
                            string += '<div class="text-center bg-red color-palette">';
                            string +='<a class="badge btn-social-icon bg-red" data-toggle="tooltip" title="User Requested Cancellation"><i class="fa fa-user"></i></a>';
                            string +='<div><i>Canceled</i></div></div>';
                        }
                        string += '</td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [9], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string = ' <td class=""> <div class="text-center">';
                        if(row.booking_cancelable && (row.booking_completion_user_confirmed === '0')){
                            string += '<a href="#" class="btn btn-social-icon bookingCancel" data-toggle="tooltip" title="Cancel Order" data-id="'+row.booking_id+'"><i class="fa fa-close"></i></a>';  
                        }
                        
                        if(row.confirm_completed){
                            string += '<a href="#" class="btn btn-social-icon orderCompleted" data-toggle="tooltip" title="Confrim Order Completion" data-id="'+row.booking_id+'"><i class="fa fa-check-square"></i></a></div></td>';  
                        }
                        
                        string += '</div></td>';
                       
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            activeOrderList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
    
    
        $(document).on('click', ".bookingCancel", function(){
            
            var id = $(this).data('id');
            
            $.confirm({
                title: 'Cancel Order!',
                content: 'Are you sure want to cancel the order?',
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
                                url: "<?php echo base_url() . 'a_cancelOrder.html'; ?>",
                                data: {'bookingId':id},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        activeOrderList.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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
        
        $(document).on('click', ".orderCompleted", function(){
            
            var id = $(this).data('id');
            
            $.confirm({
                title: 'Confirm Order Completed!',
                content: 'Are you sure you want to confirm the order completed?',
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
                                url: "<?php echo base_url() . 'a_confirmOrderCompletion.html'; ?>",
                                data: {'bookingId':id},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        activeOrderList.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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