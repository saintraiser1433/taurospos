<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    $trans = $_POST['transaction_no'];
    $borrowId = $_POST['borrowerId'];
    $itemCode = $_POST['item_code'];
    $counter = $_POST['counter'];
    $rtndate = $_POST['rtndate'];

    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_transaction 
        (transaction_no,
            borrower_id,
            item_code,
            quantity,
            start_date,
            return_date,
            return_condition,
            status) 
        VALUES ($trans,'$borrowId','$itemCode',$counter,null,'$rtndate',null,4)";
        $conn->query($sql);
    }

    //status: 
    // 4-For Approval 
    // 3-Waiting to claim
    // 2-Waiting to returned  
    // 1-Partially Returned  
    // 0-Returned
}
