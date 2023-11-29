<?php
// login_process.php

require_once '../vendor/autoload.php';
require_once '../src/Service/Authentication.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication 
    $authentication = new Authentication();  
    $authenticated = $authentication->authenticate($username, $password);

    if ($authenticated) {
        // Start a session and store user information
        session_start();
        $_SESSION['username'] = $username;

        // Redirect to a dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed
        echo $twig->render('login.twig', ['error' => 'Invalid username or password']);
    }
} else {
    // If it's not a POST request, render the login form
    echo $twig->render('login.twig', ['error' => '']);
}
?>
