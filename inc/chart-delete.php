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
    // check if product is in chart
    $stmt2 = $mysql->prepare("DELETE FROM warenkorb WHERE user_id = :uid AND artikel_id = :pid");
    $stmt2->execute(array(":uid" => $user_id, ":pid" => $pid));
  }
}
  // redirect to chart
  echo '<script type="text/javascript">
  window.location = "./index.php?site=chart"
  </script>';
?>