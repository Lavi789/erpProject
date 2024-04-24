<?php
session_start();
if ((!isset($_SESSION['user_name']))) {
    header('refresh: 1;url=login.php');
    die('Please Login First...<br><br>Redirectiing in a sec to Login Page');
}

require_once '../server/config/db.php';

$supplier = $conn->query("SELECT * FROM supplier ORDER BY supplier_name ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- END: CSS Assets-->

    <style>
        @media (min-width: 640px) {
            .sm\:w-1\/2 {
                width: 50%;
            }

            .sm\:w-1\/4 {
                width: 25%;
            }

            .sm\:w-2\/5 {
                width: 40%;
            }
        }
    </style>
</head>

<!-- END: Head -->

<body class="py-5 md:py-0">

    <!-- BEGIN: Mobile Menu Menu -->
    <?php
    $amenu = "purchase";
    include 'layout/mob.php'
    ?>
    <!-- END: Mobile Menu Menu -->

    <!-- BEGIN: Top Bar -->
    <?php
    $currentPage = 'Purchase Return Invoice';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "purchase";
    include 'layout/nav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: Title -->
        <div class="intro-y flex items-center h-10 mt-8 mb-5">
            <h2 class="text-lg font-medium truncate mr-5">
                Purchase Return Invoice
            </h2>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Purchase Header -->
        <div class="grid grid-cols-12 gap-6 mt-8 p-5 py-8">
            <div class="col-span-12 sm:col-span-4">
                <label for="old_grn_no" class="form-label">Old GRN No.</label>
                <input id="old_grn_no" name="old_grn_no" type="text" class="form-control" placeholder="Old GRN No.">
            </div>
            <div class="col-span-12 sm:col-span-4">
                <label for="invoice_no" class="form-label">Invoice No.</label>
                <input id="invoice_no" name="invoice_no" type="text" class="form-control" placeholder="Invoice No.">
            </div>
            <div class="col-span-12 sm:col-span-4">
                <label for="invoice_date" class="form-label">Invoice Date</label>
                <input id="invoice_date" name="invoice_date" type="date" class="form-control" placeholder="Invoice Date">
            </div>
            <div class="col-span-12 sm:col-span-4">
                <label for="supplier_id" class="form-label">Supplier Name</label>
                <select id="supplier_id" name="supplier_id" data-placeholder="Select Supplier" class="form-select">
                    <option value="null" selected disabled>--Select--</option>
                    <?php
                    foreach ($supplier as $row) {
                    ?>
                        <option value="<?php echo $row['supplier_id'] ?>"><?php echo $row['supplier_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <label for="item_receive_date" class="form-label">Item Receive Date</label>
                <input id="item_receive_date" name="item_receive_date" type="date" class="form-control" placeholder="Item Receive Date">
            </div>
            <div class="col-span-12 sm:col-span-4">
                <label for="payment_mode" class="form-label"> Payment Mode: </label>
                <select name="payment_mode" id="payment_mode" class="form-select">
                    <option value="Check">Check</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="UPI">UPI</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-4 hidden">
                <label for="payment_done" class="form-label text-base mr-2"> Payment Done: </label>
                <input type="checkbox" id="payment_done" name="payment_done" class="form-check-input" value="1">
            </div>
        </div>
        <!-- END: Purchase Header -->

        <!-- BEGIN: Barcode Input -->
        <label for="barcode" class="form-label mt-12">Barcode: </label>
        <input type="text" id="barcode" name="barcode" class="form-control w-full sm:w-1/4" autofocus>
        <!-- END: Barcode Input -->

        <!-- BEGIN: Responsive Table -->
        <div class="intro-y box mt-8">
            <div class="p-5" id="responsive-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table id="table" class="table table-bordered table-striped" style="width:100%" cellpadding="7px">
                            <thead class="table-dark">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Batch No.</th>
                                    <th>Exp Date</th>
                                    <th>Free Qty</th>
                                    <th>Purchase Rate</th>
                                    <th>Amount</th>
                                    <th>Discount %</th>
                                    <th>Discount Rate</th>
                                    <th>Discount Amt</th>
                                    <th>HSN Code</th>
                                    <th hidden>GST Type</th>
                                    <th>GST %</th>
                                    <th>GST Rate</th>
                                    <th>GST Amt</th>
                                    <th>Net Amt</th>
                                    <th>Sales Rate</th>
                                    <th>Sales Discount %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="purchaseBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Responsive Table -->

        <!-- BEGIN: Purchase Footer -->
        <div class="box p-5 mt-8 w-full sm:w-1/4">
            <div class="flex items-center">
                <label for="total_amount" class="form-label text-base mr-2"> Total Amount: </label>
                <input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="Total Amount" value="0" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_disc_amt" class="form-label text-base mr-2"> Total Discount: </label>
                <input type="text" id="total_disc_amt" name="total_disc_amt" class="form-control" placeholder="Total Discount" value="0" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_net_amt" class="form-label text-base mr-2"> Net Payable: </label>
                <input type="text" id="total_net_amt" name="total_net_amt" class="form-control" placeholder="Net Payable" value="0" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_gst_amt" class="form-label text-base mr-2"> GST Amt: </label>
                <input type="text" id="total_gst_amt" name="total_gst_amt" class="form-control" placeholder="GST Amt" value="0" readonly>
            </div>
        </div>
        <!-- END: Purchase Footer -->

        <!-- BEGIN: Buttons -->
        <div class="mt-8">
            <button id="btn_save" class="btn btn-primary w-20 mr-2">Save</button>
            <button id="btn_inv" class="btn btn-primary w-20 mr-2 hidden">Print Invoice</button>
            <a href="">
                <button id="btn_new_inv" class="btn btn-primary w-20 mr-2 hidden">New Invoice</button>
            </a>
        </div>
        <!-- END: Buttons -->
    </div>
    <!-- END: Content -->

    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.all.js"></script>
    <!-- END: JS Assets-->
</body>

<script>
    let count = 0;
    let totalAmount = 0;
    let totalDiscAmt = 0;
    let totalNetAmt = 0;
    let totalGstAmt = 0;

    $("#barcode").on("change", function() {
        const code = $("#barcode").val().trim();

        if (!code) {
            return;
        }

        // Get all the batches with the item code or barcode
        $.ajax({
            url: "../api/item_pur/" + code,
            method: "GET",
            success: function(res) {
                $("#barcode").val('');
                $("#barcode").focus();

                count += 1;

                let row = "";

                row += `<tr id="row${count}">`;

                row += `<td class="inp_item_code" id="inp_item_code${count}">${res.item_code}</td>`;
                row += `<td class="inp_item_name" id="inp_item_name${count}">${res.item_name}</td>`;
                row += `<td>
                            <input type="number" class="inp_qty form-control" id="inp_qty${count}" value="1" min="1" style="width: 70px;">
                        </td>`;
                row += `<td>
                            <input type="text" class="inp_batch_no form-control" id="inp_batch_no${count}" style="width: 120px;">
                        </td>`;
                row += `<td>
                            <input type="date" class="inp_exp_date form-control" id="inp_exp_date${count}">
                        </td>`;
                row += `<td>
                            <input type="number" class="inp_free_qty form-control" id="inp_free_qty${count}" value="0" min="0" style="width: 70px;">
                        </td>`;
                row += `<td>
                            <input type="text" class="inp_purchase_rate form-control" id="inp_purchase_rate${count}" value="0.00" style="width: 70px;">
                        </td>`;
                row += `<td class="inp_amount" id="inp_amount${count}">0</td>`;
                row += `<td>
                            <input type="text" class="inp_disc_per form-control" id="inp_disc_per${count}" value="0.00" style="width: 70px;">
                        </td>`;
                row += `<td class="inp_disc_rate" id="inp_disc_rate${count}">0</td>`; // Storing disc amt of 1 unit
                row += `<td class="inp_disc_amt" id="inp_disc_amt${count}">0</td>`;
                row += `<td class="inp_hsn_code" id="inp_hsn_code${count}">${res.hsn_code}</td>`;
                row += `<td class="inp_gst_flag" id="inp_gst_flag${count}" hidden>${res.gst_flag}</td>`;
                row += `<td class="inp_gst_per" id="inp_gst_per${count}">${res.gst}</td>`;
                row += `<td class="inp_gst_rate" id="inp_gst_rate${count}">0</td>`; // Storing gst amt of 1 unit
                row += `<td class="inp_gst_amt" id="inp_gst_amt${count}">0</td>`;
                row += `<td class="inp_net_amt" id="inp_net_amt${count}">0.00</td>`;
                row += `<td>
                            <input type="text" class="inp_sales_rate form-control" id="inp_sales_rate${count}" value="0.00" style="width: 70px;">
                        </td>`;
                row += `<td>
                            <input type="text" class="inp_sales_disc_per form-control" id="inp_sales_disc_per${count}" value="0.00" style="width: 70px;">
                        </td>`;
                row += `<td class="action_row" id="action_row${count}">
                            <div class="flex justify-center items-center">
                                <a href="javascript:;" onclick="updateAmount(${count})" class="flex items-center text-success mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="send" data-lucide="send" class="lucide lucide-send block mx-auto"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></a>

                                <a href="javascript:;" onclick="removeRow(${count})" class="flex items-center text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></a>
                            </div>
                        </td>`;

                row += "</tr>";

                $("#purchaseBody").after(row);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);

                Swal.fire('Unkonwn Item', '', 'info');
                // Handle error, if any
            }
        });
    });

    // Funtion to calculate and update the amount, net amount and disc amount on the change of qty.
    function updateAmount(count) {
        let qty = $("#inp_qty" + count).val();
        let purchaseRate = parseFloat($("#inp_purchase_rate" + count).val());
        let discPer = parseFloat($("#inp_disc_per" + count).val());
        let discAmtOld = parseFloat($("#inp_disc_amt" + count).html());
        let discRate = parseFloat($("#inp_disc_rate" + count).html());
        let amountOld = parseFloat($("#inp_amount" + count).html());
        let netAmtOld = parseFloat($("#inp_net_amt" + count).html());
        let gstFlag = $("#inp_gst_flag" + count).html();
        let gstPer = parseFloat($("#inp_gst_per" + count).html());
        let gstAmtOld = parseFloat($("#inp_gst_amt" + count).html());
        let gstRate = parseFloat($("#inp_gst_rate" + count).html());

        // Error handling regarding qty
        if (qty <= 0) {
            Swal.fire({
                text: 'Qty cannot be less than or equal to 0',
                icon: "info"
            });

            $("#inp_qty" + count).val(1);

            return;
        }

        // Calculating gst rate of 1 unit
        if (!gstRate) {
            gstRate = 0;

            if (gstPer) {
                if (gstFlag == 'Inclusive') {
                    let originalAmt = purchaseRate / (1 + (gstPer / 100));
                    gstRate = purchaseRate - originalAmt;

                } else if (gstFlag == 'Exclusive') {
                    gstRate = purchaseRate * (gstPer / 100);
                }
            }

            gstRate = parseFloat(gstRate.toFixed(2));

            $("#inp_gst_rate" + count).html(gstRate);
        }

        // Calculating discount rate of 1 unit
        if (!discRate) {
            discRate = 0;

            discRate = purchaseRate * (discPer / 100);

            $("#inp_disc_rate" + count).html(discRate);
        }

        // Calculating new amount, disc, net amt and gst amt
        let amountNew = purchaseRate * qty;
        let discAmtNew = discRate * qty;
        let netAmtNew = amountNew - discAmtNew;
        let gstAmtNew = gstRate * qty;

        // Updating new amount, disc, net amt and gst amt
        $("#inp_amount" + count).html(amountNew);
        $("#inp_net_amt" + count).html(netAmtNew);
        $("#inp_disc_amt" + count).html(discAmtNew);
        $("#inp_gst_amt" + count).html(gstAmtNew);

        // Calculating new amount, disc, net amt and gst amt on the bill
        totalAmount = (totalAmount - amountOld) + amountNew;
        totalNetAmt = (totalNetAmt - netAmtOld) + netAmtNew;
        totalDiscAmt = (totalDiscAmt - discAmtOld) + discAmtNew;
        totalGstAmt = ((totalGstAmt - gstAmtOld) + gstAmtNew).toFixed(2);

        // totalGstAmt = parseFloat(totalGstAmt);

        // Updating new amount, disc, net amt and gst amt on the bill
        $("#total_amount").val(totalAmount);
        $("#total_net_amt").val(totalNetAmt);
        $("#total_disc_amt").val(totalDiscAmt);
        $("#total_gst_amt").val(totalGstAmt);
    }

    // Function to remove row
    function removeRow(count) {
        let amount = parseFloat($("#inp_amount" + count).html());
        let netAmt = parseFloat($("#inp_net_amt" + count).html());
        let discAmt = parseFloat($("#inp_disc_amt" + count).html());
        let gstAmt = parseFloat($("#inp_gst_amt" + count).html());

        totalAmount = totalAmount - amount;
        totalNetAmt = totalNetAmt - netAmt;
        totalDiscAmt = totalDiscAmt - discAmt;
        totalGstAmt = (totalGstAmt - gstAmt).toFixed(2);

        // totalGstAmt = parseFloat(totalGstAmt);

        $("#total_amount").val(totalAmount);
        $("#total_net_amt").val(totalNetAmt);
        $("#total_disc_amt").val(totalDiscAmt);
        $("#total_gst_amt").val(totalGstAmt);

        $("#row" + count).remove();
    }

    // Saving the Data
    $("#btn_save").on("click", function() {
        // Check if supplier is selected or not 
        if (!$("#supplier_id").val()) {
            Swal.fire('Please select a supplier', '', 'info');
            return;
        }

        // Return if no item has been selected
        if (totalAmount == 0) {
            Swal.fire('Select at least 1 item', '', 'info');
            return;
        }

        // Disable the save btn
        $("#btn_save").attr("disabled", true);

        let data = {};

        data["supplier_id"] = $("#supplier_id").val();
        data["invoice_no"] = $("#invoice_no").val();
        data["invoice_date"] = $("#invoice_date").val();
        data["item_receive_date"] = $("#item_receive_date").val();
        data["amount"] = $("#total_amount").val();
        data["disc_amt"] = $("#total_disc_amt").val();
        data["gst_amt"] = $("#total_gst_amt").val();
        data["net_amt"] = $("#total_net_amt").val();
        data["payment_mode"] = $("#payment_mode").val();
        data["payment_done"] = $("#payment_done").val();

        data["items"] = [];

        let item_code_arr = $(".inp_item_code");
        let qty_arr = $(".inp_qty");
        let batch_no_arr = $(".inp_batch_no");
        let exp_date_arr = $(".inp_exp_date");
        let free_qty_arr = $(".inp_free_qty");
        let purchase_rate_arr = $(".inp_purchase_rate");
        let amount_arr = $(".inp_amount");
        let disc_per_arr = $(".inp_disc_per");
        let disc_amt_arr = $(".inp_disc_amt");
        let gst_amt_arr = $(".inp_gst_amt");
        let net_amt_arr = $(".inp_net_amt");
        let sales_rate_arr = $(".inp_sales_rate");
        let sales_disc_per_arr = $(".inp_sales_disc_per");

        item_code_arr.each(function(i) {
            det = {};

            det['item_code'] = item_code_arr[i].innerHTML;
            det['qty'] = qty_arr[i].value;
            det['batch_no'] = batch_no_arr[i].value;
            det['exp_date'] = exp_date_arr[i].value;
            det['free_qty'] = free_qty_arr[i].value;
            det['purchase_rate'] = purchase_rate_arr[i].value;
            det['amount'] = amount_arr[i].innerHTML;
            det['disc_per'] = disc_per_arr[i].value;
            det['disc_amt'] = disc_amt_arr[i].innerHTML;
            det['gst_amt'] = gst_amt_arr[i].innerHTML;
            det['net_amt'] = net_amt_arr[i].innerHTML;
            det['sales_rate'] = sales_rate_arr[i].value;
            det['sales_disc_per'] = sales_disc_per_arr[i].value;

            data["items"].push(det);
        });

        $.ajax({
            url: "../api/purchase",
            type: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.status === "Ok") {
                    $("#btn_inv").removeClass('hidden');
                    $("#btn_new_inv").removeClass('hidden');

                    Swal.fire(data.msg, '', 'success');
                } else {
                    Swal.fire(data.msg, '', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);

                Swal.fire('OPPs', '', 'error');
                // Handle error, if any
                $("#btn_save").attr("disabled", false);
            }
        });
    });
</script>

</html>