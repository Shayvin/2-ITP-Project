<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function BinaryToYesNo($Bin){
    if($Bin==1)
    return 'Ja';
    else
    return 'Nein';
  }
//usereditierungscode
if(isset($_POST['edituser'])){ 
  if ($_POST["password"] === $_POST["password_confirmation"]) {
    require("./config/dbaccess.php");
    if(!empty($_POST['username'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET username= :username
                      WHERE id= :id");
      $sql->bindParam(":username", $_POST["username"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['vorname'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET vorname= :vorname
                      WHERE id= :id");
      $sql->bindParam(":vorname", $_POST["vorname"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['nachname'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET nachname= :nachname
                      WHERE id= :id");
      $sql->bindParam(":nachname", $_POST["nachname"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (isset($_POST['status'])) {
      $status = $_POST['status'] == '1' ? 1 : 0;
      $sql = $mysql->prepare("UPDATE accounts SET aktiv = :status WHERE id = :id");
      $sql->bindParam(":status", $status);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (isset($_POST['admin'])) {
      $sql = $mysql->prepare("UPDATE accounts SET ROLE = :admin WHERE id = :id");
      $sql->bindParam(":admin", $_POST['admin']);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['email'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET email= :email
                      WHERE id= :id");
      $sql->bindParam(":email", $_POST["email"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['adresse'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET adresse= :adresse
                      WHERE id= :id");
      $sql->bindParam(":adresse", $_POST["adresse"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['plz'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET plz= :plz
                      WHERE id= :id");
      $sql->bindParam(":plz", $_POST["plz"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['password'])){
      $sql = $mysql->prepare("UPDATE accounts
                      SET passwort= :password1
                      WHERE username= :id");
      $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
      $sql->bindParam(":password1", $_POST["password"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
  }
  else{
    echo '<div class="container"><h3 class="fehler">Passwörter stimmen nicht überein</h3></div>';
  }
}


if (isset($_SESSION['username'])){ //content nur für admin, aber derweil noch nicht implementiert, daher für user
require("./config/dbaccess.php");
$stmt = $mysql->prepare("SELECT * FROM accounts"); // Select Statement preparen
$stmt->execute(); // Wird ausgeführt

echo '
<div class="container">
<div class="table-responsive">
<h2 class="topmargin h3 mb-3 font-weight-normal">Alle User:</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Vorname</th>
      <th scope="col">Nachname</th>
      <th scope="col">Email</th>
      <th scope="col">Aktiv</th>
    </tr>
  </thead>';
$counter=-1;
while($row= $stmt->fetch()){
  ++$counter;
  $safedRow[$counter]=$row;}
//über for schleife gelöst, weil mysql_fetch_array zu öffnen, während anderes noch als die while schleifen bedingung läuft probleme macht

for($i=0; $i<=$counter; ++$i){//also der index $i ist jeweils ein Nutzer
  $row=$safedRow[$i];

    echo '
<tbody>
  <tr data-toggle="collapse" data-target="#accordion'.$i.'" class="clickable">
  <td>'.$row[6].'</td>
  <td>'.$row[0].'</td>
  <td>'.$row[1].'</td>
  <td>'.$row[4].'</td>
  <td>'.BinaryToYesNo($row[7]).'</td>
</tr>
<tr>
<td colspan="6">
    <div id="accordion'.$i.'" class="collapse">
    <div>
    </button>
  <div id="collapseExample">
      <div class="card card-body">
      <form role="form" action="" method="post">
  <div class="form-group row">
    <div class="form-group col-md-4">
      <label for="Username">Username</label>
      <input name="username" type="text" class="form-control" id="Username" placeholder="'.$row[6].'">
    </div>
    <div class="form-group col-md-4">
      <label for="Vorname">Vorname</label>
      <input name="vorname" type="text" class="form-control" id="Vorname" placeholder="'.$row[0].'">
    </div>
    <div class="form-group col-md-4">
      <label for="Nachname">Nachname</label>
      <input name="nachname" type="text" class="form-control" id="Nachname" placeholder="'.$row[1].'">
    </div>
  </div>

  <div class="form-group row">
  <div class="form-group col-md-1">
    <label for="Status">Aktiv</label>
    <select name="status" id="Status" class="form-control">
      <option value="none" selected disabled hidden>'.BinaryToYesNo($row[7]).'</option>
      <option value="1">Ja</option>
      <option value="0">Nein</option>
    </select>
  </div>
  <div class="form-group col-md-1">
  <label for="admin">Admin</label>
  <select name="admin" id="admin" class="form-control">
    <option value="none" selected disabled hidden>'.BinaryToYesNo($row[10]).'</option>
    <option value="1">Ja</option>
    <option value="0">Nein</option>
  </select>
</div>
  <div class="form-group col-md-10">
    <label for="Email">E-mail Addresse</label>
    <input name="email" type="email" class="form-control" id="Email" placeholder="'.$row[4].'">
  </div>
  </div>

  <div class="form-group row">
    <div class="form-group col-md-9">
      <label for="Adresse">Adresse</label>
      <input name="adresse" type="text" class="form-control" id="Adresse" placeholder="'.$row[2].'">
    </div>
    <div class="form-group col-md-3">
      <label for="PLZ">PLZ</label>
      <input name="plz" type="text" class="form-control" id="PLZ" placeholder="'.$row[3].'">
    </div>
  </div>

  <div class="form-group row">
  <div class="form-group col-md-6">
    <label for="Passwort">Passwort</label>
    <input name="password" type="password" class="form-control" id="Passwort" >
  </div>
  <div class="form-group col-md-6">
    <label for="Passwort_Bestätigung">Passwort bestätigen</label>
    <input name="password_confirmation" type="password" class="form-control" id="Passwort_Bestätigung" >
  </div>
</div>
<input type="hidden" name="id" value="'.$row[8].'" >
  <button name="edituser" type="submit" class="btn btn-primary">Editieren</button>
</form>
      </div>
  </div>
</div>
<div>';

}
//Ende vom Usertable
echo '
</tbody>
</table>
</div>';
  }
?>