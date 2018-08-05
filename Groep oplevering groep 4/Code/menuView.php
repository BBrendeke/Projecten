<?php

require_once 'db.php';

/**
 * @return $item, array van items.
 *
 * Zoekt categorieen zonder parents voor in de header.
 */
function getParentCategories() {
    global $dbh;

    $items = "";

    $stmt = $dbh->query("EXEC getParentCategories");
    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
        if ($row['active'] == 1) {
            $items.= "<a class='dropdown-item' href='categorie-pagina.php?catId=".$row['rubrieknummer']."'>" . $row['rubrieknaam'] . "</a>";
        }
        /*$items[] = array(
            'id'    =>      $row['rubrieknummer'],
            'naam'  =>      $row['rubrieknaam']
        );*/
    }

    return $items;
}