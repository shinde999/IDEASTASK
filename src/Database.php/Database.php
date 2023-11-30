<?php

class DBConnection {
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "project_management_db";
    private $dbport = "3307";
    private $connection;

    public function __construct() {
        try {
            $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname, $this->dbport);

            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);

            if ($stmt === false) {
                throw new Exception("Error in preparing SQL statement: " . $this->connection->error);
            }

            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            $success = $stmt->execute();

            if ($success) {
                return $stmt->get_result();
            } else {
                throw new Exception("Error in executing SQL statement: " . $stmt->error);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>
