<?php
include 'connection.php';
if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        $adminid = $_GET['admin_id'];  
        $sql = "UPDATE tbl_admin SET login_session=0 where admin_id=$adminid";
        $conn->query($sql);
        session_destroy();
        $_SESSION['response'] = "Successfully Logout";
        $_SESSION['type'] = "success";
        header("Location:index.php");
    } else {
        $borrow = $_GET['borrowid'];
        $sql = "UPDATE tbl_borrower SET login_session=0 where borrower_id='$borrow'";
        $conn->query($sql);
        session_destroy();
        $_SESSION['response'] = "Successfully Logout";
        $_SESSION['type'] = "success";
        header("Location:index.php");
    }
}
