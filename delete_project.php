<?php

require_once 'Database.php'; 

// Check if the project ID is provided in the query parameters
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Create a new DBConnection instance
    $dbConnection = new DBConnection();

    // Delete the project
    $response = deleteProject($dbConnection, $projectId);

    // Directly echo the response message
    echo $response;
} else {
    // If the project ID is not provided, handle the error accordingly
    echo "Invalid request. Project ID not provided.";
}

function deleteProject($db, $projectId)
{
    $connection = $db->getConnection();

    $sql = "DELETE FROM projects WHERE project_id = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        return json_encode([
            'status' => 'error',
            'message' => 'Error in preparing SQL statement: ' . $connection->error,
        ]);
    }

    $stmt->bind_param('i', $projectId);

    $success = $stmt->execute();

    if ($success) {
        return json_encode([
            'status' => 'success',
            'message' => 'Project deleted successfully!',
        ]);
    } else {
        return json_encode([
            'status' => 'error',
            'message' => 'Error in executing SQL statement: ' . $stmt->error,
        ]);
    }
}
?>
