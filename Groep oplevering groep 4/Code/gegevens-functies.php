<?php
ini_set('display_errors', 1);
// hier komt de code of include voor de connectie met de betreffende database

include 'pdo-functies.php';
global $dbh;
require_once  'db.php';
session_start();

if(isset($_POST['email'])){
    $username = $_SESSION['ingelogd'];
    $newUsername = strip_tags($_POST['username']);
    $newUsername = strip_tags($_POST['username']);
    $newAdress1 = strip_tags($_POST['adress']);
    $newAdress2 = strip_tags($_POST['adress2']);
    $newZipcode = strip_tags($_POST['zipcode']);
    $newCity = strip_tags($_POST['city']);
    $newCountry =strip_tags( $_POST['country']);
    $newEmail = strip_tags($_POST['email']);

    session_destroy();

    $stmt = $dbh->prepare("UPDATE gebruiker SET gebruikersnaam = :newUsername, adresregel1 = :newAdress1,
                                    adresregel2 = :newAdress2, postcode = :newZipcode, plaatsnaam = :newCity,
                                    land = :newCountry, mailadres = :newMail WHERE gebruikersnaam = '$username'");

    $stmt->bindParam(':newUsername', $newUsername);
    $stmt->bindParam(':newAdress1', $newAdress1);
    $stmt->bindParam(':newAdress2', $newAdress2);
    $stmt->bindParam(':newZipcode', $newZipcode);
    $stmt->bindParam(':newCity', $newCity);
    $stmt->bindParam(':newCountry', $newCountry);
    $stmt->bindParam(':newMail', $newEmail);
    $stmt->execute();
}elseif(isset($_POST['confirm'])){
    $username = $_SESSION['ingelogd'];
    $passwordOld = strip_tags($_POST['password']);
    $passwordNew = strip_tags($_POST['newPassword']);
    $passwordConfirm = strip_tags($_POST['confirm']);

    if($passwordOld == getUsersInformation()['wachtwoord']) {
        if($passwordConfirm == $passwordNew) {
            session_destroy();

            $stmt = $dbh->prepare("UPDATE gebruiker SET wachtwoord = :newPassword WHERE gebruikersnaam = '$username'");

            $stmt->bindParam(':newPassword', $passwordConfirm);

            $stmt->execute();
        }
    }
}
ob_start(); // ensures anything dumped out will be caught

// do stuff here
$link = 'login-pagina.php'; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status())
{
    ob_end_clean();
}

// no redirect
header( "Location: $link" );
?>

