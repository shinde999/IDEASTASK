<?php

require_once 'Database.php'; 

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Retrieve form data
    $postData = $_POST;

    // Process project creation
    $response = processCreateProject($dbConnection, $postData);

    // Directly echo the response message
    echo $response;
} else {
    // Invalid request method
    http_response_code(405);
    echo "Invalid request method";
}

function processCreateProject($db, $data)
{
    $projectName = $data['projectName'];
    $projectNumber = $data['projectNumber'];
    
    // Check if a file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; 
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        // Move the uploaded file 
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Get the file path for storage in the database
            $image = $uploadFile;
        } else {
            // Handle file upload error
            return json_encode([
                'status' => 'error',
                'message' => 'Error uploading the image',
            ]);
        }
    } else {
        // Handle case where no image is uploaded
        $image = '';
    }

    $address = $data['address'];
    $startDate = $data['startDate'];
    $endDate = $data['endDate'];

    // database insertion
    $connection = $db->getConnection();

    $sql = "INSERT INTO projects (project_name, project_number, image, address, start_date, end_date) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $params = [$projectName, $projectNumber, $image, $address, $startDate, $endDate];

    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        return json_encode([
            'status' => 'error',
            'message' => 'Error in preparing SQL statement: ' . $connection->error,
        ]);
    }

    $stmt->bind_param('ssssss', ...$params);

    $success = $stmt->execute();

    if ($success) {
        return json_encode([
            'status' => 'success',
            'message' => 'Project created successfully!',
        ]);
    } else {
        return json_encode([
            'status' => 'error',
            'message' => 'Error in executing SQL statement: ' . $stmt->error,
        ]);
    }
}
?>
