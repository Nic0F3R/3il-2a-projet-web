<?php

try {
    if(empty($_SESSION['isAdmin'])) {
        $_SESSION['isAdmin'] = false;
    }
} catch(Exception $e) {
    session_start();
}

?>

<nav>

    <ul>
        <li><a href="index.php" class="lienMenu">Accueil</a></li>

        <?php
            if($_SESSION['isAdmin'] != true) {
                echo '<li><a href="reserver.php" class="lienMenu">Réserver</a></li>';
                echo '<li><a href="contact.php" class="lienMenu">Contact</a></li>';
            }

            if($_SESSION['isAdmin']) {
                echo '<li><a href="photos.php" class="lienMenu">Photos</a></li>';
                echo '<li><a href="reservations.php" class="lienMenu">Réservations</a></li>';
                echo '<li><a href="messagerie.php" class="lienMenu">Messagerie</a></li>';
                echo '<li><a href="deconnexion.php" class="lienMenu"><font color="#FFCCCB">Déconnexion</font></a></li>';
            }
        ?>
    </ul>

    <button class="menu-toggle">☰</button>

</nav>