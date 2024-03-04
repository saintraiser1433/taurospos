<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'ADD') {
        $description = $_POST['description'];
        $sql = "INSERT INTO tbl_size (size_description) VALUES ('$description')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $description = $_POST['description'];
        $depId = $_POST['id'];
        $sql = "UPDATE tbl_size SET size_description='$description' WHERE size_id=$depId";
        $conn->query($sql);
    } else if ($action == 'DELETE') {
        $depId = $_POST['id'];
        $sql = "DELETE FROM tbl_size WHERE size_id=$depId";
        $conn->query($sql);
    }
}
