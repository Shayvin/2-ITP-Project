<?php
require_once("./config/dbaccess.php"); // db access
if (isset($_SESSION["userID"]) && isset($_GET["pid"])){//delete according item
    $stmt_del = $mysql->prepare("DELETE FROM wishlist WHERE user_id = :uid AND artikel_id = :pid");
    $stmt_del->execute(array(":uid" => $_SESSION["userID"], ":pid" => $_GET["pid"]));
}
  // redirect to wishlist
  echo '<script type="text/javascript">
  window.location = "./index.php?site=wishlist"
  </script>';
?>