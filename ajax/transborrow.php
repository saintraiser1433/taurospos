<?php
include '../connection.php';
$action = $_POST['action'];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $trans = @$_POST['transaction_no'];
    $borrowId = @$_POST['borrowerId'];
    $itemCode = @$_POST['item_code'];
    $counter = @$_POST['counter'];
    $rtndate = @$_POST['rtndate'];

    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_transaction 
        (transaction_id,
            borrower_id,
            item_code,
            quantity,
            start_date,
            return_date,
            status) 
        VALUES ($trans,'$borrowId','$itemCode',$counter,null,'$rtndate',6)";
        $conn->query($sql);
    }
    if ($action == 'APPROVED') {
        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=3 where transaction_id=$transId";
        $conn->query($sql);
    } else if ($action == 'REJECT') {
        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=4 where transaction_id=$transId";
        $conn->query($sql);
    } else if ($action == 'RECEIVE') {
        $transId = $_POST['transid'];
        $qty = $_POST['qty'];
        $code = $_POST['code'];
        $startDate = date('Y-m-d');
        $sql = "UPDATE tbl_transaction SET status=2, start_date='$startDate'  where transaction_id=$transId";
        $conn->query($sql);
        $sqlx = "UPDATE tbl_inventory SET quantity=quantity-$qty where item_code='$code'";
        $conn->query($sqlx);
    } else if ($action == 'CANCELLED') {
        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=5 where transaction_id=$transId";
        $conn->query($sql);
    } else if ($action == 'RETURN') {
        $transId = $_POST['transid'];
        $qty = $_POST['qty'];
        $mysql = "SELECT
                quantity
                FROM
                    tbl_return_items
                WHERE transaction_id = $transId";
        $rs = $conn->query($mysql);
        if ($rs->num_rows > 0) {
            $updateqty = "UPDATE tbl_return_items SET quantity=quantity+$qty where transaction_id=$transId";
            $conn->query($updateqty);
        } else {
            $insertsql = "INSERT tbl_return_items (transaction_id,quantity) values ($transId,$qty)";
            $conn->query($insertsql);
            $sqlstatus = "UPDATE tbl_transaction SET status = 1 where transaction_id=$transId";
            $conn->query($sqlstatus);
        }
        checkReturns($transId, $conn);
    }
}

function checkReturns($transId, $conn)
{
    // Use prepared statement to prevent SQL injection
    $sqlReturns = "SELECT *
            FROM tbl_transaction trans
            WHERE trans.quantity = (
                SELECT ri.quantity
                FROM tbl_return_items ri
                WHERE ri.transaction_no = ?)
            AND trans.transaction_id = ?";
    $stmt = $conn->prepare($sqlReturns);
    $stmt->bind_param("ii", $transId, $transId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Update status in tbl_return_items
        $sql = "UPDATE tbl_transaction SET status = 0 WHERE transaction_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $transId);
        $stmt->execute();
        $stmt->close();
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
