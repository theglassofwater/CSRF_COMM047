<?php

$db = new SQLite3(__DIR__ . '/database/database.sqlite');

// Prompt for username input in CLI
echo "Enter your username: ";
$username = trim(readline());

// Prepare and execute the query to fetch the user's password
$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

// Check if a user with that username exists
if ($result) {
    // Send out the password (for testing purposes, display it here)
    // In a real application, you would NOT display the password directly
    $passwordy = $result['password'];
    echo "The password for user '{$username}' is: {$passwordy}\n";
    if ('password' ==  $result['password']) {
        echo "correct password";
    }
} else {
    echo "No user found with username '{$username}'.\n";
}

?>