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
    $amenu = "sales";
    include 'layout/mob.php'
    ?>
    <!-- END: Mobile Menu Menu -->

    <!-- BEGIN: Top Bar -->
    <?php
    $currentPage = 'Retail Sales';
    include 'layout/top.php'
    ?>
    <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <?php
    $amenu = "sales";
    include 'layout/nav.php'
    ?>
    <!-- END: Top Menu -->

    <!-- BEGIN: Content -->
    <div class="content content--top-nav">
        <!-- BEGIN: Title -->
        <div class="intro-y flex items-center h-10 mt-8 mb-5">
            <h2 class="text-lg font-medium truncate mr-5">
                Retail Sales
            </h2>
        </div>
        <!-- BEGIN: Title -->

        <!-- BEGIN: Sales Header -->
        <div class="p-5 box mb-8 w-full sm:w-2/5">
            <!-- BEGIN: Customer Details -->
            <input id="customer_id" name="customer_id" type="hidden" class="form-control" placeholder="Customer Id" readonly>

            <div class="flex items-center">
                <label for="phone" class="form-label text-base mr-2"> Contact: </label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Contact No.">
            </div>
            <div class="flex items-center mt-4">
                <label for="customer_name" class="form-label text-base mr-2"> Name: </label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Name" readonly>
            </div>
            <!-- END: Customer Details -->

            <!-- BEGIN: Payment Details -->
            <div class="flex items-center mt-4">
                <label for="payment_mode" class="form-label text-base mr-2"> Payment Mode: </label>
                <select name="payment_mode" id="payment_mode" class="form-select">
                    <option value="Credit">Credit</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="UPI">UPI</option>
                </select>
            </div>
            <div class="flex items-center mt-4 hidden">
                <label for="payment_done" class="form-label text-base mr-2"> Payment Done: </label>
                <input type="checkbox" id="payment_done" name="payment_done" class="form-check-input" value="1">
            </div>
            <!-- END: Payment Details -->
        </div>
        <!-- END: Sales Header -->

        <!-- BEGIN: Barcode Input -->
        <label for="barcode" class="form-label mt-8">Barcode: </label>
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
                                    <th>Reqd. Qty</th>
                                    <th>AVL Qty</th>
                                    <th>Batch No.</th>
                                    <th>Exp Date</th>
                                    <th>Sales Rate</th>
                                    <th>Amount</th>
                                    <th>Discount %</th>
                                    <th>Discount Amt</th>
                                    <th hidden>Discount Rate</th>
                                    <th>GST Type</th>
                                    <th>GST %</th>
                                    <th>GST Amt</th>
                                    <th hidden>GST Rate</th>
                                    <th>Net Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="salesBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Responsive Table -->

        <!-- BEGIN: Sales Footer -->
        <div class="p-5 box mt-8 w-full sm:w-1/4">
            <!-- BEGIN: Bill Details -->
            <div class="flex items-center">
                <label for="total_amount" class="form-label text-base mr-2"> Total Amount: </label>
                <input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="Total Amount" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_disc_amt" class="form-label text-base mr-2"> Total Discount: </label>
                <input type="text" id="total_disc_amt" name="total_disc_amt" class="form-control" placeholder="Total Discount" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_net_amt" class="form-label text-base mr-2"> Net Payable: </label>
                <input type="text" id="total_net_amt" name="total_net_amt" class="form-control" placeholder="Net Payable" readonly>
            </div>
            <div class="flex items-center mt-4">
                <label for="total_gst_amt" class="form-label text-base mr-2"> GST Amt: </label>
                <input type="text" id="total_gst_amt" name="total_gst_amt" class="form-control" placeholder="GST Amt" readonly>
            </div>
            <!-- END: Bill Details -->
        </div>
        <!-- END: Sales Footer -->

        <!-- BEGIN: Buttons -->
        <div class="mt-8">
            <button id="btn_save" class="btn btn-primary w-20 mr-2">Save</button>
            <button id="btn_bill" class="btn btn-primary w-20 mr-2 hidden">Print Bill</button>
            <a href="">
                <button id="btn_new_bill" class="btn btn-primary w-20 mr-2 hidden">New Bill</button>
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
            url: "../api/stock_item/" + code,
            method: "GET",
            success: function(res) {
                console.log(res);
                $("#barcode").val('');
                $("#barcode").focus();

                // Calculating discount amt
                let discAmt = res.sales_rate * (parseFloat(res.disc_per) / 100);

                // Calculating gst amt and net amt
                let gstPer = parseFloat(res.gst);
                let gstAmt = 0;
                let netAmt = 0;
                let salesRate = parseFloat(res.sales_rate);

                if (gstPer) {
                    if (res.gst_flag == 'Exclusive') {
                        gstAmt = salesRate * (gstPer / 100);

                        // Calculating net amt
                        netAmt = salesRate - discAmt + gstAmt;

                    } else if (res.gst_flag == 'Inclusive') {
                        let originalAmt = salesRate / (1 + (gstPer / 100));
                        gstAmt = salesRate - originalAmt;

                        // Calculating net amt
                        netAmt = salesRate - discAmt;
                    }
                } else {
                    // Calculating net amt
                    netAmt = salesRate - discAmt;
                }

                gstAmt = parseFloat(gstAmt.toFixed(2));

                count += 1;

                let row = "";

                row += `<tr id="row${count}">`;

                row += `<td class="inp_item_code" id="inp_item_code${count}">${res.item_code}</td>`;
                row += `<td class="inp_item_name" id="inp_item_name${count}">${res.item_name}</td>`;
                row += `<td>
                            <input type="number" class="inp_qty form-control" id="inp_qty${count}" value="1" min="1" max="${res.qty}" onchange=updateAmount(${count}) style="width: 70px;">
                        </td>`;
                row += `<td class="inp_avl_qty" id="inp_avl_qty${count}">${res.qty}</td>`;
                row += `<td class="inp_batch_no" id="inp_batch_no${count}">${res.batch_no}</td>`;
                row += `<td class="inp_exp_date" id="inp_exp_date${count}">${res.exp_date}</td>`;
                row += `<td class="inp_sales_rate" id="inp_sales_rate${count}">${res.sales_rate}</td>`;
                row += `<td class="inp_amount" id="inp_amount${count}">${res.sales_rate}</td>`;
                row += `<td class="inp_disc_per" id="inp_disc_per${count}">${res.disc_per}</td>`;
                row += `<td class="inp_disc_amt" id="inp_disc_amt${count}">${discAmt}</td>`;
                row += `<td class="inp_disc_rate" id="inp_disc_rate${count}" hidden>${discAmt}</td>`; // Storing discount amt of 1 unit
                row += `<td class="inp_gst_flag" id="inp_gst_flag${count}">${res.gst_flag}</td>`;
                row += `<td class="inp_gst_per" id="inp_gst_per${count}">${gstPer}</td>`;
                row += `<td class="inp_gst_amt" id="inp_gst_amt${count}">${gstAmt}</td>`;
                row += `<td class="inp_gst_rate" id="inp_gst_rate${count}" hidden>${gstAmt}</td>`; // Storing gst amt of 1 unit
                row += `<td class="inp_net_amt" id="inp_net_amt${count}">${netAmt}</td>`;
                row += `<td class="remove_row" id="remove_row${count}">
                            <a href="javascript:;" onclick="removeRow(${count})" class="flex items-center text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></a>
                        </td>`;

                row += "</tr>";

                $("#salesBody").after(row);

                totalAmount += parseFloat(res.sales_rate);
                totalNetAmt += netAmt;
                totalDiscAmt += discAmt;
                totalGstAmt += gstAmt;

                $("#total_amount").val(totalAmount);
                $("#total_net_amt").val(totalNetAmt);
                $("#total_disc_amt").val(totalDiscAmt);
                $("#total_gst_amt").val(totalGstAmt);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error, if any
                let errorMsg = xhr.responseJSON.msg;

                Swal.fire(errorMsg, '', 'info');
            }
        });
    });

    // Funtion to calculate and update the amount, net amount and disc amount on the change of qty.
    function updateAmount(count) {
        let qty = $("#inp_qty" + count).val();
        let avlQty = parseInt($("#inp_avl_qty" + count).html());
        let salesRate = parseFloat($("#inp_sales_rate" + count).html());
        let discAmtOld = parseFloat($("#inp_disc_amt" + count).html());
        let discRate = parseFloat($("#inp_disc_rate" + count).html());
        let amountOld = parseFloat($("#inp_amount" + count).html());
        let netAmtOld = parseFloat($("#inp_net_amt" + count).html());
        let gstFlag = $("#inp_gst_flag" + count).html();
        let gstRate = parseFloat($("#inp_gst_rate" + count).html());
        let gstAmtOld = parseFloat($("#inp_gst_amt" + count).html());

        // Error handling regarding qty
        if (qty > avlQty) {
            Swal.fire({
                text: 'Qty cannot be greater than available qty of item in this batch',
                icon: "info"
            });

            $("#inp_qty" + count).val(1);

            return;
        }

        if (qty <= 0) {
            Swal.fire({
                text: 'Qty cannot be less than or equal to 0',
                icon: "info"
            });

            $("#inp_qty" + count).val(1);

            return;
        }

        // Calculating new amount, disc, net amt and gst amt
        let amountNew = salesRate * qty;
        let discAmtNew = discRate * qty;
        let gstAmtNew = gstRate * qty;

        let netAmtNew = 0;

        if (gstFlag == "Exclusive") {
            netAmtNew = amountNew - discAmtNew + gstAmtNew;
        } else {
            netAmtNew = amountNew - discAmtNew; 
        }

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

        totalGstAmt = parseFloat(totalGstAmt);

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
        totalGstAmt = totalGstAmt - gstAmt;

        $("#total_amount").val(totalAmount);
        $("#total_net_amt").val(totalNetAmt);
        $("#total_disc_amt").val(totalDiscAmt);
        $("#total_gst_amt").val(totalGstAmt);

        $("#row" + count).remove();
    }

    // Get the customer details
    $("#phone").on("change", function() {
        const phone = $("#phone").val().trim();

        if (!phone) {
            return;
        }

        $.ajax({
            url: "../api/customer/phone/" + phone,
            method: "GET",
            success: function(res) {
                $("#customer_id").val(res.customer_id);
                $("#customer_name").val(res.customer_name);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);

                Swal.fire('Customer is not registered', '', 'info');
                // Handle error, if any
            }
        });
    });

    // Saving the Data
    $("#btn_save").on("click", function() {
        // Check if customer details are entered or not 
        if (!$("#customer_id").val()) {
            Swal.fire('Please enter customer details', '', 'info');
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

        data["customer_id"] = $("#customer_id").val();
        data["amount"] = $("#total_amount").val();
        data["disc_amt"] = $("#total_disc_amt").val();
        data["net_amt"] = $("#total_net_amt").val();
        data["gst_amt"] = $("#total_gst_amt").val();
        data["payment_mode"] = $("#payment_mode").val();
        data["payment_done"] = $("#payment_done").val();

        data["items"] = [];

        let item_code_arr = $(".inp_item_code");
        let qty_arr = $(".inp_qty");
        let batch_no_arr = $(".inp_batch_no");
        let exp_date_arr = $(".inp_exp_date");
        let amount_arr = $(".inp_amount");
        let disc_per_arr = $(".inp_disc_per");
        let disc_amt_arr = $(".inp_disc_amt");
        let gst_amt_arr = $(".inp_gst_amt");
        let net_amt_arr = $(".inp_net_amt");

        item_code_arr.each(function(i) {
            det = {};

            det['item_code'] = item_code_arr[i].innerHTML;
            det['qty'] = qty_arr[i].value;
            det['batch_no'] = batch_no_arr[i].innerHTML;
            det['exp_date'] = exp_date_arr[i].innerHTML;
            det['amount'] = amount_arr[i].innerHTML;
            det['disc_per'] = disc_per_arr[i].innerHTML;
            det['disc_amt'] = disc_amt_arr[i].innerHTML;
            det['gst_amt'] = gst_amt_arr[i].innerHTML;
            det['net_amt'] = net_amt_arr[i].innerHTML;

            data["items"].push(det);
        });

        $.ajax({
            url: "../api/sales",
            type: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.status === "Ok") {
                    $("#btn_bill").removeClass('hidden');
                    $("#btn_new_bill").removeClass('hidden');

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