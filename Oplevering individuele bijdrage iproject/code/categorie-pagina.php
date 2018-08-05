<?php
ini_set('display_errors', 1);
include 'pdo-functies.php';

$catID = $_GET['catId'];

$item_ids = getCatItem($catID);
$cat_name = getName($catID);
$subCatIds = getSubCats($catID);


?>

<!doctype html>
<html lang="en">
<link href="css/test.css" rel="stylesheet">

<body>

<?php include 'header.php' ?>

<nav aria-label="breadcrumb">
    <ol id="breadcrumbs"></ol>
</nav>

<?php

    if(!empty($subCatIds)){

    echo "<h4 class=\"text-center\">Subcategorieën in \"$cat_name\"</h4>";
    echo "<div class=\"form-inline justify-content-center\">";

    foreach ($subCatIds as $subCatId){

        $name = getName($subCatId);
        echo "<a href=\"http://iproject4.icasites.nl/categorie-pagina.php?catId=$subCatId\">
                      <button type=\"submit\" class=\"gekleurdeknop m-2\"\">$name</button></a>";
    }
    echo "</div>";
}
        if(empty($item_ids)){
            echo "<h5 class=\"text-center\">Geen actieve veilingen gevonden in \"$cat_name\".</h5>";
        }else {
            echo "<h4 class=\"text-center\">Veilingen in $cat_name.</h4>";
            echo "<div class=\"row justify-content-center\">";
            echo "<div class=\"container\">";
            echo "<div class=\"row\">";
            itemView($item_ids);
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        ?>


<?php include 'footer.php' ?>

</body>
</html>
