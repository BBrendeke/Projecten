<?php

include 'pdo-functies.php';
//include 'test.php';
$id = $_POST['id'];
$item = getDetails($id);
//deleteItem($itemId);
$stmt = $dbh->query("DELETE FROM veiling WHERE voorwerp_id = '$id'");
$stmt->execute();

$stmt2 = $dbh->query("DELETE FROM rubriek WHERE voorwerp_id = '$id'");
$stmt2->execute();
include 'header.php' ?>

<div class="container">
    <div class="row">
        <h1>Veiling <?php echo $item['titel'] ?> is verwijderd.</h1>
    </div>
</div>

<?php include 'footer.php' ?>


