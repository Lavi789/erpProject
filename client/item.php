<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}

require_once '../server/config/db.php';

$mfg_company = $conn->query("SELECT mfg_company_id, mfg_company_name FROM mfg_company ORDER BY mfg_company_name ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    $currentPage = 'Products';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "master";
    include 'layout/nav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: Title -->
        <div class="intro-y flex items-center h-10 mt-8 mb-5">
            <h2 class="text-lg font-medium truncate mr-5">
                Products
            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Add Button -->
        <button class="btn btn-primary shadow-md mr-2" onclick="add_data()" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-view">Add Product</button>
        <!-- END: Add Button -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-5">
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-bordered table-striped" style="width:100%" cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>MFG Company</th>
                                    <th>Location</th>
                                    <th>Rate</th>
                                    <th>Packing</th>
                                    <th>HSN Code</th>
                                    <th>GST %</th>
                                    <th>GST Type</th>
                                    <th>Qty</th>
                                    <th>Min Stock</th>
                                    <th>Max Stock</th>
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
                                    Product
                                </h2>
                            </div>
                            <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <form id="frm_user" name="frm_user" action="" method="post">
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="item_code" class="form-label">Item Code</label>
                                        <input id="item_code" name="item_code" type="text" class="form-control" placeholder="Item Code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="item_name" class="form-label">Item Name</label>
                                        <input id="item_name" name="item_name" type="text" class="form-control" placeholder="Item Name">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" name="category" data-placeholder="Select GST %" class="form-select">
                                            <option value="null" selected disabled>--Select--</option>
                                            <option value="Grocery">Grocery</option>
                                            <option value="Stationary">Stationary</option>
                                            <option value="Clothing">Clothing</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="description" class="form-label">Description</label>
                                        <input id="description" name="description" type="text" class="form-control" placeholder="Description">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="mfg_company_id" class="form-label">MFG Company</label>
                                        <select id="mfg_company_id" name="mfg_company_id" data-placeholder="Select MFG Company" class="form-select">
                                            <option value="null" selected disabled>--Select--</option>
                                            <?php
                                            foreach ($mfg_company as $row) {
                                            ?>
                                                <option value="<?php echo $row['mfg_company_id'] ?>"><?php echo $row['mfg_company_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="location" class="form-label">Location</label>
                                        <input id="location" name="location" type="text" class="form-control" placeholder="Location">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="rate" class="form-label">Rate</label>
                                        <input id="rate" name="rate" type="text" class="form-control" placeholder="Rate" value="0.00">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="packing" class="form-label">Packing</label>
                                        <input id="packing" name="packing" type="number" class="form-control" placeholder="Packing" value="1" min="1">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="hsn_code" class="form-label">HSN Code</label>
                                        <input id="hsn_code" name="hsn_code" type="text" class="form-control" placeholder="HSN Code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="gst" class="form-label">GST %</label>
                                        <select id="gst" name="gst" data-placeholder="Select GST %" class="form-select">
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="12">12%</option>
                                            <option value="18">18%</option>
                                            <option value="28">28%</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="gst_flag" class="form-label">GST Type</label>
                                        <select id="gst_flag" name="gst_flag" data-placeholder="Select GST Type" class="form-select">
                                            <option value="null" selected disabled>--Select--</option>
                                            <option value="Inclusive">Inclusive</option>
                                            <option value="Exclusive">Exclusive</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="qty" class="form-label">Qty</label>
                                        <input id="qty" name="qty" type="number" class="form-control" placeholder="Qty" value="0" min="0">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="min_stock" class="form-label">Min Stock</label>
                                        <input id="min_stock" name="min_stock" type="number" class="form-control" placeholder="Min Stock" value="0" min="0">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="max_stock" class="form-label">Max Stock</label>
                                        <input id="max_stock" name="max_stock" type="number" class="form-control" placeholder="Max Stock" value="0" min="0">
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
    var dtable = $('#table').DataTable({
        "processing": true,
        "searching": true,
        "serverSide": true,
        "ajax": {
            url: "../server/ajax_item.php",
            type: "POST"
        },
        "columns": [{
                "data": "item_code",
                "orderable": false
            },
            {
                "data": "item_name"
            },
            {
                "data": "category"
            },
            {
                "data": "description"
            },
            {
                "data": "mfg_company_name"
            },
            {
                "data": "location"
            },
            {
                "data": "rate"
            },
            {
                "data": "packing"
            },
            {
                "data": "hsn_code"
            },
            {
                "data": "gst"
            },
            {
                "data": "gst_flag"
            },
            {
                "data": "qty"
            },
            {
                "data": "min_stock"

            },
            {
                "data": "max_stock"
            },
            {
                "data": "action",
                "orderable": false
            }
        ],
        "order": [1, 'asc']
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
                    url: '../api/item/' + id,
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
        $("#modal-title").text('Add Item');
    }

    $("#btn_save").on("click", function() {
        const form = $("#frm_user");
        const json = convertFormToJSON(form);
        $.ajax({
            url: '../api/item',
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
        $("#modal-title").text('Edit Item');
        $.ajax({
            url: '../api/item/' + id,
            method: "GET",
            success: function(res) {
                $("#item_code").val(res.item_code);
                $("#item_name").val(res.item_name);
                $("#category").val(res.category);
                $("#description").val(res.description);
                $("#mfg_company_id").val(res.mfg_company_id);
                $("#location").val(res.location);
                $("#packing").val(res.packing);
                $("#rate").val(res.rate);
                $("#hsn_code").val(res.hsn_code);
                $("#gst").val(res.gst);
                $("#gst_flag").val(res.gst_flag);
                $("#qty").val(res.qty);
                $("#min_stock").val(res.min_stock);
                $("#max_stock").val(res.max_stock);
            }
        });
    }

    $("#btn_update").on("click", function() {
        const form = $("#frm_user");
        const json = convertFormToJSON(form);
        var id = $("#item_code").val();
        $.ajax({
            url: '../api/item/' + id,
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