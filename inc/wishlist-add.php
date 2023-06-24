<?php
require_once("./config/dbaccess.php"); // db access
if (isset($_SESSION["userID"]) && isset($_GET["pid"])){
  // check if product is already in wishlist
  $stmt_find = $mysql->prepare("SELECT * FROM wishlist WHERE user_id = :uid AND artikel_id = :pid");
  $stmt_find->execute(array(":uid" => $_SESSION["userID"], ":pid" => $_GET["pid"]));
  $row = $stmt_find->fetch();
  if ($stmt_find->rowCount() < 1){
    // if product not in wishlist, add product
    $stmt_add = $mysql->prepare("INSERT INTO wishlist (user_id, artikel_id) VALUES (:uid, :pid);");
    $stmt_add->execute(array(":uid" => $_SESSION["userID"], ":pid" => $_GET["pid"]));
  }
}
  // redirect to wishlist
  echo '<script type="text/javascript">
  window.location = "./index.php?site=wishlist"
  </script>';
?>