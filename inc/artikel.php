<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
    $id = $_GET['id'];

    require("./config/dbaccess.php");
      

      $sql = "SELECT * FROM produkte WHERE ID = :id";
    
    //echo $sort_type;
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(":id", $id);
    //$stmt->bindParam(":sort_type", $sort_type);
    $stmt->execute();
    $row = $stmt->fetch();

    $image_path = "./res/img/Artikelbilder/" . $row["IMAGE"];
    $kategorie = $row["KATEGORIE"];
 ?>   
<div class="container mt-5">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?site=shop">Shop</a></li>
    <li class="breadcrumb-item"><a href="index.php?site=shop">Kategorie</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="index.php?site=products&kategorie=<?php echo $kategorie ?>"><?php echo $row["KATEGORIE"] ?></a></li>
  </ol>
</nav>
  <div class="row">
    <div class="col-sm d-flex justify-content-center">
      <img src="<?php echo $image_path ?>" class="align-self-center img-fluid" style="max-height:300px" alt="...">
    </div>
  <div class="col">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h3> <?php echo $row["NAME"] ?></h3>
      <p>Marke: <?php echo $row["MARKE"] ?></p>
      <p>Artikelnr.: <?php echo $row["ARTNR"] ?></p>
      </div>
      <hr>
      <h3>Preis: <?php echo $row["BRUTTO"] ?> €</h3>
      <p> <?php echo $row["BESCHREIBUNG"] ?></p>      
      <a class="btn btn-primary btn-lg" position="absolute">In den Einkaufswagen</a>
      <a href="#" class="btn btn-secondary btn-lg disabled" role="button" aria-disabled="true">Lagerstand: <?php echo $row["BESTAND"] ?></a>
    </div>
  </div>
</div>