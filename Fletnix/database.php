<?php
$hostname = "(local)";
$dbname = "FLETNIX_DOCENT";
$username = "sa";
$pw = "dbrules";
try {
    $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;
			ConnectionPooling=0", "$username", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die ( "Fout met de database: {$e->getMessage()} " );
}

?>