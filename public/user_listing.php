<?php

require_once '../vendor/autoload.php';
require_once '../src/Database.php/Database.php';
require_once '../src/Repository/UserRepository.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

// Create a DBConnection instance
$dbConnection = new DBConnection();

// Create a UserRepository instance
$userRepository = new UserRepository($dbConnection);

// Get all users
$users = $userRepository->getAllUsers();

// Render the user listing page
echo $twig->render('user_listing.twig', ['users' => $users]);
?>
