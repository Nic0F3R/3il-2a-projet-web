<?php

session_start();

if(!($_SESSION['isAdmin'])) {
    header('Location:index.php');
}

include "db/config.php";

$erreur = "";



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Gîte Figuiès - Gestion des Photos</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <body>

        <?php
            include "assets/header.html";
            include "assets/menu.php";
        ?>

        <main>

            <section>

                <h2>Gestion des photos - Administration</h2>

                <p>

                    <form action="" method="POST">
                        <label for="login">Identifiant :</label>
                        <input type="text" name="login"><br />

                        <label for="mdp">Mot de passe :</label>
                        <input type="password" name="mdp"><br /><br />

                        <input type="submit" name="submit" value="Connexion"><br /><br />
                    </form>

                    <?php
                        if(!empty($erreur)) {
                            echo "<strong><font color='red'>" . $erreur . "</font></strong>";
                        }
                    ?>

                </p>

                <br /><br />

            </section>
        </main>

        <?php
            include "assets/footer.html";
        ?>



        <script>

            // ---- MENU RESPONSIVE ---- //
            document.addEventListener("DOMContentLoaded", function () {

                const menuToggle = document.querySelector(".menu-toggle");
                const navList = document.querySelector("nav ul");

                menuToggle.addEventListener("click", function () {
                    navList.classList.toggle("active");
                });
                
            });
            // ---- FIN MENU RESPONSIVE ---- //

        </script>

    </body>
</html>