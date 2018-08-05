<?php
ini_set('display_errors', 1);

$userInfo = getUsersInformation();
?>

<div class="container mt-5">

    <div class="row justify-content-center ">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <form method="post" action="gegevens-functies.php" onsubmit="return confirm('Wilt u deze veranderingen opslaan? U wordt dan wel automatisch uitgelogd.')">
                <div class="form-group">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?php echo $userInfo['gebruikersnaam']?>"
                           maxlength="20" required>
                </div>
                <div class="form-group">
                    <label for="adress">Adres</label>
                    <input type="text" class="form-control" id="adress" name="adress"
                           value="<?php echo $userInfo['adresregel1']?>"
                           maxlength="20" required>
                </div>

                <div class="form-group">
                    <label for="adress2">Adres 2</label>
                    <input type="text" class="form-control" id="adress2" name="adress2"
                           value="<?php echo $userInfo['adresregel2']?>"
                           maxlength="20">
                </div>

                <div class="form-group">
                    <label for="zipcode">Postcode</label for="zipcode">
                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                           value="<?php echo $userInfo['postcode']?>"
                           maxlength="6" required>
                </div>

                <div class="form-group">
                    <label for="city">Plaatsnaam</label>
                    <input type="text" class="form-control" id="city" name="city"
                           value="<?php echo $userInfo['plaatsnaam']?>"
                           maxlength="25" required>
                </div>

                <div class="form-group">
                    <label for="country">Land</label>
                    <input type="text" class="form-control" id="country" name="country"
                           value="<?php echo $userInfo['adresregel1']?>"
                           maxlength="25" required>
                </div>

                <div class="form-group">
                    <label for="email">Emailadres</label>
                    <input type="text" class="form-control" id="email" name="email"
                           value="<?php echo $userInfo['mailadres']?>"
                           maxlength="30" required>
                </div>

                <button type="submit" class="btn btn-primary gekleurdeknop btn-sm">Aanpassen</button>
            </form>

            <form action="wachtwoord-veranderen.php" class="mt-3">
                <button type="submit" class="btn btn-primary gekleurdeknop btn-sm">Wachtwoord veranderen</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>