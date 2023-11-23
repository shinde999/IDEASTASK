<?php

class DBConnection {
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "project_management_db";
    private $dbport = "3307";
    public $connection;

    public function __construct() {
        $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname, $this->dbport);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function executeQuery($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);

        if ($stmt === false) {
            die("Error in preparing SQL statement: " . $this->connection->error);
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();

        if ($success) {
            return $stmt->get_result();
        } else {
            die("Error in executing SQL statement: " . $stmt->error);
        }
    }
}
?>
