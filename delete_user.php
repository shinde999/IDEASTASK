<?php

require_once 'Database.php';
require_once 'UserRepository.php';

// Check if the user ID is provided in the query parameters
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Create a new UserRepository instance
    $userRepository = new UserRepository($dbConnection);

    // Delete the user
    $userRepository->deleteUser($userId);

    // Redirect to the user listing page or any other appropriate page
    header("Location: user_listing.php");
    exit();
} else {
    // If the user ID is not provided, handle the error accordingly
    echo "Invalid request. User ID not provided.";
}
?>
