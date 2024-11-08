<?php 
session_start();
require __DIR__ . '/inc/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$errors = [];
$inputs = [];

// Handle GET request to display the form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/inc/change_password.php';
}

// Handle POST request to process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/inc/handle_password_change.php';

    if ($errors) {
        require __DIR__ . '/inc/change_password.php';
    }
}

require __DIR__ . '/inc/footer.php';
?>
