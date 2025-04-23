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

    public function getProductByCategories($categoria){
        $statement = $this->db->prepare(
            "SELECT p.* 
             FROM PRODOTTO p
             JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome
             JOIN CATEGORIA c ON s.categoria = c.nome
             WHERE c.nome = ?" 
            );
        $statement->bind_param("s", $categoria);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>