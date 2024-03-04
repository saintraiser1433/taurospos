<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if ($_POST['action'] == 'SIGNUP') {
        $borrowerId = $_POST['borrowerID'];
        $firstName = $_POST['fname'];
        $middleName = $_POST['mname'];
        $lastName = $_POST['lname'];
        $phoneNumber = $_POST['phone'];
        $departmentId = $_POST['department'];
        $type = $_POST['type'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pth = '../static/front/' . $borrowerId . ".png";
        $pthbck = '../static/back/' . $borrowerId . ".png";
        move_uploaded_file($_FILES['front']['tmp_name'], $pth);
        move_uploaded_file($_FILES['back']['tmp_name'], $pthbck);
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
                front_id_path,
                back_id_path,
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
                '$pth',
                '$pthbck',
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
}
