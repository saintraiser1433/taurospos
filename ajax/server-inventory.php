<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = @$_POST['action'];
    $assetcode = @$_POST['assetcode'];
    $itemname = @$_POST['itemname'];
    $category = @$_POST['category'];
    $description = @$_POST['description'];
    $price = @$_POST['price'];
    $itemSize = @$_POST['itemSize'];
    $status = @$_POST['status'];
    $photo = @$itemname . time();
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
            category_id,
            item_name,
            description,
            price,
            img_path
        ) 
        VALUES ('$assetcode',$category,'$itemname','$description',$price,'$dir')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        if ($isImgUpdate) {
            $sql = "UPDATE tbl_inventory SET 
            item_name = '$itemname',
            category_id = $category,
            description='$description',
            img_path='$dir',
            price=$price,
            status =$status
            WHERE item_code='$assetcode'";
        } else {
            $sql = "UPDATE tbl_inventory SET 
            item_name = '$itemname',
            category_id = $category,
            description='$description',
            price=$price,
            status =$status
            WHERE item_code='$assetcode'";
        }
        $conn->query($sql);
    } else if ($action == 'DELETE') {
        $sql = "DELETE FROM tbl_inventory WHERE item_code='$assetcode'";
        $conn->query($sql);
    }
}
