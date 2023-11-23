<?php

require_once 'vendor/autoload.php';
require_once 'Database.php';

// Create a Twig environment
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader);

// rendering to index.twig
echo $twig->render('overview.twig');

?>
