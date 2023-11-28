<?php

require_once 'Database.php'; 
require_once 'vendor/autoload.php'; 
require_once 'ProjectRepository.php'; 

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// Check if the project ID is provided in the query parameters
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Create an instance of ProjectRepository
    $projectRepository = new ProjectRepository($dbConnection);

    // Get the project information
    $project = $projectRepository->getProjectById($projectId);

    // Check if the project exists
    if ($project) {
        // Render the edit project form
        echo $twig->render('edit_project.twig', ['project' => $project]);
    } else {
        // If the project does not exist, handle the error accordingly
        echo "Project not found.";
    }
} else {
    // If the project ID is not provided, handle the error accordingly
    echo "Invalid request. Project ID not provided.";
}
?>
