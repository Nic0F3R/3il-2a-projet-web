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
        <title>Gîte Figuiès - Accueil</title>
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

                <h2>Bienvenue sur le site du gîte Figuiès</h2>

                <p>
                    Notre maison en pierre, située sur les hauteurs, entre vignes, falaises et le causse vous séduira par sa vue magnifique et son environnement agréable.
                </p>

                <br /><br />

                <div class="carousel-container-wrapper">

                    <div class="carousel-container">

                        <?php

                            // Récupération des images pour le carrousel

                            $scandir = scandir("./images/carrousel/");

                            foreach($scandir as $fichier) {

                                // Filtre les images avec une regex
                                if(preg_match("#\.(jpg|jpeg|png|gif|bmp|tif)$#", strtolower($fichier))) {
                                    $baliseImage = "<div class='carousel-slide'><div class='image-container'><img src='images/carrousel/$fichier' alt='Image du gîte Figuiès' srcset='images/carrousel/w400-$fichier w400, images/carrousel/w600-$fichier w600, images/carrousel/$fichier w900' sizes='(max-width: 320px) 280px, (max-width: 640px) 600px, 1000px'  loading='lazy' width='600' height='400'></div></div>";
                                    echo $baliseImage;
                                }

                            }

                        ?>

                        <button id="prevBtn" class="carousel-button">&lt;</button>

                        <button id="nextBtn" class="carousel-button">&gt;</button>

                    </div>

                </div>

                <br /><br />

                <h3>À partir de 550€ / semaine</h3>

                <p>
                    À 20 minutes de Rodez, 10 minutes de Marcillac et 30 mn de Conques, vous êtes <strong>idéalement situés pour visiter</strong> quelques un des sites naturels ou culturels remarquables de l'Aveyron.
                    <br /><br />
                    Figuies est un hameau charmant, que l'on visite à pied. Une belle balade par un chemin, vous mènera de la cascade de la Roque, à celles de Salles-la source, en profitant de nombreux points de vue sur le paysage. On adore aussi le sentier à flanc de versant avec des passages en encorbellement creusé dans la roche ! Il nous fait pénétrer dans le paysage des falaises calcaires avec de beaux points de vue sur la vallée.  Vous êtes sur le GR 62 de Rodez à Conques.
                    <br /><br />
                    Le gîte de Figuies,  d'une superficie de 75 m² sur deux niveaux, a été <strong>entièrement rénové en 2021</strong>. Une agréable décoration allie un style contemporain et des matériaux naturels comme le bois et le rotin.
                    <br /><br />
                    Il se compose, au rez-de-chaussée d'une pièce lumineuse ouverte sur le paysage grâce à une grande baie vitrée.  De 35 m² et climatisée, cet espace offre une <strong>cuisine moderne bien équipée</strong>, un séjour et un coin salon chaleureux et cosys.
                    <br /><br />
                    La <strong>terrasse plein sud</strong>, offre une <strong>vue imprenable sur la vallée</strong> que l'on peut contempler en prenant ses repas. Vous pourrez même admirer de superbes couchers du soleil.
                    <br />
                    A l'étage, vous disposerez de <strong>deux chambres mansardées</strong> et confortables. L'une avec un lit en 140/190 et l'autre avec deux lits en 90/190. Vous y trouverez aussi la salle de bain avec son WC.
                    <br /><br />
                    Le <strong>jardin</strong>, très agréable, est non clos. Pourvu d'un bar extérieur, d'un barbecue, d'un évier et de mobilier de jardin, vous pourrez y prendre vos repas ou vous reposer à l'ombre de la glycine. Un WC et une douche complètent l'équipement.  
                    <br /><br />
                    Pour des vacances authentiques et au grand air, dans un <strong>lieu paisible à l'écart de la circulation</strong>, vous vous sentirez chez vous tout en étant dépaysé.
                </p>

                <br /><hr />

                <h3>Capacité</h3>

                <p>

                    <ul>
                        <li>Personnes : 4</li>
                        <li>Chambre : 2</li>
                        <li>Personne (maximum) : 4</li>
                    </ul>
                </p>

                <br /><hr />

                <h3>Équipements et Services</h3>

                <p>

                    <ul>
                        <li>Abris pour vélo ou VTT</li>
                        <li>Barbecue</li>
                        <li>Cuisine équipée</li>
                        <li>Jardin</li>
                        <li>Local matériel fermé</li>
                        <li>Parking privé</li>
                        <li>Salon de jardin</li>
                        <li>Terrain non clos</li>
                        <li>Terrasse</li>
                        <li>Animaux acceptés (Payant)</li>
                        <li>Location de linge (Payant)</li>
                    </ul>
                </p>

                <br /><hr />

                <h3>Langues</h3>

                <p>
                    <ul>
                        <li>Français</li>
                    </ul>
                </p>

                <br /><hr />

                <h3>Tarifs</h3>

                <p>

                    <strong>Tarifs 2023</strong>

                    <ul>
                        <li><strong>Semaine Moyenne saison</strong> à 550€</li>
                        <li><strong>Nuitée Moyenne saison</strong> à 85€</li>
                        <li><strong>Semaine Haute Saison</strong> à 650€</li>
                        <li><strong>Nuitée Haute Saison</strong> à 110€</li>
                    </ul>
                </p>

                <br /><hr />

                <h3>Moyens de payement</h3>

                <p>
                    <ul>
                        <li>Chèques</li>
                        <li>Espèces</li>
                        <li>Virements</li>
                    </ul>
                </p>

                <br /><hr />

                <h3>Disponibilités</h3>

                <p>
                    Ouverture à partir du 01/04/2023 jusqu'au 30/10/2023
                </p>

                <br /><hr />

                <h3>Localisation</h3>

                <p>
                    
                    Vous pouvez nous trouver à l'adresse suivante :<br /><br />
                    <strong>Figuiès</strong><br />
                    140 rue de Figuiès<br />
                    12330 Salles-la-Source<br /><br />

                    Ci-dessous notre localisation précise sur la carte : <br /><br />

                    <div id="map">

                    </div>
                    
                </p>

                <br /><br />

            </section>
        </main>

        <?php
            include "assets/footer.html";
        ?>

        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

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


            // ---- CARROUSEL ---- //
            const carouselContainer = document.querySelector('.carousel-container');
            const slides = document.querySelectorAll('.carousel-slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let currentIndex = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.style.display = 'block';
                    } else {
                        slide.style.display = 'none';
                    }
                });
            }

            function nextSlide() {
                currentIndex++;
                if(currentIndex >= slides.length) {
                    currentIndex = 0;
                }
                showSlide(currentIndex);
            }

            function prevSlide() {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = slides.length - 1;
                }
                showSlide(currentIndex);
            }

            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            showSlide(currentIndex);

            // ---- FIN CARROUSEL ---- //

            // ---- CARTE ---- //
            var lat = 44.449083;
            var lon = 2.493333;

            var macarte = null;
            
            function initMap() {

                macarte = L.map('map').setView([lat, lon], 11);
                
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
				
				var marker = L.marker([lat, lon]).addTo(macarte);

            }

            window.onload = function() {
		        initMap(); 
            };

            // ---- FIN CARTE ---- //

        </script>

    </body>
</html>