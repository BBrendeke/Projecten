<?php
$userBidItem_ids = getUserBidItems();
?>

<div class="container">
    <div class="row">
        <?php
        itemView($userBidItem_ids);
        ?>
    </div>
</div>



