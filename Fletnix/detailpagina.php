<!DOCTYPE html>
<html>
<head>
    <title>Fletnix</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link type="text/css" rel="stylesheet" href="css/filmpagstyle.css"/>
</head>
<body class="backgnd">

<?php
include 'php_functies/header.php';
?>
  <div class="footerSpaceFilmDescription">
		<div class="flex-container">
			<div class="polaroid">
                <?php
                $id = $_GET['id'];
                require_once('database.php');
                $data = $dbh->query("SELECT * FROM Movie WHERE movie_id = $id");
                $row = $data->fetch();

                $movieImage = "
                  <img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\" style=\"width:90%\">
                ";
                echo $movieImage;
                ?>

			</div>
			<div>
                <?php
                $id = $_GET['id'];
                require_once('database.php');
                $data = $dbh->query("SELECT * FROM Movie WHERE movie_id = $id");
                $data2 = $dbh->query("SELECT P.firstname, P.lastname, C.role
                                              FROM Movie_Cast C join Person P on C.person_id = P.person_id where C.movie_id = $id");
                $row = $data->fetch();
                $cast = $data2->fetch();

                $movieImage = "
                <h4 class=\"small red\">{$row['title']}</h4>
				<p class=\"movieDesciption, red\">Speelduur: {$row['duration']} minuten</p>
				<p class=\"movieDesciption, red\">Prijs: {$row['price']} €</p>
				<p class=\"movieDesciption, red\">Cast: </p>
				";
                $movieCast = "";
				while ($cast = $data2->fetch()) {
				    $movieCast .= "
				    <p class=\"movieDesciption\">{$cast['firstname']} {$cast['lastname']}: {$cast['role']}
		  		    </p>
				    ";
				}
				$movieInfo = "
				<p class=\"movieDesciption, red\">Samenvatting:</p>
				<p class=\"movieDesciption\">{$row['description']}</p>
				
				<a class=\"red\" href=\"{$row['URL']}\">Trailer</a>
				";

                echo $movieImage;
                echo $movieCast;
                echo $movieInfo;
                ?>
            </div>
		</div>
	</div>
<?php
include 'php_functies/footer.php';
?>
