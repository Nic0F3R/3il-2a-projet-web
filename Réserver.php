<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gîte Figuiès</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.css">
</head>
<body>

<header>
    <img src="images/logo.png" class="logo" />
    <h1>Gîte Figuiès</h1>
</header>

<nav>
    <ul>
        <li><a href="" class="lien">Réserver</a></li>
        <li><a href="" class="lien">Contact</a></li>
        <li><a href="" class="lien">index</a></li>
    </ul>
</nav>

<main>
    <div class="titre">
        <h2>Réserver</h2>
        </div>


    <div id='calendar'></div>
        
    
</main>

<footer>
    <p class="copyright">&copy; 2023 - Gîte Figuiès - Tous droits réservés - Mentions légales</p>
    <p><a href="" class="lien">Administration</a></p>
</footer>

<script src="https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth'
  });
  calendar.render();
});
</script>

</body>
</html>
