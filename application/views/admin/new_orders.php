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
                                        <th>Date of request</th>
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
                {"data": "booking_id"},
                {"data": "customer_name"},
                {"data": "person_mobile"},
                {"data": "service_name"},
                {"data": "booking_amount"},
                {"data": "booking_booked_on"},
                {"data": "booking_service_date"},
                {"data": null}
            ],
            "columnDefs": [
                {"responsivePriority": '2', "targets": [0, 1, 3, 4, 5, 6], searchable: true, orderable: true},
                {"responsivePriority": '1', "targets": [2], searchable: false, orderable: false, data: null,
                    "render": function (data, type, row) {
                        
                        var string = '<td>+60 '+ row.person_mobile +' </td>';                                                      

                        return string;
                    }
                },
                {"responsivePriority": '1', "targets": [7], searchable: false, orderable: false, data: null,
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
    
    
        $(document).on('click', ".serviceAssign", function(){
            
            var id = $(this).data('id');
            
            $.confirm({
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
                    $(document).on('change','#assign_company', function(){
                        var company_id = $(this).val();
                        $('#assign_employee').attr('disabled', true);
                        if(company_id !== '' && company_id !== null){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'a_getEmployeesForService.html'; ?>",
                                data: {'companyId':company_id,'bookingId':id},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);
                                        $('#assign_employee').empty();
                                        $('#assign_employee').append($('<option></option>').val('').html('Select employee'));
                                    if (result.status === true) {
                                        $.each(result.data, function(key, value){
                                            $('#assign_employee').append($('<option></option>').val(value.employee_id).html(value.employee_name));
                                        });
                                        $('#assign_employee').val('');
                                        $('#assign_employee').attr('disabled', false);
                                    } else {
                                        $.alert(result.message); return false;
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    $.alert(jqXHR.responseJSON.message); return false;
                                }
                            });
                        }else{
                            $('#assign_employee').empty();
                            $('#assign_employee').append($('<option></option>').val('').html('Select employee'));
                            $('#assign_employee').attr('disabled', true);
                        }
                    });
                },
                'useBootstrap': true,
                'type': 'blue',
                'typeAnimated': true,
                'animation': 'scaleX',
                buttons: {
                    confirm:{ 
                        btnClass: 'btn-green',
                        action:function () {
                            var employeeId = this.$content.find('#assign_employee').val();
                            var companyId = this.$content.find('#assign_company').val();
                            if( employeeId == '' || employeeId == null){ $.alert('Please select any Employee!'); return false;}
                            if( companyId == '' || companyId == null){ $.alert('Please select Company!'); return false;}
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url() . 'a_assignEmployeeToService.html'; ?>",
                                data: {'employeeId':employeeId,'bookingId':id, 'companyId':companyId},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        newServiceOrderList.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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