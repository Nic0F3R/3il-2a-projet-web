<?php
session_start();
?>
<nav>

    <ul>
        <li><a href="index.php" class="lienMenu">Accueil</a></li>

        <?php
            if(!($_SESSION['isAdmin'])) {
                echo '<li><a href="" class="lienMenu">Réserver</a></li>';
                echo '<li><a href="contact.php" class="lienMenu">Contact</a></li>';
            }
            
            if($_SESSION['isAdmin']) {
                echo "<li><a href='deconnexion.php' class='lienMenu'>Déconnexion</a></li>";
            }
        ?>
    </ul>

    <button class="menu-toggle">☰</button>

</nav>