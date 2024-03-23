<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['examne'];
    $action = $_POST['action'];
    $sql = "SELECT
    UPPER(last_name) as lastname,
    phone_number
FROM
    tbl_borrower a
WHERE
    borrower_id = '$id'";

    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc();
    $name = $row['lastname'];
    $contact_number = $row['phone_number'];


    $send_data = [];

//START - Parameters to Change
//Put the SID here
$send_data['sender_id'] = "PhilSMS";
//Put the number or numbers here separated by comma w/ the country code +63
$send_data['recipient'] = $contact_number;
//Put message content here

if($action == 'APPROVE'){
    $send_data['message'] = "Good day," . $name . "! 
    This is SEAIT LABORATORY TEAM,
    This is to inform you that your account has been approved. You can now sign in the portal Thank you!
    ";
}else if($action == 'OVERDUE'){
    $send_data['message'] = "Good day," . $name . "! 
    This is SEAIT LABORATORY TEAM,
    This is to inform you that your borrowed items is overdue. We added penalty in your accounts kindly check penalty module section for more details Thank you!
    ";
}else{
    $send_data['message'] = "Good day," . $name . "! 
    This is SEAIT LABORATORY TEAM,
    This is to inform you that your account has been rejected. Thank you!
    ";
}

//Put your API TOKEN here
$token = "579|GlJGQArztmEFuUUrXBHzO6r7H9Jc8Gb5Y46sewUh";
//END - Parameters to Change

//No more parameters to change below.
$parameters = json_encode($send_data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_TIMEOUT, 80);

$headers = [];
$headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$get_sms_status = curl_exec($ch);

var_dump($get_sms_status);

if($action == 'REJECT'){
    $sqldel = "DELETE FROM tbl_borrower where borrower_id='$id'";
    $conn->query($sqldel);
}



}


