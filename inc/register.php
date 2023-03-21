<main class="form-signin w-100 m-auto">
  <form method="post">
    <h1 class="h3 mb-3 fw-normal">Registrieren</h1>
    <div class="form-floating">
      <input type="text" class="form-control" name="username" placeholder="John">
      <label for="username">Nutzername</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="firstname" placeholder="John">
      <label for="firstName">Vorname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="lastname" placeholder="Doe">
      <label for="lastName">Nachname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="adresse" placeholder="name@example.com">
      <label for="adresse">Adresse</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="plz" placeholder="name@example.com">
      <label for="plz">PLZ</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
      <label for="email">Email-Adresse</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password1" placeholder="Password">
      <label for="password1">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password2" placeholder="Password">
      <label for="password2">Password wiederholen</label>
    </div>
    <div class="col-auto button">
    <button id="button-submit" class="btn btn-primary btn-lg" name="submit" type="submit">Registrieren</button>
    </div>
    </form>
</main>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if(isset($_POST["submit"]))
    {
      require("./config/dbaccess.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); // Select Statement preparen
      $stmt->bindParam(":user", $_POST["username"]); // Binded POST an die lokale Variable
      $stmt->execute(); // execute
      $useralreadyexists = $stmt->fetchColumn(); // Gibt ID aus der nächsten Zeile der Tabelle zurück
      if(!$useralreadyexists) // Wenn User nicht existiert
      {
        if($_POST["password1"] == $_POST["password2"]) // Vergleiche eingegebene Passwörter
        {
          $stmt = $mysql->prepare("INSERT INTO accounts (VORNAME, NACHNAME, ADRESSE, PLZ, EMAIL, PASSWORT, USERNAME) VALUES (:firstname, :lastname, :adresse, :plz, :email, :password1, :username)"); // Prepare insert Statement
          $stmt->bindParam(":username", $_POST["username"]);
          $stmt->bindParam(":firstname", $_POST["firstname"]); // Binded POST an die lokale Variable 
          $stmt->bindParam(":lastname", $_POST["lastname"]); // Binded POST an die lokale Variable 
          $stmt->bindParam(":email", $_POST["email"]); // Binded POST an die lokale Variable 
          $stmt->bindParam(":adresse", $_POST["adresse"]); // Binded POST an die lokale Variable
          $stmt->bindParam(":plz", $_POST["plz"]); // Binded POST an die lokale Variable 
          $hash = password_hash($_POST["password1"], PASSWORD_BCRYPT); // Hashed eingegebenes Passwort und speichert es in eine Variable
          $stmt->bindParam(":password1", $hash); // Binded POST an die lokale Variable 
          $stmt->execute(); // execute
          echo '<p class="alert">Dein Account wurde angelegt</p>';

        }
        else
        {
          echo '<p class="alert">Die Passwörter stimmen nicht überein</p>';
        }
      }
      else
      {
        echo '<p class="alert">Der Username ist bereits vergeben</p>';
      }
    }
    ?>