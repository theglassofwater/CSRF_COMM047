<?php

$db = new SQLite3(__DIR__ . '/database/database.sqlite');

echo "Enter your username: ";
$username = trim(readline());

$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

if ($result) {
    $passwordy = $result['password'];
    echo "The password for user '{$username}' is: {$passwordy}\n";
    if ('password' ==  $result['password']) {
        echo "correct password";
    }
} else {
    echo "No user found with username '{$username}'.\n";
}

?>