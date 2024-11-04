<?php 

session_start();

require __DIR__ .  '/inc/header.php'; 

$errors = []; // for storing the error messages
$inputs = []; // for storing sanitized input values

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method == "GET") { 


    require __DIR__ . "/inc/get.php";


}

if ($request_method == "POST") { 


    require __DIR__ . "/inc/post.php";


}

require __DIR__ . '/inc/footer.php';

?>