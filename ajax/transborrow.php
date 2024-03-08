<?php
include '../connection.php';
$action = $_POST['action'];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $trans = @$_POST['trans_code'];
    $borrowId = @$_SESSION['borrower_id'];
    $itemCode = @$_POST['item_code'];
    $counter = @$_POST['counter'];
    $rtndate = @$_POST['rtndate'];
    if ($action == 'GET') {
        $sqlt = "SELECT
        b.item_name,
        SUM(a.quantity) as qty,
        a.return_quantity
    FROM
        tbl_transaction a
    INNER JOIN tbl_item b ON
        a.item_code = b.item_code
    WHERE
        a.transaction_code = '$trans'
    group by a.item_code    
    ";
        $rs = $conn->query($sqlt);
        $response = array();
        if ($rs) {
            while ($row = $rs->fetch_assoc()) {
                // Assuming your resident table has 'id', 'name', and 'age' columns
                $response[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_transaction(
            transaction_code,
            borrower_id,
            item_code,
            quantity,
            STATUS
        )
        SELECT
            $trans,
            borrower_id,
            item_code,
            sum(quantity) as qty,
            6
        FROM
            tbl_cart
        WHERE
            borrower_id = '$borrowId'
        GROUP BY item_code  
        ";
        $conn->query($sql);

        $delcart = "DELETE FROM tbl_cart where borrower_id='$borrowId'";
        $conn->query($delcart);
    } else if ($action == 'APPROVED') {
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
        $return = date('Y-m-d', strtotime('+5 days'));
        $sql = "UPDATE tbl_transaction SET status=2, start_date='$startDate',expected_return_date='$return' where transaction_id=$transId";
        $conn->query($sql);
        $sqlx = "UPDATE tbl_item SET quantity=quantity-$qty where item_code='$code'";
        $conn->query($sqlx);
    } else if ($action == 'CANCELLED') {
        $transId = $_POST['transid'];
        $sql = "UPDATE tbl_transaction SET status=5 where transaction_id=$transId";
        $conn->query($sql);
    } else if ($action == 'RETURN') {
        $transId = $_POST['transid'];
        $qty = $_POST['qty'];
        $mysql = "SELECT
                quantity,
                return_quantity
                FROM
                    tbl_transaction
                WHERE transaction_id = $transId";
        $rs = $conn->query($mysql);
        if ($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            $updateqty = "UPDATE tbl_transaction SET return_quantity=return_quantity+$qty where transaction_id=$transId";
            $conn->query($updateqty);
            $qtys = "UPDATE tbl_item SET quantity=quantity+$qty where item_code='$itemCode'";
            $conn->query($qtys);

            checkReturns($transId, $conn);
        }
    }
}

function checkReturns($transId, $conn)
{
    // Use prepared statement to prevent SQL injection
    $sqlReturns = "SELECT
                    quantity,
                    return_quantity
                    FROM
                        tbl_transaction
                    WHERE transaction_id = $transId";
    $rs = $conn->query($sqlReturns);
    $row = $rs->fetch_assoc();
    if ($rs->num_rows > 0) {
        if ($row['return_quantity'] == $row['quantity']) {
            $dates = date('Y-m-d');
            $updateqty = "UPDATE tbl_transaction SET status=0,return_date='$dates' where transaction_id=$transId";
            $conn->query($updateqty);
        } else {
            $updateqty = "UPDATE tbl_transaction SET status=1 where transaction_id=$transId";
            $conn->query($updateqty);
        }
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
