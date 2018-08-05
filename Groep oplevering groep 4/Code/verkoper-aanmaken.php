<?php
include 'header.php' ;

include 'pdo-functies.php';
?>
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-4 col-md-6 col-sm-6 main-login main-center">
            <form method="post" action="sessie-functies.php">

                <div class="form-group">
                    <label for="bankrekening">bankrekening*</label>
                    <input type="text" class="form-control" id="bankrekening" name="bankrekening" placeholder="Bankrekening *"
                           maxlength="20" required>
                </div>

                <div class="form-group">
                    <label for="bank">Bank*</label>
                    <select class="form-control" name="bank" id="bank">
                        <option>ABN AMRO</option>
                        <option>Achmea</option>
                        <option>AEGON</option>
                        <option>Allianz</option>
                        <option>ASN Bank</option>
                        <option>Rabobank</option>
                        <option>Delta Lloyd</option>
                        <option>ING</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="creditcard">Creditcard</label>
                    <input type="text" class="form-control" id="creditcard" name="creditcard" placeholder="Creditcard"
                           maxlength="20">
                </div>






                <input type="submit" value="registreren" name="verkoper" class="btn btn-primary gekleurdeknop m-1 mr-">
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>