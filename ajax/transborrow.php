<?php
include '../connection.php';
$action = $_POST['action'];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

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
        VALUES ($trans,'$borrowId','$itemCode',$counter,null,'$rtndate',null,5)";
        $conn->query($sql);
    }
    if ($action == 'APPROVED') {

        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=3 where transaction_no=$transId";
        $conn->query($sql);
    } else if ($action == 'REJECT') {
        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=4 where transaction_no=$transId";
        $conn->query($sql);
    } else if ($action == 'RECEIVE') {
        $transId = $_POST['transid'];
        $startDate = date('Y-m-d');
        $sql = "UPDATE tbl_transaction SET status=2, start_date='$startDate'  where transaction_no=$transId";
        $conn->query($sql);
    }
}




  //status: 
    // 5-For Approval 
    // 4-Rejected
    // 3-Waiting to claim
    // 2-Waiting to returned  
    // 1-Partially Returned  
    // 0-Returned
