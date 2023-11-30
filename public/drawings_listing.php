<?php

require_once '../vendor/autoload.php';
require_once '../src/Database.php/Database.php';  
require_once '../src/Repository/DrawingRepository.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

$dbConnection = new DBConnection();  
$drawingRepository = new DrawingRepository($dbConnection);

$drawings = $drawingRepository->getAllDrawings();

echo $twig->render('drawings_listing.twig', ['drawings' => $drawings]);
?>
