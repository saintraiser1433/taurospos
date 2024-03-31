<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $discountName = @$_POST['discountName'];
    $percentage = @$_POST['percentage'];
    $points = @$_POST['points'];
    $status = @$_POST['status'];
    $action = @$_POST['action'];
    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_discount (discount_name,discount_percent,points) 
        VALUES ('$discountName',$percentage,$points)";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $disId = $_POST['id'];
        $checkStatus = $_POST['status'];
        $sql = "UPDATE tbl_discount 
                SET discount_name='$discountName',
                    discount_percent=$percentage,
                    points=$points,
                    status=$checkStatus
                WHERE discount_id=$disId";
        $conn->query($sql);
    } else if ($action == "DELETE") {
        $disId = $_POST['id'];
        $sql = "DELETE FROM tbl_discount where discount_id = $disId";
        $conn->query($sql);
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $disId = $_GET['id'];
    $sql = "SELECT
                *
            FROM
                tbl_discount
            WHERE
             discount_id=$disId
            ORDER BY
                date_created ASC";
    $rs = $conn->query($sql);
    $data = [];
    if ($rs) {
        while ($row = $rs->fetch_assoc()) {
            $data[] = [
                'discount_id' => $row['discount_id'],
                'discount_name' => $row['discount_name'],
                'discount_percent' => $row['discount_percent'],
                'points' => $row['points'],
                'status' => $row['status'],
            ];
        }
    }
    echo json_encode($data);
}
