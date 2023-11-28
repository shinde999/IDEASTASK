<?php

require_once 'Database.php';

class UserRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->executeQuery($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $result = $this->db->executeQuery($sql, [$userId]);

        return $result->fetch_assoc();
    }

    public function createUser($data)
    {
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $userType = $data['userType'];
        $dob = $data['dob'];
        $address = $data['address'];

        $sql = "INSERT INTO users (first_name, last_name, email, user_type, date_of_birth, address) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $params = [$firstName, $lastName, $email, $userType, $dob, $address];

        $this->db->executeQuery($sql, $params);
    }

    public function updateUser($userId, $data)
    {
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $userType = $data['userType'];

        $sql = "UPDATE users 
                SET first_name = ?, last_name = ?, email = ?, user_type = ? 
                WHERE user_id = ?";

        $params = [$firstName, $lastName, $email, $userType, $userId];

        $this->db->executeQuery($sql, $params);
    }

    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $params = [$userId];

        $this->db->executeQuery($sql, $params);
    }
}
?>
