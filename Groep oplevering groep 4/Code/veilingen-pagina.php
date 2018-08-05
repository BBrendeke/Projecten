<?php







?>

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titel</th>
                    <th scope="col">Prijs</th>
                    <th scope="col">Verwijderen</th>
                </tr>
            </thead>
            <tbody>

            <?php

            if(getVerkoperStatus() == 1) {
                $itemIds = getUserItems();
                if (!empty($itemIds)) {
                    getItemsTable($itemIds);
                } else echo " <h3>U heeft geen veilingen</h3>";
            }else echo "U bent nog geen verkoper <a href='verkoper-aanmaken.php'> Klik </a> hier om er een te worden";
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.delete').click(function() {
        console.log($(this).attr('id'));
        $.ajax({
            type    :   'POST',
            url     :   'test.php',
            data    :   {
                id    :   $(this).attr('id'),
                action  :   'deleteItem'
            },
            success :   function (response) {
                location.reload();
            }
        });
    });
</script>