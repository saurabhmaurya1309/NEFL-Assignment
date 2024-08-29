<?php
include '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];

    if (!empty($task)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
        $stmt->execute([$user_id, $task]);
    }
}
?>
