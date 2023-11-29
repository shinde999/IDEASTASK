<?php

require_once '../src/Database.php/Database.php';
require_once '../src/Repository/UserRepository.php';
require_once '../src/Repository/ProjectRepository.php'; 
require_once '../vendor/autoload.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

// Check if the user ID is provided in the query parameters
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Create instances of UserRepository and ProjectRepository
    $userRepository = new UserRepository($dbConnection);
    $projectRepository = new ProjectRepository($dbConnection);

    // Get the user and project information
    $user = $userRepository->getUserById($userId);
    $projects = $projectRepository->getAllProjects();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Handle form submission
        if (isset($_POST['assignProjects'])) {
            $selectedProjects = isset($_POST['projects']) ? $_POST['projects'] : [];

            // Assign the selected projects to the user 
            $projectRepository->assignProjectsToUser($userId, $selectedProjects);

            // Redirect to the user listing page or any other appropriate page
            header("Location: user_listing.php");
            exit();
        }
    }

    // Render the assign projects form
    echo $twig->render('assign_projects_form.twig', [
        'user' => $user,
        'projects' => $projects,
    ]);
} else {
    // If the user ID is not provided, handle the error accordingly
    echo "Invalid request. User ID not provided.";
}
?>
