<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zoeken</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link type="text/css" rel="stylesheet" href="css/filmpagstyle.css"/>
</head>
<body class="backgnd">
<?php
  include 'php_functies/header.php';
?>


<h3 class="grey">Zoeken op filmtitel:</h3>
<form action="php_functies/zoekentitel.php" method="GET">
    <input type="text" name="qt" />
    <input type="submit" value="Zoeken" />
</form><br>

<h3 class="grey">Zoeken op jaartal:</h3>
<form action="php_functies/zoekenjaartal.php" method="GET">
    <input type="text" name="qy" />
    <input type="submit" value="Zoeken" />
</form><br>

<h3 class="grey">Zoeken op filmgenre:</h3>
<form action="php_functies/zoekengenre.php" method="GET">
    <input type="text" name="qg" />
    <input type="submit" value="Zoeken" />
</form><br>

<h3 class="grey">Zoeken op achternaam regisseur:</h3>
<form action="php_functies/zoekenregisseur.php" method="GET">
    <input type="text" name="qr" />
    <input type="submit" value="Zoeken" />
</form><br>


<?php
  include 'php_functies/footer.php';
?>
