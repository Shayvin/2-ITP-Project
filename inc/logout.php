<?php
  session_destroy(); // Löscht alle Daten die in der Session waren und killt sie
  echo '<script type="text/javascript">
  window.location = "./index.php?site=home"
  </script>';
 ?>