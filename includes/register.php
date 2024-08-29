<?php
include 'config/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);

    header('Location: login.php');
    exit();
}
?>

<h2>Register</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>
