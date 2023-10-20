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

                if(!empty($_POST['objet']) && strlen($_POST['objet']) < 100) {

                    if(!empty($_POST['message'])) {
    
                        if(strlen($_POST['message']) > 20  && strlen($_POST['message']) < 2000) {
    
                            $nom = htmlspecialchars($_POST['nom']);
                            $prenom = htmlspecialchars($_POST['prenom']);
                            $email = htmlspecialchars($_POST['email']);
                            $objet = htmlspecialchars($_POST['objet']);
                            $message = htmlspecialchars($_POST['message']);
    
                            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

                            try {

                                $pdo = new PDO($dsn, $user, $password);
                
                                $req = "INSERT INTO Message (nom, prenom, email, objet, message) VALUES (:nom, :prenom, :email, :objet, :message);";
                
                                $res = $pdo->prepare($req);
    
                                $res->bindParam(':nom', $nom);
                                $res->bindParam(':prenom', $prenom);
                                $res->bindParam(':email', $email);
                                $res->bindParam(':objet', $objet);
                                $res->bindParam(':message', $message);

                                $res->execute();

                                $msgOK = "Votre message a été envoyée. Vous recevrez une réponse par mail";
                
                            } catch (PDOException $e) {
                                $erreur = "Erreur lors de l'envoi du message";
                            }

                        } else {
                            $erreur = "Veuillez saisir un message cohérent";
                        }
    
                    } else {
                        $erreur = "Le contenu du message est obligatoire";
                    }
    
                } else {
                    $erreur = "L'objet du message est obligatoire";
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
                    <div id='calendar'></div>
                </p>

                <br /><hr />

                <h2>Formulaire de réservation</h2>

                <p>

                    <form action="" method="POST">
                        <label for="nom">Nom :</label><br />
                        <input type="text" name="nom"><br /><br />

                        <label for="prenom">Prénom :</label><br />
                        <input type="text" name="prenom"><br /><br />

                        <label for="email">E-Mail :</label><br />
                        <input type="text" name="email"><br /><br />

                        <!--<label for="objet">Objet :</label><br />
                        <input type="text" name="objet"><br /><br />

                        <label for="message">Message :</label><br />
                        <textarea name="message" rows="10" cols="50"></textarea><br /><br />
                        -->
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
                    selectable: true,
                    select: function(info) {
                        var date_debut = info.startStr;
                        var date_fin = info.endStr;

                        /*
                        if (date_debut && date_fin) {
                            // Envoyer les données au serveur via la Fetch API
                            fetch('enregistrer_date.php', {
                                method: 'POST',
                                body: JSON.stringify({ date_debut, date_fin }),
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.text())
                            .then(data => {
                                if (data === 'success') {
                                    // Actualisez le calendrier ou effectuez d'autres actions nécessaires.
                                    calendar.refetchEvents();
                                } else {
                                    alert('Erreur lors de l\'enregistrement.');
                                }
                            });
                        }*/
                    }
                });

                calendar.render();
            });


            // ---- FIN GESTION CALENDRIER ---- //


        </script>

    </body>
</html>