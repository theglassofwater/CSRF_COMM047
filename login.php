<?php

if (isset($_SESSION['username'])) {
    $_SESSION = [];

    session_destroy();
}

session_start();
require __DIR__ . '/inc/header.php';

$errors = [];
// $db = new SQLite3(__DIR__ . '/database/database.sqlite');

// Generate a CSRF token if the CSRF option is checked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enable_csrf'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enable_csrf = isset($_POST['enable_csrf']);

    // CSRF validation if enabled
    if ($enable_csrf) {
        $csrf_token = $_POST['csrf_token'] ?? '';
        if (empty($csrf_token) || $csrf_token !== ($_SESSION['csrf_token'] ?? '')) {
            $errors[] = "Invalid CSRF token.";
        }
    }

    // Connect to the database
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Connect to the database
    $db = new SQLite3(__DIR__ . '/database/database.sqlite');

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        // Validate login
    if ($password == $result["password"]) {
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

    <label for="enable_csrf">Enable CSRF Protection:</label>
    <input type="checkbox" name="enable_csrf" id="enable_csrf"
           onchange="toggleCSRFTokenField(this.checked);"><br>

    <?php if (!empty($_SESSION['csrf_token']) && isset($_POST['enable_csrf'])): ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <?php endif; ?>

    <button type="submit">Login</button>
</form>

<script>
function toggleCSRFTokenField(enabled) {
    if (enabled) {
        document.querySelector('[name="csrf_token"]').value = "<?php echo $_SESSION['csrf_token'] ?? ''; ?>";
    } else {
        document.querySelector('[name="csrf_token"]').value = '';
    }
}
</script>

<?php require __DIR__ . '/inc/footer.php'; ?>
