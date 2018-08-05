
<?php
session_start();
require_once 'db.php';
include 'pdo-functies.php';
$itemId = $_GET['id'];
$item = getDetails($itemId);
$images = getImage($itemId);

function requiredBid(){
    global $itemId;

    if(empty(getHighestBid($itemId))){
        return $requiredBid = getDetails($itemId)['startprijs'];
    }else{
        return $requiredBid = getHighestBid($itemId) + 0.01;
    }
}

$biedhref = '"login-pagina.php" ';
if(isset($_SESSION['ingelogd'])){
    if ($_SESSION['ingelogd'] != null) {
        $biedhref = '"bieden-functies.php" onsubmit="setTimeout(function() { window.location.reload(); }, 5)"';
        $gebruikersnaam = $_SESSION['ingelogd'];
    }
}

?>

<!doctype html>
<html lang="en">
<body>

<?php include 'header.php'; ?>


<div class="timerRow container flex-column">

    <?php


$date = getEndDate($item['voorwerp_id']);
echo " Deze veiling is over: <span class='detailTimer' id='example1' data-countdown='".$date->format('Y/m/d')."'> </span> afgelopen.";

?>

</div>


<div class="justify-content-end d-flex container">
    <?php
    if(adminRights()==true) {
        echo "<form method = \"post\" onsubmit='confirm(\"Weet u zeker dat u deze veiling verwijderen? Dit is niet terug te draaien!\")' 
                action=\"item-delete.php\">
                    <input type = \"hidden\" name = \"id\" id = \"id\" value = '" . $itemId ." ' >
                    <button type = \"submit\" class=\"btn btn-primary gekleurdeknop\" > Veiling verwijderen </button >
                </form >";
    }
    ?>
</div>



<div class=" container d-flex flex-wrap">

    <div>
        <div id="demo" class="carousel slide " data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo $images[0] ?>" alt="plaatje" width="500" height ="height"/>
                </div>

                <?php
                for ($i = 1; $i < count($images); $i++){

                    echo "<div class=\"carousel-item c\">
                    <img src=\" $images[$i] \" alt=\"plaatje\" width=\"500\" height =\"height\" />
                </div>";
                }

                ?>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <div class="container flex-wrap col-lg-4 ">
        <div class="border mb-lg-2">
            <table class="table mb-lg-0">
                <thead>
                <tr>
                    <th scope="col">Bodbedrag</th>
                    <th scope="col">Gebruikersnaam</th>
                </tr>
                </thead>

                <tbody>
                <?php

                $bids = getBids($_GET['id']);
                foreach ($bids as $bid) {
                    echo "<tr>";
                    echo "<td class=''> <span class='m-lg-0'>€ </span>" . number_format($bid['bodbedrag'],2,',','.') . "</td>";
                    echo "<td>" . $bid['gebruikersnaam'] . "</td>";
                    echo "<tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
<div class=" container">
        <form class="form-inline" action= <?php echo $biedhref ?>   method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $itemId ?>"/>
            <input type="hidden" name="userId" id="userId" value="<?php echo "$gebruikersnaam" ?>"/>
            <input type="number" step="any" min="<?php echo requiredBid() ?>" class="form-control mr-lg-1" name="bod" id="bod" placeholder="Bodbedrag €" required/>
            <button type="submit" class="btn btn-primary gekleurdeknop " >Bieden</button>
        </form>
</div>
    </div>

</div>

    <div class="container ">

        <div class="data">
        <h2>
            <?php echo $item['titel']; ?>
        </h2>
            <?php
              $rubriekNumber = getRubriekNumber($item['voorwerp_id']);
              $rubriekName = getName($rubriekNumber);
            echo 'rubriek: ' . $rubriekName;

            ?>
        <br>

        <h1>Contactgegevens:  </h1>
        <p> Verkoper: <?php echo $item['verkoper']; ?> <br>
            Land: <?php echo $item['plaatsnaam']; ?> <br>
        </p>

        <h5>Betaling gegevens:</h5>
        <p>
            Startprijs: <?php echo '€' . number_format($item['startprijs'], 2, ',', '.'); ?> <br>
            Betalingswijze: <?php echo $item['betalingswijze']; ?> <br>

        <h5>Verzend gegevens:</h5>
        <p>
            Verzendkosten: <?php echo '€' . number_format($item['verzendkosten'], 2, ',', '.' ); ?> <br>
            Verzendinstructie: <?php echo $item['verzendinstructie']; ?> <br>
        </p>

        <h5>Basis gegevens:</h5>
        <p>
            Conditie: <?php echo $item['conditie'] ?>
        </p>

        <h5>Samenvatting:</h5>
        <p><?php echo $item['beschrijving']; ?></p>
</div>
    </div>





<?php


include 'footer.php'  ?>


</body>
</html>