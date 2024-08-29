<?php
include '../config/db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get filter and sort options from query parameters
    $filter = $_GET['filter'] ?? 'all';
    $sort = $_GET['sort'] ?? 'newest';

    // Start the base query
    $query = "SELECT * FROM tasks WHERE user_id = ?";

    // Apply filter
    if ($filter === 'completed') {
        $query .= " AND completed = 1";
    } elseif ($filter === 'pending') {
        $query .= " AND completed = 0";
    }

    // Apply sorting
    if ($sort === 'newest') {
        $query .= " ORDER BY created_at DESC";
    } elseif ($sort === 'oldest') {
        $query .= " ORDER BY created_at ASC";
    } elseif ($sort === 'alphabetical') {
        $query .= " ORDER BY task ASC";
    }

    // Prepare and execute the statement
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return tasks as JSON
    echo json_encode($tasks);
}
?>
