<?php

include "db/config.php";
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

$intervalles = array();

try {

    $pdo = new PDO($dsn, $user, $password);
    $req1 = "SELECT date_debut, date_fin FROM ReservationsAcceptees;";

    $stmt = $pdo->prepare($req1);
    $stmt->execute();

    $res1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($res1) > 0) {

        foreach($res1 as $row) {

            $intervalles[] = array(
                'title' => 'Réservation',
                'start' => $row['date_debut'],
                'end' => $row['date_fin']
            );
    
        }

    }
    
    // Retourner les intervalles de dates au format JSON
    echo json_encode($intervalles);

} catch(PDOException $e) {
    echo "<strong><font color='red'>Erreur lors de la réception des messages</font></strong>";
}

?>