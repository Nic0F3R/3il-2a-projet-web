<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SESSION['isAdmin']) {
    header('Location:index.php');
}

include "db/config.php";

$erreur = "";
$msgOK = "";

if(isset($_POST['submit'])) {

    $msgOK = "";

    if(!empty($_POST['nom']) && strlen($_POST['nom']) < 50) {

        if(!empty($_POST['prenom']) && strlen($_POST['prenom']) < 50) {

            if(!empty($_POST['email']) && strlen($_POST['email']) < 100) {

                if(!empty($_POST['telephone']) && strlen($_POST['telephone']) >= 10 && strlen($_POST['telephone']) <= 14) {

                    if(!empty($_POST['date_debut']) && !empty($_POST['date_fin'])) {
    
                        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['date_debut']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['date_fin'])) {

                            $dateDebutTest = new DateTime(htmlspecialchars($_POST['date_debut']));
                            $dateFinTest = new DateTime(htmlspecialchars($_POST['date_fin']));
                            
                            $today = new DateTime();

                            if($dateDebutTest >= $today && $dateFinTest >= $today) {

                                if(strlen($_POST['message']) < 2000) {
            

                                    $nom = htmlspecialchars($_POST['nom']);
                                    $prenom = htmlspecialchars($_POST['prenom']);
                                    $email = htmlspecialchars($_POST['email']);
                                    $telephone = htmlspecialchars($_POST['telephone']);
                                    $dateDebut = htmlspecialchars($_POST['date_debut']);
                                    $dateFin = htmlspecialchars($_POST['date_fin']);
                                    $message = htmlspecialchars($_POST['message']);
            
                                    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

                                    try {

                                        $pdo = new PDO($dsn, $user, $password);
                    
                                        $req = "INSERT INTO Reservations (nom, prenom, email, telephone, date_debut, date_fin, message) VALUES (:nom, :prenom, :email, :telephone, :date_debut, :date_fin, :message);";
                        
                                        $res = $pdo->prepare($req);
            
                                        $res->bindParam(':nom', $nom);
                                        $res->bindParam(':prenom', $prenom);
                                        $res->bindParam(':email', $email);
                                        $res->bindParam(':telephone', $telephone);
                                        $res->bindParam(':date_debut', $dateDebut);
                                        $res->bindParam(':date_fin', $dateFin);
                                        $res->bindParam(':message', $message);

                                        $res->execute();

                                        $msgOK = "Votre demande de réservation a été envoyée. Vous recevrez une acceptation ou refus par mail et/ou téléphone";
                        
                                    } catch (PDOException $e) {
                                        $erreur = "Erreur lors de l'envoi du message";
                                    }

                                } else {
                                    $erreur = "Le message est trop long (> 2000 caractères)";
                                }

                            } else {
                                $erreur = "Les dates saisies doivent ne doivent pas être dans le passé";
                            }

                        } else {
                            $erreur = "Les dates de réservations doivent être cohérentes ";
                        }
    
                    } else {
                        $erreur = "Les dates de début et de fin de résevration sont obligatoires";
                    }
    
                } else {
                    $erreur = "Le numéro de téléphone est obligatoire";
                }

            } else {
                $erreur = "L'adresse E-Mail est obligatoire";
            }

        } else {
            $erreur = "Le prénom est obligatoire";
        }

    } else {
        $erreur = "Le nom est obligatoire";
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Gîte Figuiès - Réservation</title>
        <meta charset="UTF-8" />

        <meta name="description" content="Gîte Figuiès - Calendrier et Formulaire de Réservation" />
		<meta name="keywords" content="Figuiès, Figuies, gîte, gite, maison, location, réserver, réservation, Aveyron, Salle-la-Source"/>
		<meta name="author" content="Gîte Figuiès" />
		<meta name="copyright" content="Gîte Figuiès" />

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

                <h2>Calendrier des disponibilités</h2>

                <p>
                    Pour les utilisateurs utilisant un <strong>ordinateur</strong>, cliquez sur la case correspondant à la date de début de réservation, puis <strong>déplacez le curseur</strong> en <strong>maintenant le clic</strong> de la souris jusqu'à la date de fin de réservation. <em>La durée sélectionnée sera en surbrillance.</em><br /><br />
                    Pour les utilisateurs utilisant un <strong>téléphone mobile</strong>, touchez la case correspondant à la première date et <strong>maintenez votre doigt</strong> pendant <strong>quelques secondes</strong>, et déplacez votre doigt vers la date de fin. <em>La durée sélectionnée sera en surbrillance.</em><br /><br />
                    
                    Le <strong>formulaire</strong> de réservation est <strong>en bas</strong> de la page.<br /><br />
                    
                    <div id='calendar'></div>
                </p>

                <br /><hr />

                <h2>Formulaire de réservation</h2>

                <p>

                    <form action="reserver.php#formulaire" method="POST" id="formulaire">
                        <label for="nom">Nom :</label><br />
                        <input type="text" name="nom"><br /><br />

                        <label for="prenom">Prénom :</label><br />
                        <input type="text" name="prenom"><br /><br />

                        <label for="email">E-Mail :</label><br />
                        <input type="text" name="email"><br /><br />

                        <label for="telephone">Téléphone :</label><br />
                        <input type="text" name="telephone"><br /><br />

                        <label for="date_debut">Date de début de réservation (à sélectionner sur le calendrier) :</label><br />
                        <input type="text" id="date_debut" name="date_debut" readonly><br /><br />

                        <label for="date_fin">Date de fin de réservation (à sélectionner sur le calendrier) :</label><br />
                        <input type="text" id="date_fin" name="date_fin" readonly><br /><br />

                        <label for="message">Message (facultatif) :</label><br />
                        <textarea name="message" rows="10" cols="50"></textarea><br /><br />
                        
                        <input type="submit" name="submit" value="Envoyer"><br /><br />
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


        </script>

    </body>
</html>