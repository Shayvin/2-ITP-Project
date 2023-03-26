<?php
  session_destroy(); // Löscht alle Daten die in der Session waren und killt sie
  //echo '<p class="alert">Der User ist ausgeloggt. Weiterleitung zur Startseite.</p>';
  header('Location: index.php?site=home'); // Weiterleitung an login.php
 ?>