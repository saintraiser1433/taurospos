<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'Quantity') {
        $qty = @$_POST['quantity'];
        $itemId = @$_POST['id'];
        $id = @$_SESSION['staff_id'];
        $sql = "INSERT INTO tbl_cart (item_id,quantity,transact_by) values ($itemId,$qty,$id)";
        $conn->query($sql);
        header("Location:../staff/index.php");
    }
}
