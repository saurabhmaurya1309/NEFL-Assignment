<?php
include '../config/db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tasks);
}
?>
