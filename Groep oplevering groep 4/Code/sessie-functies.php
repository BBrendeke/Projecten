<?php
//USE PHPMailer\PHPMailer\PHPMailer;
//USE PHPMailer\PHPMailer\Exception;

//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/PHPMailer.php';

//require 'PHPMailer/src/SMTP.php';
//require 'composer.phar/vendor/autoload.php';





ini_set('display_errors', 1);
// hier komt de code of include voor de connectie met de betreffende database

include 'pdo-functies.php';

global $dbh;
require_once  'db.php';
if(!isset($_SESSION)) {
    session_start();
}





if(isset($_POST['registreren'])) {
    if ($_POST['password'] != $_POST['confirm_password']) {

        header("location:registratie-pagina.php");
        //Fout melding

                } else {
                    $seller= 0;
                    $username = strip_tags($_POST['username']);
                    $firstname = strip_tags($_POST['firstname']);
                    $lastname = strip_tags($_POST['lastname']);
                    $adress = strip_tags($_POST['adress']);
                    $adress2 = strip_tags($_POST['adress2']);
                    $zipcode = strip_tags($_POST['zipcode']);
                    $city = strip_tags($_POST['city']);
                    $country =strip_tags( $_POST['country']);
                    $birthdate = strip_tags($_POST['birthdate']);
                    $email = strip_tags($_POST['email']);
                    $password = strip_tags($_POST['password']);
                    $question = strip_tags($_POST['question']);
                    $answer = strip_tags($_POST['answer']);

                    $to      = $_POST['email'];
                    $subject = 'Signup | Confirmation';
                    $message = 'Please click this link to confirm your registration: ';
                    $headers = 'From: eenmaalandermaal@iproject4.nl' . "\r\n";
                   imap_mail($to, $subject, $message, $headers);

                    $stmt = $dbh->prepare("INSERT INTO gebruiker (gebruikersnaam, voornaam, achternaam, adresregel1, adresregel2, postcode, plaatsnaam, land, geboortedatum, mailadres, wachtwoord, vraag, antwoordtekst, verkoper)
                                        VALUES (:username, :firstname, :lastname, :adress, :adress2, :zipcode, :city, :country, :birthdate , :email, :password, :question, :answer, :seller)");

                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':adress', $adress);
                    $stmt->bindParam(':adress2', $adress2);
                    $stmt->bindParam(':zipcode', $zipcode);
                    $stmt->bindParam(':city', $city);
                    $stmt->bindParam(':country', $country);
                    $stmt->bindParam(':birthdate', $birthdate);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':question', $question);
                    $stmt->bindParam(':answer', $answer);
                    $stmt->bindParam(':seller', $seller);

                    $stmt->execute();



        header("location: login-pagina.php");

    }

}

if(isset($_POST['inloggen'])) {
    $gebruikersnaam = strip_tags($_POST['gebruikersnaam']);
    $wachtwoord = strip_tags($_POST['wachtwoord']);
    

    $query = $dbh->query("SELECT gebruikersnaam, wachtwoord FROM gebruiker WHERE gebruikersnaam='$gebruikersnaam' AND wachtwoord='$wachtwoord'");
    $row = $query->fetch(PDO::FETCH_BOTH);


    if($gebruikersnaam === $row['gebruikersnaam'] and $wachtwoord === $row['wachtwoord']){
        $_SESSION['ingelogd'] = $gebruikersnaam;
        header("location: index.php");
    }elseif($gebruikersnaam != $row['gebruikersnaam'] and $wachtwoord === $row['wachtwoord']){

        die(header('refresh: 5; url=login-pagina.php'). 'Invalid username, wait 5 seconds');


    }elseif($wachtwoord != $row['wachtwoord'] and $gebruikersnaam === $row['gebruikersnaam']){
        die(header('refresh: 5; url=login-pagina.php'). 'Invalid password, wait 5 seconds');


    }else{
        die(header('refresh: 5; url=login-pagina.php'). 'Invalid credentials, wait 5 seconds');

    }
}

if(isset($_POST['uitloggen'])) {
    unset ($_SESSION['ingelogd']);
    header("location: login-pagina.php");
}

if(isset($_POST['verkoper'])) {
    $bank = strip_tags($_POST['bank']);
    $bankrekening = strip_tags($_POST['bankrekening']);
    $creditcard = strip_tags($_POST['creditcard']);
    $gebruikersnaam = $_SESSION['ingelogd'];
    if(!empty(getVerkoperStatus($gebruikersnaam))){
        $stmt = $dbh->prepare("UPDATE verkoper SET bank = :bank, bankrekening = :bankrekening,
                                        creditcard = :creditcard
                                        WHERE gebruikersnaam = :gebruikersnaam");
    }else {
        $stmt = $dbh->prepare("INSERT INTO verkoper (gebruikersnaam, bank, bankrekening, creditcard)
                                          VALUES(:gebruikersnaam, :bank, :bankrekening, :creditcard)");
    }
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->bindParam(':bank', $bank);
    $stmt->bindParam(':bankrekening', $bankrekening);
    $stmt->bindParam(':creditcard', $creditcard);
    $stmt->execute();

    $statement = $dbh->query("UPDATE gebruiker SET verkoper = 1 WHERE gebruikersnaam = '$gebruikersnaam' ");

    header("location: dashboard.php");
}



/*

$data = $dbh->query("select * from gebruikers where email = '$email' and wachtwoord = '$wachtwoord'");


if($data['email'] != $email and $data['wachtwoord'] != $wachtwoord){
echo 'klopt niet';
} else{
 header("location: footer.php");}
}




dit komt in de header, om te kijken of er iemand ingelogd is
if($_SESSION['ingelogd']){
// gegevens in hoek weergeven
} else{
// inlog mogelijkheid weergeven
}
*/


?>

