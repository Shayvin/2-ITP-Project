<?php
require_once("./config/dbaccess.php"); // db access
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $user_id = $_POST["user_id"];
  foreach(array_keys($_POST) as $key){
    if (str_starts_with($key, "amount")){
      $pid = substr($key, 6);
      $amount = $_POST[$key];
    if ($user_id && $pid && $amount){
      $stmt = $mysql->prepare("SELECT * FROM warenkorb WHERE user_id = :uid AND artikel_id = :aid");
      $stmt->execute(array(":uid" => $user_id, ":aid" => $pid));
      $row = $stmt->fetch();
      if ($stmt->rowCount() == 1){
        // update exisiting chart entry
        $stmt2 = $mysql->prepare("UPDATE warenkorb SET menge = :menge WHERE user_id = :uid AND artikel_id = :aid");
        $stmt2->execute(array(":uid" => $user_id, ":aid" => $pid, ":menge" => $amount));
      } else {
        // add new chart entry
        $stmt3 = $mysql->prepare("INSERT INTO warenkorb (user_id, artikel_id, menge) VALUES (:uid, :aid, :menge);");
        $stmt3->execute(array(":uid" => $user_id, ":aid" => $pid, ":menge" => $amount));
      }
    }
  }
  }
    // redirect to chart
    echo '<script type="text/javascript">
    window.location = "http://localhost/2-ITP-Project/index.php?site=chart"
    </script>';
} else {
  // redirect to chart
  echo '<script type="text/javascript">
           window.location = "http://localhost/2-ITP-Project/index.php?site=chart"
      </script>';
}
?>