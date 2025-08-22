<link rel="stylesheet" type="text/css" href="style/form.css"/>
<section>
    <form action="actions/<?php
        if ($templateParams["tipoForm"] == "registrazione") {
            echo "profile/register.php";
        } else if ($templateParams["tipoForm"] == "cambiaEmail") {
            echo "profile/change-email.php";
        } else if ($templateParams["tipoForm"] == "cambiaPass") {
            echo "profile/change-pass.php";
        } else if ($templateParams["tipoForm"] == "cambiaTelefono") {
            echo "profile/change-phone.php";
        } else if ($templateParams["tipoForm"] == "rimuoviAccount") {
            echo "profile/delete-account.php";
        } else if ($templateParams["tipoForm"] == "nuovoProdotto") {
            echo "product/add-new.php";
        }else {
            echo "profile/login.php";
        }
    ?>" method="post" <?php 
        if ($templateParams["tipoForm"] == "nuovoProdotto") {
            echo 'enctype="multipart/form-data"';
        }
    ?>>
        <h1><?php
            if ($templateParams["tipoForm"] == "registrazione") {
                echo "Registrazione";
            } else if ($templateParams["tipoForm"] == "cambiaEmail") {
                echo "Cambia email";
            } else if ($templateParams["tipoForm"] == "cambiaPass") {
                echo "Cambia password";
            } else if ($templateParams["tipoForm"] == "cambiaTelefono") {
                echo "Cambia numero di telefono";
            } else if ($templateParams["tipoForm"] == "rimuoviAccount") {
                echo "Conferma rimozione dell'account";
            } else if ($templateParams["tipoForm"] == "nuovoProdotto") {
                echo "Aggiungi nuovo prodotto";
            } else {
                echo "Login";
            }
        ?></h1>
        <p class="errore"<?php 
            if (isset($templateParams["messaggioForm"])) {
                echo '>' . $templateParams["messaggioForm"];
            } else {
                echo ' hidden="true">';
            }
        ?></p>
        <ul>
            <?php
                if ($templateParams["tipoForm"] == "registrazione") {
                    echo <<<EOD
                        <li>
                            <label for="username">Username:</label><input type="text" id="username" name="username" />
                        </li>
                        <li>
                            <label for="password">Password:</label><input type="password" id="password" name="password" />
                        </li>
                        <li>
                            <label for="confermaPassword">Ripeti password:</label><input type="password" id="confermaPassword" name="confermaPassword" />
                        </li>
                        <li>
                            <label for="email">Email:</label><input type="email" id="email" name="email" />
                        </li>
                        <li>
                            <label for="confermaEmail">Ripeti email:</label><input type="email" id="confermaEmail" name="confermaEmail" />
                        </li>
                        <li>
                            <label for="telefono">Telefono:</label><input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" />
                        </li>
                        <li>
                            <label for="confermaTelefono">Ripeti telefono:</label><input type="tel" id="confermaTelefono" name="confermaTelefono" pattern="[0-9]{10}" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Registrati" />
                        </li>
                    EOD;
                } else if ($templateParams["tipoForm"] == "cambiaEmail") {
                    echo <<<EOD
                        <li>
                            <label for="email">Email:</label><input type="email" id="email" name="email" />
                        </li>
                        <li>
                            <label for="confermaEmail">Ripeti email:</label><input type="email" id="confermaEmail" name="confermaEmail" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Cambia email" />
                        </li>
                    EOD;
                } else if ($templateParams["tipoForm"] == "cambiaPass") {
                    echo <<<EOD
                        <li>
                            <label for="vecchiaPassword">Vecchia password:</label><input type="password" id="vecchiaPassword" name="vecchiaPassword" />
                        </li>
                        <li>
                            <label for="password">Nuova password:</label><input type="password" id="password" name="password" />
                        </li>
                        <li>
                            <label for="confermaPassword">Ripeti password:</label><input type="password" id="confermaPassword" name="confermaPassword" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Cambia password" />
                        </li>
                    EOD;
                } else if ($templateParams["tipoForm"] == "cambiaTelefono") {
                    echo <<<EOD
                        <li>
                            <label for="telefono">Telefono:</label><input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" />
                        </li>
                        <li>
                            <label for="confermaTelefono">Ripeti telefono:</label><input type="tel" id="confermaTelefono" name="confermaTelefono" pattern="[0-9]{10}" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Cambia telefono" />
                        </li>
                    EOD;
                } else if ($templateParams["tipoForm"] == "rimuoviAccount") {
                    echo <<<EOD
                        <li>
                            <input type="submit" name="submit" value="Rimuovi account" />
                        </li>
                    EOD;
                } else if ($templateParams["tipoForm"] == "nuovoProdotto") {
                    $html =  <<<EOD
                        <li>
                            <label for="marca">Marca:</label><input type="text" id="marca" name="marca" />
                        </li>
                        <li>
                            <label for="nome">Nome:</label><input type="text" id="nome" name="nome" />
                        </li>
                        <li>
                            <label for="didascalia">Didascalia:</label><textarea id="didascalia" name="didascalia" maxlength="64">
                    EOD . PRODUCT_CAPTION_DEFAULT . <<<EOD
                    </textarea>
                        </li>
                        <li>
                            <label for="descrizione">Descrizione:</label><textarea id="descrizione" name="descrizione" maxlength="65535">
                    EOD . PRODUCT_DESCRIPTION_DEFAULT . <<<EOD
                    </textarea>
                        </li>
                        <li>
                            <label for="istruzioni">Istruzioni:</label><textarea id="istruzioni" name="istruzioni" maxlength="65535">
                    EOD . PRODUCT_INSTRUCTIONS_DEFAULT . <<<EOD
                    </textarea>
                        </li>
                        <li>
                            <label for="ingredienti">Ingredienti:</label><textarea id="ingredienti" name="ingredienti" maxlength="65535">
                    EOD . PRODUCT_INGREDIENTS_DEFAULT . <<<EOD
                    </textarea>
                        </li>
                        <li>
                            <label for="avvertenze">Avvertenze:</label><textarea id="avvertenze" name="avvertenze" maxlength="65535">
                    EOD . PRODUCT_WARNINGS_DEFAULT . <<<EOD
                    </textarea>
                        </li>
                        <li>
                            <label for="categoria">Categoria:</label><select id="categoria" name="categoria">
                    EOD;
                    foreach ($templateParams["categorie"] as $categoria) {
                        $html = $html . '<option value="' . strtolower($categoria["nome"]) . '">'
                                . strtoupper($categoria["nome"]) . '</option>';
                    }
                    $html = $html . <<<EOD
                        </select></li>
                        <li>
                            <label for="sottocategoria">Sottocategoria:</label><input type="text" id="sottocategoria" name="sottocategoria" />
                        </li>
                        <li>
                            <label for="immagine">Immagine:</label><input type="file" id="immagine" name="immagine" accept="image/*" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Inserisci" />
                        </li>
                    EOD;
                    echo $html;
                }else {
                    echo <<<EOD
                        <li>
                            <label for="username">Username:</label><input type="text" id="username" name="username" />
                        </li>
                        <li>
                            <label for="password">Password:</label><input type="password" id="password" name="password" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Accedi" />
                        </li>
                    EOD;
                }
            ?>
        </ul>
        <p<?php
            if ($templateParams["tipoForm"] == "registrazione") {
                echo '><a href="login.php">Hai già un account? <span>Accedi!</span></a>';
            } else if ($templateParams["tipoForm"] == "login") {
                echo '><a href="registration.php">Non hai ancora un account? <span>Registrati!</span></a>';
            } else {
                echo ' hidden="true">';
            }
        ?></p>
    </form>
    <?php
        if (
            $templateParams["tipoForm"] == "cambiaEmail"
            || $templateParams["tipoForm"] == "cambiaPass"
            || $templateParams["tipoForm"] == "cambiaTelefono"
            || $templateParams["tipoForm"] == "rimuoviAccount"
        ) {
            echo '<a href="handle-profile.php"><button>Torna indietro</button></a>';
        } else if ($templateParams["tipoForm"] == "nuovoProdotto") {
            echo '<a href="availability.php"><button>Torna indietro</button></a>';
        }
    ?>
</section>