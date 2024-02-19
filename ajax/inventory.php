<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    $itemCode = $_POST['itemCode'];
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemCategory = $_POST['itemCategory'];
    $itemCondition = $_POST['itemCondition'];
    $itemQty = $_POST['itemQty'];
    $itemSize = $_POST['itemSize'];
    $photo = $itemName . time();
    $uploadsDir = '../static/item/';
    if (empty($_FILES) || !isset($_FILES['files'])) {
        $dir = "no-image.png"; // Set to NULL keyword
        $isImgUpdate = false;
    } else {
        $pth = $uploadsDir . $photo . ".png";
        $dir = $photo . ".png";
        move_uploaded_file($_FILES['files']['tmp_name'], $pth);
        $isImgUpdate = true;
    }
    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_inventory 
        (
            item_code,
            item_name,
            category_id,
            quantity,
            size_id,
            item_condition,
            status,
            description,
            img_path
        ) 
        VALUES ('$itemCode','$itemName',$itemCategory,$itemQty,$itemSize,'$itemCondition',1,'$itemDescription','$dir')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $itemCode = $_POST['itemCode'];
        if ($isImgUpdate) {
            $sql = "UPDATE tbl_inventory SET 
            item_code = '$itemCode',
            item_name = '$itemName',
            category_id = $itemCategory,
            quantity = $itemQty,
            size_id = $itemSize,
            item_condition = '$itemCondition',
            description='$itemDescription',
            img_path='$dir'
            WHERE item_code='$itemCode'";
        } else {
            $sql = "UPDATE tbl_inventory SET 
            item_code = '$itemCode',
            item_name = '$itemName',
            category_id = $itemCategory,
            quantity = $itemQty,
            size_id = $itemSize,
            item_condition = '$itemCondition',
            description='$itemDescription'
            WHERE item_code='$itemCode'";
        }

        $conn->query($sql);
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $itemCode = $_GET['itemCode'];
    $sql = "SELECT
    a.item_code,
    a.item_name,
    a.category_id,
    a.quantity,
    a.size_id,
    a.item_condition,
    a.status,
    a.description,
    a.img_path
FROM
    tbl_inventory a
WHERE item_code = '$itemCode'";
    $rs = $conn->query($sql);
    $data = [];
    if ($rs) {
        while ($row = $rs->fetch_assoc()) {
            $data[] = [
                'item_code' => $row['item_code'],
                'item_name' => $row['item_name'],
                'category_id' => $row['category_id'],
                'size_id' => $row['size_id'],
                'quantity' => $row['quantity'],
                'item_condition' => $row['item_condition'],
                'status' => $row['status'],
                'description' => $row['description'],
                'img_path' => $row['img_path'],
            ];
        }
    }
    echo json_encode($data);
}
