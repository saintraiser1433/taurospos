<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'ADD') {
        $description = $_POST['description'];
        $sql = "INSERT INTO tbl_category (category_name) VALUES ('$description')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $description = $_POST['description'];
        $stat = $_POST['status'];
        $depId = $_POST['id'];
        $sql = "UPDATE tbl_category SET category_name='$description',status=$stat WHERE category_id=$depId";
        $conn->query($sql);
    } else if ($action == 'DELETE') {
        $depId = $_POST['id'];
        $sql = "DELETE FROM tbl_category WHERE category_id=$depId";
        $conn->query($sql);
    }
}
