<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: todo.php");
    exit();
}

include 'includes/header.php';
?>

<h1>Welcome to the To-Do List App</h1>
<p><a href="login.php">Login</a> or <a href="register.php">Register</a> to start managing your tasks.</p>

<?php include 'includes/footer.php'; ?>
