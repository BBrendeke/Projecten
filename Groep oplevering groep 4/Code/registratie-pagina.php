<script>

    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }
    }

    function stripspaces(input)
    {
        input.value = input.value.replace(/\s/gi,"");
        return true;
    }
</script>

<?php
include 'header.php' ;

include 'pdo-functies.php';



$vragen = $dbh->query("SELECT vraag FROM vraag");
while ($row = $vragen->fetch(PDO::FETCH_BOTH)) {
    $items[] = $row['vraag'];
}
?>


<div class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-4 col-md-6 col-sm-6 main-login main-center">
            <form method="post" action="sessie-functies.php">

                <div class="form-group">
                    <label for="username">Gebruikersnaam *</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Gebruikersnaam"
                           maxlength="20" minlength="3" onkeydown="stripspaces(this)" required>
                </div>

                <div class="form-group">
                    <label for="firstname">Voornaam *</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Voornaam"
                           maxlength="20" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Achternaam *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Achternaam"
                           maxlength="20" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="adress">Adres *</label>
                    <input type="text" class="form-control" id="adress" name="adress" placeholder="Adres"
                           maxlength="20" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="adress2">Adres 2</label>
                    <input type="text" class="form-control" id="adress2" name="adress2" placeholder="Adres 2"
                           maxlength="20" minlength="3">
                </div>

                <div class="form-group">
                    <label for="zipcode">Postcode *</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postcode"
                           maxlength="6" required>
                </div>

                <div class="form-group">
                    <label for="city">Plaatsnaam *</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Plaatsnaam"
                           maxlength="25" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="country">Land *</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Land"
                           maxlength="25" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="birthdate">Geboortedatum *</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" min="1918-01-01"
                           max="2018-01-01" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mailadres *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mailadres"
                           maxlength="30" minlength="3" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord *</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord"
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Het wachtwoord moet op ze minst 1 nummer, 1 hoofdletter, 1 kleine letter en minstens 8 karakters  bevatten"
                           maxlength="20" minlength="8" required onkeyup='check();'>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord bevestigen *</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                           placeholder="Wachtwoord bevestigen"
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Het wachtwoord moet op ze minst 1 nummer, 1 hoofdletter, 1 kleine letter en minstens 8 karakters regix bevatten"
                           maxlength="20" minlength="8" required onkeyup='check();'>
                         <span id='message'></span>
                </div>

                <div class="form-group">
                    <label for="question">Vraag</label>
                <select name="question">

                    <?php
                    $i = 1;
                    foreach($items as $item) {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $item; ?></option>
                    <?php
                        $i++;
                    }
                    ?>

                </select>
                </div>

                <div class="form-group">
                    <label for="answer">Antwoord *</label>
                    <input type="text" class="form-control" id="answer" maxlength="20" minlength="3" name="answer" placeholder="Antwoord" required>
                </div>

                <input type="submit" value="registreren" name="registreren" class="gekleurdeknop">
            </form>
        </div>
    </div>
</div>



<?php include 'footer.php' ?>



