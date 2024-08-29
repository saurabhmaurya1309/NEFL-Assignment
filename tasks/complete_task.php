<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the current task status
    $stmt = $pdo->prepare("SELECT completed FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
    $task = $stmt->fetch();

    if ($task) {
        // Toggle the completed status
        $newStatus = $task['completed'] ? 0 : 1;

        // Update the task
        $stmt = $pdo->prepare("UPDATE tasks SET completed = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$newStatus, $id, $user_id]);

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Task not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
