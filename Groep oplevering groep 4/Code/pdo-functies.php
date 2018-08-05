<?php

require_once 'db.php';
/**
 * @return $item, array van alle item ids.
 *
 * Haalt alle item ids op.
 */
function getItemId(){
    global $dbh;

    $query = $dbh->query("EXEC getItemId");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;
}
/**
 * @return $item, array van alle item ids.
 * @param $page, geeft de pagenummer mee
 * Haalt alle item ids op.
 */
function getItemIds($page){
    global $dbh;

    $query = $dbh->query("EXEC getItemIds @page='$page'");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;
}

/**
 * @return $item, array van alle item ids.
 * Haalt alle item ids op.
 */
function getItemsByCategory($id){
    global $dbh;

    $query = $dbh->query("EXEC getItemsByCategory @rubriekLaagsteNiveau='$id'");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;
}

/**
 * @param $mailadres, mailadres van een geblacklistte gebruiker.
 * @return $user, geeft een mailadres als deze bekend is in de blacklist.
 *
 * Kijkt of de gebruiker is geblacklist.
 */
function blacklist($mailadres){
    global $dbh;

    $query = $dbh->query("EXEC addBlacklist @mailadres = '$mailadres'");

    while($row = $query->fetch(PDO::FETCH_BOTH)){
        $user = $row['mailadres'];
    }
    return $user;
}

/**
 * @param $userMail, mailadres van de gebruiker die moet worden geblacklist.
 *
 * Zet de gebruikers mailadres in de blacklist.
 */
function blacklistUser($userMail){
    global $dbh;

    $stmt = $dbh->prepare("insert into blacklist(mailadres) values(:mail)");

    $stmt->bindParam(':mail',$userMail);

    $stmt->execute();
}

/**
 * @return $item, een array van items die de ingelogde gebruiker heeft aangeboden.
 *
 * Haalt alle item ids op van de ingelogde gebruiker.
 */
function getUserItems(){
    global $dbh;
    $userName = $_SESSION['ingelogd'];

    $query = $dbh->query("SELECT voorwerp_id FROM veiling WHERE verkoper = '$userName'");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;
}

/**
 * @return $seller, bevat verkoper als ingelogde gebruiker verkoper is.
 *
 * Haalt op of de ingelogde gebruiker verkoper is.
 */
function getVerkoperStatus(){
    global $dbh;
    $userName = $_SESSION['ingelogd'];

    $query = $dbh->query("SELECT verkoper FROM gebruiker WHERE gebruikersnaam = '$userName'");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $seller = $row['verkoper'];

    }

    return $seller;

}

/**
 * @return $user, array gebruikersnaam en mailadres van opgevraagde gebruiker.
 *
 * Zoekt in de database op gerbuikersnamen die op de ingevoerde lijken.
 */
function getUsers(){
    global $dbh;
    $gebruikersnaam = $_POST['user'];

    $query = $dbh->query("SELECT gebruikersnaam, mailadres FROM gebruiker WHERE gebruikersnaam like '%$gebruikersnaam%' 
                                   AND beheerder = 0");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $users[] = $row;
    }
    if(!empty($users)) {
        return $users;
    }
}

/**
 * @return $item, items waar de gebruiker op heeft geboden.
 *
 * Zoekt alle voorwerpen op waar de ingelogde gebruiker op geboden heeft, en geeft alleen het hoogste van die gebruiker
 * op dat voorwerp terug.
 */
function getUserBidItems(){
    global $dbh;
    $gebruikersnaam = $_SESSION['ingelogd'];

    $query = $dbh->query("SELECT voorwerp_id, MAX(bodbedrag) FROM bod WHERE gebruikersnaam = '$gebruikersnaam'
                                   GROUP BY voorwerp_id");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;

}


/**
 * @return $userInfo, account gegevens van de gebruiker.
 *
 * Vraagd de gegevens van de ingelogde gebruiker op.
 */
function getUsersInformation(){
    global $dbh;
    $gebruikersnaam = $_SESSION['ingelogd'];

    $query = $dbh->query("SELECT * FROM gebruiker WHERE gebruikersnaam='$gebruikersnaam'");

    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $userInfo = $row;
    }
    return $userInfo;

}

/**
 * @return $sellerInfo, verkoop gegevens.
 *
 * Geeft verkopers informatie terug van de ingelogde gebruiker.
 */
function getVerkopersInformation(){
    global $dbh;
    $gebruikersnaam = $_SESSION['ingelogd'];
    $sellerInfo = "";
    $query = $dbh->query("SELECT * FROM verkoper WHERE gebruikersnaam='$gebruikersnaam'");

    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $sellerInfo = $row;
    }
    return $sellerInfo;

}

/**
 * @return $admin, geeft aan of de ingelogde gebruiker beheerder is.
 *
 * Geeft true terug als de ingelogde gebruiker beheerder is.
 */
function adminRights(){
    global $dbh;
    if(isset($_SESSION['ingelogd'])) {
        if ($_SESSION['ingelogd'] != null) {
            $gebruikersnaam = $_SESSION['ingelogd'];
        }


        $query = $dbh->query("SELECT beheerder FROM gebruiker WHERE gebruikersnaam = '$gebruikersnaam'");
        while ($row = $query->fetch(PDO::FETCH_BOTH)) {
            $admin = $row['beheerder'];
            if ($admin == 1) {
                return $admin = true;
            } else {
                return $admin = false;
            }
        }
    }
}

/**
 * @return $item, geeft array terug van item ids.
 *
 * Geeft populare veilingen terug, waar door veel mensen op geboden wordt.
 */
function getPopularItems() {
    global $dbh;

    $query = $dbh->query("EXEC getPopularItems");
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];
    }
    return $item;
}

/**
 * @return $item, array van items.
 *
 * Zoekt items op die bijna aflopen.
 */
function getLastItems() {
    global $dbh;

    $query = $dbh->query("EXEC getLastItems");
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];
    }
    return $item;
}

/**
 * @return $item, aantal items in de database.
 *
 * Zoekt items op die bijna aflopen.
 */
function getAantalItems() {
    global $dbh;

    $query = $dbh->query("EXEC getAantalItems");
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item = $row['aantal'];
    }
    return $item;
}

/**
 * @param $itemId, het id van de gewenste veiling.
 * @return $item, informatie van de gewenste veiling.
 *
 * Geeft informatie van de opgevraagde veiling terug.
 */
function getDetails($itemId) {
    global $dbh;

    $query = "EXEC getDetails @itemId = $itemId";
    $item = $dbh->query($query);
    return $item->fetch();
}

/**
 * @param $itemId, id van het gevraagde item.
 * @return $bids, boden op het gevraagde item.
 *
 * Selecteerd de top 5 hoogste boden op het gevraagde item.
 */
function getBids($itemId) {
    global $dbh;

    $query = "EXEC getBIDS @itemId = $itemId";
    $bids = $dbh->query($query);

    return $bids;
}

/**
 * @param $item_id, id van het gevraagde item.
 * @return $title, titel van het gevraagde item.
 *
 * Haalt de titel op van het gevraagde item.
 */
function getTitle($item_id){
    global $dbh;

    $query = $dbh->query("EXEC getTitle @itemId = $item_id");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $title = $row['titel'];
    }
    return $title;
}

/**
 * @param $item_id, id van het gevraagde item.
 * @return $item_image, alle afbeeldingen van het gevraagde item.
 *
 * Haalt alle afbeeldingen op van het gevraagde item.
 */
function getImage($item_id){
    global $dbh;
    $item_image = array();
    $query = $dbh->query("EXEC getImage @itemId = $item_id");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item_image[] = $row['filenaam'];
    }

    return $item_image;
}

/**
 * @param $item_id, id van het gevraagde item.
 * @return $date, eind datum van het gevraagde item.
 *
 * Geeft de einddatum van het gevraagde item.
 */
function getEndDate($item_id){
    global $dbh;

    $query = $dbh->query("SELECT looptijd_eind FROM veiling WHERE voorwerp_id = '$item_id'");

    $date = "";
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $date = $row['looptijd_eind'];
    }

    $dateTime = new DateTime($date);

    return $dateTime;
}


function getItemDescription($item_id){
    global $dbh;
    $data = $dbh->query("EXEC getItemDescription @itemId = $item_id");
    $row = $data->fetch(PDO::FETCH_BOTH);

    $description = $row['beschrijving'];

    return $description;
}

/**
 * @param $item_id, id van het gevraagde item.
 * @return $highestBid, hoogste bod op item.
 *
 * Geeft het hoogste bod terug van het gevraagde item.
 */
function getHighestBid($item_id){
    global $dbh;

    $query = $dbh->query("EXEC getHighestBid @itemId = $item_id");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $highestBid = $row[0];
    }

    return $highestBid;
}

/**
 * @return $voorwerp_id, het hoogste voorwerp id.
 *
 * Haalt het hoogste voorwerp id op.
 */
function getHighestVoorwerp_id(){
    global $dbh;

    $query = $dbh->query("EXEC getHighestVoorwerp_id");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $voorwerp_id = $row[0];

    }

    return $voorwerp_id;
}

/**
 * @param $cat_id, id van het gevraagde item.
 * @return $name, de naam van de rubriek.
 *
 * Haalt categorie naam op.
 */
function getName($cat_id){
    global $dbh;

    $query = $dbh->query("EXEC getName @catId = $cat_id");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $name = $row['rubrieknaam'];
    }
    return $name;
}

/**
 * @param $item_ids, array van item ids die opgevraagd worden.
 *
 * Geeft alle regels aan gegevens van elk gevraagd id terug. Deze worden meteen weergegeven.
 */
function getItemsTable($item_ids) {

    foreach ($item_ids as $item_id) {
        $title = getTitle($item_id);
        $price = number_format(getHighestBid($item_id), 2, ',', '.');

        echo "<tr>";
            echo "<th scope='row'><a href='detail-pagina.php?id=". $item_id . "'>". $title . "</a></th>";
            echo "<td>€ " . $price . "</td>";
            echo "<td><img id='" . $item_id . "' class='delete' src='icons/si-glyph-delete.svg' width='16px' height='16px'></td>";
        echo "</tr>";
    }

}

/**
 * @param $itemId, id van gevraagd item.
 * @return $bid, het bod van op het gevraagde item van de gebruiker.
 *
 * Geeft het hoogste bod terug wat de gebruiker op een bod heeft geplaatst.
 */
function userBid($itemId){
    global $dbh;
    $user = $_SESSION['ingelogd'];

    $query = $dbh->query("SELECT MAX(bodbedrag) FROM bod WHERE gebruikersnaam = '$user' 
                                   AND voorwerp_id = '$itemId'");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $bid = $row[0];

    }
    return $bid;
}

/**
 * @param $itemId, id van het gevraagde item.
 * @return string, is een class van bootstrap.
 *
 * Geeft een groene text kleur terug als de gebruiker het hoogste bod heeft op een item.
 */
function biddingTextColor($itemId){
    if(stripos($_SERVER['REQUEST_URI'], 'dashboard.php')){
        if(getHighestBid($itemId)==userBid($itemId)){
            return "text-info";
        }else{
            return "text-danger";
        }
    }

}

/**
 * @param $item_ids, array van item ids die weergegeven moeten worden.
 *
 * Zet voor elk item een blokje neer met daarin basis gegevens en foto van dit voorwerp.
 */
function itemView($item_ids)
{
    foreach ($item_ids as $item_id) {
        $title = getTitle($item_id);
        if(!isset(getImage($item_id)[0])){
            $image = "images/geen-foto.jpg";
        }else {
            $image = getImage($item_id)[0];
        }
        $date = getEndDate($item_id);

        $textColor = biddingTextColor($item_id);


        $description = getItemDescription($item_id);
        if(!empty(getHighestBid($item_id))) {
            $price = number_format(getHighestBid($item_id), 2, ',', '.');
        }else{
            $price = number_format(getDetails($item_id)['startprijs'], 2, ',', '.');
        }
        //var_dump($datums);

        echo "<div class='col-md-3 col-sm-6'>" .
                "<a href='http://iproject4.icasites.nl/detail-pagina.php?id=" . $item_id . "'>" .
                "<div class='service-box d-flex'>" .
                    "<div class='service-icon grey'>" .
                        "<div class='front-content'>" .
                            "<div class='d-flex flex-column'>" .
                                "<img class='mb-2 rounded img img-fluid overzichpaginafoto mt-5' src='" . $image . " ' alt='" . $title . "'>" .
                                "<h3>" . $title . "</h3>" .
                                "<p class=' " . $textColor . "'>€ " . $price . "</p>" .



                            "</div>" .

                            "<div id='$item_id' data-countdown='".$date->format('Y/m/d')."'>" .

                            "</div>" .
                        "</div>" .
                    "</div>" .

                    "<div class='service-content'>" .
                        "<h3>Beschrijving</h3>" .
                        "<p>" . $description . "</p>" .
                    "</div>" .
                "</div>" .
                "</a>" .
            "</div>";

    }
}

/*function getOldItems(){
    global $dbh;

    $query = $dbh->query("EXEC getOldItems");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $item[] = $row['voorwerp_id'];

    }

    return $item;
}*/

/**
 * @param $min, minimale waarde.
 * @param $max, maximale waarde.
 * @return $min + $rnd, minimale waarde plus afgeronde waarde.
 *
 * Genereert een token op basis van de invoer velden.
 */
function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if($range < 0) return $min;
        $log = log($range,2);
        $bytes = (int) ($log / 8) + 1;
        $bits = (int) $log + 1;
        $filter = (int) (1 << $bits) -1;
        do{
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;
        } while($rnd >= $range);
        return $min + $rnd;
}

/**
 * @param $length, de gewenste lengte van de token, deze wordt nu overschreven met 32 maar kan aangepast worden voor
 * uitbreid mogelijkheden.
 * @return $token, de gegeneerde token.
 *
 * Geeft een token terug.
 */
function getToken($length = 32){
    $token = "";
    $codeAlphabet  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    for($i=0; $i<$length; $i++){
        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}

/**
 * @param $mail, het mail adres waar je op wilt checken.
 * @return bool of $mail, als het mailadres wordt gevonden wordt deze terug gegevens, anders is het false.
 *
 * Checked of mailadres voorkomt in de database.
 */
function checkValidity($mail){
    global $dbh;
    $result = "";
    $query = $dbh->query("Select mailadres FROM gebruiker WHERE mailadres = '$mail'");
    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $result = $row['mailadres'];
    }
    if(empty($result)){
        return false;
    }else{
        return $mail;
    }
}

/**
 * @param $token, de opgegeven token.
 * @param $mail, mailadres van opvrager.
 * @return bool, true op moment dat de token klopt.
 *
 * Checked of de opgegeven token klopt.
 */
function checkToken($token)
{
    global $dbh;

    $query = $dbh->query("SELECT token  FROM token WHERE token = '$token'");
    $query->fetch(pdo::FETCH_BOTH);
    $result = $query;

    if(empty($result))
    {
        return false;
    }else{
        return true;
    }
}

/**
 * @param $voorwerp_id, het id van het opgevraagde voorwerp.
 * @return $row, bevat het rubrieknummer.
 *
 * Geeft het laagste rubrieknummer terug waar een voorwerp in zit.
 */
function getRubriekNumber($voorwerp_id){
    global $dbh;
    $data = $dbh->query("select rubriekLaagsteNiveau from rubriek where voorwerp_id = $voorwerp_id");
    $row = $data->fetch();
    return $row[0];
}

/*
function getRubriekName($rubriekNumber){
    global $dbh;
    $data = $dbh->query("select rubrieknaam from rubrieken where rubrieknummer = $rubriekNumber");
    $row = $data->fetch();
    return $row;
}*/

/**
 * @param $catID, id van opgevraagde categorie.
 * @return $subCatIds, array van alle subcategorieën van de opgevraagde categorie.
 *
 * Geeft subcategorieën terug van de opgevraagde categorie.
 */
function getSubCats($catID){
    global $dbh;
    $querySubCat = $dbh->query("SELECT rubrieknummer FROM rubrieken WHERE parent = '$catID'");
    $subCatIds = "";
    while($rowSubCat = $querySubCat->fetch(PDO::FETCH_BOTH)) {
        $subCatIds[] = $rowSubCat['rubrieknummer'];
    }
    return $subCatIds;
}

/**
 * @param $catID, id van gevraagde categorie.
 * @return $item_ids, array van items in gevraagde categorie.
 *
 * Geeft alle items terug in de gevraagde categorie.
 */
function getCatItem($catID){
    global $dbh;
    $queryItem = $dbh->query("SELECT voorwerp_id FROM Rubriek WHERE rubriekLaagsteNiveau = '$catID'");
    $item_ids = "";
    while($rowItem = $queryItem->fetch(PDO::FETCH_BOTH)) {
        $item_ids[] = $rowItem['voorwerp_id'];
    }

    return $item_ids;
}

/**
 * @return $questions, array van vragen
 *
 * Haalt veiligheidsvragen op.
 */
function getQuestions(){
    global $dbh;
    $query = $dbh->query("SELECT vraag FROM vraag");
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $questions[] = $row['vraag'];
    }
    return $questions;
}


/**
 * @param $searchItem, invoer van zoekveld.
 * @param $page, op welke pagina je bevind
 * @return $searchItem_ids, alle voorwerpen met zoekterm in hun titel.
 *
 * Haalt alle voorwerpen op met in de titel de zoekterm.
 */
function getSearchTitle($searchItem, $page){
    global $dbh;
    $queryTitle = $dbh->query("EXEC getSearchItems @item='$searchItem' , @page='$page'");
    while($rowTitle = $queryTitle->fetch(PDO::FETCH_BOTH)) {
        $searchItem_ids[] = $rowTitle['voorwerp_id'];


    }

    return $searchItem_ids;
}

function getAantalSearchTitle($searchItem){
    global $dbh;
    $queryTitle = $dbh->query("EXEC getAantalSearchItems @item='$searchItem'");
    while($rowTitle = $queryTitle->fetch(PDO::FETCH_BOTH)) {
        $searchItem_ids = $rowTitle['aantal'];


    }

    return $searchItem_ids;
}

/**
 * @param $searchItem, invoer van zoekveld.
 * @return $seachCat_ids, alle categorieën met zoekterm in hun naam tot een subcategorie diep.
 *
 * Haalt alle categorieën met zoekterm in hun naam tot een subcategorie diep op.
 */
function getSearchCat($searchItem){
    global $dbh;
    $queryCat = $dbh->query("SELECT rubrieknummer FROM rubrieken WHERE rubrieknaam LIKE '%$searchItem%' 
                                      AND (parent = -1 OR parent in (SELECT rubrieknummer	FROM rubrieken WHERE Parent = -1))");

    while($rowCat = $queryCat->fetch(PDO::FETCH_BOTH)) {
        $searchCat_ids[] = $rowCat['rubrieknummer'];
    }
    return $searchCat_ids;
}


/*
 * De onderstaande functies hallen alle items binnen alle subcategorieën van een hoofdcategorie op.
 * Dit dient als een overzicht, en kan je daarna verder soteren door op de categorieën zelf te klikken.
 *
 * Deze zijn helaas niet uitgewerkt ivm tijdsnood, in de toekomst kunnen deze worden geïmplementeerd.
 *
function getSubCatsIds($catId){

    $allSubCatIds = subCatIdsSecond($catId) + subCatIdsThird($catId) + subCatIdsForth($catId);

    return $allSubCatIds;
}

function subCatIdsForth($catId){
    global $dbh;
    $query = $dbh->query("
    if exists(
    select d.rubrieknaam as forth 
    FROM rubrieken r
    JOIN rubrieken z ON r.parent = z.rubrieknummer
    JOIN rubrieken b ON r.rubrieknummer = b.parent
    JOIN rubrieken c ON b.rubrieknummer = c.parent
    JOIN rubrieken d ON c.rubrieknummer = d.parent)
    BEGIN 
        select d.rubrieknummer as forth
        FROM rubrieken r
        JOIN rubrieken z ON r.parent = z.rubrieknummer
        JOIN rubrieken b ON r.rubrieknummer = b.parent
        JOIN rubrieken c ON b.rubrieknummer = c.parent
        JOIN rubrieken d ON c.rubrieknummer = d.parent 
        WHERE r.rubrieknummer = $catId
    ORDER BY r.rubrieknaam ASC
    END
    ");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $subCatIdsForth[] = $row['forth'];
    }
    return $subCatIdsForth;
}

function subCatIdsThird($catId){
    global $dbh;
    $query = $dbh->query("
    if exists(
    select c.rubrieknaam as third
    FROM rubrieken r
    JOIN rubrieken z ON r.parent = z.rubrieknummer
    JOIN rubrieken b ON r.rubrieknummer = b.parent
    JOIN rubrieken c ON b.rubrieknummer = c.parent)
    BEGIN 
        select c.rubrieknummer as third
        FROM rubrieken r
        JOIN rubrieken z ON r.parent = z.rubrieknummer
        JOIN rubrieken b ON r.rubrieknummer = b.parent
        JOIN rubrieken c ON b.rubrieknummer = c.parent
        WHERE r.rubrieknummer = $catId
        ORDER BY r.rubrieknaam ASC
    END ");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $subCatIdsThird[] = $row['third'];
    }
    return $subCatIdsThird;
}

function subCatIdsSecond($catId){
    global $dbh;
    $query = $dbh->query("
    if exists(
    select b.rubrieknaam as second
    FROM rubrieken r
    JOIN rubrieken z ON r.parent = z.rubrieknummer
    JOIN rubrieken b ON r.rubrieknummer = b.parent)
    BEGIN 
	    select b.rubrieknummer as second
	    FROM rubrieken r
	    JOIN rubrieken z ON r.parent = z.rubrieknummer
	    JOIN rubrieken b ON r.rubrieknummer = b.parent
	    WHERE r.rubrieknummer = $catId
        ORDER BY r.rubrieknaam ASC
    END ");

    while($row = $query->fetch(PDO::FETCH_BOTH)) {
        $subCatIdsSecond[] = $row['second'];
    }
    return $subCatIdsSecond;
}*/