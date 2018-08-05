<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 05/06/2018
 * Time: 13:31
 */

include 'header.php';
include 'pdo-functies.php';

$mail = strip_tags($_POST['e-mail']);

$valid = checkValidity($mail);
if($valid === false)
{
    Echo "Dit is geen geldig mailadres registreer eerst";
}else{
    $token = getToken();
    try {
            global $dbh;

            $stmt = $dbh->prepare("insert into token values(:token,:mail)");
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $to      = $mail;
            $subject = 'Password reset';
            $message = 'Your token is ' . $token . "\n" . 'Please click this link: ' . ' http://iproject4.icasites.nl/wachtwoord-link.php ' . 'to reset your password' ;
            $headers = 'From: eenmaalandermaal@iproject4.nl' . "\r\n";
            imap_mail($to, $subject, $message, $headers);

            echo "Mail met token is verzonden naar: $mail";

        }catch(PDOException $exception){
            echo $exception;
        }
}


















?>













<?php include 'footer.php'; ?>
