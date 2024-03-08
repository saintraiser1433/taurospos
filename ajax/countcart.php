<?php
include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $borrowId = $_SESSION['borrower_id'];
    $sql = "SELECT SUM(cnt) AS total_count
    FROM (
        SELECT COUNT(item_code) AS cnt
        FROM tbl_cart
        WHERE borrower_id = '$borrowId'
        GROUP BY item_code
    ) AS counts";
    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc();
    if ($rs->num_rows > 0) {
        echo $row['total_count'] ?? 0;
    } 
}
