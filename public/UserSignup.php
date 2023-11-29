<?php

class UserSignup {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function processSignup($data) {
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $userType = $data['userType'];
        $dob = $data['dob'];
        $address = $data['address'];

        // database insertion
        $connection = $this->db->getConnection();

       
        $sql = "INSERT INTO users (first_name, last_name, email, user_type, date_of_birth, address) 
                VALUES ('$firstName', '$lastName', '$email', '$userType', '$dob', '$address')";

        if ($connection->query($sql) === TRUE) {
            return [
                'status' => 'success',
                'message' => 'Signup successful!',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Error: ' . $connection->error,
            ];
        }
    }
}
?>
