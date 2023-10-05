<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gîte Figuiès</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <style>
        .centered-content {
            text-align: center;
            padding-top: 100px;
        }

        .centered-content figure {
            display: inline-block;
            margin: 10px;
        }

        #map {
            height: 400px;
            margin:25px 300px 200px;
        }
    </style>
</head>
<body>

<?php
include "assets/header.html";
include "assets/menu.php";
?>

<main>
    <section>
        <h2>Nous Contacter</h2>
        <p>
            <div id="map">
                <!-- Ici s'affichera la carte -->
            </div>
            <div class="centered-content">
        <figure>
            <img src="/images/Contact /chemin_vers_image.jpg" alt="Horraire d'ouverture" />

            <figcaption>Ouvert toute l'année
                <br>
                <br>
                De 8h à 12 h et de 14 à 19 h</figcaption>
        </figure>

        <figure>
            <img src="chemin_vers_image.jpg" alt="Echangeons" />

            <figcaption>
                <br>
                0586966435 
                <br>
                0686945757
            </figcaption>
        </figure>

        <figure>
            <img src="chemin_vers_image.jpg" alt="Demande d'information" />
            <figcaption>
                <br>
                <br>
                <br>
            </figcaption>
        </figure>
    </div>
        </p>
    </section>
</main>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
<script type="text/javascript">
    // On initialise la latitude et la longitude du nouvel emplacement
    var lat = 44.449083;
    var lon = 2.493333;
    var macarte = null;

    // Fonction d'initialisation de la carte
    function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map').setView([lat, lon], 11);

        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);

        // Nous ajoutons un marqueur
        var marker = L.marker([lat, lon]).addTo(macarte);
    }

    window.onload = function () {
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
    };
</script>

<?php
include "assets/footer.html";
?>

</body>
</html>
