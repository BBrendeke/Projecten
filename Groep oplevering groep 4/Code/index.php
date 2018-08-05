
<?php
// header
include 'header.php';
require_once 'pdo-functies.php  ' ?>

<!--De slider  -->
<div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/images/homepage1.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/images/homepage3.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/images/homepage7.jpg" alt="Third slide">
            </div>
        </div>
    </div>
</div>

<!-- Hier komt de code voor veilingen neer te zetten -->

<div class="container-fluid justify-content-center">
    <hr>
    <h1 class="mainText"> Populaire veilingen</h1>
</div>
    <div class="container">
        <div class="row">
            <?php $popularBods = getPopularItems();
            itemView($popularBods);
            ?>
        </div>
    </div>


<div class="container-fluid justify-content-center">
    <hr>
    <h1 class="mainText"> Laatste kans</h1>
</div>


    <div class="container">
        <div class="row">
            <?php $lastChance = getLastItems();
            itemView($lastChance);
            ?>
        </div>
    </div>




<!-- Footer -->
<?php include 'footer.php'; ?>


