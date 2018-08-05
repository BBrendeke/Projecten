<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zoeken</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link type="text/css" rel="stylesheet" href="css/filmpagstyle.css"/>
</head>

<?php
	include 'header.php';
$hostname = "(local)";
$dbname = "FLETNIX_DOCENT";
$username = "sa";
$pw = "dbrules";

$con = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", "$username", "$pw");

echo '<h1>U heeft gezocht op regisseur: <i><font color="blue">"' . $_GET['qr'] . '"</font></i></h1>';

$stmt = $con->query("SELECT P.firstname, P.lastname, M.title, M.publication_year, M.movie_id
			FROM Movie M INNER JOIN Movie_Director D ON M.movie_id = D.movie_id INNER JOIN Person P ON D.person_id = P.person_id
			WHERE P.lastname LIKE " . "'%" . $_GET['qr'] . "%'
			ORDER BY M.publication_year DESC, M.title");
			
		$stmt->bindColumn('title', $title);
		$stmt->bindColumn('firstname', $firstname);
		$stmt->bindColumn('lastname', $lastname);
		$stmt->bindColumn('publication_year', $publication_year);
		$stmt->bindColumn('movie_id', $id);

		 while($stmt->fetch(4)){	
			 echo "<br><br><a href='detailpagina.php?id=$id' title='Ga naar de filmpagina van $title'><font color='black'>$title </font></a>";
			 echo "<a href='zoekenjaartal.php?qy=$publication_year' title='Zoek alle films uit $publication_year'>($publication_year),&nbsp;</a>";
			 echo "<span><font color='black'>Regisseur:&nbsp;<i>$firstname&nbsp;</i></font></span>";
			 echo "<span><i><font color='black'>$lastname</font></i></span>";
		 }

	include 'footer.html';
?>

</html>