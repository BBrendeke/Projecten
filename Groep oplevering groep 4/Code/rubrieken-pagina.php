<?php

function getTree($resultSet) {
    $results = array();

    foreach ($resultSet as $result) {
        $results[] = array(
            'rubrieknummer' => $result['rubrieknummer'],
            'rubrieknaam' => $result['rubrieknaam'],
            'parent' => $result['parent'],
            'active' => $result['active']
        );
    }

    return $results;
}

function viewCategories($results) {
    $output = "";
    foreach ($results as $key => $result) {
        $parent = $result['parent'];
        $id = $result['rubrieknummer'];
        $name = $result['rubrieknaam'];
        $active = $result['active'];
        $class = "";
        if (!$active) {
            $class = "disabled";
        }

        if ($parent == -1) {
            $output .=  "<div class='card'>" .
                            "<div class='card-header' id='heading$key'>" .
                                "<h5 class='mb-0'>" .
                                    "<button class='btn btn-link collapsed $class' data-toggle='collapse' data-target='#collapse$key' aria-expanded='true' aria-controls='collapse$key'>" . $name . "</button>" .
                                    "<input class='form-control d-none mb-2 col-8' type='text' placeholder='$name'>" .
                                    "<img src='icons/si-glyph-database-plus.svg' id='$id' class='btnIcon float-right addBtn'/>" .
                                    "<img src='icons/si-glyph-delete.svg' id='$id' class='btnIcon float-right mr-3 deleteBtn'/>" .
                                    "<img src='icons/si-glyph-edit.svg' id='$id' class='btnIcon float-right mr-3 editBtn'/>" .
                                    "<img src='icons/si-glyph-floppy-disk.svg' id='$id' class='btnIcon float-right mr-3 saveBtn'/>" .
                                "</h5>" .
                            "</div>" .
                            "<div id='collapse$key' class='collapse' aria-labelledby='heading$key' data-parent='#accordion'>" .
                                $output2 = viewCategoriesTier2($results, $id) .
                            "</div>" .
                        "</div>";
        }
    }
    return $output;
}

function viewCategoriesTier2($results, $parentId) {
    $output = "";
    foreach ($results as $key => $result) {
        $parent = $result['parent'];
        $id = $result['rubrieknummer'];
        $name = $result['rubrieknaam'];
        $active = $result['active'];
        $class = "";
        if (!$active) {
            $class = "disabled";
        }

        if ($parent == $parentId) {
            $output .=  "<div class='card'>" .
                            "<div class='card-header' id='heading$key'>" .
                                "<h5 class='mb-0'>" .
                                    "<button class='btn btn-link collapsed $class' data-toggle='collapse' data-target='#collapse$key' aria-expanded='true' aria-controls='collapse$key'><span class='ml-5'></span>" . $name . "</button>" .
                                    "<input class='form-control d-none mb-2 col-8' type='text' placeholder='$name'>" .
                                    "<img src='icons/si-glyph-database-plus.svg' id='$id' class='btnIcon float-right addBtn'/>" .
                                    "<img src='icons/si-glyph-delete.svg' id='$id' class='btnIcon float-right mr-3 deleteBtn'/>" .
                                    "<img src='icons/si-glyph-edit.svg' id='$id' class='btnIcon float-right mr-3 editBtn'/>" .
                                    "<img src='icons/si-glyph-floppy-disk.svg' id='$id' class='btnIcon float-right mr-3 saveBtn'/>" .
                                "</h5>" .
                            "</div>" .
                            "<div id='collapse$key' class='collapse' aria-labelledby='heading$key' data-parent='#collapse$key'>" .
                                viewCategoriesTier3($results, $id).
                             "</div>" .
                        "</div>";
        }
    }
    return $output;
}

function viewCategoriesTier3($results, $parentId) {
    $output = "";
    foreach ($results as $key => $result) {
        $parent = $result['parent'];
        $id = $result['rubrieknummer'];
        $name = $result['rubrieknaam'];
        $active = $result['active'];
        $class = "";
        if (!$active) {
            $class = "disabled";
        }

        if ($parent == $parentId) {
            $output .=  "<div class='card'>" .
                "<div class='card-header' id='heading$key'>" .
                "<h5 class='mb-0'>" .
                "<button class='btn btn-link collapsed $class' data-toggle='collapse' data-target='#collapse$key' aria-expanded='true' aria-controls='collapse$key'><span class='ml-5'></span><span class='ml-5'></span>" . $name . "</button>" .
                "<input class='form-control d-none mb-2 col-8' type='text' placeholder='$name'>" .
                "<img src='icons/si-glyph-database-plus.svg' id='$id' class='btnIcon float-right addBtn'/>" .
                "<img src='icons/si-glyph-delete.svg' id='$id' class='btnIcon float-right mr-3 deleteBtn'/>" .
                "<img src='icons/si-glyph-edit.svg' id='$id' class='btnIcon float-right mr-3 editBtn'/>" .
                "<img src='icons/si-glyph-floppy-disk.svg' id='$id' class='btnIcon float-right mr-3 saveBtn'/>" .
                "</h5>" .
                "</div>" .
                "<div id='collapse$key' class='collapse' aria-labelledby='heading$key' data-parent='#collapse$key'>" .
                viewCategoriesTier4($results, $id).
                "</div>" .
                "</div>";
        }
    }
    return $output;
}

function viewCategoriesTier4($results, $parentId) {
    $output = "";
    foreach ($results as $key => $result) {
        $parent = $result['parent'];
        $id = $result['rubrieknummer'];
        $name = $result['rubrieknaam'];
        $active = $result['active'];
        $class = "";
        if (!$active) {
            $class = "disabled";
        }

        if ($parent == $parentId) {
            $output .=  "<div class='card'>" .
                "<div class='card-header' id='heading$key'>" .
                "<h5 class='mb-0'>" .
                "<button class='btn btn-link collapsed $class' data-toggle='collapse' data-target='#collapse$key' aria-expanded='true' aria-controls='collapse$key'><span class='ml-5'></span><span class='ml-5'></span><span class='ml-5'></span>" . $name . "</button>" .
                "<input class='form-control d-none mb-2 col-8' type='text' placeholder='$name'>" .
                "<img src='icons/si-glyph-database-plus.svg' id='$id' class='btnIcon float-right addBtn'/>" .
                "<img src='icons/si-glyph-delete.svg' id='$id' class='btnIcon float-right mr-3 deleteBtn'/>" .
                "<img src='icons/si-glyph-edit.svg' id='$id' class='btnIcon float-right mr-3 editBtn'/>" .
                "<img src='icons/si-glyph-floppy-disk.svg' id='$id' class='btnIcon float-right mr-3 saveBtn'/>" .
                "</h5>" .
                "</div>" .
                "<div id='collapse$key' class='collapse' aria-labelledby='heading$key' data-parent='#collapse$key'>" .

                "</div>" .
                "</div>";
        }
    }
    return $output;
}

$resultSet = $dbh->query("EXEC getCategories");
$results = getTree($resultSet);

?>

<div class="container">
    <div id="accordion" class="col-md-12 p-0">

        <?php echo viewCategories($results); ?>

    </div>
</div>

<script>

    $(document).ready(function () {
        $('.deleteBtn').click(function () {
            let id = $(this).attr('id');
            $(this).parent().find(">:first-child").toggleClass('disabled');

            $.ajax({
                type: 'POST',
                url: 'test.php',
                data: {
                    id: id,
                    action: 'toggleVisibility'
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });

        $('.editBtn').click(function () {
            $(this).parent().find(">:first-child").toggleClass('d-none');
            $(this).parent().find(">:nth-child(2)").toggleClass('d-none');
        });

        $('.saveBtn').click(function () {
            let id = $(this).attr('id');
            let value = $(this).parent().find(">:nth-child(2)").val();

            if (!$(this).parent().find(">:nth-child(2)").hasClass('d-none')) {
                $(this).parent().find(">:first-child").toggleClass('d-none');
                $(this).parent().find(">:first-child").text(value);
                $(this).parent().find(">:nth-child(2)").toggleClass('d-none');

                $.ajax({
                    type: 'POST',
                    url: 'test.php',
                    data: {
                        id: id,
                        value: value,
                        action: 'updateName'
                    },
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        });

        $('.addBtn').click(function () {
            let id = $(this).attr('id');
            console.log(id);

            $.ajax({
                type: 'POST',
                url: 'test.php',
                data: {
                    id: id,
                    action: 'addChild'
                },
                success: function (response) {
                    location.reload();
                }
            });
        });
    });
</script>