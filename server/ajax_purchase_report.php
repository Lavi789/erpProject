<?php
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$columns = array(
    0 => 'grn_no',
    1 => 'grn_date',
    2 => 'supplier_id',
    3 => 'disc_amt',
    4 => 'invoice_no',
    5 => 'invoice_amt',
    6 => 'net_amt',
    6 => 'gst_amt',
    7 => 'payment_done',
    8 => 'remarks',
   
);

try {
    require_once 'config/db.php';

    $sql = "SELECT * FROM purchase";
    if ($startDate !== null && $endDate !== null) {
        $sql .= " WHERE DATE(GRN_DATE) BETWEEN '$startDate' AND '$endDate'";
    }

    $totalData = $conn->query("SELECT count(*) FROM ($sql) as count")->fetchColumn();
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . " GRN_DATE DESC " . "  LIMIT " . $_REQUEST['start'] . " ," . $_REQUEST['length'] . "   ";
    
    $result = $conn->query($sql)->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br>";
    print $sql;
    die();
}

$objArr = array();

foreach ($result as $row) {
    $object = new stdClass();

    $id = $row['grn_no'];

    $action = '<div class="flex justify-center items-center">
                <a href="javascript:;" onclick="viewData(' . $id . ')" class="flex items-center mr-5"  data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-view">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>
</a>';

    $object->grn_no    = $id;
    $object->grn_date  = $row['grn_date'];
    $object->supplier_id  = $row['supplier_id'];
    $object->disc_amt  = $row['disc_amt'];
    $object->invoice_no  = $row['invoice_no'];
    $object->invoice_amt  = $row['invoice_amt'];
    
    $object->net_amt  = $row['net_amt'];
    $object->gst_amt  = $row['gst_amt'];
   
    $object->payment_done  = $row['payment_done'];
    $object->remarks = $row['remarks'];
   
    

    $object->action     = $action;

    array_push($objArr, $object);
}

$output = array(
    "draw" => intval($_REQUEST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $objArr,
    "sql"=>$sql
);

echo json_encode($output);
