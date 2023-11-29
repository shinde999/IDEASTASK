<?php

// require_once 'vendor/autoload.php';
// require_once 'Database.php';
// require_once 'UserRepository.php';

// // Create a Twig environment
// $loader = new \Twig\Loader\FilesystemLoader('templates/');
// $twig = new \Twig\Environment($loader);

// // Create a DBConnection instance
// $dbConnection = new DBConnection();

// // Create a UserRepository instance
// $userRepository = new UserRepository($dbConnection);

// // Handle form submission
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Retrieve form data
//     $formData = $_POST;

//     // Process user creation
//     $result = $userRepository->createUser($formData);

//     // Redirect to user listing page
//     header("Location: user_listing.php");
//     exit();
// }

// // Render the user creation form
// echo $twig->render('create_user.twig');
?>
