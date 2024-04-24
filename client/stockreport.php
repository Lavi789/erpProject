<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}
?>

<!DOCTYPE html>
<html lang="en" class="light">

<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/hindalco.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hindalco</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <!-- END: CSS Assets-->
</head>

<style>
    .dataTables_length select {
        width: 60px;
    }
</style>
<!-- END: Head -->

<body class="py-5 md:py-0">

    <!-- BEGIN: Mobile Menu Menu -->
    <?php
    $amenu = "master";
    include 'layout/mob.php'
    ?>
    <!-- END: Mobile Menu Menu -->

    <!-- BEGIN: Top Bar -->
    <?php
    $currentPage = 'Date Wise Purchase Report';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "report";
    include 'layout/nav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: Title -->
        <div class="intro-y flex items-center h-10 mt-8">
            <h2 class="text-lg font-medium truncate mr-5">
                Stock Report
            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Add Button -->
        <div class='flex justify-around items-center gap-3 '>
            
            <div class="grid grid-cols-12 text-dark mt-6 gap-4">
                <label class="col-span-1 mb-5 align-self-center flex items-center">Start Date: </label>
                <div class="col-span-2 mb-5 mr-8">
                    <input type="date" name="startDate" id="startDate" value="" />
                </div>

                <label class="col-span-1 mb-5 align-self-center flex items-center">End Date: </label>
                <div class="col-span-2 mb-5">
                    <input type="date" name="endDate" id="endDate" value="" />

                </div>

                <div class="col-span-2">
                    <button type="button" id="btn_filter" class="btn btn-outline-primary rounded-full">Search</button>
                </div>
            </div>

        </div>
        <!-- END: Add Button -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-5">

            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-bordered table-striped" style="width:100%" cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    <th>Stock</th>
                                    <th>Item</th>
                                    
                                    <th>Batch No.</th>
                                    <th>EXP Date</th>
                                    <th>Quantity</th>
                                    <th>Created At</th>
                                   
                                   
                                  
                                   
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Responsive Table -->
    </div>
    <!-- END: Content -->

    <!-- BEGIN: View Modal -->
    <div class="intro-y box mt-5 hidden">
        <div id="header-footer-modal" class="p-5">
            <div class="preview">
                <!-- BEGIN: Modal Content -->
                <div id="header-footer-modal-preview-view" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- BEGIN: Modal Header -->
                            <!-- <div class="modal-header">
                                <h2 id="modal-title" class="font-medium text-base mr-auto">
                                    Stock Report
                                </h2> -->
                           
                            </form>
                            <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                
                            </div>
                            <!-- END: Modal Footer -->
                        </div>
                    </div>
                </div>
                <!-- END: Modal Content -->
            </div>
        </div>
    </div>
    <!-- END: View Modal -->

    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.all.js"></script>
    <!-- END: JS Assets-->

</body>
<script>
    var dtable;
    $(document).ready(function() {
        dtable = $('#table').DataTable({
            "processing": true,
            "searching": true,
            "serverSide": true,
            "ajax": {
                url: "../server/ajax_stockreport.php",
                type: "GET"
            },
            "columns": [{
                    "data": "stock_id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "orderable": false
                },
                { "data": "item_code" },
               
                { "data": "batch_no" },
                { "data": "exp_date" },
                { "data": "qty" },
                { "data": "created_at" },
                

                // { "data": "action",
                //   "orderable": false
                // }
            ]
        });
        dtable.draw();

        $('#btn_filter').click(() => {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            dtable.ajax.url('../server/ajax_stockreport.php?startDate=' + startDate + '&endDate=' + endDate).load();

        })
    });



// function viewData(id) {
//     console.log("Clicked ViewData", id);
//     let url = '../api/stockReport/' + id;
//     $.ajax({
//         url: url,
//         method: 'GET',
//         dataType: 'json',
//         success: function(data) {
//             console.log(data);
//             var tbody = $('#ModalBody')
//             tbody.empty();

//             if (data === null) {
                
//                 tbody.append('<tr><td colspan="11">There is no data in the Table</td></tr>');
//             }else{
                
//             var dataArray = Array.isArray(data) ? data : [data];
//            console.log(dataArray.length);
//             if (dataArray.length > 0) {
//                 dataArray.forEach(function(dataArray) {
//                     var row = '<tr>' +
//                         '<td>' + dataArray.item_code + '</td>' +
//                         '<td>' + dataArray.item_name + '</td>' +
//                         '<td>' + dataArray.mfg_company_name + '</td>' +
//                         '<td>' + dataArray.mrp + '</td>' +
                        
//                         '<td>' + dataArray.purchase_rate + '</td>' +
//                         '<td>' + dataArray.cgst + '</td>' +
                        
//                         '<td>' + dataArray.sgst + '</td>' +
                        
                        
//                         '</tr>';
//                     tbody.append(row);
//                 });
//              } else {
//                 console.log('Data is empty');
                
//              }
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error fetching data:', error);
//         }
//     });
// }

 


</script>

</html>