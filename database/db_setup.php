<?php

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }
}
$db = new MyDB;

// creats users table with password and username ( and id as primary key)
$db->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)");

// Inserts sammple users with the unique usernames but all with password = "password"

$db->exec("INSERT INTO users (username, password) VALUES ('user1', 'password')");
$db->exec("INSERT INTO users (username, password) VALUES ('user2', 'password')");
$db->exec("INSERT INTO users (username, password) VALUES ('user3', 'password')");

echo "Successfully created Database\n";
?>