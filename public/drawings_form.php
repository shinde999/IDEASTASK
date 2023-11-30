<?php


require_once '../vendor/autoload.php';
require_once '../src/Database.php/Database.php';
require_once '../src/Service/FileUploader.php'; 
require_once '../src/Repository/DrawingRepository.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates/');
$twig = new \Twig\Environment($loader);

$dbConnection = new DBConnection();
$drawingRepository = new DrawingRepository($dbConnection);

// Set the upload directory for the FileUploader
$fileUploader = new FileUploader('Dfiles');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission and file upload
    $drawing_no = $_POST['drawing_no'];
    $drawing_name = $_POST['drawing_name'];
    $status = $_POST['status'];
    $category = $_POST['category'];

    $uploadedFile = $fileUploader->uploadFile($_FILES['file']);

    // Check if the file was successfully uploaded before creating the drawing
    if ($uploadedFile !== false) {
        $drawingRepository->createDrawing($drawing_no, $drawing_name, $status, $uploadedFile, $category);

        header("Location: drawings_listing.php");
        exit();
    } else {
        // Handle file upload error
        echo $twig->render('drawings_form.twig', ['error' => 'Error uploading the file. Please make sure it is a PDF.']);
        exit();
    }
}

echo $twig->render('drawings_form.twig');
?>
