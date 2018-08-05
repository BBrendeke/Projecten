<?php
$first_page = 1;
$file = $_SERVER['PHP_SELF'];

if(isset($_GET['zoek'])) {
    $searchItem = "&zoek=".strip_tags($_GET['zoek']);
}else $searchItem = "";
$last_page = $maxPages;
$curr_page = 1;
$page = "<li class='page-item'><a class='page-link' href='http://iproject4.icasites.nl/$file?page=";
$page_ending = '</a></li>';

if(isset($_GET['page'])){
    $curr_page = $_GET['page'];
}
if($curr_page <=2){
    $prev_page = 2;
    $curr_page = 3;
}
if($curr_page >= $last_page - 2){
    $curr_page = $last_page -2;
    $next_page = $last_page - 1;
}

$prev_page = $curr_page - 1;
$next_page = $curr_page + 1;

if($curr_page < 1  ){
    $curr_page = 1;
}
if($curr_page > $last_page){
    $curr_page = $last_page;
}

?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href='http://iproject4.icasites.nl/<?php echo$file?>?page=
            <?php echo $prev_page ?>' aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
        if($last_page >= 1){
        echo  $page .  $first_page . $searchItem ."'>" . $first_page . $page_ending;
        }
        if($last_page >= 4){
        if($last_page <= 5){
        $pagenr = $first_page+1;
        echo  $page .  $pagenr  . $searchItem.  "'>" . $pagenr  . $page_ending;
        }else{
        echo  $page .  $prev_page  . $searchItem.  "'>" . $prev_page  . $page_ending;
        }
        }
        if($last_page >= 3){
        if($last_page == 3){
        $pagenr = $first_page+1;
        echo  $page .  $pagenr  . $searchItem ."'>" . $pagenr  . $page_ending;
        }elseif($last_page <= 5){
        $pagenr = $first_page+2;
        echo  $page .  $pagenr  . $searchItem.  "'>" . $pagenr  . $page_ending;
        }else{
        echo  $page .  $curr_page  . $searchItem ."'>" . $curr_page  . $page_ending;
        }



        }
        if($last_page >= 5){
        if($last_page <= 5){
        $pagenr = $last_page-1;
        echo  $page .  $pagenr . $searchItem . "'>" . $pagenr  . $page_ending;
        }else{
        echo  $page .  $next_page  . $searchItem . "'>" . $next_page  . $page_ending;
        }

        }
        if($last_page >= 2) {
        echo  $page .  $last_page . $searchItem . "'>" . $last_page . $page_ending;
        }
        ?>
        <li class="page-item">
            <a class="page-link" href='http://iproject4.icasites.nl/<?php echo$file?>?page=
            <?php echo $next_page ?>' aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>


