<?php
include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $borrowId = $_SESSION['borrower_id'];
    $sql = "SELECT COUNT(DISTINCT item_code) AS total_count
    FROM tbl_cart where borrower_id='$borrowId'";
    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc();
    if ($rs->num_rows > 0) {
        echo $row['total_count'] ?? 0;
    } 
}
