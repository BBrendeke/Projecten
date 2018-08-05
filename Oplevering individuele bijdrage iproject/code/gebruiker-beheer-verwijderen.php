<?php

require_once 'db.php';
include 'pdo-functies.php';
global $dbh;
$mailadress = $_POST['userMail'];
blacklistUser($mailadress);
$stmt = $dbh->prepare("DELETE FROM gebruiker WHERE mailadres = '$mailadress'");

$stmt->execute();

header('Location:http://iproject4.icasites.nl/dashboard.php');

?>
