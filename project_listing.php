<?php

require_once 'Database.php'; 
require_once 'ProjectRepository.php'; 

// Create a new DBConnection instance
$dbConnection = new DBConnection();

// Create an instance of ProjectRepository
$projectRepository = new ProjectRepository($dbConnection);

// Get all projects from the repository
$projects = $projectRepository->getAllProjects();

// Include the Twig autoload file
require_once 'vendor/autoload.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// Render the project listing page
echo $twig->render('project_listing.twig', ['projects' => $projects]);
?>
