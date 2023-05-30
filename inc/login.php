<main class="form-signin w-100 m-auto">
  <form method="post">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="username" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password1" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <button id="button-submit" class="btn btn-primary btn-lg" name="submit" type="submit">Login</button>
  </form>
</main>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if(isset($_POST["submit"])) // Checkt ob submit geklickt wurde.
    {
      require("./config/dbaccess.php"); // Datenbankverbindung
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); // Select Statement preparen
      $stmt->bindParam(":user", $_POST["username"]); // Binded POSt an die lokale Variable
      $stmt->execute(); // Wird ausgeführt
      $count = $stmt->rowCount(); // Zählt die Rows die vom letzten Statement zurückgegeben werden. In dem Fall 1 weil 1 User
      
      if($count == 1) // Wenn der count gleich 1 ist
      {
        $row = $stmt->fetch(); // Geht in die Zeile vom Username
        if($row["AKTIV"] == 1) // Wenn der User aktiv ist, fahre fort.
        {
          if(password_verify($_POST["password1"], $row["PASSWORT"])) // Vergleicht den im Formular eingegebenen Wert mit dem in der Datenbank
          {
            session_start(); // Session start
            $_SESSION["username"] = $row["USERNAME"]; // Setzt die Session Variable gleich den Username aus der DB
            $url = "index.php?site=home"; // Variable die noch "profil.php?id=%USERNAME%" an die URL ranhängt
            header("Location: $url"); // Weiterleitung an url
          }
          else
          {
            echo '<p class="alert">Der Login ist fehlgeschlagen</p>';
          }
        }
        else {
          echo '<p class="alert">User ist gesperrt</p>';
        }
      }
      else 
      {
        echo '<p class="alert">Der Login ist fehlgeschlagen</p>';
      }
    }
     ?>
