<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

// Render the login form
echo $twig->render('login.twig', ['error' => '']);
?>
