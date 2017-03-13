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
            <li class="active">Basic Information</li>
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
                                    <table id="service_list" class="table table-bordered table-striped tables-button-edit">
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
                                            <tr>
                                                <td>1234</td>
                                                <td>Shiva</td>
                                                <td>2/20/2017 - 10:25 AM</td>
                                                <td> text</td>
                                                <td class=""> 
                                                    <div class="text-center">
                                                        <a href="#myModal" class="btn btn-social-icon " title="Edit" data-toggle="modal" data-whatever="First service"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-social-icon " title="Archive"><i class="fa fa-archive"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1234</td>
                                                <td>Shiva</td>
                                                <td>2/20/2017 - 10:25 AM</td>
                                                <td> text</td>
                                                <td class=""> 
                                                    <div class="text-center">
                                                        <a href="#myModal" class="btn btn-social-icon " title="Edit" data-toggle="modal" data-whatever="First service"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-social-icon " title="Archive"><i class="fa fa-archive"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="editService.html" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Service</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Service Name:</label>
                        <input type="text" name="serviceName" class="form-control" id="serviceName">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" type="submit" id="saveServiceEdit">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(function () {
        $('#service_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "ajax": {
            "url": "<?php echo base_url().'listService.html';?>",
            "type": "POST"
            },
            "columns": [
                { "data": "service_id" },
                { "data": "service_name" },
                { "data": "service_created_on" },
                { "data": "service_created_by" }
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
                       
                    }else{
                        notifyMessage('error', result.message);
                    }
                }
            });
        });
        
        
    });

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    });
    
    
    
</script>