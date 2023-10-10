<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!($_SESSION['isAdmin'])) {
    header('Location:index.php');
}

include "db/config.php";

$erreur = "";
$msgOK = "";

if(isset($_POST['submit'])) {

    $msgOK = "";

    if(!empty($_FILES['fichier']['name'])) {

        $dossier_destination = 'images/carrousel/';
        $nom_fichier = $_FILES["fichier"]["name"];
        $chemin_temporaire = $_FILES["fichier"]["tmp_name"];
        $chemin_fichier = $dossier_destination . $nom_fichier;
        $tailleFichier = $_FILES['fichier']['size'];

        $tabExtension = explode('.', $nom_fichier);
        $extension = strtolower(end($tabExtension));

        $extensions = ['jpg', 'png', 'jpeg', 'gif'];

        // Vérification de l'extension du fichier
        if(in_array($extension, $extensions)) {

            if(move_uploaded_file($chemin_temporaire, $chemin_fichier)) {

                $msgOK = "L'image $nom_fichier a été téléchargée";

            } else {
                $erreur = "Erreur lors du téléchargement du fichier";
            }

        } else {
            $erreur = "Le fichier sélectionné doit être une image (jpg, jpeg, png, gif)";
        }
        
    } else {
        $erreur = "Veuillez sélectionner un fichier";
    }

}

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

                <h3>Télécharger des photos</h3>

                <p>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="fichier">Sélectionner une image :</label>

                        <input type="file" name="fichier"><br /><br />

                        <input type="submit" name="submit" value="Télécharger"><br /><br />
                    </form>

                    <?php

                        if(!empty($erreur)) {
                            echo "<strong><font color='red'>" . $erreur . "</font></strong>";
                        }

                        if(!empty($msgOK)) {
                            echo "<strong><font color='#008000'>" . $msgOK . "</font></strong>";
                        }

                    ?>

                </p>

                <br /><hr />

                <h3>Visualiser / supprimer des photos</h3>

                <p>

                </p>

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