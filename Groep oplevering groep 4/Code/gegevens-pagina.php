<?php
ini_set('display_errors', 1);

$userInfo = getUsersInformation();
$verkopersInfo = getVerkopersInformation();
$verkopersStatus = getVerkoperStatus();


?>

<div class="container mt-5">
    <div class="row justify-content-sm-around ">
    <h3 class="col-lg-4 col-md-6 col-sm-6 background-dark rounded" > Gebruikersgegevens:</h3>
        <h3 class="col-lg-4 col-md-6 col-sm-6 background-dark rounded"> Verkopersgegevens:</h3>
    </div>
    <div class="row justify-content-sm-around ">
        <div class="col-lg-4 col-md-6 col-sm-6 background-dark rounded ">

            <div class="form-group mt-2">
                <h5>Gebruikersnaam</h5>
                <strong><?php echo $userInfo['gebruikersnaam']?></strong>
            </div>
            <div class="form-group mt-2">
                <h5>Adres</h5>
                <strong><?php echo $userInfo['adresregel1']?></strong>

                <div class="form-group mt-2">
                    <h5>Adres 2</h5>
                    <strong><?php if(!empty($userInfo['adresregel2'])){echo $userInfo['adresregel2'];}
                        else{ echo "(Niet ingesteld.)";}?></strong>
                </div>

                <div class="form-group mt-2">
                    <h5>Postcode</h5>
                    <strong><?php echo $userInfo['postcode']?></strong>
                </div>

                <div class="form-group mt-2">
                    <h5>Plaatsnaam</h5>
                    <strong><?php echo $userInfo['plaatsnaam']?></strong>
                </div>

                <div class="form-group mt-2">
                    <h5>Land</h5>
                    <strong><?php echo $userInfo['land']?></strong>
                </div>

                <div class="form-group mt-2">
                    <h5>Mailadres</h5>
                    <strong><?php echo $userInfo['mailadres']?></strong>
                </div>
                <form action="dashboard.php" method="get">
                    <button type="submit" name="aanpassen" class="btn btn-primary gekleurdeknop btn-sm">Aanpassen</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 background-dark rounded">
            <?php
            if(getVerkoperStatus() == 1){?>
                <div class="form-group mt-2">
                    <h5>Bank</h5>
                    <strong><?php echo $verkopersInfo['bank']?></strong>
                </div>
                <div class="form-group mt-2">
                    <h5>Bankrekening</h5>
                    <strong><?php echo $verkopersInfo['bankrekening']?></strong>

                    <div class="form-group mt-2">
                        <h5>Creditcard</h5>
                        <strong><?php if(!empty($verkopersInfo['creditcard'])){echo $verkopersInfo['creditcard'];}
                            else{ echo "(Niet ingesteld.)";}?></strong>
                    </div>

                    <form action="verkoper-aanmaken.php" method="get">
                        <button type="submit" name="verkoper" class="btn btn-primary gekleurdeknop btn-sm">Aanpassen</button>
                    </form>
                </div>
            <?php }else echo "U bent nog geen verkoper <a href='verkoper-aanmaken.php'>Klik</a> hier om er een te worden"; ?>



        </div>
    </div>
</div>



