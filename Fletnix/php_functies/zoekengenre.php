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

echo '<h1>U heeft gezocht op genre: <i><font color="red">"' . $_GET['qg'] . '"</font></i></h1>';

$stmt = $con->query("SELECT M.title, G.genre_name, M.movie_id
			FROM Movie M INNER JOIN Movie_Genre MG ON M.movie_id = MG.movie_id INNER JOIN Genre G ON MG.genre_name = G.genre_name
			WHERE G.genre_name LIKE " . "'%" . $_GET['qg'] . "%'
			ORDER BY M.publication_year DESC, M.title");
			
		$stmt->bindColumn('title', $title);
		$stmt->bindColumn('genre_name', $genre_name);
		$stmt->bindColumn('movie_id', $id);

		 while($stmt->fetch(2)){	
			 echo "<br><br><a href='detailpagina.php?id=$id' title='Ga naar de filmpagina van $title'><font color='black'>$title </font></a>";
			 echo "<span><font color='grey'>($genre_name)</font></span>";
		 }

	include 'footer.html';
?>

</html>