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
        $statement= $this->db->prepare("SELECT descrizione FROM categoria WHERE nome= ?");
        $statement->bind_param("s", $categoria);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['descrizione'] : null;
    }



    public function getProductByCategories($categoria, $marche = [], $sottocategorie = [], $taglie = [], $prezzi = [], $search = '') {
        $query = "SELECT DISTINCT p.*, d.taglia, d.prezzo, d.IDdisponibilità
                  FROM PRODOTTO p
                  JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome
                  JOIN CATEGORIA c ON s.categoria = c.nome
                  LEFT JOIN DISPONIBILITÀ d ON p.IDprodotto = d.IDprodotto
                  WHERE c.nome = ?";

        $params = [$categoria];
        $types = "s";

        if (!empty($marche)) {
            $placeholders = implode(',', array_fill(0, count($marche), '?'));
            $query .= " AND p.marca IN (" . $placeholders . ")";
            foreach ($marche as $marca) { $params[] = $marca; }
            $types .= str_repeat('s', count($marche));
        }
        if (!empty($sottocategorie)) {
            $placeholders = implode(',', array_fill(0, count($sottocategorie), '?'));
            $query .= " AND p.sottocategoria IN (" . $placeholders . ")";
            foreach ($sottocategorie as $sottocategoria) { $params[] = $sottocategoria; }
            $types .= str_repeat('s', count($sottocategorie));
        }
        if (!empty($taglie)) {
            $placeholders = implode(',', array_fill(0, count($taglie), '?'));
            $query .= " AND d.taglia IN (" . $placeholders . ")";
            foreach ($taglie as $taglia) { $params[] = $taglia; }
            $types .= str_repeat('s', count($taglie));
        }
        if (!empty($prezzi)) {
            $placeholders = implode(',', array_fill(0, count($prezzi), '?'));
            $query .= " AND d.prezzo IN (" . $placeholders . ")";
            foreach ($prezzi as $prezzo) { $params[] = $prezzo; }
            $types .= str_repeat('d', count($prezzi));
        }

        if (!empty($search)) {
            $search_is_filter = false;
            foreach ($marche as $marca) {
                if (strcasecmp($marca, $search) == 0) {
                    $search_is_filter = true;
                    break;
                }
            }
            if (!$search_is_filter) {
                foreach ($sottocategorie as $sottocategoria) {
                    if (strcasecmp($sottocategoria, $search) == 0) {
                        $search_is_filter = true;
                        break;
                    }
                }
            }

            if (!$search_is_filter) {
                $query .= " AND (p.nome LIKE ? OR p.marca LIKE ? OR p.didascalia LIKE ?)";
                $searchTerm = "%" . $search . "%";
                $params[] = $searchTerm;
                $params[] = $searchTerm;
                $params[] = $searchTerm;
                $types .= "sss";
            }
        }

        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT p.*, d.taglia, d.prezzo, p.ingredienti, p.istruzioni, d.IDdisponibilità
                  FROM PRODOTTO p
                  LEFT JOIN DISPONIBILITÀ d ON p.IDprodotto = d.IDprodotto
                  WHERE p.IDprodotto = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
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

    public function getBrand($categoria){
        $statement= $this->db->prepare("SELECT DISTINCT p.marca FROM PRODOTTO p JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome JOIN CATEGORIA c ON s.categoria = c.nome WHERE c.nome = ?");
        $statement->bind_param("s", $categoria);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getSubcategory($categoria){
        $statement= $this->db->prepare("SELECT DISTINCT p.sottocategoria FROM PRODOTTO p JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome JOIN CATEGORIA c ON s.categoria = c.nome WHERE c.nome = ?");
        $statement->bind_param("s", $categoria);
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

    public function sameProductExists($name, $brand, $subcategory) {
        $statement = $this->db->prepare("SELECT * FROM prodotto WHERE nome = ? AND marca = ? AND sottocategoria = ?");
        $name = strtolower($name);
        $brand = strtolower($brand);
        $subcategory = strtolower($subcategory);
        $statement->bind_param("sss", $name, $brand, $subcategory);
        $statement->execute();

        $result = $statement->get_result();
        return mysqli_num_rows($result) != 0;
    }

    public function brandExists($brand) {
        $statement = $this->db->prepare("SELECT * FROM marca WHERE nome = ?");
        $brand = strtolower($brand);
        $statement->bind_param("s", $brand);
        $statement->execute();

        $result = $statement->get_result();
        return mysqli_num_rows($result) != 0;
    }

    public function createBrand($brand) {
        $statement = $this->db->prepare("INSERT INTO marca(nome) VALUES(?)");
        $brand = strtolower($brand);
        $statement->bind_param("s", $brand);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function subcategoryExists($category, $subname) {
        $statement = $this->db->prepare("SELECT * FROM sottocategoria WHERE nome = ? AND categoria = ?");
        $category = strtolower($category);
        $subname = strtolower($subname);
        $statement->bind_param("ss", $subname, $category);
        $statement->execute();

        $result = $statement->get_result();
        return mysqli_num_rows($result) != 0;
    }

    public function createSubcategory($category, $subname) {
        $statement = $this->db->prepare("INSERT INTO sottocategoria(nome, categoria) VALUES(?, ?)");
        $category = strtolower($category);
        $subname = strtolower($subname);
        $statement->bind_param("ss", $subname, $category);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function addProduct($name, $brand, $caption, $description, $instructions, $ingredients, $warnings, $image, $subcategory) {
        $statement = $this->db->prepare("
            INSERT INTO prodotto(nome, marca, didascalia, descrizione, URLimmagine, istruzioni, ingredienti, avvertenze, sottocategoria)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $name = strtolower($name);
        $brand = strtolower($brand);
        $subcategory = strtolower($subcategory);
        $statement->bind_param("sssssssss", $name, $brand, $caption, $description, $image, $instructions, $ingredients, $warnings, $subcategory);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function getSize($categoria) {
        $query = "SELECT DISTINCT d.taglia FROM DISPONIBILITÀ d JOIN PRODOTTO p ON d.IDprodotto = p.IDprodotto JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome JOIN CATEGORIA c ON s.categoria = c.nome WHERE c.nome = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return [];
        $stmt->bind_param("s", $categoria);
        if (!$stmt->execute()) return [];
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPrice($categoria){
        $query = "SELECT DISTINCT d.prezzo FROM DISPONIBILITÀ d JOIN PRODOTTO p ON d.IDprodotto = p.IDprodotto JOIN SOTTOCATEGORIA s ON p.sottocategoria = s.nome JOIN CATEGORIA c ON s.categoria = c.nome WHERE c.nome = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) return [];
        $stmt->bind_param("s", $categoria);
        if (!$stmt->execute()) return [];
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hasUnreadNotifications($username, $user_type) {
        $table = $user_type == "venditore" ? "`NOTIFICA-VENDITORE`" : "`NOTIFICA-ACQUIRENTE`";
        $param = $user_type == "venditore" ? "usernameVenditore" : "usernameAcquirente";
        $statement = $this->db->prepare(
            "SELECT * FROM "
            . $table
            . " WHERE "
            . $param
            . " = ? AND letto = 'false'"
        );
        $statement->bind_param("s", $username);
        $statement->execute();

        $result = $statement->get_result();
        return mysqli_num_rows($result) != 0;
    }

    public function getAllNotifications($username, $user_type, $read) {
        $table = $user_type == "venditore" ? "`NOTIFICA-VENDITORE`" : "`NOTIFICA-ACQUIRENTE`";
        $param = $user_type == "venditore" ? "usernameVenditore" : "usernameAcquirente";
        $query = "SELECT * FROM " . $table . " WHERE " . $param . " = ? AND LETTO = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("si", $username, $read);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function toggleNotificationRead($user_type, $notificationID) {
        $table = $user_type == "venditore" ? "`NOTIFICA-VENDITORE`" : "`NOTIFICA-ACQUIRENTE`";
        $checkQuery = "SELECT * FROM " . $table . "WHERE IDnotifica = ?";
        $setQuery = "UPDATE " . $table . " SET letto = ? WHERE IDnotifica = ?";

        $checkStatement = $this->db->prepare($checkQuery);
        $checkStatement->bind_param("i", $notificationID);
        $checkStatement->execute();
        $check = $checkStatement->get_result()->fetch_all(MYSQLI_ASSOC);
        $checkStatement->close();

        $newRead = $check[0]["letto"] == 0 ? 1 : 0;
        $setStatement = $this->db->prepare($setQuery);
        $setStatement->bind_param("ii", $newRead, $notificationID);
        $setStatement->execute();
        $setStatement->close();
    }

    public function getAvailabilities($productID) {
        $statement = $this->db->prepare("SELECT * FROM disponibilità WHERE IDprodotto = ? AND quantità != 0 ORDER BY prezzo ASC");
        $statement->bind_param("i", $productID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getCategoryBySearch($term) {
        $like = "%" . $term . "%";

        $q = $this->db->prepare("SELECT nome FROM CATEGORIA WHERE nome LIKE ? LIMIT 1");
        $q->bind_param("s", $like);
        $q->execute();
        $res = $q->get_result()->fetch_assoc();
        if ($res) return $res["nome"];

        $q = $this->db->prepare("SELECT DISTINCT S.categoria
                                FROM PRODOTTO P
                                JOIN SOTTOCATEGORIA S ON P.sottocategoria = S.nome
                                WHERE P.marca LIKE ? LIMIT 1");
        $q->bind_param("s", $like);
        $q->execute();
        $res = $q->get_result()->fetch_assoc();
        if ($res) return $res["categoria"];


        $q = $this->db->prepare("SELECT DISTINCT S.categoria
                                FROM PRODOTTO P
                                JOIN SOTTOCATEGORIA S ON P.sottocategoria = S.nome
                                WHERE P.nome LIKE ? LIMIT 1");
        $q->bind_param("s", $like);
        $q->execute();
        $res = $q->get_result()->fetch_assoc();
        if ($res) return $res["categoria"];

        return null;
    }

    public function getAvailabilitiesBySeller($productID, $username) {
        $statement = $this->db->prepare("SELECT * FROM disponibilità WHERE IDprodotto = ? AND usernameVenditore = ?");
        $statement->bind_param("is", $productID, $username);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAvailabilityByID($availabilityID, $username) {
        $statement = $this->db->prepare("SELECT * FROM disponibilità WHERE IDdisponibilità = ? AND usernameVenditore = ?");
        $statement->bind_param("is", $availabilityID, $username);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateAvailabilityPrice($availabilityID, $price) {
        $statement = $this->db->prepare("UPDATE disponibilità SET prezzo = ? WHERE IDdisponibilità = ?");
        $statement->bind_param("di", $price, $availabilityID);
        
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function updateAvailabilityQuantity($availabilityID, $quantity) {
        $statement = $this->db->prepare("UPDATE disponibilità SET quantità = ? WHERE IDdisponibilità = ?");
        $statement->bind_param("ii", $quantity, $availabilityID);

        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function notifyBuyers($users, $title, $content, $orderID = null, $availabilityID = null) {
        foreach ($users as $user) {
            $statement = $this->db->prepare("
                INSERT INTO `notifica-acquirente` (usernameAcquirente, titolo, contenuto, data, IDordine, IDdisponibilità)
                VALUES (?, ?, ?, CURDATE(), ?, ?)
            ");
            $statement->bind_param("sssii", $user["username"], $title, $content, $orderID, $availabilityID);
            $statement->execute();
            $statement->close();
        }
    }

    public function notifySellers($users, $title, $content, $orderID = null, $availabilityID = null) {
        foreach ($users as $user) {
            $statement = $this->db->prepare("
                INSERT INTO `notifica-venditore` (usernameVenditore, titolo, contenuto, data, IDordine, IDdisponibilità)
                VALUES (?, ?, ?, CURDATE(), ?, ?)
            ");
            $statement->bind_param("sssii", $user["username"], $title, $content, $orderID, $availabilityID);
            $statement->execute();
            $statement->close();
        }
    }

    public function getInterestedBuyers($availabilityID) {
        $statement = $this->db->prepare("
            SELECT a.*
            FROM acquirente a, disponibilità d, preferito p
            WHERE p.IDprodotto = d.IDprodotto
            AND p.usernameAcquirente = a.username
            AND d.IDdisponibilità = ?
        ");
        $statement->bind_param("i", $availabilityID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByAvailability($availabilityID) {
        $statement = $this->db->prepare("
            SELECT p.*, c.nome
            FROM disponibilità d, prodotto p, sottocategoria s, categoria c
            WHERE p.IDprodotto = d.IDprodotto
            AND s.nome = p.sottocategoria
            AND s.categoria = c.nome
            AND d.IDdisponibilità = ?
        ");
        $statement->bind_param("i", $availabilityID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sameAvailabilityExists($productID, $size) {
        $statement = $this->db->prepare("SELECT * FROM disponibilità WHERE IDprodotto = ? AND taglia = ?");
        $statement->bind_param("is", $productID, $size);
        $statement->execute();

        $result = $statement->get_result();
        return mysqli_num_rows($result) != 0;
    }

    public function recordAvailability($productID, $size, $price, $quantity, $seller) {
        $statement = $this->db->prepare("
            INSERT INTO disponibilità (IDprodotto, taglia, prezzo, quantità, usernameVenditore)
            VALUES (?, ?, ?, ?, ?)
        ");
        $statement->bind_param("isdis", $productID, $size, $price, $quantity, $seller);
        try {
            $statement->execute();
        } catch (Exception $th) {
            return -1;
        }
        $statement->close();

        $returnStatement = $this->db->prepare("SELECT * FROM disponibilità WHERE IDprodotto = ? AND taglia = ?");
        $returnStatement->bind_param("is", $productID, $size);
        $returnStatement->execute();
        $result = $returnStatement->get_result()->fetch_all(MYSQLI_ASSOC);

        if (empty($result)) {
            return -1;
        } else {
            return $result[0]["IDdisponibilità"];
        }
    }

    public function getCustomerOrders($username) {
        $statement = $this->db->prepare('
            SELECT *
            FROM ordine o, pagamento p
            WHERE o.IDordine = p.IDordine
            AND o.usernameAcquirente = ?
            AND o.stato != "carrello"
        ');
        $statement->bind_param("s", $username);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersToSeller($username) {
        $statement = $this->db->prepare('
            SELECT o.*, p.*
            FROM ordine o, pagamento p
            WHERE o.IDordine = p.IDordine
            AND o.stato != "carrello"
            AND o.IDordine IN (
                SELECT i.IDordine
                FROM inclusione i, disponibilità d
                WHERE i.IDdisponibilità = d.IDdisponibilità
                AND d.usernameVenditore = ?
            )
        ');
        $statement->bind_param("s", $username);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function advanceOrderState($orderID) {
        $statement = $this->db->prepare("UPDATE ordine SET stato = stato + 1 WHERE IDordine = ?");
        $statement->bind_param("i", $orderID);
        try {
            $statement->execute();
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function getOrderByID($orderID) {
        $statement = $this->db->prepare("SELECT * FROM ordine WHERE IDordine = ?");
        $statement->bind_param("i", $orderID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderAuthor($orderID) {
        $statement = $this->db->prepare("
            SELECT a.*
            FROM ordine o, acquirente a
            WHERE o.usernameAcquirente = a.username
            AND o.IDordine = ?
        ");
        $statement->bind_param("i", $orderID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderedAvailabilities($orderID) {
        $statement = $this->db->prepare("
            SELECT p.nome, p.marca, p.URLimmagine, d.taglia, d.prezzo, i.quantità, o.stato, p.IDprodotto, pa.data
            FROM ordine o, inclusione i, disponibilità d, prodotto p, pagamento pa
            WHERE i.IDordine = o.IDordine
            AND pa.IDordine = o.IDordine
            AND i.IDdisponibilità = d.IDdisponibilità
            AND d.IDprodotto = p.IDprodotto
            AND o.IDordine = ?
        ");
        $statement->bind_param("i", $orderID);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>