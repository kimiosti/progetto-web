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

    public function addUser($username, $password, $email) {
        $statement = $this->db->prepare("INSERT INTO acquirente(username, password, email) VALUES (?,?,?)");
        $statement->bind_param("sss", $username, $password, $email);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function checkLogin($username, $password) {
        $customerStatement = $this->db->prepare("SELECT * FROM acquirente WHERE username = ? AND password = ?");
        $customerStatement->bind_param("ss", $username, $password);
        $customerStatement->execute();
        $customers = $customerStatement->get_result()->fetch_all(MYSQLI_ASSOC);

        $sellerStatement = $this->db->prepare("SELECT * FROM venditore WHERE username = ? AND password = ?");
        $sellerStatement->bind_param("ss", $username, $password);
        $sellerStatement->execute();
        $sellers = $sellerStatement->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($customers) == 1) {
            return 1;
        } else if (count($sellers) == 1) {
            return 2;
        } else {
            return 0;
        }
    }

    public function getCustomerInfo($username) {
        $statement = $this->db->prepare("SELECT email, telefono FROM acquirente WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();

        return $statement->get_result();
    }

    public function getSellerInfo($username) {
        $statement = $this->db->prepare("SELECT email, telefono FROM venditore WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

?>