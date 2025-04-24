<link rel="stylesheet" type="text/css" href="style/form.css"/>
<section>
    <form action="profile.php" method="post">
        <h1><?php
            if ($templateParams["tipoForm"] == 1) {
                echo "Registrazione";
            } else {
                echo "Login";
            }
        ?></h1>
        <p class="errore"><?php 
            if (isset($templateParams["erroreLogin"])) {
                echo $templateParams["erroreLogin"];
            }
        ?></p>
        <ul>
            <li>
                <label for="username">Username:</label><input type="text" id="username" name="username" />
            </li>
            <?php
                if ($templateParams["tipoForm"] == 1) {
                    echo <<<EOD
                    <li>
                        <label for="email">Email:</label><input type="email" id="email" name="email" />
                    </li>
                    <li>
                        <label for="confermaEmail">Ripeti email:</label><input type="email" id="confermaEmail" name="confermaEmail" />
                    </li>
                    EOD;
                }
            ?>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <?php
                if ($templateParams["tipoForm"] == 1) {
                    echo <<<EOD
                    <li>
                        <label for="confermaPassword">Ripeti password:</label><input type="password" id="confermaPassword" name="confermaPassword" />
                    </li>
                    EOD;
                }
            ?>
            <li>
                <input type="submit" name="submit" value="<?php
                    if ($templateParams["tipoForm"] == 1) {
                        echo "Registrati";
                    } else {
                        echo "Accedi";
                    }
                ?>" />
            </li>
        </ul>
        <p><?php
            if ($templateParams["tipoForm"] == 1) {
                echo '<a href="login.php">Hai già un account? <span>Accedi!</span></a>';
            } else {
                echo '<a href="registration.php">Non hai ancora un account? <span>Registrati!</span></a>';
            }
        ?></p>
    </form>
</section>