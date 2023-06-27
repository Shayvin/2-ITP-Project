<?php
//sql muss hier schon anfangen, um die Bezahlung abzubrechen, falls es keine legale Bestellung ist.
$userID = $_POST["userID"];
require_once("../config/dbaccess.php");
//zuerst die entsprechenden artikel aus dem warenkorb in $warenkorb speichern
$stmt = $mysql->prepare("SELECT * FROM warenkorb WHERE user_id = :id");
$stmt->bindParam(":id", $userID);
$stmt->execute();
$warenkorb = [];
$i=0;
while($row = $stmt->fetch()){
  $warenkorb[$i]=[$row["artikel_id"], $row["menge"]];
  ++$i;
  }
//Check ob ausreichend von jedem Artikel vorhanden ist
$sufficient = true;
foreach($warenkorb as $artikel){
    //Zuerst feststellen, wieviele da sind
    $stmt = $mysql->prepare("SELECT bestand FROM `produkte` WHERE `ID` = :ArtID;");
    $stmt->bindParam(":ArtID", $artikel[0]);
    $stmt->execute();
    $row = $stmt->fetch();
    $Anzahl = $row[0];
    if($Anzahl < $artikel[1]){
        $sufficient = false;
    }
}
if($sufficient){ //dieser code managed das paypal backend
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    curl_setopt($ch, CURLOPT_USERPWD, 'AbFZ3_BhtY9LxaAJXM0QHVbfd1vLSwmQ8Y-XP-gglW8JIzfFdJpvoxNG-JZX1_AjRerNhjSz6S0lR60b:EB2g9yLWbvQEcP-T41PB29n6vDrvFByj8Oy1rRNLp3NAeHPkJJFOpmRjYgJEaEzSat_bSUudWvvzSv8A');

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Accept-Language: en_US';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    if (curl_errno($ch))
    {
        echo json_encode([
            "status" => "error",
            "message" => curl_error($ch)
        ]);
        exit();
    }
    curl_close($ch);

    $result = json_decode($result);

    $access_token = $result->access_token;

    $payment_token_parts = explode("-", $_POST["orderID"]);
    $payment_id = "";
    
    if (count($payment_token_parts) > 1)
    {
        $payment_id = $payment_token_parts[1];
    }

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders/' . $payment_id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $access_token;
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($curl);

    if (curl_errno($curl))
    {
        echo json_encode([
            "status" => "error",
            "message" => "Payment not verified. " . curl_error($curl)
        ]);
        exit();
    }
    curl_close($curl);

    //neue Bestellung anlegen
    $stmt = $mysql->prepare("INSERT INTO `bestellungen` (`user_id`, `datum`) VALUES (:id, now())");
    $stmt->bindParam(":id", $userID);
    $stmt->execute();
    //BestellungsID in erfahrung bringen: nimm einfach aktuellsten eintrag mit deiner user_id
    $stmt = $mysql->prepare("SELECT * FROM `bestellungen` WHERE user_id = :id AND datum = (SELECT MAX(datum) FROM `bestellungen`);");
    $stmt->bindParam(":id", $userID);
    $stmt->execute();
    $row = $stmt->fetch();
    $bestellungsID = $row[0];
    //Für jeden Artikel Eintrag in artikel_bestellungen anlegen
    foreach($warenkorb as $artikel){
    $stmt = $mysql->prepare("INSERT INTO `artikel_bestellungen` (`bestellung_id`, `artikel_id`, `menge`) VALUES (:BestID, :ArtID, :menge)");
    $stmt->bindParam(":BestID", $bestellungsID);
    $stmt->bindParam(":ArtID", $artikel[0]);
    $stmt->bindParam(":menge", $artikel[1]);
    $stmt->execute();
    }
    //Warenkorb leeren
    $stmt = $mysql->prepare("DELETE FROM warenkorb WHERE user_id = :id");
    $stmt->bindParam(":id", $userID);
    $stmt->execute();

    //Artikelanzahl update
    foreach($warenkorb as $artikel){
    //Zuerst feststellen, wieviele da sind
    $stmt = $mysql->prepare("SELECT bestand FROM `produkte` WHERE `ID` = :ArtID;");
    $stmt->bindParam(":ArtID", $artikel[0]);
    $stmt->execute();
    $row = $stmt->fetch();
    $Anzahl = $row[0];
    $neueAnzahl = $Anzahl - $artikel[1];
    //dann updaten
    $stmt = $mysql->prepare("UPDATE `produkte` SET `BESTAND` = :Anzahl WHERE `produkte`.`ID` = :ArtID;");
    $stmt->bindParam(":ArtID", $artikel[0]);
    $stmt->bindParam(":Anzahl", $neueAnzahl);
    $stmt->execute();
    }
    $result = json_decode($result);

    echo json_encode([
        "status" => "success",
        "message" => "Payment verified.",
        "result" => $result
    ]);
}
else{
    echo json_encode([
        "status" => "failed",
        "message" => "Ordered amount surpasses stock amount",
    ]); 
}
exit();
?>