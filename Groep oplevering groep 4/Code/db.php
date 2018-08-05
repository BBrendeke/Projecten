<?php

//ini_set('display_errors', 1);

$hostname   =   "mssql2.iproject.icasites.nl";
$database   =   "iproject4";
$username   =   "iproject4";
$password   =   "AE5xwVEZ3W";

try {
    $dbh = new PDO ("sqlsrv:Server=$hostname; Database=$database; ConnectionPooling=0","$username","$password");
} catch (PDOException $e) {
    echo $e->getMessage();
}