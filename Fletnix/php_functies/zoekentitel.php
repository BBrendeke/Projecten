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

echo '<h1>U heeft gezocht op titel: <i><font color="blue">"' . $_GET['qt'] . '"</font></i></h1>';

$stmt = $con->query("SELECT title, publication_year, movie_id
			FROM Movie
			WHERE title LIKE " . "'%" . $_GET['qt'] . "%'
			ORDER BY publication_year DESC, title");
			
		$stmt->bindColumn('title', $title);
		$stmt->bindColumn('publication_year', $publication_year);
		$stmt->bindColumn('movie_id', $id);

		 while($stmt->fetch(2)){	
			 echo "<br><br><a href='detailpagina.php?id=$id' title='Ga naar de filmpagina van $title'><font color='black'>$title </font></a>";
			 echo "<a href='zoekenjaartal.php?qy=$publication_year' title='Zoek alle films uit $publication_year'>($publication_year)</a>";
		 }

	include 'footer.html';
?>

</html>