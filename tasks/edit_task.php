<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['task']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];
    $task = trim($_POST['task']);
    $user_id = $_SESSION['user_id'];

    if (!empty($task)) {
        $stmt = $pdo->prepare("UPDATE tasks SET task = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$task, $id, $user_id]);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Task cannot be empty.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
