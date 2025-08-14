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

    public function getDescriptionByCategories($categoria){
        $statement= $this->db->prepare(
        "SELECT descrizione
         FROM categoria
         WHERE nome= ?"
         );

        $statement->bind_param("s", $categoria);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        // Restituisci solo la descrizione, non l'intero array
        return $row ? $row['descrizione'] : null;

    }



    public function getProductByCategories($categoria, $marca = '', $sottocategoria = '', $taglia = '', $prezzo = '') {
    $query = "SELECT DISTINCT p.*, d.taglia, d.prezzo, d.IDdisponibilità
              FROM PRODOTTO p
              JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome
              JOIN CATEGORIA c ON s.categoria = c.nome
              LEFT JOIN DISPONIBILITÀ d ON p.IDprodotto = d.IDprodotto
              WHERE c.nome = ?";

    $params = [$categoria];
    $types = "s";

    if (!empty($marca)) {
        $query .= " AND p.marca = ?";
        $params[] = $marca;
        $types .= "s";
    }

    if (!empty($sottocategoria)) {
        $query .= " AND p.sottocategoria = ?";
        $params[] = $sottocategoria;
        $types .= "s";
    }

    if (!empty($taglia)) {
        $query .= " AND d.taglia = ?";
        $params[] = $taglia;
        $types .= "s";
    }

    if (!empty($prezzo)) {
        $query .= " AND d.prezzo = ?";
        $params[] = $prezzo;
        $types .= "d";
    }

    $stmt = $this->db->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
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


    public function getBrand($categoria){
        $statement= $this->db->prepare(
            "SELECT DISTINCT p.marca
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



    public function getSubcategory($categoria){
        $statement= $this->db->prepare(
            "SELECT DISTINCT p.sottocategoria
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


    public function getSize($categoria){
    $query = "SELECT DISTINCT d.taglia
              FROM DISPONIBILITÀ d
              JOIN PRODOTTO p ON d.IDprodotto = p.IDprodotto
              JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome
              JOIN CATEGORIA c ON s.categoria = c.nome
              WHERE c.nome = ?";

    $stmt = $this->db->prepare($query);
    if (!$stmt) return [];

    $stmt->bind_param("s", $categoria);
    if (!$stmt->execute()) return [];

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getPrice($categoria){
    $query = "SELECT DISTINCT d.prezzo
              FROM DISPONIBILITÀ d
              JOIN PRODOTTO p ON d.IDprodotto = p.IDprodotto
              JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome
              JOIN CATEGORIA c ON s.categoria = c.nome
              WHERE c.nome = ?";

    $stmt = $this->db->prepare($query);
    if (!$stmt) return [];

    $stmt->bind_param("s", $categoria);
    if (!$stmt->execute()) return [];

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}



}

?>