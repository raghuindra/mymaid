<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
            Services
            <small class="hidden">advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Services Add/List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Add Service</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <div class="box box-primary">

                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="box-body">
                                   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Service Name *:</label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" id="serviceName" name="serviceName" placeholder="Service Name">
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <div class="col-sm-11">
                                            <button type="button" class="btn btn-default pull-right btn-lg bg-red">Clear</button>
                                        </div> 
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-info pull-right btn-lg bg-green" id="addService">Add</button>
                                        </div>
                                    </div>
                                    <!-- /.box-footer -->

                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.box -->

                </div>
                <div class="clearfix"></div>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Service List</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <div class="box box-primary">
                            <div class="box-header with-border hidden">
                                <h3 class="box-title">Bank Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="service_list" class="table table-bordered table-striped tables-button-edit responsive">
                                        <thead>
                                            <tr>
                                                <th>ID </th>
                                                <th>Service Name</th>
                                                <th>Service Created On</th>
                                                <th>Service Updated On</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            

                                        </tbody>
            <!--                            <tfoot class="hidden">
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th>Platform(s)</th>
                                                <th>Engine version</th>
                                                <th>CSS grade</th>
                                            </tr>
                                        </tfoot>-->
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.box -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="serviceEditModal" tabindex="-1" role="dialog" aria-labelledby="serviceEditModalLabel">
    <div class="modal-dialog" role="document">
        
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Service</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Service Name:</label>
                        <input type="text" name="editServiceName" class="form-control" id="editServiceName">
                        <input type="hidden" name="editServiceId" class="form-control" id="editServiceId">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" type="submit" id="saveServiceEdit">Save changes</button>
                </div>
            </div>
    </div>
</div>


<!-- Confirm Modal -->
<div class="modal fade" id="archiveConfirmModal" tabindex="-1" role="dialog" aria-labelledby="archiveConfirmModalLabel">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Archive Service</h4>
                </div>
                <div class="modal-body">
                    <!-- 
                        Modal Body
                    -->
                    Are you sure you want to archive service?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" type="submit" id="archiveConfirm">Yes</button>
                </div>
            </div>
    </div>
</div>
<!-- Confirm Modal END -->


<script>
    $(function () {
        var serviceListTable = $('#service_list').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollX": true,
            "processing": true,
            "buttons": [
               'excel', 'pdf'
            ],
            //"dom": 'Bfrtip',
            //"select": true,
            "ajax": {
                "url": '<?php echo base_url().'listService.html';?>',
                "type": "POST",
                "dataSrc": 'data'
            },
            "columns": [
                { "data": "service_id" },
                { "data": "service_name" },
                { "data": "service_created_on" },
                { "data": "service_updated_on" },
                { "data": null }
            ],
            "columnDefs": [
                  { "responsivePriority":'2', "targets": [0, 2, 3], searchable: true, orderable: true },
                  { "responsivePriority":'2', "targets": [1], searchable: true, orderable: true, data:null,
                        "render": function(data,type,row){
                            var string =' <td class=""><a href="./service_details.html/'+row.service_id+'" class="" title="Service detail" >'+row.service_name+'</a></td>';
                            return string;
                        }
                  },
                  { "responsivePriority":'1', "targets": [4], searchable: false, orderable: false,data:null,
                      "render": function(data,type,row){ 
                        var string =' <td class=""> <div class="text-center">'
                                    +'<a href="#serviceEditModal" class="btn btn-social-icon " title="Edit" data-toggle="modal" data-name="'+row.service_name+'" data-id = "'+row.service_id+'"><i class="fa fa-edit"></i></a>'
                                    +'<a href="#" class="btn btn-social-icon serviceArchive" title="Archive" data-id = "'+row.service_id+'"><i class="fa fa-archive"></i></a></div></td>';
                            return string;
                      }
                  }
            ]
        });
        
        
        /* Add Service name AJAX Call */
        $("#addService").click(function(){
            var serviceName = $("#serviceName").val().trim();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'addService.html'?>",
                data: {'serviceName':serviceName},
                cache: false,
                success: function(res){
                    var result = JSON.parse(res);
                    
                    if(result.status === true){
                        notifyMessage('success', result.message);
                        serviceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                    }else{
                        notifyMessage('error', result.message);
                    }
                }
            });
        });
        
        /* Edit Service name AJAX Call */
        $("#saveServiceEdit").click(function(){
            var serviceName = $("#editServiceName").val().trim();
            var id          = $("#editServiceId").val().trim();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'editService.html'?>",
                data: {'serviceName':serviceName, 'serviceId':id},
                cache: false,
                success: function(res){
                    var result = JSON.parse(res);
                    
                    if(result.status === true){
                        notifyMessage('success', result.message);
                        serviceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                        $("#serviceEditModal").modal('hide');
                    }else{
                        notifyMessage('error', result.message);
                    }
                }
            });
        });
        
        
        /* Pass the service name to modal text field */
        $('#serviceEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var serviceName = button.data('name');// Extract info from data-* attributes
            var serviceId   = button.data('id');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #editServiceName').val(serviceName);
            modal.find('.modal-body #editServiceId').val(serviceId);
        });
        
        /* Archive service Modal */
        $(document).on('click','.serviceArchive',function(e){
            e.preventDefault();

            var serviceId = $(this).data('id');
            $('#archiveConfirmModal').modal().one('click', '#archiveConfirm', function(e) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'archiveService.html';?>",
                    data: {'serviceId': serviceId},
                    cache: false,
                    success: function (res) {                      
                        var result = JSON.parse(res);

                        if (result.status === true) {
                            notifyMessage('success', result.message);
                            serviceListTable.ajax.reload(); //call datatable to reload the Ajax resource
                            $('#archiveConfirmModal').modal('hide');
                        } else {
                            notifyMessage('error', result.message);
                        }

                    },
                    error: function( jqXHR, textStatus, errorThrown){
                       notifyMessage('error', errorThrown);
                    }
                });
            });
        });
        
    });

</script>