<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $firstname = @$_POST['firstname'];
    $lastname = @$_POST['lastname'];
    $middlename = @$_POST['middlename'];
    $age = @$_POST['age'];
    $phonenumber = "+63" . @$_POST['phonenumber'];
    $username = @$_POST['username'];
    $address = @$_POST['address'];
    $password = "test123";
    $action = @$_POST['action'];
    if ($action == 'ADD') {
        $sql = "INSERT INTO tbl_customers (first_name,last_name,middle_name,age,address,phone,username,password) 
        VALUES ('$firstname','$lastname','$middlename',$age,'$address','$phonenumber','$username','$password')";
        $conn->query($sql);
    } else if ($action == 'UPDATE') {
        $custId = $_POST['id'];
        $checkStatus = $_POST['status'];
        $sql = "UPDATE tbl_customers 
                SET first_name='$firstname',
                    last_name='$lastname',
                    middle_name='$lastname',
                    age=$age,address='$address',
                    phone='$phonenumber',
                    username='$username',
                    status='$checkStatus'
                WHERE customer_id=$custId";
        $conn->query($sql);
    } else if ($action == "DELETE") {
        $custId = $_POST['id'];
        $sql = "DELETE FROM tbl_customers where customer_id = $custId";
        $conn->query($sql);
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $userId = $_GET['id'];
    $sql = "SELECT
    customer_id,
    first_name,
    last_name,
    middle_name,
    address,
    age,
    phone,
	STATUS as status,
    username,
    date_created
FROM
    tbl_customers
WHERE
    customer_id=$userId
ORDER BY
    date_created ASC";
    $rs = $conn->query($sql);
    $data = [];
    if ($rs) {
        while ($row = $rs->fetch_assoc()) {
            $data[] = [
                'customer_id' => $row['customer_id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'middle_name' => $row['middle_name'],
                'address' => $row['address'],
                'age' => $row['age'],
                'phone' => $row['phone'],
                'status' => $row['status'],
                'username' => $row['username'],
                'date_created' => $row['date_created'],
            ];
        }
    }
    echo json_encode($data);
}
