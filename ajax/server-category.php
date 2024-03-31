<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $categoryName = @$_POST['categoryName'];
    $action = $_POST['action'];
    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_category(category_name) VALUES ('$categoryName')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $catId = $_POST['id'];
        $checkStatus = $_POST['status'];
        $sql = "UPDATE tbl_category SET category_name='$categoryName',status=$checkStatus where category_id = $catId";
        $conn->query($sql);
    } else if ($action == "DELETE") {
        $catId = $_POST['id'];
        $sql = "DELETE FROM tbl_category where category_id = $catId";
        $conn->query($sql);
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $categoryId = $_GET['id'];
    $sql = "SELECT
    category_name,
    status
FROM
tbl_category a
WHERE category_id = $categoryId";
    $rs = $conn->query($sql);
    $data = [];
    if ($rs) {
        while ($row = $rs->fetch_assoc()) {
            $data[] = [
                'category_name' => $row['category_name'],
                'status' => $row['status']
            ];
        }
    }
    echo json_encode($data);
}
