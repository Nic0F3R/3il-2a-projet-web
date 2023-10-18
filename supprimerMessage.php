<?php

include "db/config.php";
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

if(!empty($_POST['idMessageASuppr'])) {

    $idMessageASuppr = htmlentities(htmlspecialchars($_POST['idMessageASuppr']));

    $pdo = new PDO($dsn, $user, $password);
    $req = "DELETE FROM Message WHERE id=:idMsg";

    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':idMsg', $idMessageASuppr, PDO::PARAM_INT);
    $stmt->execute();
    
    $rowCount = $stmt->rowCount();

    if($rowCount > 0) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }

    header('Location:messagerie.php');
    
}

?>