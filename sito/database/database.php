<?php

class DatabaseHelper{
    private $db;

    public function __construct($server, $username, $password, $dbName) {
        $this->db = new mysqli($server, $username, $password, $dbName);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getCategories() {
        $statement = $this->db->prepare("SELECT * FROM categoria LIMIT 5");
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>