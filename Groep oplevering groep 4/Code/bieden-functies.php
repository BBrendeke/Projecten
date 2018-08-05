<?php
include 'pdo-functies.php';
require_once 'db.php';


global $dbh;

$bid = $_POST['bod'];
$itemId = $_POST['id'];
$userId = $_POST['userId'];
$boddag = date("Y-m-d h:i:s");


$stmt = $dbh->prepare("INSERT INTO bod (voorwerp_id,bodbedrag,gebruikersnaam,boddag) VALUES (:voorwerp_id,:bodbedrag,:gebruikersnaam,:boddag)");

$stmt->bindParam(':voorwerp_id', $itemId);
$stmt->bindParam(':bodbedrag', $bid);
$stmt->bindParam(':gebruikersnaam', $userId);
$stmt->bindParam(':boddag', $boddag);
$stmt->execute();
header("Location:javascript://history.go(-1)");


?>