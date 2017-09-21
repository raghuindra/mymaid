<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Canceled Jobs
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Canceled Jobs</li>
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
                                        <th>Customer Phone</th>
                                        <th>Service Name</th>
                                        <th>Amount</th>
                                        <th>Service Date</th>
                                        <th>Frequency</th>
                                        <th>Canceled On</th>
                                        <th>Cancellation Status</th>
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
                "url": '<?php echo base_url() . 'listCanceledOrdersOfVendor.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    //d.archived = $("#service_location_status").attr('data-val');
                }
            },
            "order": [[ 0, "DESC" ]],
            "columns": [
                {"data": "booking_id"},
                {"data": "customer_name"},
                {"data": "person_mobile"},
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": "booking_service_date"},
                {"data": "frequency_name"},
                {"data": "booking_cancelled_on"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '1', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="orderDetails" data-id="'+row.booking_id+'">' + row.booking_id + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [1, 3, 5, 6, 7], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [2], searchable: true, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td class="">+60 '+ row.person_mobile +'</td>';
                            
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [4], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';                        
                        string += ' <td class="">RM '+ row.booking_amount +'</td>';  
                   
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [8], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';
                        if(row.booking_cancelled_approved_by_admin === '1'){
                            string += ' <td class=""><div class="text-center bg-green color-palette" data-toggle="tooltip" title="Admin Confirmed"> <i>Approved</i></div></td>';  
                        }else{
                            string += '<td class=""><div class="text-center bg-yellow color-palette" data-toggle="tooltip" title="Admin Confirmation Pending"><i>Processing</i></div></td>';
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
                    
                },
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'closeIcon': true,
                columnClass: 'col-md-6 col-md-offset-3',
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