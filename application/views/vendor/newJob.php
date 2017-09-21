<?php
$this->load->view("block/vendor_topNavigation");

$this->load->view("block/vendor_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Jobs
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Jobs</li>
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
                            <table id="new_service_job_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id</th>
                                        <th>Customer Name</th>
                                        <th>Service Name</th>
                                        <th>Amount </th>
                                        <th>Date of Request</th>
                                        <th>Service Date</th>
                                        <th>Frequency</th>
                                        <th class="action">Action</th>
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

var jConfirm;
    
$(function(){
    
    /* Service Location List Datatable */
        var newServiceJobList = $('#new_service_job_list').DataTable({
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
                "url": '<?php echo base_url() . 'listNewBookingForVendor.html'; ?>',
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
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": "booking_booked_on"},
                {"data": "booking_service_date"},
                {"data": "frequency_name"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '1', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        var string = ' <td class=""><a href="#" class="orderDetails" data-id="'+row.booking_id+'">' + row.booking_id + ' </a></td>';
                        return string;
                    }
                },
                {"responsivePriority": '2', "targets": [1, 2, 4, 5, 6], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [3], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string ='';                        
                        string += ' <td class="">RM '+ row.booking_amount +'</td>';  
                   
                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string = ' <td class=""> <div class="text-center">';                                                      
                            string += '<a href="#" class="btn btn-social-icon serviceAccept" data-toggle="tooltip" title="Accept the Job" data-id="'+row.booking_id+'"><i class="fa fa-check"></i></a></div></td>';
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            newServiceJobList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
    
    
        $(document).on('click', ".serviceAccept", function(){
            
            var id = $(this).data('id');
            var last_valid_selection = null;
            
            jConfirm = $.confirm({
                title: 'Assign Job:',
                content: function(){
                    var self = this;
                    //self.setContent('Checking callback flow');
                    return $.ajax({
                        url: '<?php echo base_url() . 'getEmployeesForJob.html'; ?>',
                        dataType: 'html',
                        method: 'post',
                        data:{'booking_id':id}
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
                    //$('.ser_employee').select2();
                    $(".ser_employee").on('focusout', function(){
                        let mincount = $(this).attr('data-minCount');
                        
                        if($(this).val().length < mincount){
                            $.alert('Please assign minimum '+mincount+' employee/s.');
                            
                        }else if($(this).val().length > mincount){
                            $(this).val('');                          
                            $.alert('Can assign maximum '+mincount+' employee/s.');
                        }
                    });
                },
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                'columnClass': 'col-md-8 col-md-offset-2',
                buttons: {
                    confirm:{ 
                        btnClass: 'btn-green',
                        action:function () {
                            $("#assign_job_form").submit();                         
                            return false;
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
    
    
    $(document).on('submit', '#assign_job_form', function(e){
        e.preventDefault();
        console.log('Submitted');
        var flag = 1;
        var flag_1 = 1;
        var flag_2 = 1;
        var date = "<ul>";
        var date_1 = "<ul>";
        var date_2 = "<ul>";
        var mincount = 0;
        $(".ser_employee").each(function () {
            mincount = $(this).attr('data-mincount');
            
            if($(this).val()==null || $(this).val().length < mincount){
                //$.alert('Please assign minimum '+mincount+' employee/s.');
                flag_1 = flag_1 *0;
                date_1 += "<li>"+ $(this).closest('.row').children().children().find('.ser_date').val() +"</li>";
            }else if($(this).val()==null || $(this).val().length > mincount){
                $(this).val('');                          
                //$.alert('Can assign maximum '+mincount+' employee/s.');
                flag_2 = flag_2 *0;
                date_2 += "<li>"+ $(this).closest('.row').children().children().find('.ser_date').val() +"</li>";
            }
            
            if($(this).val() == '' || $(this).val() == null){               
                flag = flag * 0;
                date += "<li>"+ $(this).closest('.row').children().children().find('.ser_date').val() +"</li>";
            }

        });
        
        date += "</ul>"; date_1 += "</ul>"; date_2 += "</ul>";
        
        if(!flag){
            $.alert('Please choose employee for service date/s: '+date);
        }else if(!flag_1){
            $.alert('Please assign minimum '+mincount+' employee/s for service date/s: '+date_1);
        }else if(!flag_2){
            $.alert('Can assign maximum '+mincount+' employee/s for service date/s: '+date_2);
        }else{
            
            var data = $('#assign_job_form').serializeArray();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'assignEmployeeToJob.html'; ?>",
                data: data,
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        newServiceJobList.ajax.reload(); //call datatable to reload the Ajax resource
                        jConfirm.close();
                    } else {
                       $.alert(result.message);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $.alert(errorThrown);
                }
            });
        }
    });
});
</script>