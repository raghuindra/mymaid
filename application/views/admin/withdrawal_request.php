<?php
$this->load->view("block/admin_topNavigation");

$this->load->view("block/admin_leftMenu");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header ">
        
        <div class="clearfix "></div>
        <ol class="breadcrumb ">
            <li><a href="# "><i class="fa fa-dashboard "></i> Home</a></li>
            <li class="active ">Request Payment</li>
        </ol>
    </section>
    <div id="balence-show-table">
        <!-- Content Header (Page header) -->
        <section class="content-header ">
            <h3>
                Wallet Withdrawal Request
                <small class=""><a href="#" class="btn btn-social-icon withdrawalRefresh" title="Refresh" data-toggle="tooltip" ><i class="fa fa-refresh"></i></a></small>
                <small class="hidden ">advanced tables</small>
            </h3>
        </section>

        <!-- Main content -->
        <section class="content ">
            <div class="row ">
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header hidden ">
                            <h3 class="box-title ">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            <table id="withdrawal_request_list" class="table table-bordered table-striped tables-button-edit ">
                                <thead>
                                    <tr>
                                        <th>Vendor Id</th>
                                        <th>Vendor Name</th>
                                        <th>Company</th>
                                        <th>Wallet Balance</th>
                                        <th>Requested On</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
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
</div>
<!-- /.content-wrapper -->

<script>

$(function(){
    
    /* Wallet Withdrawal Requesr List Datatable */
    var walletWithdrawalList = $('#withdrawal_request_list').DataTable({
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
            "url": "<?php echo base_url() . 'vendors_withdrawal_request_list.html'; ?>",
            "type": "POST",
            "dataSrc": 'data',
            "data": function (d) {
                //d.archived = $("#service_location_status").attr('data-val');
            }
        },
        "columns": [
            {"data": "vendor_wallet_withdrawal_vendor_id"},
            {"data": "vendor_full_name"},
            {"data": "vendor_company"},
            {"data": "vendor_wallet_amount"},
            {"data": "vendor_wallet_withdrawal_request_on"},
            {"data": "vendor_wallet_withdrawal_amount"},
            {"data": null},
            {"data": null}
        ],
        "columnDefs": [
            {"responsivePriority": '1', "targets": [0, 1, 2, 3, 4, 5], searchable: true, orderable: true},
            {"responsivePriority": '2', "targets": [6], searchable: true, orderable: true, data: null,
                "render": function (data, type, row) {
                    
                    var string = ' <td>';

                    if(row.vendor_wallet_withdrawal_approval_status === '<?php echo Globals::WALLET_WITHDRAWAL_REQUEST_PROCESSING?>'){
                        string += '<div class="text-center bg-yellow color-palette"> <i>Processing</i></a></div>';
                    
                    }else if(row.vendor_wallet_withdrawal_approval_status === '<?php echo Globals::WALLET_WITHDRAWAL_REQUEST_APPROVED?>'){
                        string += '<div class="text-center bg-green color-palette"> <i>Approved</i></a></div>';                  
                        
                    }else if(row.vendor_wallet_withdrawal_approval_status === '<?php echo Globals::WALLET_WITHDRAWAL_REQUEST_REJECTED?>'){
                        string += '<div class="text-center bg-red color-palette"> <i>Rejected</i></a></div>';                  
                    }
             
                    string += '</td>';
                    return string;
                }
            },
            {"responsivePriority": '2', "targets": [7], searchable: true, orderable: true, data: null,
                "render": function (data, type, row) {

                    var string = ' <td>';

                    if(row.vendor_wallet_withdrawal_approval_status === '<?php echo Globals::WALLET_WITHDRAWAL_REQUEST_PROCESSING?>'){
                        
                        string += '<div class="text-center">\n\
                                        <a href="#" class="btn btn-social-icon approveRequest" data-toggle="tooltip" title="Approve Withdrawal Request" data-id="'+row.vendor_wallet_withdrawal_id+'"><i class="fa  fa-check-square"></i></a>\n\
                                    \n\ <a href="#" class="btn btn-social-icon rejectRequest" data-toggle="tooltip" title="Reject Withdrawal Request" data-id="'+row.vendor_wallet_withdrawal_id+'"><i class="fa  fa-close"></i></a>\n\
                                    </div>';  
                    }
             
                    string += '</td>';
                    return string;
                }
            },
//            {"responsivePriority": '2', "targets": [4], searchable: false, orderable: false, data: null,
//                "render": function (data, type, row) {
//
//                    var string = ' <td>';
//
//                    if(row.confirm_completed && row.booking_status !== '<?php //echo Globals::BOOKING_CANCELLED;?>' && row.booking_cancelled_by === null){
//
//                        string += '<div class="text-center"><a href="#" class="btn btn-social-icon orderCompleted" data-toggle="tooltip" title="Confrim Order Completion" data-id="'+row.booking_id+'"><i class="fa  fa-check-square"></i></a></div></td>';  
//                    }else{ string += ' -- '; }                      
//
//                    string += '</td>';
//                    return string;
//                }
//            }
        ]
    });
    
    /* Handle the Withdrawal Request Datatable Refresh. */
    $(".withdrawalRefresh").on('click', function(){            
        walletWithdrawalList.ajax.reload(); //call datatable to reload the Ajax resource        
    });
        
    $(document).on('click', '.approveRequest', function(){
        
        var id = $(this).data('id');
            
            $.confirm({
                title: 'Confirm Approval!',
                content: 'Are you sure you want to confirm the withdrawal request?',
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
                                url: "<?php echo base_url() . 'approveWithdrwalRequest.html'; ?>",
                                data: {'withdrawId':id},
                                cache: false,
                                success: function (res) {
                                    var result = JSON.parse(res);

                                    if (result.status === true) {
                                        notifyMessage('success', result.message);
                                        walletWithdrawalList.ajax.reload(); //call datatable to reload the Ajax resource
                                        
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