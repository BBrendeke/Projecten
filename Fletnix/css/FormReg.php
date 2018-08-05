<?php/*
  echo date mktime(0, 0, 0, date("m")  , date("d"), date("Y"));;
*/?>


<?php
	require_once('database.php');
  $email = $_POST['email'];
  $voornaam = $_POST['voornaam'];
  $achternaam = $_POST['achternaam'];
  $betaal_methode = $_POST['betaal_methode'];
  $rekeningnummer = $_POST['rekeningnummer'];
  $contract_type = $_POST['subTyp'];
  $username = $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];
  $wachtwoord_herhalen = $_POST['wachtwoord_herhalen'];
  $land = $_POST['land'];
  $geslacht = $_POST['Geslacht'];
  $geboortedatum = $_POST["Geboortedatum"];


  if ($wachtwoord == $wachtwoord_herhalen)
  {
    $data = $dbh->query(statement,"INSERT INTO customer  VALUES ($email, $voornaam, $achternaam, $betaal_methode, $rekeningnummer, $contract_type,(SELECT CONVERT(INT,GETDATE())), NULL, $username, $wachtwoord, $land, $geslacht, $geboortedatum)");
  }
   else {
		 echo "Wachtwoorden niet gelijk.";
	 }
?>
