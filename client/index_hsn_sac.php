<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}
?>
<?php
require_once '../server/config/db.php';
$stmt = $conn->prepare("SELECT * FROM unit ");
$stmt->execute();
$hsn = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en" class="light">

<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/hindalco.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HSN/SAC</title>
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
    $currentPage = 'hsn_sac';
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
                HAC/SAC
            </h2>
            <!-- <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a> -->
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Add Button -->
        <button class="btn btn-primary shadow-md mr-2" onclick="add_data()" data-tw-toggle="modal"
            data-tw-target="#header-footer-modal-preview-view">Add</button>
        <!-- END: Add Button -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-5">
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-bordered table-striped" style="width:100%"
                            cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>SL NO</th>
                                    <th>HSM Code</th>
                                    <th>HSN Name</th>
                                    <th>HSN Descr</th>
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
                                    HSN/SAC
                                </h2>
                            </div>
                            <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <form id="frm_user" name="frm_user" action="" method="post">
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                    <input id="hsn_id" name="hsn_id" type="hidden" class="form-control"
                                        placeholder="hsn Id" readonly>
                                    <div class="col-span-12 sm:col-span-6">
                                        <input type="radio" id="goods" name="fav_language" value="">
                                        <label for="goods">Goods</label><br>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <input type="radio" id="services" name="fav_language" value="">
                                        <label for="services">Servises</label><br>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="hsn_code" class="form-label"> HSN CODE</label>
                                        <input id="hsn_code" name="hsn_code" type="text" class="form-control"
                                            placeholder="hsn code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                    <label for="hsn_description" class="form-label"> HSN Description</label>
                                       
                                    <select name="hsn_description"id="hsn_description"class="wd-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full tom-select">
                                                        <option >HSN Descr</option>

                                                <?php foreach ($hsn as $hsn_sac) { ?>
                                        
                                        <option value="<?= $hsn_sac['unit_name'] ?>"><?= $hsn_sac['unit_name'] ?></option>
                                      <?php } ?>
                            </select>
                                      
                                    </div>

                                </div>
                            </form>
                            <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                <button id="btn_save" data-tw-dismiss="modal" class="btn btn-primary w-20">Save</button>
                                <button id="btn_update" data-tw-dismiss="modal"
                                    class="btn btn-primary w-20">Update</button>
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
var dtable = $('#table').DataTable({
    "processing": true,
    "searching": true,
    "serverSide": true,
    "ajax": {
        url: "../server/ajax_hsn.php",
        type: "POST"
    },
    "columns": [{
            "data": "hsn_id",
            "visible": false
        },
        {
            "data": "sl_no",
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            "orderable": false
        },
        {
            "data": "hsn_code"
        },
        {
            "data": "hsn_description"
        },



        {
            "data": "action",
            "orderable": false
        }
    ]
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

function remove_data(id) {
    Swal.fire({
        title: 'Are you sure to Delete?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../api/hsn/' + id,
                type: 'DELETE',
                dataType: 'json',
                contentType: 'application/json',
                success: function(data) {
                    if (data.status == "Ok") {
                        Swal.fire({
                            title: data.msg,
                            icon: 'success',
                        }).then((result) => {
                            dtable.draw();
                        });
                    } else {
                        Swal.fire(data.msg, '', 'error');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    Swal.fire('Error', 'An error occurred while deleting the data.', 'error');
                }
            });

        } else {
            Swal.close();
        }
    });
}

function add_data() {
    $("#btn_save").show();
    $("#btn_update").hide();
    $("#frm_user").trigger("reset");
    $("#modal-title").text('Add');
}

$("#btn_save").on("click", function() {
    const form = $("#frm_user");
    const json = convertFormToJSON(form);
    $.ajax({
        url: '../api/hsn',
        type: 'POST',
        data: JSON.stringify(json),
        dataType: 'json',
        contentType: 'application/json',
        success: function(data) {
            if (data.status === "Ok") {
                $("#frm_user").trigger('reset');
                $("#header-footer-modal-preview").hide();
                dtable.draw();

                Swal.fire(data.msg, '', 'success');
            } else {
                Swal.fire(data.msg, '', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);

            Swal.fire('OOPS', '', 'error');
            // Handle error, if any
        }
    });
});


function load_data(id) {
    $("#btn_save").hide();
    $("#btn_update").show();
    $("#modal-title").text('Edit Bank');
    $.ajax({
        url: '../api/hsn/' + id,
        method: "GET",
        success: function(res) {
            $("#hsn_id").val(res.hsn_id);
            $("#hsn_code").val(res.hsn_code);
            $("#hsn_description").val(res.hsn_description);


        }
    });
}


$("#btn_update").on("click", function() {
    const form = $("#frm_user");
    const json = convertFormToJSON(form);
    var id = $("#hsn_id").val();
    $.ajax({
        url: '../api/hsn/' + id,
        type: 'PUT',
        data: JSON.stringify(json),
        dataType: 'json',
        contentType: 'application/json',
        success: function(data) {
            if (data.status === "Ok") {
                $("#frm_user").trigger('reset');
                $("#header-footer-modal-preview").hide();
                dtable.draw();

                Swal.fire(data.msg, '', 'success');
            } else {
                Swal.fire(data.msg, '', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);

            Swal.fire('OOPS', '', 'error');
            // Handle error, if any
        }
    });
});
</script>

</html>