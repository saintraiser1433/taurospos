<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'ADD') {
        $penaltyId = $_POST['penaltyId'];
        $sql = "UPDATE tbl_penalty set status=1 where penalty_id=$penaltyId";
        $conn->query($sql);
    } 
}
