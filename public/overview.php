<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../src/Database.php/Database.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates/');
$twig = new \Twig\Environment($loader);

// rendering to index.twig
echo $twig->render('overview.twig');

?>
