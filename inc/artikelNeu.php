<div class="container-fluid">
<form role="form" action="" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <div class="form-group col-md-8">
      <label for="Produktname">Produktname</label>
      <input name="Produktname" type="text" class="form-control" id="name" required>
    </div>
    <div class="form-group col-md-4">
      <label for="Kategorie">Kategorie</label>
      <input name="Kategorie" type="text" class="form-control" id="Kategorie" required>
    </div>
   </div>
   <div class="form-group row">
    <div class="form-group col-md-2">
      <label for="Artikelnummer">Artikelnummer</label>
      <input name="Artikelnummer" type="number" class="form-control" id="Artikelnummer" required>
    </div>
    <div class="form-group col-md-2">
      <label for="Bestand">Bestand</label>
      <input name="Bestand" type="number" class="form-control" id="Bestand" required>
    </div>
    <div class="form-group col-md-2">
      <label for="Preis">Preis</label>
      <input name="Preis" type="number" class="form-control" id="Preis" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Marke">Marke</label>
      <input name="Marke" type="text" class="form-control" id="Marke" required>
    </div> 
  </div>
  <div class="form-group row">
    <div class="form-outline">   
      <label class="form-label" for="beschreibung">Beschreibung</label>
      <textarea rows="3" class="form-control" name="beschreibung" id="beschreibung" required></textarea>
    </div>
  </div>
  <div class="form-group row">  
      <label class="form-label" for="image">Bild</label>
      <input type="file" name="image" id="image" required>
  </div>
  <button name="newarticle" type="submit" class="btn btn-primary">Anlegen</button>
</form>
</div>


<?php
if(isset($_POST['newarticle'])){
  $image = $_FILES["image"];
  $fileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)); //findet heraus welche file endung
  if ($fileType === 'png') {
      // Neuen Dateinamen generieren
      $imagename = pathinfo($image['name'], PATHINFO_FILENAME).'.jpg';
      // Konvertieren und speichern der PNG-Datei als JPG
      $JPGimage = imagecreatefrompng($image['tmp_name']);
      $imagepath = "./res/img/Artikelbilder/".$imagename;
      imagejpeg($JPGimage, $imagepath, 100);
      imagedestroy($JPGimage);
  }
  else{ //sonst reicht simples abspeichern
    $imagename= $image["name"];
    $imagepath = "./res/img/Artikelbilder/".$image["name"];
    move_uploaded_file($image['tmp_name'], $imagepath);
  }
  //produkt in DB einfügen
  require("./config/dbaccess.php");
      $sql = $mysql->prepare("INSERT INTO `produkte` (`NAME`, `IMAGE`, `ARTNR`, `BRUTTO`, `BESCHREIBUNG`, `BESTAND`, `MARKE`, `KATEGORIE`)
                              VALUES (:Pname, :img, :Artnr, :preis, :descr, :bestand, :marke, :kategorie)");
      $sql->bindParam(":Pname", $_POST["Produktname"]);
      $sql->bindParam(":img", $imagename);
      $sql->bindParam(":Artnr", $_POST["Artikelnummer"]);
      $sql->bindParam(":preis", $_POST["Preis"]);
      $sql->bindParam(":descr", $_POST["beschreibung"]);
      $sql->bindParam(":bestand", $_POST["Bestand"]);
      $sql->bindParam(":marke", $_POST["Marke"]);
      $sql->bindParam(":kategorie", $_POST["Kategorie"]);
      $sql->execute();
    }
?>