<?php
session_start();
require __DIR__ . '/inc/header.php';

$errors = [];

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$enable_csrf = isset($_SESSION['csrf_token']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = trim($_POST['new_password']);

    if ($enable_csrf) {
        $csrf_token = $_POST['csrf_token'] ?? '';
        if (empty($csrf_token) || $csrf_token !== ($_SESSION['csrf_token'] ?? '')) {
            $errors[] = "Invalid CSRF token.";
        }
    }

    if (!$errors) {
        if (empty($new_password)) {
            $errors[] = "Password cannot be empty.";
        } else {

            $username = $_SESSION['username'];

            $db = new SQLite3(__DIR__ . '/database/database.sqlite');
            $stmt = $db->prepare("UPDATE users SET password = :new_password WHERE username = :username");
            if ($stmt) {
                $stmt->bindValue(':new_password', $new_password);
                $stmt->bindValue(':username', $username);
                $stmt->execute();
                echo '<h2>Password Changed Successfully</h2>';
                echo '<p>Your password has been updated. Please log in again.</p>';
                echo '<a href="index.php"><button>Go to Login Page</button></a>';
                exit();
            } else {
                $errors[] = "Failed to prepare SQL statement for updating the password.";
            }
        }
    }
}
?>

<h2>Change Password</h2>
<?php if ($enable_csrf): ?>
    <div>
        CSRF Protection Activated!
    </div>
<?php endif; ?>

<form action="change_password.php" method="POST">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required><br>

    <?php if ($enable_csrf): ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <?php endif; ?>

    <button type="submit">Change Password</button>
</form>
<?php if ($csrf_token): ?>
    <div>
        CSRF Protection Activated!
    </div>
<?php endif; ?>
<div>
    <h3>Advert</h3>
    <p>Click Link below to get £1000 pounds for free!</p>
        <a href="hacked_site.html">
            <p>
                Click here to learn more
            </p>
        </a>
</div>

<?php require __DIR__ . '/inc/footer.php'; ?>
