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
                $sql = "INSERT INTO tbl_category (category_name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("s", $description);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Added Category']);
                break;
            case 'UPDATE':
                $description = $_POST['description'];
                $stat = $_POST['status'];
                $depId = $_POST['id'];
                $sql = "UPDATE tbl_category SET category_name=?,status=? WHERE category_id=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("sii", $description, $stat, $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Update Category']);
                break;
            case 'DELETE':
                $depId = $_POST['id'];
                $sql = "DELETE FROM tbl_category WHERE category_id=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("i", $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Deleted Category']);
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
                break;
        }
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo json_encode(['error' => $e->getMessage()]);
    }
}
