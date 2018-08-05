<?php

$hostname = "mssql2.iproject.icasites.nl"; 	// naam van server
$dbname = "iproject4";    	// naam van database
$username = "iproject4";      	// gebruikersnaam
$pw = "AE5xwVEZ3W";      	// password

$dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname;
			ConnectionPooling=0", "$username", "$pw");



        echo "<div class=\"col-md-3 col-sm-6\">
<a href=\"http://iproject4.icasites.nl/detail-pagina.php?id=$item_id\">
    <div class=\"service-box\">

        <div class=\"service-icon grey\">
        <div class=\"front-content\">
            <img class=\"mb-2 rounded img w-100 img-fluid\" src='" . $image . "' alt=" . $title . ">
            <h3>$title</h3>

            <p class='timer' id=\"demo\"> Deadline:</p>
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date(\"$datum\").getTime();

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now an the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id=\"demo\"
                    document.getElementById(\"demo\").innerHTML = days + \"d \" + hours + \"h \"
                    + minutes + \"m \" + seconds + \"s \";

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(\"demo\").innerHTML = \"EXPIRED\";
                    }
                }, 1000);
            </script>
        </div>
    </div>
    <div class=\"service-content\">
        <h3> Beschrijving</h3>
        <p>$description</p>
    </div>
    </div>
</a>
</div>";
    

?>