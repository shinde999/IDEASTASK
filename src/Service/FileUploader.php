<?php

class FileUploader {
    private $uploadDirectory;

    public function __construct($uploadDirectory)
    {
        // Append the directory separator if it's missing(dnt knw much need to study)
        $this->uploadDirectory = rtrim($uploadDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        // Create the upload directory if it doesn't exist
        if (!file_exists($this->uploadDirectory)) {
            mkdir($this->uploadDirectory, 0777, true);
        }
    }

    public function uploadFile($file)
    {
        $targetFilePath = $this->uploadDirectory . basename($file['name']);
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if the file is a PDF
        if ($fileType !== 'pdf') {
            return 'Invalid file format. Please upload a PDF file.';
        }

        // Check if the file already exists
        if (file_exists($targetFilePath)) {
            return 'File already exists. Please choose a different file.';
        }

        // Check if the file size is within an acceptable range
        $maxFileSize = 10 * 1024 * 1024; // 10 MB
        if ($file['size'] > $maxFileSize) {
            return 'File size exceeds the maximum limit (10 MB).';
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return $targetFilePath; // Return the file path
        } else {
            return 'Failed to move the uploaded file.';
        }
    }
}
?>
