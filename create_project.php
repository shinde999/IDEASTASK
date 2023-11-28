<?php

require_once 'vendor/autoload.php';
require_once 'Database.php'; // 

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// rendering to create_project.twig
echo $twig->render('create_project.twig');
?>
