<?php

include 'menuView.php';

ini_set('display_errors', 1);
if (!isset($_SESSION)) {

    session_start();

}
$gebruikersnaam = 'inloggen';
$inloghref = 'login-pagina.php';
if (isset($_SESSION['ingelogd'])) {
    if ($_SESSION['ingelogd'] != null) {
        $gebruikersnaam = $_SESSION['ingelogd'];
        $inloghref = 'dashboard.php';

    } else {
        $gebruikersnaam = 'inloggen';
        $inloghref = 'login-pagina.php';
    }
}


function getSeller($gebruikersnaam)
{
    global $dbh;
    $data = $dbh->query("select beheerder from gebruiker where gebruikersnaam = $gebruikersnaam");
    $row = $data->fetch();
    return $row;
}


if (isset($_SESSION['ingelogd'])) {
    $veilingplaatsenhref = "<a class='nav-link' href='veiling-plaatsen-pagina.php'>Veiling plaatsen</a>";
} else {
    $veilingplaatsenhref = "<a class='nav-link' href='login-pagina.php'>Veiling plaatsen</a>";
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Our CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/test.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>EENMAAL | ANDERMAAL</title>
</head>
<body>

<header>
    <div class="mb-2">
        <div class="container-fluid">
            <div class="container">
                <header>
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <a class="logo" href="http://iproject4.icasites.nl/"><span id="logo-left"
                                                                                   class="logo">Eenmaal</span><span
                                    id="logo-seperator" class="logo"> | </span><span id="logo-right"
                                                                                     class="logo">Andermaal</span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse ml-lg-3" id="navbarNav">
                            <ul class="navbar-nav ml-auto">
                <span class="border-defined">
                    <li class="nav-item active">
                        <a class="nav-link" href="overzicht-pagina.php">Overzicht</a>
                    </li>
                </span>

                                <li class="nav-item">
                                    <?php echo $veilingplaatsenhref; ?>
                                </li>
                                <li class="nav-item">
                                    <nav class="navbar navbar-light">
                                        <form class="form-inline" action="zoeken-pagina.php" method="get">
                                            <input minlength="2" class="form-control mr-sm-2" name="zoek" id="zoek"
                                                   type="search"
                                                   placeholder="Search" aria-label="Search" required>
                                            <button class="btn my-2 my-sm-0 gekleurdeknop" type="submit">Search</button>
                                        </form>
                                    </nav>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categorieën
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#"><?php echo getParentCategories(); ?></a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href=" <?php echo $inloghref; ?> "><?php echo $gebruikersnaam; ?></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>
</header>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- lib for countdown timer -->
<script src="http://cdn.rawgit.com/hilios/jQuery.countdown/2.0.4/dist/jquery.countdown.min.js"></script>
<script src="js/timer3.js"></script>

<!-- Not active? -->
<script src="js/js-functions.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

</body>
</html>