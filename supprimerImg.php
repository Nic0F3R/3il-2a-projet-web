<?php

if(!empty($_POST['idImgASuppr'])) {

    $idImgASuppr = htmlentities(htmlspecialchars($_POST['idImgASuppr']));

    $dossier_destination = 'images/carrousel/';
    $chemin_fichier = $dossier_destination . $idImgASuppr;

    if(file_exists($chemin_fichier)) {
        unlink($chemin_fichier);
        http_response_code(200);
    } else {
        http_response_code(404);
    }

    header('Location:photos.php');

}

?>