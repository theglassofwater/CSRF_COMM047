<?php
session_start();
require __DIR__ . '/inc/header.php';

$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Connect to the database
    $db = new SQLite3(__DIR__ . '/database/database.sqlite');
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    // Validate login
    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $errors[] = "Invalid username or password.";
    }
}
?>

<h2>Login</h2>
<?php if ($errors): ?>
    <div>
        <?php foreach ($errors as $error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>

<?php require __DIR__ . '/inc/footer.php'; ?>
