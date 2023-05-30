<?php
require_once("./config/dbaccess.php");
$stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :username");
$stmt->bindParam(":username", $_SESSION["username"]);
$stmt->execute();
$row = $stmt->fetch();
$username = $row["USERNAME"];
$orderTotal = $_POST['orderTotal'];

$stmt = $mysql->prepare("INSERT INTO bestellungen (user_id, total) VALUES (:userID, :orderTotal)");
$stmt->bindParam(":userID", $username);
$stmt->bindParam(":orderTotal", $orderTotal);
$stmt->execute();

// Sende die JSON-Antwort zurück
$response = array("status" => "success", "message" => "Order saved.");
header("Content-type: application/json");
echo json_encode($response);
?>
