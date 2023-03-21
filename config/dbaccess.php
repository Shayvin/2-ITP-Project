<?php
$host = "127.0.0.1";
$name = "webshop";
$user = "root"; // hoteladm hat insert, update, file & select Rechte (Minimale Rechte). Der User muss aber extra angelegt werden.
$password = "";

$mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
// PDO (PHP Data Object), ist eine Schnittstelle von der man auf eine SQL Datenbank
// zugreifen kann
?>