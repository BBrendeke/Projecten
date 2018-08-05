
<?php
ini_set('display_errors', 1);
include 'header.php';
include 'pdo-functies.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center ">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <form method="post" action="gegevens-functies.php" onsubmit="return confirm('Wilt u uw wachtwoord veranderen?')">
                <div class="form-group">
                    <label for="password">Oud wachtwoord</label>
                    <input type="password" class="form-control" id="password" name="password" maxlength="20" required>
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

<?php include 'footer.php'; ?>
