<?php
ini_set('display_errors', 1);
include 'pdo-functies.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = $_POST['id'];
    if (isset($_POST['value'])) {
        $value = $_POST['value'];
    }
}

switch ($action) {
    case 'deleteItem':
        deleteItem($id);
        break;
    case 'toggleVisibility':
        toggleVisibility($id);
        break;
    case 'updateName':
        updateName($id, $value);
        break;
    case 'addChild':
        addChild($id);
        break;
    case 'endAuction':
        endAuction($id);
        break;
    default:
        die('No other functions..');
        break;
}

function deleteItem($id) {
    global $dbh;

    $stmt = $dbh->query("DELETE FROM veiling WHERE voorwerp_id = '$id'");
    $stmt->execute();

    $stmt2 = $dbh->query("DELETE FROM rubriek WHERE voorwerp_id = '$id'");
    $stmt2->execute();
}

function toggleVisibility($id) {
    global $dbh;

    if (isActive($id)) {
        $stmt = $dbh->prepare("UPDATE rubrieken SET active = 0 WHERE rubrieknummer = '$id'");
        $stmt->execute();
    } else {
        $stmt = $dbh->prepare("UPDATE rubrieken SET active = 1 WHERE rubrieknummer = '$id'");
        $stmt->execute();
    }
}

function isActive($id) {
    global $dbh;

    $stmt = $dbh->query("SELECT active FROM rubrieken WHERE rubrieknummer = '$id'");
    $row = $stmt->fetch();

    if ($row[0] == 1) {
        return true;
    } else {
        return false;
    }
}

function updateName($id, $value) {
    global $dbh;

    $stmt = $dbh->prepare("UPDATE rubrieken SET rubrieknaam = '$value' WHERE rubrieknummer = '$id'");
    $stmt->execute();
}

function addChild($id) {
    global $dbh;

    $highestId = highestId();
    $highestId++;

    $stmt = $dbh->prepare("INSERT INTO rubrieken (rubrieknummer, rubrieknaam, parent, active) VALUES ('$highestId', 'Geef naam..', '$id', 1)");
    $stmt->execute();
}

function highestId() {
    global $dbh;

    $stmt = $dbh->prepare("SELECT MAX(rubrieknummer) FROM rubrieken");
    $stmt->execute();
    $row = $stmt->fetch();

    return $row[0];
}

function endAuction($id) {
    $seller = getSellerInfo($id);
    $buyer = getBuyerInfo($id);

    if (!hasBids($id)) {
        deleteItem($id);

        $to      = $seller['mailadres'];
        $subject = 'Veiling verlopen';
        $message = 'Uw veiling is verlopen zonder dat erop geboden is. De veiling is verwijderd.';
        $headers = 'From: eenmaalandermaal@iproject4.nl' . "\r\n";
        imap_mail($to, $subject, $message, $headers);

    } else {
        if (isAuctionActive($id)) {
            closeAuction($id);
            $to      = $seller['mailadres'];
            $subject = 'Veiling verlopen';
            $message = "Uw veiling is verlopen en het hoogste bod is ".$buyer['bodbedrag'].". Het emailadres van de hoogste bieder is: ".$buyer['mailadres'].".";
            $headers = 'From: eenmaalandermaal@iproject4.nl' . "\r\n";
            imap_mail($to, $subject, $message, $headers);

            $to      = $buyer['mailadres'];
            $subject = 'Veiling gewonnen!';
            $message = "U hebt een veiling gewonnen. U kunt contact opnemen met de verkoper op mailadres ".$seller['mailadres'].".";
            $headers = 'From: eenmaalandermaal@iproject4.nl' . "\r\n";
            imap_mail($to, $subject, $message, $headers);
        }
    }

}

function getSellerInfo($id) {
    global $dbh;

    $stmt = $dbh->query("select verkoper from veiling where voorwerp_id = '$id'");
    $row = $stmt->fetch();
    $sellerUsername = $row['verkoper'];

    $stmt2 = $dbh->query("select * from gebruiker where gebruikersnaam = '$sellerUsername'");
    $row2 = $stmt2->fetch();

    return $row2;
}

function getBuyerInfo($id) {
    global $dbh;

    $stmt = $dbh->query("SELECT gebruikersnaam, bodbedrag FROM Bod WHERE bodbedrag = (SELECT max(bodbedrag) FROM BOD WHERE voorwerp_id = '$id')");
    $row = $stmt->fetch();
    $buyerUsername = $row['gebruikersnaam'];
    $highestBid = $row['bodbedrag'];

    $stmt2 = $dbh->query("select * from gebruiker where gebruikersnaam = '$buyerUsername'");
    $row2 = $stmt2->fetch();
    $row2['bodbedrag'] = $highestBid;

    return $row2;
}

function closeAuction($id) {
    global $dbh;

    $stmt = $dbh->prepare("UPDATE veiling SET gesloten = 1 WHERE voorwerp_id = '$id'");
    $stmt->execute();
}

function isAuctionActive($id) {
    global $dbh;

    $stmt = $dbh->query("SELECT gesloten FROM veiling WHERE voorwerp_id = '$id'");
    $row = $stmt->fetch();

    if ($row[0] == 0) {
        return true;
    } else {
        return false;
    }
}

function hasBids($id) {
    global $dbh;

    $stmt = $dbh->query("SELECT 1 FROM Bod WHERE voorwerp_id = '$id'");
    $row = $stmt->fetch();

    if ($row) {
        return true;
    } else {
        return false;
    }
}