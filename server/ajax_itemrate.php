<?php
$requestData = $_REQUEST;
$item = isset($_GET['id']) ? $_GET['id'] : '';
$columns = array(
    0 => 'itemg_id',

    1 => 'item_name',
    2=> 'part_no',
    3 => 'action'
);



try {
require_once 'config/db.php';

$sql = "SELECT im.item_name, im.part_no 
FROM item im
JOIN itemgroup ig ON ig.itemg_id = im.itemg_id 
WHERE ig.itemg_id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $item, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countSql = "SELECT COUNT(*) 
     FROM item im
     JOIN itemgroup ig ON ig.itemg_id = im.itemg_id 
     WHERE ig.itemg_id = :id";
$countStmt = $conn->prepare($countSql);
$countStmt->bindParam(':id', $item, PDO::PARAM_INT);
$countStmt->execute();
$totalData = $countStmt->fetchColumn();
$totalFiltered = $totalData;

$sql .= " ORDER BY " . $columns[$_REQUEST['order'][0]['column']] . " " . $_REQUEST['order'][0]['dir'] . " LIMIT " . $_REQUEST['start'] . ", " . $_REQUEST['length'];

if (!empty($requestData['search']['value'])) {
$rd = "%{$requestData['search']['value']}%";
$sql .= " WHERE (itemg_name LIKE :search)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':search', $rd, PDO::PARAM_STR);
$stmt->execute();
$totalFiltered = $stmt->rowCount();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br>";
print $sql;
die();
}

$objArr = array();

foreach ($result as $row) {
    $object = new stdClass();

    $id = $row['itemg_name'];
    $itemid=$row['itemg_id'];

    $action = '<div class="flex justify-center items-center">
                <a href="javascript:;" onclick="load_data('.$itemid.',' . $id . ')" class="flex items-center mr-5"  data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-view">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></a>

                <a href="javascript:;" onclick="remove_data(' .$itemid.','. $id . ')" class="flex items-center text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></a>
                </div>';

    $object->itemg_id    = $id;
    $object->item_name  = $row['item_name'];
    $object->part_no  = $row['part_no'];
  
    $object->action     = $action;

    array_push($objArr, $object);
}

$output = array(
    "draw" => intval($_REQUEST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $objArr
);

echo json_encode($output);
?>
