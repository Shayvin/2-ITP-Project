<?php 
  $kategorie = $_GET['kategorie'];
?>
<section class="container mt-5">
<div class="row">
  <div class="col">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php?site=shop">Shop</a></li>
      <li class="breadcrumb-item"><a href="index.php?site=shop">Kategorie</a></li>
    </ol>
    </nav>
  </div>
  <div class="col">
    <div class="d-flex justify-content-end">
    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
      Sortieren nach: 
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <!-- dropdown menu links -->
      <li><a class="dropdown-item" href="index.php?site=products&kategorie=<?php echo $kategorie ?>&kategorie_name=<?php echo $_GET['kategorie_name'];?>&sort=preis_asc">Preis aufsteigend</a></li>
      <li><a class="dropdown-item" href="index.php?site=products&kategorie=<?php echo $kategorie ?>&kategorie_name=<?php echo $_GET['kategorie_name'];?>&sort=preis_desc">Preis absteigend</a></li>
      <li><a class="dropdown-item" href="index.php?site=products&kategorie=<?php echo $kategorie ?>&kategorie_name=<?php echo $_GET['kategorie_name'];?>&sort=name_asc">Name aufsteigend</a></li>
      <li><a class="dropdown-item" href="index.php?site=products&kategorie=<?php echo $kategorie ?>&kategorie_name=<?php echo $_GET['kategorie_name'];?>&sort=name_desc">Name absteigend</a></li>
    </ul>
    </div>
    </div>
</div>
</div>

  <div class="row align-items-center justify-content-center">
    <h2><?php echo $_GET['kategorie_name'];?></h2>
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
    require("./config/dbaccess.php");
    
    
    if(isset($_GET['sort'])){
      $sort = $_GET['sort'];
    } else {
      $sort = "def";
    }
    

    if($sort == 'preis_asc'){
      
      $sql = "SELECT NAME, IMAGE, BRUTTO, ID FROM produkte WHERE KATEGORIE = :kategorie ORDER BY BRUTTO asc";
    } 
    elseif($sort == 'preis_desc'){
      
      $sql = "SELECT NAME, IMAGE, BRUTTO, ID FROM produkte WHERE KATEGORIE = :kategorie ORDER BY BRUTTO desc";
    }
    elseif($sort == 'name_desc'){
      
      $sql = "SELECT NAME, IMAGE, BRUTTO, ID FROM produkte WHERE KATEGORIE = :kategorie ORDER BY NAME desc";
    }
    else {
      
      $sql = "SELECT NAME, IMAGE, BRUTTO, ID FROM produkte WHERE KATEGORIE = :kategorie ORDER BY NAME asc";
    }
    //echo $sort_type;
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(":kategorie", $kategorie);
    //$stmt->bindParam(":sort_type", $sort_type);
    $stmt->execute();

    //herausfinden ob der user admin is und in isadmin speichern
    $isadmin = false;
    if (isset($_SESSION['username'])) {
    $sqladmin = $mysql->prepare("SELECT ROLE FROM accounts WHERE USERNAME = :username");
    $sqladmin->bindParam(":username", $_SESSION["username"]);
    $sqladmin->execute();
    $Arow = $sqladmin->fetch();
    $isadmin = $Arow["ROLE"];
    }

while ($row = $stmt->fetch()){
  $product_name = $row["NAME"];
  $product_price = $row["BRUTTO"];
    $image_path = "./res/img/Artikelbilder/" . $row["IMAGE"];
    $angepasstes_image = "./res/img/Artikelbilder/edit_" . $row["IMAGE"];
    $product_id = $row["ID"];
    // Pfad zum Originalbild
    $originalBild = $image_path;

    // Neues Bild erstellen
    $neuesBild = imagecreatetruecolor(150, 150);

    // Originalbild laden
    $original = imagecreatefromjpeg($originalBild);

    // Bildgröße ändern
    imagecopyresampled($neuesBild, $original, 0, 0, 0, 0, 150, 150, imagesx($original), imagesy($original));

  
    // Neues Bild speichern
    imagejpeg($neuesBild, $angepasstes_image);

    // Ressourcen freigeben
    imagedestroy($original);
    imagedestroy($neuesBild);
  ?>
  
  
    <div class="col">
      <div class="card" style="overflow:hidden">  <!-- style="width="200px"-->
        <img src="<?php echo $angepasstes_image ?>" class="align-self-center" alt="...">
        <div class="card-body">
        <?php echo $product_name;?>
        <hr>
        <p>Preis: <?php echo $product_price;?> Euro</p>
        </div>
        <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-center"> 
          <a href="index.php?site=artikel&id=<?php echo $product_id ?>" class="btn btn-primary btn-sm">Details</a>
          <a href="index.php?site=chart-add&pid=<?php echo $product_id ?>" class="btn btn-success btn-sm">In den Warenkorb</a>
        </div>
        <?php //für die Artikelverwaltung
        if($isadmin){?>
          <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-center"> 
          <a href="index.php?site=editArtikel&id=<?php echo $product_id ?>" class="btn btn-secondary btn-sm">Artikel bearbeiten</a>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php 
}
if($isadmin){
?>
<div class="col">
      <div class="card" style="overflow:hidden">  <!-- style="width="200px"-->
        <img src="./res/img/artikelNeu.png" class="align-self-center" alt="...">
        <div class="card-body">
        Neues Produkt
        </div>
        <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-center"> 
          <a href="index.php?site=artikelNeu" class="btn btn-primary btn-sm">Anlegen</a>
        </div>
      </div>
    </div>
  <?php } ?>



  </div>
</section>