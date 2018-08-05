<!DOCTYPE html>
<html>
<head>
  <title>Registreren</title>
  <link type="text/css" rel="stylesheet" href="css/style.css"/>
  <link type="text/css" rel="stylesheet" href="css/signup.css"/>
</head>
<body class="backgnd">
<?php
  include 'php_functies/header.php';
  //require_once 'php_functies/FormReg.php';
?>
<div class="footerSpace">
<form action="php_functies/FormReg.php" method='post'>
		<label class="red"> Voornaam*: </label> <br>
		  <input type="text" name="voornaam" size="40" required/><br>
    <label class="red"> Achternaam*: </label> <br>
		  <input type="text" name="achternaam" size="40" required/><br>
    <label class="red"> Mailadres*: </label> <br>
		  <input type="email" name="email" size="40" required/><br>
    <label class="red"> Wachtwoord*: </label> <br>
		  <input type="password" name="wachtwoord" size="20" required/><br>
    <label class="red"> Wachtwoord herhalen*: </label> <br>
		  <input type="password" name="wachtwoord_herhalen" size="20" required/><br>
    <label class="red"> Betaal methode*: </label> <br>
    <select name="betaal_methode" required>
      <option name="Amax" value="Amax">Amax</option>
      <option name="Visa" value="Visa">Visa</option>
      <option name="Creditcard" value="Creditcard">Creditcard</option>
    </select><br>
    <label class="red"> Rekening nummer*: </label> <br>
		  <input type="number" name="rekeningnummer" size="40" required/><br>
    <label class="red"> Land*: </label> <br>
    <select required>
      <option name="Nederland" value="Nederland">Nederland</option>
      <option name="land" value="Duitsland">Duitsland</option>
      <option name="land" value="Frankrijk">Frankrijk</option>
      <option name="land" value="België">België</option>
      <option name="land" value="China">China</option>
      <option name="land" value="Verenigde Staten">Verenigde Staten</option>
    </select><br>
    <label class="red"> Geboortedatum*: </label> <br>
      <input type="date" name="Geboortedatum" size="40" required/><br>
    <label class="red">Geslacht*:</label><br>
      <input type="checkbox" name="Geslacht" value="V"><label class='red'>Vrouw</label></input><br>
      <input type="checkbox" name="Geslacht" value="M"><label class='red'>Man</label></input><br>
  	<label class="red" >Selecteer uw abonnement*:</label><br>
  	<div class="abbobtnline">
  		<input type="button"	class="abbobtn buttonLayout" name="subTyp" value="Angsthaas"/>
  		<input type="button"	class="abbobtn buttonLayout" name="subTyp" value="Killer"/>
  		<input type="button"	class="abbobtn buttonLayout" name="subTyp" value="Psycho"/>
  	</div>
    	<label class="red" class="red">Als je een account aanmaakt gaat u akkoord met onze
      <a class="red" href="voorwaarden.php">gebruiksvoorwaarden.</a></label>
    <div>
    	<input type="button"  class="cancelBtn buttonLayout" value="Cancel"/>
      <input type="submit" class="signupbtn buttonLayout" value="Sign Up"/>
    </div>
</form>
</div>
<?php
  include 'php_functies/footer.php';
?>
