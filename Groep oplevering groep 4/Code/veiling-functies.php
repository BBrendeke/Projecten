<?php
ini_set('display_errors', 1);
if(!isset($_SESSION)) {
    session_start();
}
include 'pdo-functies.php';
global $dbh;
require_once  'db.php';

if(isset($_POST['veilingPlaatsen'])){

    $voorwerp_id = getHighestVoorwerp_id() + 1;
    $titel = strip_tags($_POST['titel']);
    $beschrijving = strip_tags($_POST['beschrijving']);
    $rubriekLaagsteNiveau = $_POST['rubriekId'];
    $startprijs = $_POST['startprijs'];
    $looptijd = $_POST['looptijd'];
    $betalingswijze = $_POST['betalingswijze'];
    $betalingsinstructie = strip_tags($_POST['betalingsinstructie']);
    $verzendkosten = $_POST['verzendkosten'];
    $verzendinstructie = strip_tags($_POST['verzendinstructie']);
    $plaatsnaam = 'placeholder';
    $verkoper = $_SESSION['ingelogd'];
    var_dump($_SESSION['ingelogd']);
    $koper = NULL;
    $land = 'Nederland';
    $looptijd_begin = date('Y-m-d h:i:s');
    $d=strtotime("+ $looptijd days");
    $looptijd_eind = date('Y-m-d h:i:s', $d);
    $gesloten = 0;
    $conditie = strip_tags($_POST['conditie']);
    $verkoopprijs = $startprijs;

    //$datum_begin = date("Y-m-d");

    //$datum_eind = date("Y-m-d", $d);

    //$Clean = array_map('strip_tags', $_POST);
    //$_POST = array_map('strip_tags', $_POST);




    $stmt = $dbh->prepare("INSERT INTO veiling (voorwerp_id, titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, looptijd, looptijd_begin, looptijd_eind, verzendkosten, verzendinstructie, verkoper, koper, gesloten, verkoopprijs, conditie )
                            VALUES (:voorwerp_id, :titel, :beschrijving, :startprijs, :betalingswijze, :betalingsinstructie ,:plaatsnaam, :land, :looptijd, :looptijd_begin, :looptijd_eind, :verzendkosten, :verzendinstructie, :verkoper, :koper, :gesloten, :verkoopprijs, :conditie)");



/*$stmt = $dbh->prepare("EXEC uspVeilingPlaatsen VALUES(:voorwerp_id, :titel, :beschrijving, :startprijs, :betalingswijze,
                                                             :betalingsinstructie, :plaatsnaam, :land, :looptijd, :looptijd_begin,
                                                             :looptijd_eind, :verzendkosten, :verzendinstructie, :verkoper, :koper, :gesloten, :verkoopprijs, :conditie)
                                                             ");*/
    //var_dump($stmt);
//$stmt = $dbh->db->prepare('uspVeilingPlaatsen(:voorwerp_id, :titel,:beschrijving,:startprijs,:betalingswijze,:betalingsinstructie,:plaatsnaam,:land,:looptijd,:looptijd_begin,:looptijd_eind, :verzendkosten,:verzendinstructie,:verkoper,:koper,:gesloten,:verkoopprijs,:conditie) ');

/*
    $dbh->db->bindParam($stmt,':voorwerp_id', $dbh->$voorwerp_id);
    $dbh->db->bindParam($stmt,':titel', $dbh->$titel);
    $dbh->db->bindParam($stmt,':beschrijving', $dbh->$beschrijving);
    $dbh->db->bindParam($stmt,':startprijs', $dbh->$startprijs);
    $dbh->db->bindParam($stmt,':betalingswijze', $dbh->$betalingswijze);
    $dbh->db->bindParam($stmt,':betalingsinstructie', $dbh->$betalingsinstructie);
    $dbh->db->bindParam($stmt,':plaatsnaam', $dbh->$plaatsnaam);
    $dbh->db->bindParam($stmt,':land', $dbh->$land);
    $dbh->db->bindParam($stmt,':looptijd', $dbh->$looptijd);
    //$stmt->bindParam(':datum_begin', $datum_begin);
    //$stmt->bindParam(':datum_eind', $datum_eind);
    $dbh->db->bindParam($stmt,':looptijd_begin', $dbh->$looptijd_begin);
    $dbh->db->bindParam($stmt,':looptijd_eind', $dbh->$looptijd_eind);
    $dbh->db->bindParam($stmt,':verzendkosten', $dbh->$verzendkosten);
    $dbh->db->bindParam($stmt,':verzendinstructie', $dbh->$verzendinstructie);
    $dbh->db->bindParam($stmt,':verkoper', $dbh->$verkoper);
    $dbh->db->bindParam($stmt,':koper', $dbh->$koper);
    $dbh->db->bindParam($stmt,':gesloten', $dbh->$gesloten);
    $dbh->db->bindParam($stmt,':verkoopprijs', $dbh->$verkoopprijs);
    $dbh->db->bindParam($stmt,':conditie', $dbh->$conditie);
    $dbh->db->commit(); */


    $stmt->bindParam(':voorwerp_id', $voorwerp_id);
    $stmt->bindParam(':titel', $titel);
    $stmt->bindParam(':beschrijving', $beschrijving);
    $stmt->bindParam(':startprijs', $startprijs);
    $stmt->bindParam(':betalingswijze', $betalingswijze);
    $stmt->bindParam(':betalingsinstructie', $betalingsinstructie);
    $stmt->bindParam(':plaatsnaam', $plaatsnaam);
    $stmt->bindParam(':land', $land);
    $stmt->bindParam(':looptijd', $looptijd);
    $stmt->bindParam(':looptijd_begin', $looptijd_begin);
    $stmt->bindParam(':looptijd_eind', $looptijd_eind);
    $stmt->bindParam(':verzendkosten', $verzendkosten);
    $stmt->bindParam(':verzendinstructie', $verzendinstructie);
    $stmt->bindParam(':verkoper', $verkoper);
    $stmt->bindParam(':koper', $koper);
    $stmt->bindParam(':gesloten', $gesloten);
    $stmt->bindParam(':verkoopprijs',$verkoopprijs);
    $stmt->bindParam(':conditie', $conditie);
    $stmt->execute();
    //var_dump($stmt);

    echo "Success";




            $statement2 = $dbh->prepare("INSERT INTO rubriek (voorwerp_id, rubriekLaagsteNiveau)
                                                   VALUES (:voorwerp_id, :rubriekLaagsteNiveau)");
            $statement2->bindParam(':voorwerp_id', $voorwerp_id);
            $statement2->bindParam(':rubriekLaagsteNiveau', $rubriekLaagsteNiveau);
            $statement2->execute();
            //var_dump($rubriekLaagsteNiveau);


    for($i = 1; $i <= 3; $i++) {
        $image = 'image'.$i;
        //print_r($image);
        if (isset($_FILES[$image])) {
            $imagenumber = $i.$voorwerp_id;
            $errors = array();

            $file_size = $_FILES[$image]['size'];
            $file_tmp = $_FILES[$image]['tmp_name'];
            $file_type = $_FILES[$image]['type'];
            $file_ext = strtolower(end(explode('.', $_FILES[$image]['name'])));

            //$ext = pathinfo($_FILES[$image]['name'], PATHINFO_EXTENSION);
            
            $file_name = "images/".$imagenumber.$_FILES[$image]['name'];

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) == false) {
                $errors[] = 'extension not allowed, please choose a JPEG or PNG file.';
            }

            if ($file_size > 10000000) {
                $errors[] = 'File size must be excately 10 MB';
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file_name);

            }
            $statement = $dbh->prepare("INSERT INTO bestand (filenaam, voorwerp_id)
                                                  VALUES (:voorwerp_afbeelding,:voorwerp_id)");
            //var_dump($statement);
            $statement->bindParam(':voorwerp_id', $voorwerp_id);
            $statement->bindParam(':voorwerp_afbeelding', $file_name);
            $statement->execute();
            var_dump($statement);
            echo 'afbeedling uploaded';


        } else {
            print_r($errors);
        }
    }
    $item_id = getHighestVoorwerp_id();
    header("Location:http://iproject4.icasites.nl/detail-pagina.php?id= $item_id");

    }

?>







