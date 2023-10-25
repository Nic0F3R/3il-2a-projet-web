<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SESSION['isAdmin'] != true) {
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
        <link rel="icon" href="images/favicon.ico" />
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

                    <?php
                        // Affichage de toutes les images dans le dossier carrousel

                        $scandir = scandir("./images/carrousel/");

                        foreach($scandir as $fichier) {

                            // Filtre les images avec une regex
                            if(preg_match("#\.(jpg|jpeg|png|gif|bmp|tif)$#", strtolower($fichier))) {
                                $baliseImage = "<div class='container-photo-btn'><img src='images/carrousel/$fichier' alt='Image du gîte Figuiès' id='$fichier'><button type='button' class='btn-supprimer-image' id='$fichier'>X</button></div><br /><br/>";
                                echo $baliseImage;
                            }

                        }

                    ?>

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


            // ---- SUPPRESSION DES PHOTOS ---- //
            var btnSupprimerClass = document.querySelectorAll('.btn-supprimer-image');
            
            btnSupprimerClass.forEach(function(bouton) {

                bouton.addEventListener('click', function() {

                    var btnSupprId = bouton.id;
                
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "supprimerImg.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                // Image supprimée
                                window.location.href = window.location.href;
                            }
                        }
                    };

                    xhr.send("idImgASuppr=" + btnSupprId);
                    
                });
                
            });

            // ---- FIN SUPPRESSION DES PHOTOS ---- //

        </script>

    </body>
</html>