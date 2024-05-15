<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}
?>
<?php
require_once '../server/config/db.php';
$stmt = $conn->prepare("SELECT * FROM itemgroup  ");
$stmt->execute();
$item = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en" class="light">

<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/hindalco.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Rate</title>
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
    $currentPage = 'Itemrate';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "master";
    include 'layout/masternav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: Title -->
        <div class="intro-y flex items-center h-10 mt-8 mb-5">
            <h2 class="text-lg font-medium truncate mr-5">
              Itemrate
            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Add Button -->
           <div class="grid grid-cols-12 text-dark mt-3">
                        <label class="col-span-1 align-self-center flex items-center " for="item">Item Rate: </label>
                        <div class="col-span-2">
                            <select name="item" id="item" class="wd-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full tom-select">
                                                        <option >Item Group</option>

                                                <?php foreach ($item as $itemrate) { ?>
                                        
                                        <option value="<?= $itemrate['itemg_name'] ?>"><?= $itemrate['itemg_name'] ?></option>
                                      <?php } ?>
                            </select>
                
                        </div>
                
                 </div>
        <!-- <button class="btn btn-primary shadow-md mr-2" onclick="add_data()" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-view">Add itemrate</button> -->
        <!-- END: Add Button -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-5">
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table1" class="table table-bordered table-striped" style="width:100%" cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    
                                    <th>Sl No.</th>
                                    <th>Part No</th>
                                    <th>Item Name</th>
                                    <!-- <th>Rate</th> -->
                                    <th>Action</th>
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

    <!-- BEGIN: Header Footer Modal -->
    <div class="intro-y box mt-5 hidden">
        <div id="header-footer-modal" class="p-5">
            <div class="preview">
                <!-- BEGIN: Modal Content -->
                <div id="header-footer-modal-preview-view" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                                <h2 id="modal-title" class="font-medium text-base mr-auto">
                                 Itemrate
                                </h2>
                                
                            </div>
                            <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <form id="frm_user" name="frm_user" action="" method="post">
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                    <input id="make_id" name="make_id" type="hidden" class="form-control" placeholder="make Id" readonly>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="make_name" class="form-label">Make Name</label>
                                        <input id="make_name" name="make_name" type="text" class="form-control" placeholder="Make Name">
                                    </div>
                                   
                                  
                                </div>
                            </form>
                            <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                <button id="btn_save" data-tw-dismiss="modal" class="btn btn-primary w-20">Save</button>
                                <button id="btn_update" data-tw-dismiss="modal" class="btn btn-primary w-20">Update</button>
                            </div>
                            <!-- END: Modal Footer -->
                        </div>
                    </div>
                </div>
                <!-- END: Modal Content -->
            </div>
        </div>
    </div>
    <!-- END: Header Footer Modal -->

    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.all.js"></script>
    <!-- END: JS Assets-->

</body>
<script>
     document.getElementById('item').addEventListener('change', function() {
    var selectedOption = this.value;
    if (selectedOption) {
        var id = selectedOption.split(' - ')[0];
        console.log('Selected item:', id);
        load_search_data(id);
    }
});

function load_search_data(id) {
    if (id) {
        if ($.fn.DataTable.isDataTable('#table1')) {
            $('#table1').DataTable().destroy();
        }

        var dtable = $('#table1').DataTable({
            "processing": true,
            "searching": true,
            "serverSide": true,
            "ajax": {
                "url": "../server/ajax_itemrate.php",
               
            },
            "columns": [
                { "data": "item_name" },
                { "data": "part_no" },
                { "data": "action" }
            ],
            "order": [0, "asc"]
        });
    }
}
var dtable = $('#table1').DataTable({
     
            "processing": true,
            "searching": true,
            "serverSide": true,
            "ajax":  "../server/ajax_itemrate.php",
            "columns": [
                { "data": "item_name" },
                { "data": "part_no" },
                { "data": "action" }
                
            ],
            "order": [0, "asc"],
        });
    




    function convertFormToJSON(form) {
        const array = $(form).serializeArray();
        const json = {};
        $.each(array, function() {
            key = this.name;
            json[key] = this.value || "";
        });
        return json;
    }

            
  

    
</script>

</html>