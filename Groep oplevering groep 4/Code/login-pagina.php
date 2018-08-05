<?php


require 'db.php';
require 'pdo-functies.php';

ini_set('display_errors', 1);
?>

<!doctype html>
<html lang="en">
<body>

<?php include 'header.php';?>











<div class="container">
    <div class="login-form">
        <form method="post" action="sessie-functies.php">
            <div class="form-group">
                <input type="text" class="form-control" id="gebruikersnaam" name="gebruikersnaam" placeholder="gebruikersnaam">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" placeholder="wachtwoord">
            </div>
            <input type="submit" value="inloggen" name="inloggen" class="gekleurdeknop">
            <a href="registratie-pagina.php" class="btn-link ml-2">Registreren</a>
            <a href="./wachtwoord-vergeten.php" class="btn-link ml-5">Wachtwoord vergeten?</a>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>

</body>
</html>

