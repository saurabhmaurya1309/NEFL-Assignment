<?php
include '../config/db.php';
session_start();

if (isset($_POST['id']) && isset($_SESSION['user_id'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
}
?>
