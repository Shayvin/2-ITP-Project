<main class="form-signin w-100 m-auto">
  <form method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Profil</h1>
    <div class="form-floating">
      <input type="text" class="form-control" name="username" id="username" placeholder="John">
      <label for="username">Nutzername</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="John">
      <label for="firstName">Vorname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="lastname" name="lastname" placeholder="Doe">
      <label for="lastName">Nachname</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="adresse" id="adresse" placeholder="name@example.com">
      <label for="adresse">Adresse</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="plz" id="plz" placeholder="name@example.com">
      <label for="plz">PLZ</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
      <label for="email">Email-Adresse</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password1" id="password1" placeholder="Password">
      <label for="password1">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="password2" id="password2" placeholder="Password">
      <label for="password2">Password wiederholen</label>
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Profilbild bearbeiten</label>
      <input class="form-control" name="picture" type="file" id="formFile" accept="image/jpeg, image/png, image/gif">
    </div>
    <div class="col-auto button">
    <button id="button-submit" class="btn btn-primary btn-lg" name="submit" type="submit">Speichern</button>
    </div>
    </form>
</main>
<?php
  // TODO: GET => fill form with data loaded from database
  // TODO: POST => update databasse with form data
  error_reporting(E_ALL);
ini_set('display_errors', 1);
  if(isset($_POST["submit"]))
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
    ?>