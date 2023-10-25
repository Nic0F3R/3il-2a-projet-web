<?php

include "db/config.php";
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

if(!empty($_POST['idReservASuppr'])) {

    $idReservASuppr = htmlentities(htmlspecialchars($_POST['idReservASuppr']));

    $pdo = new PDO($dsn, $user, $password);
    $req = "DELETE FROM Reservations WHERE id=:idReserv";

    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':idReserv', $idReservASuppr, PDO::PARAM_INT);
    $stmt->execute();
    
    $rowCount = $stmt->rowCount();

    if($rowCount > 0) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }

    header('Location:reservations.php');
    
}

?>