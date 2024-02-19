<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'ADD') {
        $description = $_POST['description'];
        $sql = "INSERT INTO tbl_department (department_name) VALUES ('$description')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $description = $_POST['description'];
        $stat = $_POST['status'];
        $depId = $_POST['id'];
        $sql = "UPDATE tbl_department SET department_name='$description',status=$stat WHERE department_id=$depId";
        $conn->query($sql);
    } else if ($action == 'DELETE') {
        $depId = $_POST['id'];
        $sql = "DELETE FROM tbl_department WHERE department_id=$depId";
        $conn->query($sql);
    }
}
