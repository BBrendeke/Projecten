<?php
include 'header.php';
//include 'pdo-functies.php';
include 'sessie-functies.php';
require_once 'db.php';

?>
<!doctype html>
<html lang="en">
<body>

<div class="mb-2">
    <div class="container-fluid">
        <div class="container">
            <form method="get" action="dashboard.php" class="form-inline">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDash"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse ml-lg-3" id="navbarDash">


                        <ul class="navbar-nav ml-auto">


                            <li class="nav-item m-1 " >
                                <input type="submit" value="Gegevens" name="Gegevens"class="btn btn-primary gekleurdeknop" >
                            </li>
                            <li class="nav-item m-1">
                                <input type="submit" value="Biedingen" name="Biedingen" class="btn btn-primary gekleurdeknop">
                            </li>
                            <li class="nav-item m-1">
                                <input type="submit" value="Veilingen" name="Veilingen" class="btn btn-primary gekleurdeknop">
                            </li>
                            <?php
                                if(adminRights()==true){
                                    echo "<li class='nav-item m-1'>" .
                                        "<input type='submit' value='Gebruiker beheer' name='Gebruiker-beheer' 
                                                   class='btn btn-primary gekleurdeknop'>" .
                                        "</li>";
                                    echo "<li class='nav-item m-1'>" .
                                        "<input type='submit' value='Rubrieken beheer' name='rubrieken' 
                                                   class='btn btn-primary gekleurdeknop'>"  .
                                        "</li>";
                                }
                            ?>

            </form>

            <form method="post" action="sessie-functies.php">
                <input type="submit" value="uitloggen" name="uitloggen" class="btn btn-primary gekleurdeknop m-1 mr-3">
            </form>

            </nav>
        </div>
    </div>
</div>


<?php
if(!isset($_SESSION['ingelogd'])) {
?>
    <script type= "text/javascript">
    window.location.href = 'http://iproject4.icasites.nl/login-pagina.php';
    </script>
<?php
}else{
    if (isset($_GET['Gegevens'])) {                                              // dashboard gegevens inzien
        include 'gegevens-pagina.php';
    } elseif (isset($_GET['aanpassen'])) {                                         // dashboard gegevens aanpassen
        include 'gegevens-veranderen-pagina.php';
    } elseif (isset($_GET['Biedingen'])) {                                         // dashboard biedingen inzien
        include 'biedingen-pagina.php';
    } elseif (isset($_GET['Veilingen'])) {                                         // dashboard veilingen inzien en verkoper worden
        include 'veilingen-pagina.php';
    } elseif (isset($_GET['Gebruiker-beheer'])) {                                 // dashboard gebruiker beheer
        include 'gebruiker-beheer-pagina.php';
    } elseif (isset($_GET['rubrieken'])) {                                         // dashboard rubrieken inzien
        include 'rubrieken-pagina.php';
    } else {
        include 'gegevens-pagina.php';                                          // dashboard gegevens inzien - standaard
    };

}


?>
















<?php include 'footer.php';?>
</body>
</html>