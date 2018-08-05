<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 06/06/2018
 * Time: 09:39
 */

include 'pdo-functies.php';
include 'header.php';

?>


<div class="container mt-5">

    <div class="row justify-content-center ">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <form method="post" action="wachtwoord-functies.php">
                <div class="form-group">
                    <label for="token">Token</label>
                    <input type="text" class="form-control" id="token" name="token" maxlength="40" required>
                </div>
                <div class="form-group">
                    <label for="e-mail">E-mail</label>
                    <input type="text" class="form-control" id="mail" name="mail" maxlength="40" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" maxlength="20" required>
                </div>
                <div class="form-group">
                    <label for="confirm">Wachtwoord herhalen</label>
                    <input type="password" class="form-control" id="confirm" name="confirm" maxlength="20" required>
                </div>
                <button type="submit" class="btn btn-primary gekleurdeknop btn-sm">Aanpassen</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
