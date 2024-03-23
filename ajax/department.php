<?php
include '../connection.php';
$conn->autocommit(false);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        switch ($action) {
            case 'ADD':
                $description = $_POST['description'];
                $sql = "INSERT INTO tbl_department (department_name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("s", $description);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Added Department']);
                break;
            case 'UPDATE':
                $description = $_POST['description'];
                $stat = $_POST['status'];
                $depId = $_POST['id'];
                $sql = "UPDATE tbl_department SET department_name=?, status=? WHERE department_id=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("sii", $description, $stat, $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Update Department']);
                break;

            case 'DELETE':
                $depId = $_POST['id'];
                $sql = "DELETE FROM tbl_department WHERE department_id=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                } 
                $stmt->bind_param("i", $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Deleted Department']);
                break;
        }
        // Commit the transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo json_encode(['error' => $e->getMessage()]);
    }
}
