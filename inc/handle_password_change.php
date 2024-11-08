<?php
// Connect to the database
$db = new SQLite3(__DIR__ . '/../database/database.sqlite');

// Validate and sanitize inputs
$new_password = trim($_POST['new_password']);
if (empty($new_password)) {
    $errors[] = "Password cannot be empty.";
} else {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $username = $_SESSION['username'];

    $stmt = $db->prepare("UPDATE users SET password = :new_password WHERE username = :username");
    $stmt->bindValue(':new_password', $hashed_password);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    session_destroy();
        
    // Display confirmation message
    echo '<h2>Password Changed Successfully</h2>';
    echo '<p>Your password has been updated. Please log in again.</p>';
    echo '<a href="login.php"><button>Go to Login Page</button></a>';
    exit();
}
?>
