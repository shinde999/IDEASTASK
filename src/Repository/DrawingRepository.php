<?php


class DrawingRepository {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function createDrawing($drawing_no, $drawing_name, $status, $file_path, $category) {
        $sql = "INSERT INTO drawings (drawing_no, drawing_name, status, file_path, category) VALUES (?, ?, ?, ?, ?)";
        $params = [$drawing_no, $drawing_name, $status, $file_path, $category];

        $stmt = $this->dbConnection->getConnection()->prepare($sql);

        if ($stmt === false) {
            die("Error in preparing SQL statement: " . $this->dbConnection->getConnection()->error);
        }

        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);

        $success = $stmt->execute();

        if (!$success) {
            die("Error in executing SQL statement: " . $stmt->error);
        }
    }

    public function getAllDrawings() {
        $sql = "SELECT * FROM drawings";
        $result = $this->dbConnection->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
