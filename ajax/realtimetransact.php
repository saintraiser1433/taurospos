<?php
include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $borrow = $_POST['borrower_id'];
    $sql = "SELECT
    CONCAT(
        b.first_name,
        ', ',
        b.last_name,
        ' ',
        LEFT(b.middle_name, 1)
    ) AS borrower_name,
    a.transaction_no,
    a.start_date,
    a.expected_return_date,
    a.return_date,
    a.status
FROM
    tbl_transaction_header a
INNER JOIN tbl_borrower b ON
    a.borrower_id = b.borrower_id
WHERE a.status IN(1,2,3,6) and a.borrower_id='$borrow'
ORDER BY
    a.date_created
DESC";
    $rs = $conn->query($sql);
    $response = array();
    if ($rs) {
        while ($row = $rs->fetch_assoc()) {
            // Assuming your resident table has 'id', 'name', and 'age' columns
            $response[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
