<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database.php/Database.php';


// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// rendering to index.twig
echo $twig->render('index.twig');
?>
