<?php
session_start();
include 'includes/functions.php';
redirectIfNotLoggedIn();
include 'config/db.php';
include 'includes/header.php';
?>

<h1>Your To-Do List</h1>

<form id="add-task-form">
    <input type="text" id="task" name="task" placeholder="New task..." required>
    <button type="submit" style="padding: 2px 8px; font-size: 0.8em; height: 44px; line-height: 1;">Add Task</button>
</form>

<ul id="tasks">
</ul>

<p><a href="logout.php" class="logout-link">Logout</a></p>

<?php include 'includes/footer.php'; ?>
