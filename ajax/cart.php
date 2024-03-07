<?php
include '../connection.php';
$action = $_POST['action'];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $borrowId = $_SESSION['borrower_id'];
    $itemCode = $_POST['item_code'];
    $counter = @$_POST['quantity'];
    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_cart 
            (item_code,
            quantity,
            borrower_id) 
        VALUES ('$itemCode',$counter,'$borrowId')";
        $conn->query($sql);
    }

    if ($action == 'REMOVE') {
        $sql = "DELETE FROM tbl_cart where item_code='$itemCode' and borrower_id='$borrowId'";
        $conn->query($sql);
    }
}


// transid: col1,
// qty : qty,
// action: 'RETURN'


  //status: 
    // 6-For Approval 
    // 5-Cancelled 
    // 4-Rejected
    // 3-Waiting to claim
    // 2-Waiting to returned  
    // 1-Partially Returned  
    // 0-Returned
