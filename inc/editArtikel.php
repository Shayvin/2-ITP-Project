<?php //zuerst alle Produktinformation aus der DB holen um sie als Defaultwert in das Formular zu schreiben
error_reporting(E_ALL);
  ini_set('display_errors', 1);
    $id = $_GET['id'];
    require("./config/dbaccess.php");
      $sql = "SELECT * FROM produkte WHERE ID = :id";
      $stmt = $mysql->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      $row = $stmt->fetch();
?>

<div class="container-fluid">
<form role="form" action="" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <div class="form-group col-md-8">
      <label for="Produktname">Produktname</label>
      <input name="Produktname" type="text" class="form-control" id="name" value="<?php echo $row[0]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="Kategorie">Kategorie</label>
      <input name="Kategorie" type="text" class="form-control" id="Kategorie" value=<?php echo $row[8]?>>
    </div>
   </div>
   <div class="form-group row">
    <div class="form-group col-md-2">
      <label for="Artikelnummer">Artikelnummer</label>
      <input name="Artikelnummer" type="number" class="form-control" id="Artikelnummer" value="<?php echo $row[2]?>">
    </div>
    <div class="form-group col-md-2">
      <label for="Bestand">Bestand</label>
      <input name="Bestand" type="number" class="form-control" id="Bestand" value=<?php echo $row[5]?>>
    </div>
    <div class="form-group col-md-2">
      <label for="Preis">Preis</label>
      <input name="Preis" type="number" class="form-control" id="Preis" value=<?php echo $row[3]?>>
    </div>
    <div class="form-group col-md-6">
      <label for="Marke">Marke</label>
      <input name="Marke" type="text" class="form-control" id="Marke" value=<?php echo $row[7]?>>
    </div> 
  </div>
  <div class="form-group row">
    <div class="form-outline">   
    <label class="form-label" for="beschreibung">Beschreibung</label>
    <textarea rows="3" class="form-control" name="beschreibung" id="beschreibung"><?php echo $row[4]?></textarea>
  </div>
</div>
<div class="form-group row">  
    <label class="form-label" for="image">neues Bild</label>
    <input type="file" name="image" id="image">
</div>
<input type="hidden" name="id" value="<?php echo $row[6] ?>" >
  <button name="editarticle" type="submit" class="btn btn-primary">Editieren</button>
</form>
<form role="form" action="" method="post">
<input type="hidden" name="id" value="<?php echo $row[6] ?>" >
<button name="DELarticle" type="submit" class="btn btn-danger">Artikel zur Gänze löschen</button>
</form>
</div>


<?php
if(isset($_POST['DELarticle'])){
//zuerst die zugehörigen bilder auf dem server finden und löschen (unlink)
$stmt = $mysql->prepare("SELECT image
      FROM produkte
      WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$row = $stmt->fetch();
$image = "./res/img/Artikelbilder/".$row[0];
$editimage = "./res/img/Artikelbilder/edit_".$row[0];
if(file_exists($image)){
  unlink($image);
}
if(file_exists($editimage)){
  unlink($editimage);
}

//dann aus db löschen
$sql = $mysql->prepare("DELETE FROM produkte
                          WHERE id= :id");
$sql->bindParam(":id", $_POST["id"]);
$sql->execute();
}

if(isset($_POST['editarticle'])){
    //falls man editen will, wird jedes Feld auf Änderungen überprüft und je nachdem geändert
    //um versehentlichem löschen vorzubeugen, kann man dabei nicht einfach ein Feld zur Gänze entfernen (!empty checks)
    if(!empty($_POST['name'])){ 
      $sql = $mysql->prepare("UPDATE produkte
                      SET name= :Pname
                      WHERE id= :id");
      $sql->bindParam(":Pname", $_POST["name"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
      //Die Bilder erstmal vom server löschen
      $stmt = $mysql->prepare("SELECT image
      FROM produkte
      WHERE id = :id");
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      $row = $stmt->fetch();
      $image = "./res/img/Artikelbilder/".$row[0];
      $editimage = "./res/img/Artikelbilder/edit_".$row[0];
      if(file_exists($image)){
        unlink($image);
      }
      if(file_exists($editimage)){
        unlink($editimage);
      }
      //Bild speichern und namen bestimmen, was um einiges komplizierter bei png ist
      $image = $_FILES["image"];
      $fileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
      if ($fileType === 'png') {
          // Neuen Dateinamen generieren
          $imagename = pathinfo($image['name'], PATHINFO_FILENAME).'.jpg';
          // Konvertieren und speichern der PNG-Datei als JPG
          $JPGimage = imagecreatefrompng($image['tmp_name']);
          $imagepath = "./res/img/Artikelbilder/".$imagename;
          imagejpeg($JPGimage, $imagepath, 100);
          imagedestroy($JPGimage);
      }
      else{ //fall jpg
      $imagename= $image["name"];
      $imagepath = "./res/img/Artikelbilder/".$image["name"];
      move_uploaded_file($image['tmp_name'], $imagepath);
      }
      //Neue addresse in db
      $sql = $mysql->prepare("UPDATE produkte
                      SET image= :image
                      WHERE id= :id");
      $sql->bindParam(":image", $imagename);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['Kategorie'])){
      $sql = $mysql->prepare("UPDATE produkte
                      SET Kategorie= :Kategorie
                      WHERE id= :id");
      $sql->bindParam(":Kategorie", $_POST["Kategorie"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if(!empty($_POST['Artikelnummer'])){
      $sql = $mysql->prepare("UPDATE produkte
                      SET Artnr= :Artikelnummer
                      WHERE id= :id");
      $sql->bindParam(":Artikelnummer", $_POST["Artikelnummer"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (!empty($_POST['Preis'])) {
      $sql = $mysql->prepare("UPDATE produkte
                              SET brutto = :Preis
                              WHERE id = :id");
      $sql->bindParam(":Preis", $_POST["Preis"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (!empty($_POST['beschreibung'])) {
      $sql = $mysql->prepare("UPDATE produkte
                              SET beschreibung = :beschreibung
                              WHERE id = :id");
      $sql->bindParam(":beschreibung", $_POST["beschreibung"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (!empty($_POST['Marke'])) {
      $sql = $mysql->prepare("UPDATE produkte
                              SET Marke = :Marke
                              WHERE id = :id");
      $sql->bindParam(":Marke", $_POST["Marke"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
    if (!empty($_POST['Bestand'])) {
      $sql = $mysql->prepare("UPDATE produkte
                              SET Bestand = :Bestand
                              WHERE id = :id");
      $sql->bindParam(":Bestand", $_POST["Bestand"]);
      $sql->bindParam(":id", $_POST["id"]);
      $sql->execute();
    }
}
?>