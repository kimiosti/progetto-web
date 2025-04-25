<link rel="stylesheet" type="text/css" href="style/form.css"/>
<section>
    <form action="actions/profile/<?php
        if ($templateParams["tipoForm"] == "registrazione") {
            echo "register.php";
        } else if ($templateParams["tipoForm"] == "cambiaEmail") {
            echo "change-email.php";
        } else if ($templateParams["tipoForm"] == "cambiaPass") {
            echo "change-pass.php";
        } else if ($templateParams["tipoForm"] == "cambiaTelefono") {
            echo "change-phone.php";
        } else {
            echo "login.php";
        }
    ?>" method="post">
        <h1><?php
            if ($templateParams["tipoForm"] == "registrazione") {
                echo "Registrazione";
            } else if ($templateParams["tipoForm"] == "cambiaEmail") {
                echo "Cambia email";
            } else if ($templateParams["tipoForm"] == "cambiaPass") {
                echo "Cambia password";
            } else if ($templateParams["tipoForm"] == "cambiaTelefono") {
                echo "Cambia numero di telefono";
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
                            <label for="telefono">Telefono:</label><input type="tel" id="telefono" name="telefono" maxlength="10" />
                        </li>
                        <li>
                            <label for="confermaTelefono">Ripeti telefono:</label><input type="tel" id="confermaTelefono" name="confermaTelefono" maxlength="10" />
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
                            <label for="vecchiaPassword">Vecchia password:</label><input type="password" id="vecchiaPassword" name="password" />
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
                            <label for="telefono">Telefono:</label><input type="tel" id="telefono" name="telefono" maxlength="10" />
                        </li>
                        <li>
                            <label for="confermaTelefono">Ripeti telefono:</label><input type="tel" id="confermaTelefono" name="confermaTelefono" maxlength="10" />
                        </li>
                        <li>
                            <input type="submit" name="submit" value="Cambia telefono" />
                        </li>
                    EOD;
                } else {
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
            ) {
                echo '<a href="handle-profile.php"><button>Torna indietro</button></a>';
            }
        ?>
</section>