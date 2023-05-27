<?php
require_once("./config/dbaccess.php"); // db access
if (isset($_SESSION["username"]) && isset($_GET["pid"])){
  $pid = $_GET["pid"];
  // Get user_id
  $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :name");
  $stmt->execute(array(":name" => $_SESSION["username"]));
  $row = $stmt->fetch();
  $user_id = $row["ID"];
  if ($user_id){
    // check if product is already in chart
    $stmt2 = $mysql->prepare("SELECT * FROM warenkorb WHERE user_id = :uid AND artikel_id = :pid");
    $stmt2->execute(array(":uid" => $user_id, ":pid" => $pid));
    $row = $stmt2->fetch();
    if ($stmt2->rowCount() < 1){
      // if product not in chart, add product to 
      $stmt3 = $mysql->prepare("INSERT INTO warenkorb (user_id, artikel_id, menge) VALUES (:uid, :pid, 1);");
      $stmt3->execute(array(":uid" => $user_id, ":pid" => $pid));
    }
  }
}
  // redirect to chart
  echo '<script type="text/javascript">
  window.location = "./index.php?site=chart"
  </script>';
?>