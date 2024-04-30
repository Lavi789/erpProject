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
                                    <th>Party Name</th>
                                   
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
                                    Party
                                </h2>
                            </div>
                            <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <form id="frm_user" name="frm_user" action="" method="post">
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                    <input id="party_id" name="party_id" type="hidden" class="form-control" placeholder="Party Id" readonly>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="party_name" class="form-label">Party Name</label>
                                        <input id="party_name" name="party_name" type="text" class="form-control" placeholder="Party Name">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="alias" class="form-label">Alias</label>
                                        <input id="alias" name="alias" type="text" class="form-control" placeholder="Alias">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="partyg_name" class="form-label">Part Group Name</label>
                                        <input id="partyg_name" name="partyg_name" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input id="address" name="address" type="text" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="pin" class="form-label">PIN</label>
                                        <input id="pin" name="pin" type="text" class="form-control" placeholder="PIN">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="city_name" class="form-label">CITY NAME</label>
                                        <input id="city_name" name="city_name" type="text" class="form-control" placeholder="CITY NAME">
                                    </div>
                                   
                                     <div class="col-span-12 sm:col-span-6">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input id="contact" name="contact" type="text" class="form-control" placeholder="Contact">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="email" class="form-label">EMAIL</label>
                                        <input id="email" name="email" type="text" class="form-control" placeholder="EMAIL">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="division" class="form-label">DIVISION</label>
                                        <input id="division" name="division" type="text" class="form-control" placeholder="DIVISION">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="range_at" class="form-label">RANGE AT</label>
                                        <input id="range_at" name="range_at" type="text" class="form-control" placeholder="RANGE AT">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="grace_days" class="form-label">GRACE DAYS</label>
                                        <input id="grace_days" name="grace_days" type="text" class="form-control" placeholder="GRACE DAYS">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="credit_days" class="form-label">credit DAYS</label>
                                        <input id="credit_days" name="credit_days" type="text" class="form-control" placeholder="credit DAYS">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="tds_per" class="form-label">TDS PER</label>
                                        <input id="tds_per" name="tds_per" type="text" class="form-control" placeholder="TDS PER">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="disc_per" class="form-label">DISC PER</label>
                                        <input id="disc_per" name="disc_per" type="text" class="form-control" placeholder="DISC PER">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="distance" class="form-label">DISTANCE</label>
                                        <input id="distance" name="distance" type="text" class="form-control" placeholder="DISTANCE">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="type" class="form-label">type</label>
                                        <input id="type" name="type" type="text" class="form-control" placeholder="type">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="bank_name" class="form-label">Bank</label>
                                        <input id="bank_name" name="bank_name" type="text" class="form-control" placeholder="bank">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="cheque" class="form-label">Cheque</label>
                                        <input id="cheque" name="cheque" type="text" class="form-control" placeholder="cheque">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="ledger" class="form-label">Ledger</label>
                                        <input id="ledger" name="ledger" type="text" class="form-control" placeholder="ledger">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="tin_no" class="form-label">TIN NO</label>
                                        <input id="tin_no" name="tin_no" type="text" class="form-control" placeholder="Tin no">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="gstin" class="form-label">GST IN</label>
                                        <input id="gstin" name="gstin" type="text" class="form-control" placeholder="gst in">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="pan_no" class="form-label">PAN NO</label>
                                        <input id="pan_no" name="pan_no" type="text" class="form-control" placeholder="pan no">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="service_tax_no" class="form-label">SERVICE TAX NO</label>
                                        <input id="service_tax_no" name="service_tax_no" type="text" class="form-control" placeholder="Service tax">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="handling_charge" class="form-label">Handling Charge</label>
                                        <input id="handling_charge" name="handling_charge" type="text" class="form-control" placeholder="Handling charge">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="micr_code" class="form-label">MICR CODE</label>
                                        <input id="micr_code" name="micr_code" type="text" class="form-control" placeholder="Micr code">
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="ifsc_code" class="form-label">IFSC CODE</label>
                                        <input id="ifsc_code" name="ifsc_code" type="text" class="form-control" placeholder="IFSC CODE">
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
                    url: '../api/bank/' + id,
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
            url: '../api/bank',
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
            url: '../api/bank/' + id,
            method: "GET",
            success: function(res) {
                $("#bank_id").val(res.bank_id);
                $("#bank_name").val(res.bank_name);
                $("#address").val(res.address);
            }
        });
    }

    $("#btn_update").on("click", function() {
        const form = $("#frm_user");
        const json = convertFormToJSON(form);
        var id = $("#bank_id").val();
        $.ajax({
            url: '../api/bank/' + id,
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