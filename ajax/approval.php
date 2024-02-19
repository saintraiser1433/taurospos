<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    $depId = $_POST['id'];
    if ($action == 'UPDATE') {
        $sql = "UPDATE tbl_borrower SET status=1,status_approval=1 WHERE borrower_id='$depId'";
        $conn->query($sql);
    } else if ($action == 'DELETE') {
        $sql = "DELETE FROM tbl_borrower WHERE borrower_id='$depId'";
        $conn->query($sql);
    }
}
