<?php

require_once 'vendor/autoload.php';
require_once 'Database.php';
require_once 'UserRepository.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// Create a DBConnection instance
$dbConnection = new DBConnection();

// Create a UserRepository instance
$userRepository = new UserRepository($dbConnection);

// Check if the user ID is provided in the URL parameters
if (!isset($_GET['id'])) {
    // Redirect to user listing page if ID is not provided
    header("Location: user_listing.php");
    exit();
}

// Get the user ID from the URL parameters
$userId = $_GET['id'];

// Retrieve the user details based on the ID
$user = $userRepository->getUserById($userId);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $formData = $_POST;

    // Process user update
    $result = $userRepository->updateUser($userId, $formData);

    // Redirect to user listing page
    header("Location: user_listing.php");
    exit();
}

// Render the user edit form
echo $twig->render('edit_user.twig', ['user' => $user]);
?>
