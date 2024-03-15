<?php
include '../connection.php';
$conn->autocommit(false);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_POST['action'];
    
    // Start a transaction
    $conn->begin_transaction();
    
    try {
        switch ($action) {
            case 'ADD':
                $description = $_POST['description'];
                $sql = "INSERT INTO tbl_size (size_description) VALUES (?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("s", $description);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Added Size']);
                break;
            case 'UPDATE':
                $description = $_POST['description'];
                $depId = $_POST['id'];
                $sql = "UPDATE tbl_size SET size_description=? WHERE size_id=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("si", $description, $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Updated Size']);
                break;
            case 'DELETE':
                $depId = $_POST['id'];
                $sql = "DELETE FROM tbl_size WHERE size_ids=?";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    echo json_encode(['error' => $conn->error]);
                    break;
                }
                $stmt->bind_param("i", $depId);
                $stmt->execute();
                echo json_encode(['success' => 'Successfully Deleted Size']);
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
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
?>
