<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 06/06/2018
 * Time: 11:15
 */

include 'pdo-functies.php';
require_once 'db.php';

$token = strip_tags($_POST['token']);
$mail = strip_tags($_POST['mail']);
$password = strip_tags($_POST['newPassword']);
$confirm = strip_tags($_POST['confirm']);

$tokenExist = checkToken($token);

if($tokenExist === false)
{
    echo "That token does not exist";
    //var_dump($token);
}elseif($tokenExist = true && $password = $confirm)
{
    global $dbh;

    $stmt = $dbh->prepare("UPDATE gebruiker SET wachtwoord = '$password' WHERE mailadres = '$mail'");
    $stmt->execute();
    //var_dump($stmt);
    echo "Succes your password was changed";
    header('Location:http://iproject4.icasites.nl/login-pagina.php');
}

?>