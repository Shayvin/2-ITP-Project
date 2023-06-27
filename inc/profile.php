<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  if(isset($_SESSION["username"])){ //nur für eingeloggte user verfügbar 
        require("./config/dbaccess.php"); // DB Connector eingebunden
        if(isset($_POST["submit"])) // Wenn submit gedrückt wurde, um Accountdaten zu ändern
        {
            $stmt = $mysql->prepare("UPDATE accounts SET VORNAME = :firstname, NACHNAME = :lastname, ADRESSE = :adresse, PLZ = :plz, EMAIL = :email WHERE USERNAME = :id"); // Prepare SQL Statement
            $stmt->execute(array(":firstname" => $_POST["firstname"], ":lastname" => $_POST["lastname"], ":adresse" => $_POST["adresse"], ":plz" => $_POST["plz"], ":email" => $_POST["email"], ":id" => $_SESSION["username"])); // Setze lokale Variablen gleich der POST/GET und führe aus
            
            echo '<p class="alert">Das Profil wurde aktualisiert</p>';
        }
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :id"); // Check Username
        $stmt->execute(array(":id" => $_SESSION["username"])); // Setze SESSION gleich mit lokaler Variable und führe aus
        $row = $stmt->fetch(); // Nimmt die nächste Reihe vom ergebnis vorhin

        $count = $stmt->rowCount(); // Zählt die Rows die vom letzten Statement zurückgegeben werden. In dem Fall 1 weil 1 User
        if($count != 0) // Wenn ungleich 0
        {
            if(isset($_POST["changepw"])) // Wenn changepw button gedrückt
            {
                if($_POST["password1"] == $_POST["password2"]) // Kontrolliert ob eingegebene Passwörter übereinstimmen
                {
                    $hash = password_hash($_POST["password1"], PASSWORD_BCRYPT); // Hashed das eingegebene Passwort (Feld1) und speichert es in eine variable
                    $stmt = $mysql->prepare("UPDATE accounts SET PASSWORT = :password1 WHERE USERNAME = :id"); // Updated den Eintrag in der Datenbank beim User
                    $stmt->bindParam(":password1", $hash); // Binded den hashed Wert
                    $stmt->bindParam(":id", $_SESSION["username"]); // Bindet SESSION mit variable
                    $stmt->execute(); // execute
                    echo '<p class="alert">Das Passwort wurde geändert</p>';
                } 
                else
                {
                  echo '<p class="alert">Die angegebenen Passwörter stimmen nicht überein</p>';
                }
            }
        }
        if(isset($_POST["bildch"]))
        {
          if(isset($_FILES["picture"]))
          {
          $filename = $_SESSION["username"] . ".jpg";
          $file_type = $_FILES["picture"]["type"];
          $allowed = array("image/jpeg", "image/gif", "image/png");
          if(!in_array($file_type, $allowed))
          {
              echo 'Nur jpg, gif und png sind erlaubt.';
              exit();
          }
          move_uploaded_file($_FILES["picture"]["tmp_name"], "./res/img/user/" . $filename);
          require("./config/dbaccess.php");
          $stmt = $mysql->prepare("UPDATE accounts SET IMAGE = :image WHERE USERNAME = :user");
          $stmt->execute(array(":image" => $filename, ":user" => $_SESSION["username"]));
          }
        }
  }
?>

<main class="form-signin w-100 m-auto">
  <form enctype="multipart/form-data" method="post">
    <h1 class="h3 mb-3 fw-normal">Profil</h1>
    <div class="form-floating">
      <input type="text" class="form-control" name="firstname" value="<?php echo $row["VORNAME"] ?>" id="firstname" placeholder="John">
      <label for="firstName">Vorname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="lastname" value="<?php echo $row["NACHNAME"] ?>" id="lastname" placeholder="Doe">
      <label for="lastName">Nachname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="adresse" value="<?php echo $row["ADRESSE"] ?>" id="adresse" placeholder="name@example.com">
      <label for="adresse">Adresse</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="plz" value="<?php echo $row["PLZ"] ?>" id="plz" placeholder="name@example.com">
      <label for="plz">PLZ</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" value="<?php echo $row["EMAIL"] ?>" id="email" placeholder="name@example.com">
      <label for="email">Email-Adresse</label>
    </div>
    <div class="col-auto button">
    <button id="button-submit" class="btn btn-primary btn-lg" name="submit" type="submit">Speichern</button>
    </div>
    </form>

    <form method="post">
    <h1 class="h3 mb-3 fw-normal">Passwort</h1>
    <div class="form-floating">
      <input type="password" class="form-control" name="password1" id="password1" placeholder="Password">
      <label for="password1">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="password2" id="password2" placeholder="Password">
      <label for="password2">Password wiederholen</label>
    </div>
    <div class="col-auto button">
    <button id="button-submit" class="btn btn-primary btn-lg" name="changepw" type="submit">Ändern</button>
    </div>
    </form>

    <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="formFile" class="form-label">Profilbild bearbeiten</label>
      <input class="form-control" name="picture" type="file" id="formFile" accept="image/jpeg, image/png, image/gif">
    </div>
    <div class="col-auto button">
    <button id="button-submit" class="btn btn-primary btn-lg" name="bildch" type="submit">Speichern</button>
    </div>
    </form>
</main>
