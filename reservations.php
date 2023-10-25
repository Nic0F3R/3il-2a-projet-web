<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SESSION['isAdmin'] != true) {
    header('Location:index.php');
}

include "db/config.php";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Gîte Figuiès - Gestion des Réservations</title>
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

                <h2>Gestion des réservations - Administration</h2>

                <p>

                    <?php

                        try {

                            $pdo = new PDO($dsn, $user, $password);
                            $req = "SELECT * FROM Reservations ORDER BY id DESC;";

                            $stmt = $pdo->prepare($req);
                            $stmt->execute();

                            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if(count($res) > 0) {

                                foreach($res as $row) {

                                    echo '<div class="container-reserv-btn">
                                            <div class="reserv" id="' . $row['id'] . '">
                                                <strong>De :</strong> ' . $row['nom'] . ' ' . $row['prenom'] . ' - ' . $row['email'] . ' - ' . $row['telephone'] . '<br /><br /><strong>Du </strong>' . $row['date_debut'] . ' <strong>au</strong> ' . $row['date_fin'] .
                                            '</div>
                                            <button type="button" class="btn-supprimer-reserv" id="' . $row['id'] . '">X</button>
                                        </div><hr /><br />';
                            
                                }

                            } else {
                                echo "Aucune reservation à afficher";
                            }

                        } catch(PDOException $e) {
                            echo "<strong><font color='red'>Erreur lors de la réception des messages</font></strong>";
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


            // ---- SUPPRESSION DES RÉSERVATIONS ---- //
            var btnSupprimerClass = document.querySelectorAll('.btn-supprimer-reserv');
            
            btnSupprimerClass.forEach(function(bouton) {

                bouton.addEventListener('click', function() {

                    var btnSupprId = bouton.id;
                
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "supprimerReserv.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    
                    xhr.onreadystatechange = function() {
                        if(xhr.readyState === 4) {
                            if(xhr.status === 200) {
                                // Réservation supprimée
                                window.location.href = window.location.href;
                            }
                        }
                    };

                    xhr.send("idReservASuppr=" + btnSupprId);
                    
                });
                
            });

            // ---- FIN SUPPRESSION DES RÉSERVATIONS ---- //

        </script>

    </body>
</html>