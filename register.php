<?php
include 'config/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        echo "Username already taken.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        // echo "Registration successful! <a href='login.php'>Login here</a>.";
        header("Location: login.php");
    }
}
?>

<h1>Register</h1>
<form method="POST" action="register.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>
