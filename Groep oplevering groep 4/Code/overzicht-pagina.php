<?php

include 'pdo-functies.php';
include 'header.php';
$pagination = true;
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
    $item_ids = getItemIds($current_page - 1);
} else {
    $current_page = 1;
    $item_ids = getItemIds($current_page - 1);
}

$maxPages = floor(count(getItemId())/100);
?>

<div class="container">
    <?php if ($pagination) {include 'pagination.php';} ?>
    <div class="row">
        <?php
        itemView($item_ids);
        ?>
    </div>
    <?php if ($pagination) {include 'pagination.php';} ?>
</div>

<?php include 'footer.php' ?>

