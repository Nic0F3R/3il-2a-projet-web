<?php

include "db/config.php";

$erreur = "";

if(!empty($_POST['login'])) {

    if(!empty($_POST['mdp'])) {

        $login = htmlspecialchars(htmlentities($_POST['login']));
        $mdp = htmlspecialchars(htmlentities($_POST['mdp']));


        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $pdo = new PDO($dsn, $user, $password);

            $req = "SELECT * FROM ComptesAdmin WHERE login='" . $login . "' AND mdp='" . $mdp . "';";

            $res = $pdo->query($req);

            $nbComptesAdmin = $res->fetchColumn();


            
        } catch (PDOException $e) {
            $erreur = "Erreur de connexion. Veuillez contacter le webmaster";
        }
        


    } else {
        $erreur = "Le mot de passe est obligatoire";
    }
} else {
    $erreur = "L'identifiant est obligatoire";
}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Gîte Figuiès - Administration</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="style/style.css" />
    </head>
    <body>

        <?php
            include "assets/header.html";
            include "assets/menu.html";
        ?>

        <main>

            <section>

                <h2>Administration</h2>

                <p>

                    <form action="" method="POST">
                        <label for="login">Identifiant :</label>
                        <input type="text" name="login"><br />

                        <label for="mdp">Mot de passe :</label>
                        <input type="password" name="mdp"><br /><br />

                        <input type="submit" value="Connexion"><br /><br />
                    </form>

                    <?php
                        if(isset($erreur)) {
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