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
    
    public function addUser($username, $password, $email, $phone) {
        $statement = $this->db->prepare("INSERT INTO acquirente(username, password, email, telefono) VALUES (?,?,?,?)");
        $statement->bind_param("ssss", $username, $password, $email, $phone);
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
            return "acquirente";
        } else if (count($sellers) == 1) {
            return "venditore";
        } else {
            return "wrongCredentials";
        }
    }

    public function getCustomerInfo($username) {
        $statement = $this->db->prepare("SELECT email, telefono FROM acquirente WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSellerInfo($username) {
        $statement = $this->db->prepare("SELECT email, telefono FROM venditore WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function setEmail($table, $username, $email) {
        $statement = $this->db->prepare("UPDATE " . $table . " SET email = ? WHERE username = ?");
        $statement->bind_param("ss", $email, $username);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function setPassword($table, $username, $password) {
        $statement = $this->db->prepare("UPDATE " . $table . " SET password = ? WHERE username = ?");
        $statement->bind_param("ss", $password, $username);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function setPhoneNumber($table, $username, $phone) {
        $statement = $this->db->prepare("UPDATE " . $table . " SET telefono = ? WHERE username = ?");
        $statement->bind_param("ss", $phone, $username);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function deleteSeller($username) {
        try {
            $availabilityStatement = $this->db->prepare("DELETE FROM disponibilità WHERE usernameVenditore = ?");
            $availabilityStatement->bind_param("s", $username);
            $availabilityStatement->execute();

            $offerStatement = $this->db->prepare("DELETE FROM offerta WHERE usernameVenditore = ?");
            $offerStatement->bind_param("s", $username);
            $offerStatement->execute();

            $notificationStatement = $this->db->prepare("DELETE FROM `ricezione-venditore` WHERE usernameVenditore = ?");
            $notificationStatement->bind_param("s", $username);
            $notificationStatement->execute();

            $accountStatement = $this->db->prepare("DELETE FROM venditore WHERE username = ?");
            $accountStatement->bind_param("s", $username);
            $accountStatement->execute();

            return $this->db->affected_rows == 1;
        } catch (Exception $th) {
            return false;
        }
    }

    public function deleteCustomer($username) {
        try {
            $orderStatement = $this->db->prepare("DELETE FROM ordine WHERE usernameAcquirente = ?");
            $orderStatement->bind_param("s", $username);
            $orderStatement->execute();

            $paymentStatement = $this->db->prepare("DELETE FROM pagamento WHERE usernameAcquirente = ?");
            $paymentStatement->bind_param("s", $username);
            $paymentStatement->execute();

            $favouriteStatement = $this->db->prepare("DELETE FROM preferito WHERE usernameAcquirente = ?");
            $favouriteStatement->bind_param("s", $username);
            $favouriteStatement->execute();

            $notificationStatement = $this->db->prepare("DELETE FROM `ricezione-acquirente` WHERE usernameAcquirente = ?");
            $notificationStatement->bind_param("s", $username);
            $notificationStatement->execute();

            $accountStatement = $this->db->prepare("DELETE FROM acquirente WHERE username = ?");
            $accountStatement->bind_param("s", $username);
            $accountStatement->execute();

            return $this->db->affected_rows == 1;
        } catch (Exception $th) {
            return false;
        }
    }

    public function getBrand(){
        $statement= $this->db->prepare(
            "SELECT DISTINCT o.categoria AS Categoria, o.marca AS Marca
             FROM OFFERTA o  
             JOIN CATEGORIA c ON o.categoria = c.nome"
             );
    
            $statement->execute();
            $result = $statement->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getWishlist($idUtente) {
        $statement = $this->db->prepare("
            SELECT *
            FROM prodotto p
            WHERE p.IDprodotto IN (
                SELECT pr.IDprodotto
                FROM preferito pr
                WHERE pr.usernameAcquirente = ?
            )
        ");
        $statement->bind_param("s", $idUtente);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>