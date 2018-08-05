<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 04/06/2018
 * Time: 13:53
 */
include 'pdo-functies.php';


?>


<?php include 'header.php'; ?>

    <div class="container mt-5">

        <div class="row justify-content-center ">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <form method="post" action="wachtwoord-reset.php" onsubmit="">
                    <label class=" col-sm-2 col-form-label" for="e-mail">e-Mail:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="e-mail" name="e-mail" >
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary gekleurdeknop btn-sm">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>










<?php include 'footer.php';
