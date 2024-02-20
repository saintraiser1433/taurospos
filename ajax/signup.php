<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $borrowerId = $_POST['borrowerId'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $departmentId = $_POST['department'];
    $type = $_POST['type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $uploadsDir = 'uploads/';
    $pth = $uploadsDir . $_POST['docsFile'] . ".png";
    $dir = $_POST['docsFile'] . ".png";
    move_uploaded_file($_FILES['files']['tmp_name'], $pth);
    $query = "INSERT INTO tbl_borrower (
            borrower_id,
            first_name,
            middle_name,
            last_name,
            phone_number,
            department_id,
            type,
            status,
            status_approval,
            docs_file,
            username,
            password) 
        values (
            '$borrowerId',
            '$firstName',
            '$middleName',
            '$lastName',
            '$phoneNumber',
            $departmentId,
            '$type',
            0,
            0,
            '$dir',
            '$username',
            '$password'
            )";
    $stmt = $conn->query($query);
    if ($stmt) {
        echo json_encode(['message' => 'Successfully signup kindly wait for approval. We would message you thru text message for your status ']);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
}
