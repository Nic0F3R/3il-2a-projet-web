<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db/config.php";
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

if(!empty($_POST['idReservAAccepter'])) {

    $idReservAAccepter = htmlentities(htmlspecialchars($_POST['idReservAAccepter']));

    $pdo = new PDO($dsn, $user, $password);

    $req = "SELECT * FROM Reservations WHERE id=:idReservAAccepter;";

    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':idReservAAccepter', $idReservAAccepter, PDO::PARAM_INT);
    $stmt->execute();

    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($res) > 0) {

        $i = 0;

        foreach($res as $row) {

            if($i == 0) {

                $req2 = "INSERT INTO ReservationsAcceptees (nom, prenom, email, telephone, date_debut, date_fin, message) VALUES (:nom, :prenom, :email, :telephone, :date_debut, :date_fin, :message);";

                $stmt = $pdo->prepare($req2);

                $stmt->bindParam(':nom', $row['nom']);
                $stmt->bindParam(':prenom', $row['prenom']);
                $stmt->bindParam(':email', $row['email']);
                $stmt->bindParam(':telephone', $row['telephone']);
                $stmt->bindParam(':date_debut', $row['date_debut']);
                $stmt->bindParam(':date_fin', $row['date_fin']);
                $stmt->bindParam(':message', $row['message']);
                
                $stmt->execute();

                $req3 = "DELETE FROM Reservations WHERE id=:idReserv";

                $stmt = $pdo->prepare($req3);
                $stmt->bindParam(':idReserv', $row['id'], PDO::PARAM_INT);
                $stmt->execute();

                $rowCount = $stmt->rowCount();

                if($rowCount > 0) {
                    http_response_code(200);
                } else {
                    http_response_code(404);
                }

                $i++;
            }
    
        }

    } else {
        http_response_code(404);
    }

    header('Location:reservations.php');
    
}

?>