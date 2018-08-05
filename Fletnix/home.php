<!DOCTYPE html>
<html>
<head>
    <title>Fletnix</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link type="text/css" rel="stylesheet" href="css/filmpagstyle.css"/>
</head>
<body class="backgnd">

<?php
  include 'header.php';
?>

  <div class="footerSpaceDagFilm">
	  <h4 class="small red">HOME</h4>
      <h2 class="small red">Aanbevolen</h2>
	  <div class="ruimte">
          <?php
          require_once('database.php');
          $data = $dbh->query("select TOP 5 * from Movie order by movie_id");

          $overzicht = "";
          while ($row = $data->fetch()){
              $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
          }
          echo $overzicht;
          ?>
      </div>
		<h2 class="small red">Uitgelicht</h2>
		<div class="ruimte">

            <?php
            require_once('database.php');
            $data = $dbh->query("select TOP 5 * from Movie where movie_id > 4 order by movie_id");

            $overzicht = "";
            while ($row = $data->fetch()){
                $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
            }
            echo $overzicht;
            ?>
		</div>
		<div class="ruimte">
            <?php
            require_once('database.php');
            $data = $dbh->query("select TOP 5 * from Movie where movie_id > 9 order by movie_id");

            $overzicht = "";
            while ($row = $data->fetch()){
                $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
            }
            echo $overzicht;
            ?>
		</div>
		<div class="ruimte">
            <?php
            require_once('database.php');
            $data = $dbh->query("select TOP 5 * from Movie where movie_id > 14 order by movie_id");

            $overzicht = "";
            while ($row = $data->fetch()){
                $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
            }
            echo $overzicht;
            ?>
		</div>
		<div class="ruimte">
            <?php
            require_once('database.php');
            $data = $dbh->query("select TOP 5 * from Movie where movie_id > 19 order by movie_id");

            $overzicht = "";
            while ($row = $data->fetch()){
                $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
            }
            echo $overzicht;
            ?>
		</div>
      <div class="ruimte">
          <?php
          require_once('database.php');
          $data = $dbh->query("select TOP 5 * from Movie where movie_id > 24 order by movie_id");

          $overzicht = "";
          while ($row = $data->fetch()){
              $overzicht .= "	    
			    <div class=\"plaatje container\">
			    <a href='detailpagina.php?id={$row['movie_id']}'>
					<img src=\"{$row['cover_image']}\" alt=\"{$row['title']}\">
				<div class=\"overlay\">
					<div class=\"text grey\">{$row['title']}</div>
				</div>
				</a>
		        </div>
                ";
          }
          echo $overzicht;
          ?>
      </div>
	</div>
<?php
  include 'php_functies/footer.php';
?>
