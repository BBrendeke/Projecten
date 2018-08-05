

<?php
require_once('php_functies/database.php');

$user = $_POST['user'];
$password = $_POST['password'];

$stmt = $con->query("SELECT customer_mail_address, password FROM Customer WHERE customer_mail_address='{$user}' AND"
					."password='{$password}'");

if($user === customer_mail_address and $password === password){
  echo submit
}else{
  echo "Ongeldige invoerwaarde."
}

echo "<br><br><font size='12' color='black'>Je bent nu ingelogd als: <strong>$user</strong></font>";
?>
