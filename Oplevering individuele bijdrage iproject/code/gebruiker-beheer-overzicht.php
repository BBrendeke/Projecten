<?php
include 'header.php';
require_once 'db.php';
include 'pdo-functies.php';

$users = getUsers();

?>
<ul class="offset-2 userList">
<?php
if(!empty($users)) {

    foreach ($users as $user){
        $userName = $user['gebruikersnaam'];
        $userMail = $user['mailadres'];
        echo "<li class='form-inline m-2'<h5>Gebruikersnaam: $userName <br> Mailadres: $userMail</h5>
                <form action='gebruiker-beheer-verwijderen.php' method='post' 
                onsubmit='confirm(\"Weet u zeker dat u deze gebruiker wilt verwijderen? Dit is niet terug te draaien!\")
                 setTimeout(function() { window.location.reload(); }, 5)'>
                    <input type='hidden' id='userMail' name='userMail' value='$userMail'/>
                    <button class='ml-1 btn gekleurdeknop btn-sm' type='submit'>Gebruiker verwijderen</button>
                </form>
                
              </li>
              <div class='col-10'>
                    <hr>
              </div>";
    }
}else{
    echo "Sorry geen gebruikers actief met $gebruikersnaam in de naam.
    Klik <a href='dashboard.php?Gebruiker-beheer=Gebruiker+beheer'>hier</a> om terug te gaan";

}
?>
</ul>
<?php
    include 'footer.php';
?>
