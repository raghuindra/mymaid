<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Orders
            <small class=""><a href="#" class="btn btn-social-icon servicesRefresh" title="Refresh" ><i class="fa fa-refresh"></i></a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Orders</li>
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
                            <table id="new_service_order_list" class="table table-bordered table-striped tables-button-edit">
                                <thead>
                                    <tr>
                                        <th>Booking id </th>
                                        <th>Customer Name</th>
                                        <th>Customer Contact</th>
                                        <th>Service Name</th>
                                        <th>Amount </th>
                                        <th>Package</th>
                                        <th>Frequency</th>
                                        <th>Service date</th>
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
    var jConfirm;

$(function(){
    
    /* Service Location List Datatable */
        var newServiceOrderList = $('#new_service_order_list').DataTable({
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
                "url": '<?php echo base_url() . 'a_listNewOrders.html'; ?>',
                "type": "POST",
                "dataSrc": 'data',
                "data": function (d) {
                    //d.archived = $("#service_location_status").attr('data-val');
                }
            },
            "columns": [
                {"data": null},
                {"data": "customer_name"},
                {"data": "person_mobile"},
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": null},
                {"data": "frequency_name"},
                {"data": "booking_service_date"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [1, 3, 4, 6, 7], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [0], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td><div class="text-center">';                                                      
                            string += '<a href="#" class="orderDetail" data-toggle="tooltip" title="Order Details" data-id="'+row.booking_id+'"> '+row.booking_id+'</a></div></td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [2], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td>+60 '+ row.person_mobile +' </td>';                                                      

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [5], searchable: true, orderable: true, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td><div class="text-center">'; 
                            string += '<a href="#" class="" data-toggle="tooltip" title="'+row["package"].area+', '+ row["package"].bedroom +' Bedrooms/'+ row["package"].bathroom +' Bathrooms, '+row["package"].crew+' Crew(s)"> '+row["package"].building+'</a></div></td>';

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [8], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string = ' <td class=""> <div class="text-center">';                                                      
                            string += '<a href="#" class="btn btn-social-icon serviceAssign" data-toggle="tooltip" title="Assign to Vendor/Company" data-id="'+row.booking_id+'"><i class="fa fa-bank"></i></a></div></td>';
                        return string;
                    }
                }
            ]
        });
        
        
        /* Handle the Service Jobs Datatable Refresh. */
        $(".servicesRefresh").on('click', function(){            
            newServiceOrderList.ajax.reload(); //call datatable to reload the Ajax resource        
        });
        
        
        /* Fetch the Order/booking Deatils */       
        $(document).on('click', '.orderDetail', function(e){
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
    

        $(document).on('click', ".serviceAssign", function(){
            
            var id = $(this).data('id');
            
            jConfirm = $.confirm({
                title: 'Assign Job To:',
                content: function(){
                    var self = this;
                    //self.setContent('Checking callback flow');
                    return $.ajax({
                        url: '<?php echo base_url() . 'getCompaniesForService.html'; ?>',
                        dataType: 'html',
                        method: 'post',
                        data:{'booking_id':id}
                    }).done(function (response) {
                        self.setContent('');
                        self.setContentAppend(response);
                    }).fail(function(){
                        self.setContentAppend('<br>Fail to load!');
                    }).always(function(){
                        //self.setContentAppend("sdsa");
                    });
                },
                contentLoaded: function(data, status, xhr){
                    
                },
                onContentReady: function(){

                    $("#assign_company").unbind('change');
                    $(document).on('change','.assign_company', function(){
                        var company_id = $(this).val();
                        $('#assign_employee').attr('disabled', true);
                        if(company_id !== '' && company_id !== null){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'a_getEmployeesForService.html'; ?>",
                                data: {'companyId':company_id,'bookingId':id},
                                cache: false,
                                success: function (res) {                              
                                    
                                    $("#employee_service_rows").html(res); 
                                    
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
                                error: function (jqXHR, textStatus, errorThrown) {
                                    $.alert(jqXHR.responseJSON.message); return false;
                                }
                            });
                        }else{
                            $.alert('No data.'); return false;
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
    
    $(document).on('submit', '#assign_job_form', function(e){
        e.preventDefault();
        
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
                url: "<?php echo base_url() . 'a_assignEmployeeToService.html'; ?>",
                data: data,
                cache: false,
                success: function (res) {
                    var result = JSON.parse(res);

                    if (result.status === true) {
                        notifyMessage('success', result.message);
                        newServiceOrderList.ajax.reload(); //call datatable to reload the Ajax resource
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