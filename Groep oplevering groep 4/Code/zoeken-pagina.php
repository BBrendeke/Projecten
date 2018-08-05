<?php

require_once 'db.php';
include 'pdo-functies.php';

global $dbh;

    $searchItem = strip_tags($_GET['zoek']);
    if(isset($_GET['zoek'])) {
        $searchItem = strip_tags($_GET['zoek']);
    }




    $searchCat_ids = getSearchCat($searchItem);
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
    $searchItem_ids = getSearchTitle($searchItem, $current_page -1);
} else {
    $current_page = 1;
    $searchItem_ids = getSearchTitle($searchItem, $current_page -1);
}
$maxPages = floor(getAantalSearchTitle($searchItem) / 100);
?>

<!doctype html>
<html lang="en">
<link href="css/test.css" rel="stylesheet">
<body>

<?php include 'header.php' ?>


<div class="container-fluid mt-lg-4">

    <div>
        <?php
        echo "<h3 class=\"text-center\">Uw zoekterm: $searchItem</h3>";
        if(!empty($searchCat_ids)){

            echo "<h4 class=\"text-center\">Categorieën met uw zoekterm.</h4>";
            echo "<div class=\"form-inline justify-content-center\">";
            foreach ($searchCat_ids as $searchCat_id){
                $name = getName($searchCat_id);
                echo "<a href=\"http://iproject4.icasites.nl/categorie-pagina.php?catId=$searchCat_id\">
                      <button type=\"submit\" class=\"gekleurdeknop m-2\"\">$name</button></a>";
            }
            echo "</div>";
        }



        include 'pagination.php';
        if(empty($searchItem_ids)){
            echo "<h5 class=\"text-center\">Geen actieve veilingen gevonden op deze zoekterm.</h5>";
        }else {
            echo "<h4 class=\"text-center\">Veilingen met uw zoekterm.</h4>";
            echo "<div class=\"row justify-content-center\">";
            echo "<div class=\"container\">";
            echo "<div class=\"row\">";
            itemView($searchItem_ids);
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        include 'pagination.php';
        ?>

    </div>
</div>

<?php include 'footer.php' ?>

</body>
</html>