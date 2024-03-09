<?php
include '../connection.php';
$action = $_POST['action'];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $trans = @$_POST['trans_code'];
    $borrowId = @$_SESSION['borrower_id'];
    $itemCode = @$_POST['item_code'];
    $counter = @$_POST['counter'];
    $rtndate = @$_POST['rtndate'];
    $transId = @$_POST['transid'];
    $qty = @$_POST['qty'];
    if ($action == 'GET') {
        $sqlt = "SELECT
        b.item_name,
        SUM(a.quantity) as qty,
        a.return_quantity,
        a.status,
        a.trans_item_id,
        a.item_code,
        a.transaction_no,
        c.borrower_id
    FROM
        tbl_transaction_detail a
    INNER JOIN tbl_item b ON
        a.item_code = b.item_code
    INNER JOIN tbl_transaction_header c ON
        a.transaction_no = c.transaction_no
    WHERE
        a.transaction_no = '$trans'
    group by a.item_code";
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

        //add header transaction
        $sqlt = "INSERT INTO tbl_transaction_header(transaction_no,borrower_id) values ('$trans','$borrowId')";
        $conn->query($sqlt);

        //add detail transaction
        $sql = "INSERT INTO tbl_transaction_detail(
            transaction_no,
            item_code,
            quantity
        )
        SELECT
            $trans,
            item_code,
            sum(quantity) as qty
        FROM
            tbl_cart
        WHERE
            borrower_id = '$borrowId'
        GROUP BY item_code";
        $conn->query($sql);

        $delcart = "DELETE FROM tbl_cart where borrower_id='$borrowId'";
        $conn->query($delcart);
    } else if ($action == 'APPROVED') {
        //for approve
        $sqls = "UPDATE tbl_transaction_header SET status=3 where transaction_no=$trans";
        $sql = "UPDATE tbl_transaction_detail SET status=3 where transaction_no=$trans";
        $conn->query($sqls);
        $conn->query($sql);
    } else if ($action == 'REJECT') {
        //for reject
        $sqlt = "UPDATE tbl_transaction_header SET status=4 where transaction_no=$trans";
        $sql = "UPDATE tbl_transaction_detail SET status=5 where transaction_no=$trans";
        $conn->query($sql);
        $conn->query($sqlt);
    } else if ($action == 'RECEIVE') {
        //for receive
        $startDate = date('Y-m-d');
        $return = date('Y-m-d', strtotime('+5 days'));
        $sqldetail = "UPDATE tbl_transaction_header SET status=2, start_date='$startDate',expected_return_date='$return' where transaction_no=$trans";
        $conn->query($sqldetail);
        $sqlheader = "UPDATE tbl_transaction_detail SET status=2 where transaction_no=$trans";
        $conn->query($sqlheader);
        $sqltransdet = "SELECT quantity,item_code FROM tbl_transaction_detail where transaction_no=$trans";
        $rstransdet = $conn->query($sqltransdet);
        foreach ($rstransdet as $rowtrans) {
            $transqty = $rowtrans['quantity'];
            $code = $rowtrans['item_code'];
            $sqlx = "UPDATE tbl_item SET quantity=quantity-$transqty where item_code='$code'";
            $conn->query($sqlx);
        }
    } else if ($action == 'CANCELLED') {
        //for cancelled
        $sqlt = "UPDATE tbl_transaction_header SET status=5 where transaction_no=$trans";
        $sql = "UPDATE tbl_transaction_detail SET status=5 where transaction_no=$trans";
        $conn->query($sql);
        $conn->query($sqlt);
    } else if ($action == 'RETURN') {
        //for return
        $updateqty = "UPDATE tbl_transaction_detail SET return_quantity=return_quantity+$qty where trans_item_id=$transId";
        $qtys = "UPDATE tbl_item SET quantity=quantity+$qty where item_code='$itemCode'";
        $conn->query($updateqty);
        $conn->query($qtys);
        checkReturns($transId, $conn);
        checkTransactReturn($trans, $conn);
    }
}

function checkReturns($transId, $conn)
{
    $sqlReturns = "SELECT
                    quantity,
                    return_quantity
                    FROM
                        tbl_transaction_detail
                    WHERE trans_item_id = $transId";
    $rs = $conn->query($sqlReturns);
    $row = $rs->fetch_assoc();
    if ($rs->num_rows > 0) {
        if ($row['return_quantity'] == $row['quantity']) {
            $updateqty = "UPDATE tbl_transaction_detail SET status=0 where trans_item_id=$transId";
            $conn->query($updateqty);
        } else {
            $updateqty = "UPDATE tbl_transaction_detail SET status=1 where trans_item_id=$transId";
            $conn->query($updateqty);
        }
    }
}

function checkTransactReturn($transNo, $conn)
{
    $sqlReturns = "SELECT
    SUM(quantity) AS currentQty,
    SUM(return_quantity) AS returnQuantity,
    head.expected_return_date,
    head.borrower_id
FROM
    tbl_transaction_detail det
INNER JOIN tbl_transaction_header head ON det.transaction_no=head.transaction_no
WHERE
    det.transaction_no = $transNo
GROUP BY
    det.transaction_no";
    $rs = $conn->query($sqlReturns);
    $row = $rs->fetch_assoc();
    if ($rs->num_rows > 0) {
        if ($row['currentQty'] == $row['returnQuantity']) {
            $date = date('Y-m-d');
            $updateqty = "UPDATE tbl_transaction_header SET status=0,return_date='$date' where transaction_no=$transNo";
            $conn->query($updateqty);
            if (strtotime($row['expected_return_date']) < strtotime($date)) {
                $sqlpen = "INSERT INTO tbl_penalty(transaction_no) values ($transNo)";
                $conn->query($sqlpen);
                echo "ok";
            }
        } else {
            if ($row['returnQuantity'] != 0) {
                $updateqty = "UPDATE tbl_transaction_header SET status=1 where transaction_no=$transNo";
                $conn->query($updateqty);
            }
        }
    }
}



     //status for transaction header
    // 6-For Approval 
    // 5-Cancelled 
    // 4-Rejected
    // 3-Waiting to claim
    // 2-Waiting to returned  
    // 1-Partially Returned  
    // 0-Returned


    //status for transaction details
    // 4-For Approval
    // 3-Waiting to claim
    // 2-Waiting to returned  
    // 1-Partially Returned  
    // 0-Returned
