<?php

session_start();

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Gîte Figuiès - Mentions légales</title>
        <meta charset="UTF-8" />

        <meta name="description" content="Gîte Figuiès - Magnifique maison en pierre, située en Aveyron à Salle-la-Source, sur les hauteurs, entre vignes, falaises et le causse, possédant une vue magnifique et un environnement agréable. Disponible à la location toute l'année" />
		<meta name="keywords" content="Figuiès, Figuies, gîte, gite, maison, location, réserver, réservation, Aveyron, Salle-la-Source"/>
		<meta name="author" content="Gîte Figuiès" />
		<meta name="copyright" content="Gîte Figuiès" />

        <link rel="stylesheet" href="style/style.css" />
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    </head>
    <body>

        <?php
            include "assets/header.html";

            include "assets/menu.php";
        ?>

        <main>

            <section>

                <h2>Gîte Figuiès - Mentions légales</h2>

                <h3>Coordonnées</h3>

                <p>
                    Gîte Figuiès<br />
                    140 rue de Figuiès<br />
                    12330 Salles-la-Source<br />
                </p>

                <hr /><br />

                <h3>Hébergeur</h3>

                <p>
                    AlwaysData<br />
                    91 Rue du Faubourg Saint-Honoré<br />
                    75008 Paris<br /><br />

                    Téléphone : 01 84 16 23 40
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