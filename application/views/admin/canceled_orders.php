<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
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
                    <div class="form-horizontal">

                        <div class="box-body">
                            <table id="canceled_booking_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Vendor Company</th>
                                        <th>Company Contact</th>
                                        <th>Service Name</th>
                                        <th>Amount </th>
                                        <th>Service Date</th>
                                        <th>Canceled On</th>
                                        <th>Canceled By</th>
                                        <th>Cancellation Approved On</th>
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
                "url": '<?php echo base_url() . 'a_listCanceledOrders.html'; ?>',
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
                {"data": "booking_cancelled_on"},
                {"data": "booking_cancelation_request_sent_from"},
                {"data": "booking_cancelled_approved_by_admin_on"}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="orderDetails" data-id="'+row.booking_id+'">' + row.booking_id + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [ 1, 5, 6, 7, 8, 9, 10], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [2], searchable: true, orderable: true, data: null,
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
                            string += '<td class="">+60 '+ row.company_landphone +'</td>';
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
    
            
        /* Fetch the Order/booking Deatils */       
        $(document).on('click', '.orderDetails', function(e){
            e.preventDefault();
            var bookingId = $(this).data('id');
            
            $.confirm({
                title: 'Order Information:',
                content: function(){
                    var self = this;
                    //self.setContent('Checking callback flow');
                    return $.ajax({
                        url: '<?php echo base_url() . 'serviceOrderDeatils.html'; ?>',
                        dataType: 'html',
                        method: 'post',
                        data:{'booking_id':bookingId}
                    }).done(function (response) {
                        self.setContentAppend(response);
                    }).fail(function(){
                        self.setContentAppend('<br>Fail to load!');
                    }).always(function(){
                        //self.setContentAppend("sdsa");
                    });
                },
                contentLoaded: function(data, status, xhr){
                    //self.setContentAppend(data);
                },
                onContentReady: function(){
                    $(document).on('click', '#get_invoice', function(){
                        $("#invoice_modal").modal('show');
                    });
                },
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'closeIcon': true,
                columnClass: 'col-md-8 col-md-offset-2',
                buttons: {
                    
                    cancel:{
                        text: 'Close',
                        btnClass: 'btn-default bg-maroon',
                        action: function () {

                        }
                    }
                }
            });
                       
        });
        
        
});
</script>