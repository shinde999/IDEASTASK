<?php

require_once '../src/Database.php/Database.php';
require_once 'UserSignup.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Create a new UserSignup instance
    $userSignup = new UserSignup($dbConnection);

    // Retrieve form data
    $postData = $_POST;

    // Process signup
    $response = $userSignup->processSignup($postData);

    // Directly echo the response message
    // echo $response;
} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method";
}
?>
