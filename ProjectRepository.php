<?php

require_once 'Database.php';

class ProjectRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM projects";
        $result = $this->db->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProjectById($projectId)
    {
        $sql = "SELECT * FROM projects WHERE project_id = ?";
        $result = $this->db->executeQuery($sql, [$projectId]);

        return $result->fetch_assoc();
    }

    
}
?>
