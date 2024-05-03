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
    <title>ERP</title>
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
    $currentPage = 'ERP';
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
                ERP
            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Add Button -->
        <button class="btn btn-primary shadow-md mr-2" onclick="add_data()" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-view">Add </button>
        <!-- END: Add Button -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-5">
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-bordered table-striped" style="width:100%" cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Sl No.</th>
                                    <th>Item Name</th>
                                    <th>Part No</th>

                                   
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
                                    Item
                                </h2>
                            </div>
                            <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <form id="frm_user" name="frm_user" action="" method="post">
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                    <input id="item_id" name="item_id" type="hidden" class="form-control" placeholder="Item Id" readonly>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="item_name" class="form-label">Item Name</label>
                                        <input id="item_name" name="item_name" type="text" class="form-control" placeholder="Item Name">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="itemg_name" class="form-label">Item Group Name</label>
                                        <input id="itemg_name" name="itemg_name" type="text" class="form-control" placeholder="Item Group Name">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="ledger" class="form-label">Ledger</label>
                                        <input id="ledger" name="ledger" type="text" class="form-control" placeholder="ledger">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="showin_sr" class="form-label">Show in Source Report</label>
                                        <input id="showin_sr" name="showin_sr" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="source" class="form-label">Source</label>
                                        <input id="source" name="source" type="text" class="form-control" placeholder="Source">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="part_no" class="form-label">Part no</label>
                                        <input id="part_no" name="part_no" type="text" class="form-control" placeholder="Part no">
                                    </div>
                                   
                                     <div class="col-span-12 sm:col-span-6">
                                        <label for="make" class="form-label">Make</label>
                                        <input id="make" name="make" type="text" class="form-control" placeholder="Make">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="packaging_std" class="form-label">Packaging Std</label>
                                        <input id="packaging_std" name="packaging_std" type="text" class="form-control" placeholder="Packaging Std">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="grade" class="form-label">Grade</label>
                                        <input id="grade" name="grade" type="text" class="form-control" placeholder="Grade">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="specification" class="form-label">Specification AT</label>
                                        <input id="specification" name="specification" type="text" class="form-control" placeholder="Specification AT">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="min_level" class="form-label">Min Level</label>
                                        <input id="min_level" name="min_level" type="text" class="form-control" placeholder="Min Level">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="p_min_order" class="form-label">Packaginf min order</label>
                                        <input id="p_min_order" name="p_min_order" type="text" class="form-control" placeholder="Packaginf min order">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="reorder_level" class="form-label">Reorder Level</label>
                                        <input id="reorder_level" name="reorder_level" type="text" class="form-control" placeholder="Reorder Level">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="lead_time" class="form-label">Lead Time</label>
                                        <input id="lead_time" name="lead_time" type="text" class="form-control" placeholder="Lead Time">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="finished_work" class="form-label">Finished work</label>
                                        <input id="finished_work" name="finished_work" type="text" class="form-control" placeholder="Finished work">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="input_weight" class="form-label">input_weight</label>
                                        <input id="input_weight" name="input_weight" type="text" class="form-control" placeholder="Weight">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="length" class="form-label">Length</label>
                                        <input id="length" name="length" type="text" class="form-control" placeholder="length">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="thickness" class="form-label">Thickness</label>
                                        <input id="thickness" name="thickness" type="text" class="form-control" placeholder="Thickness">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="revision_level" class="form-label">Revision Level</label>
                                        <input id="revision_level" name="revision_level" type="text" class="form-control" placeholder="Revision Level">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="traffic_head" class="form-label">Traffic Level</label>
                                        <input id="traffic_head" name="traffic_head" type="text" class="form-control" placeholder="Traffic Level">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="hsn_code" class="form-label">HSN CODE</label>
                                        <input id="hsn_code" name="hsn_code" type="text" class="form-control" placeholder="hsn code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="sac_code" class="form-label">SAC code</label>
                                        <input id="sac_code" name="sac_code" type="text" class="form-control" placeholder="Sac code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="purchase_unit" class="form-label">Purchase unit</label>
                                        <input id="purchase_unit" name="purchase_unit" type="text" class="form-control" placeholder="Purchase Unit">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="stock_unit" class="form-label">Stock Unit</label>
                                        <input id="stock_unit" name="stock_unit" type="text" class="form-control" placeholder="Stock_unit">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="type" class="form-label">TYpe</label>
                                        <input id="type" name="type" type="text" class="form-control" placeholder="Type">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="auto_quality" class="form-label">Auto Quality</label>
                                        <input id="auto_quality" name="auto_quality" type="text" class="form-control" placeholder="Auto Quality">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="posting" class="form-label">Posting</label>
                                        <input id="posting" name="posting" type="text" class="form-control" placeholder="Posting">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="tooling" class="form-label">Account Type</label>
                                        <input id="tooling" name="tooling" type="text" class="form-control" placeholder="account type">
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
            url: "../server/ajax_party.php",
            type: "POST"
        },
        "columns": [{
                "data": "party_id",
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
                "data": "party_name"
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
                    url: '../api/party/' + id,
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
        $("#modal-title").text('Add Bank');
    }

    $("#btn_save").on("click", function() {
        const form = $("#frm_user");
        const json = convertFormToJSON(form);
        $.ajax({
            url: '../api/party',
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
            url: '../api/party/' + id,
            method: "GET",
            success: function(res) {
                $("#party_id").val(res.party_id);
                $("#party_name").val(res.party_name);
                $("#alias").val(res.alias);
                $("#partyg_name").val(res.partyg_name);
                $("#address").val(res.address);
                $("#pin").val(res.pin);
                $("#city_name").val(res.city_name);
                $("#contact").val(res.contact);
                $("#email").val(res.email);
                $("#division").val(res.division);
                $("#range_at").val(res.range_at);
                $("#grace_days").val(res.grace_days);
                $("#credit_days").val(res.credit_days);
                $("#tds_per").val(res.tds_per);
                $("#disc_per").val(res.disc_per);
                $("#distance").val(res.distance);
                $("#p_type").val(res.p_type);
                $("#bank_name").val(res.bank_name);
                $("#cheque").val(res.cheque);
                $("#ledger").val(res.ledger);
                $("#tin_no").val(res.tin_no);
                $("#gstin").val(res.gstin);
                $("#pan_no").val(res.pan_no);
                $("#service_tax_no").val(res.service_tax_no);
                $("#handling_charge").val(res.handling_charge);
                $("#micr_code").val(res.micr_code);
                $("#ifsc_code").val(res.ifsc_code);
                $("#account_no").val(res.account_no);
                $("#account_type").val(res.account_type);


            }
        });
    }

    $("#btn_update").on("click", function() {
        const form = $("#frm_user");
        const json = convertFormToJSON(form);
        var id = $("#party_id").val();
        $.ajax({
            url: '../api//' + id,
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