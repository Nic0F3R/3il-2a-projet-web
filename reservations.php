<?php

session_start();

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

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
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
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

                    <div id='calendar'></div>

                </p>

                <hr />
                <br />

                <h3>Réservations en cours</h3>

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
                                            <button type="button" class="btn-accepter-reserv" id="' . $row['id'] . '">✓</button>
                                        </div>
                                        <div style="width: 600px">
                                            <hr />
                                        </div>
                                        <br />';
                            
                                }

                            } else {
                                echo "Aucune réservation à afficher";
                            }

                        } catch(PDOException $e) {
                            echo "<strong><font color='red'>Erreur lors de la réception des messages</font></strong>";
                        }

                    ?>

                </p>

                <br /><hr />

                <h3>Réservations acceptées (actuelles ou à venir)</h3>

                <p>

                    <?php

                        try {

                            $pdo = new PDO($dsn, $user, $password);
                            $req1 = "SELECT * FROM ReservationsAcceptees WHERE date_debut >= CURDATE() ORDER BY id DESC;";

                            $stmt = $pdo->prepare($req1);
                            $stmt->execute();

                            $res1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if(count($res1) > 0) {

                                foreach($res1 as $row) {

                                    echo '
                                            <div class="reserv" id="' . $row['id'] . '">
                                                <strong>De :</strong> ' . $row['nom'] . ' ' . $row['prenom'] . ' - ' . $row['email'] . ' - ' . $row['telephone'] . '<br /><br /><strong>Du </strong>' . $row['date_debut'] . ' <strong>au</strong> ' . $row['date_fin'] .
                                            '</div>
                                        
                                        <div style="width: 600px">
                                            <hr />
                                        </div>
                                        <br />';
                            
                                }

                            } else {
                                echo "Aucune réservation à afficher";
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


            // ---- GESTION CALENDRIER ---- //
            document.addEventListener('DOMContentLoaded', function() {
                
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'fr',
                    events: 'getIntervallesDates.php',
                    selectable: true,
                    select: function(info) {

                        var date_debut = info.startStr;
                        var date_fin = info.endStr;

                        var date_finDate = new Date(date_fin);

                        date_finDate.setDate(date_finDate.getDate() - 1);

                        // Obtenez la nouvelle date sous forme de chaîne de caractères au format ISO (AAAA-MM-JJ)
                        date_fin = date_finDate.toISOString().split('T')[0];

                        if (date_debut && date_fin) {
                            document.getElementById('date_debut').value = date_debut;
                            document.getElementById('date_fin').value = date_fin;
                        }

                    }
                });

                calendar.render();

            });
            // ---- FIN GESTION CALENDRIER ---- //


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

            // ---- ACCEPTATION DES RÉSERVATIONS ---- //
            var btnaccepterClass = document.querySelectorAll('.btn-accepter-reserv');
            
            btnaccepterClass.forEach(function(bouton) {

                bouton.addEventListener('click', function() {

                    var btnAccepterId = bouton.id;
                
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "accepterReserv.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    
                    xhr.onreadystatechange = function() {
                        if(xhr.readyState === 4) {
                            if(xhr.status === 200) {
                                // Réservation acceptée
                                window.location.href = window.location.href;
                            }
                        }
                    };

                    xhr.send("idReservAAccepter=" + btnAccepterId);
                    
                });
                
            });
            // ---- FIN ACCEPTATION DES RÉSERVATIONS ---- //

        </script>

    </body>
</html>