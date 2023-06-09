<?php
$isvalid = true;
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

    //AB hier für die Sternbewertung

    if(isset($_POST["Bewerten"])){
        if(isset($_SESSION["userID"])){
        $isvalid = true;
        $rating = $_POST["rating"];
        $sqlcheck = "SELECT AVG(bewertung) from bewertungen where artikel_id = :id AND user_id= :user";
        $stmt = $mysql->prepare($sqlcheck);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":user", $_SESSION["userID"]);
        $stmt->execute();
        $Bewertung = $stmt->fetch();
        if($Bewertung[0] == NULL){
         $sqlnew = "INSERT INTO `bewertungen` (`user_id`, `artikel_id`, `bewertung`) VALUES (:user, :id, :sterne);";
         $stmt = $mysql->prepare($sqlnew);
         $stmt->bindParam(":id", $id);
         $stmt->bindParam(":user", $_SESSION["userID"]);
         $stmt->bindParam(":sterne", $rating);
         $stmt->execute();         
        }
        else{
          $sqlnew = "UPDATE `bewertungen` SET `bewertung`=:sterne WHERE user_id = :user and artikel_id = :id";
          $stmt = $mysql->prepare($sqlnew);
          $stmt->bindParam(":id", $id);
          $stmt->bindParam(":user", $_SESSION["userID"]);
          $stmt->bindParam(":sterne", $rating);
          $stmt->execute();    
        }
    }
    else{
      $isvalid = false;
    }
  }

  $sqlbewertung = "SELECT AVG(bewertung) FROM bewertungen WHERE artikel_id = :id";
  $stmtbewertung = $mysql->prepare($sqlbewertung);
  $stmtbewertung->bindParam(":id", $id);
  $stmtbewertung->execute();
  $Bewertung = $stmtbewertung->fetch();
  $Sternanzahl = 0;
  if ($Bewertung[0] != NULL){
  $Sternanzahl = round($Bewertung[0]);
  }
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
      <form action="" method="POST">
          <div class="rating">
            <input type="radio" id="star5" name="rating" value="5" <?php if($Sternanzahl == 5) echo "checked";?> />
            <label for="star5" title="5 Sterne">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4" <?php if($Sternanzahl == 4) echo "checked";?> />
            <label for="star4" title="4 Sterne">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3" <?php if($Sternanzahl == 3) echo "checked";?> />
            <label for="star3" title="3 Sterne">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2" <?php if($Sternanzahl == 2) echo "checked";?> />
            <label for="star2" title="2 Sterne">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1" <?php if($Sternanzahl == 1) echo "checked";?> />
            <label for="star1" title="1 Stern">&#9733;</label>
          </div>
          <input type="submit" value="Bewerten" name="Bewerten" class="btn btn-primary mb-3"/>
        </form>
        <?php if(!$isvalid) echo "<div class='alert alert-danger'>Loggen Sie sich ein um eine Bewertung abzugeben</div>";?>
        <a class="btn btn-primary" href="" onclick="copyLink()">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"/>
          </svg>
        Link kopieren
      </a>
      <a class="btn btn-primary" href="mailto:?subject= <?php echo urlencode($row["NAME"]) . "&body=" . "http://" . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
      </svg>
        Artikel teilen
      </a>
        <script>
          function copyLink(){
            navigator.clipboard.writeText(window.location.href);
          }
        </script>
    </div>
  </div>
</div>