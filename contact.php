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
    padding-top: 500px;
}

.centered-content figure {
    display: inline-block;
    margin: 10px;


}
#map{
    height:400px;
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
                <br>
                0586966435
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

        <?php
            include "assets/footer.html";
        ?>

    </body>
</html>