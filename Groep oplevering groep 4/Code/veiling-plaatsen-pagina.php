<?php
    include 'pdo-functies.php';
ini_set('display_errors', 1);

function getTree($resultSet) {
    $results = array();

    foreach ($resultSet as $result) {

        if ($result['active'] == 1) {
            $results[] = array(
                'rubrieknummer' => $result['rubrieknummer'],
                'rubrieknaam' => $result['rubrieknaam'],
                'parent' => $result['parent'],
                'active' => $result['active']
            );
        }

    }

    return $results;
}

$resultSet = $dbh->query("EXEC getCategories");
$results = getTree($resultSet);

$jsonArray = json_encode($results);

?>

<!doctype html>
<html lang="en">

<body>
<?php include 'header.php' ?>
<br>
<div class="container">
    <?php
    if(getVerkoperStatus() == 1){?>
            <form method="post" id="form" action="veiling-functies.php" enctype = "multipart/form-data">
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="titel">Titel:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="titel" name="titel" maxlength="50" minlength="3" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="beschrijving">Beschrijving:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="beschrijving" name="beschrijving" maxlength="255" minlength="3" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="image1">Afbeelding1:</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control-file." id="image1" name="image1" required  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="image2">Afbeelding2:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file." id="image2" name="image2" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="image">Afbeelding3:</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file." id="image3" name="image3" required  >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="rubrieken">Rubrieken:</label>
                    <div class="col-sm-10">
                    <select multiple class="form-control" id="dropdown1" required>
                    </select>
                    <select multiple class="form-control mt-2" id="dropdown2">
                    </select>
                    <select multiple class="form-control mt-2" id="dropdown3" name ="dropdown3">
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="startprijs">Startbedrag:</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="startprijs" name="startprijs" min="0" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="looptijd">Looptijd:</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="looptijd" name="looptijd" min="1" max="10" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="betalingswijze">Betalingswijze:</label>
                    <div class="col-sm-10">
                    <select multiple class="form-control" id="betalingswijze" name="betalingswijze" required>
                        <option> Contant  </option>
                        <option> Rekening </option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="betalingsinstructie">Betalingsinstructie:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="betalingsinstructie" name="betalingsinstructie" maxlength="30" minlength="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="verzendkosten">Verzendkosten:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="verzendkosten" name="verzendkosten" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="verzendinstructie">Verzendinstructie:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="verzendinstructie" name="verzendinstructie" maxlength="50" minlength="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class=" col-sm-2 col-form-label" for="conditie">conditie:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="conditie" name="conditie" maxlength="20" minlength="3"required ></textarea>
                    </div>
                </div>
                <input type="submit" value="veilingPlaatsen" name="veilingPlaatsen" class="gekleurdeknop" id="submitBtn">
            </form>
        </div>
<?php }else echo "U bent nog geen verkoper <a href='verkoper-aanmaken.php'>Klik</a> hier om er een te worden"; ?>

<br>

<?php include 'footer.php';

?>

<script>

    let array = <?php echo $jsonArray ?>;
    var id;

    const dropdown1 = $('#dropdown1');
    const dropdown2 = $('#dropdown2');
    const dropdown3 = $('#dropdown3');
    const submitBtn = $('#submitBtn');
    dropdown2.hide();
    dropdown3.hide();

    $(document).ready(function(){
        $.each(array, function(key, value) {
            if (array[key]['parent'] == -1) {
                dropdown1.append($("<option></option>")
                    .attr("value", key)
                    .text(array[key]['rubrieknaam']));
            }
        });
    });

    $(document).ready(function(){
        dropdown1.change(function() {
            dropdown3.hide();
            dropdown2.empty();
            dropdown2.hide();
            let key = $(this).find('option:selected').val();
            let rubrieknummer = array[key]['rubrieknummer'];
            $.each(array, function(key, value) {
                if (array[key]['parent'] == rubrieknummer) {
                    dropdown2.append($("<option></option>")
                        .attr("value", key)
                        .text(value['rubrieknaam']));
                    dropdown2.show();
                }
            });
            id = array[key]['rubrieknummer'];
        });
    });

    $(document).ready(function(){
        dropdown2.change(function() {
            dropdown3.empty();
            dropdown3.hide();
            let key = $(this).find('option:selected').val();
            let rubrieknummer = array[key]['rubrieknummer'];
            $.each(array, function(key, value) {
                if (array[key]['parent'] == rubrieknummer) {
                    dropdown3.append($("<option></option>")
                        .attr("value", key)
                        .text(value['rubrieknaam']));
                    dropdown3.show();
                }
            });
            id = array[key]['rubrieknummer'];
        });
    });

    $(document).ready(function(){
        dropdown3.change(function() {
            let key = $(this).find('option:selected').val();
            id = array[key]['rubrieknummer'];
        });
    });

    $("#form").click(function() {
        $('<input />').attr('type', 'hidden')
            .attr('name', "rubriekId")
            .attr('value', id)
            .appendTo(this);
        return true;
    });
</script>

</body>
</html>

