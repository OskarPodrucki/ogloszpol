<?php
session_start();

$_SESSION['zalogowano'] = false;
$_SESSION['login'] = "odwiedzacz";
$_SESSION['upr'] = "odwiedzajacy";

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="css/search.css">
</head>

<body>


    <?php
    include "components/header.php";
    ?>

    <div id="content">

        <div id="search">

            <div class="searched">
                <div>
                    <img class="categoryImg" src="../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                </div>
                <div>
                    <h3 class="categoryTitle">tutaj będą się wyświetlać ogłoszenia</h3>
                    <h3 class="categoryTitle">używanie czy nie</h3>
                    <h3 class="categoryTitle">cena</h3>
                    <h3 class="categoryTitle">lokalizacja</h3>
                    <h3 class="categoryTitle">ikonka serca i czy lubisz czy nie pzdr</h3>
                </div>
            </div>

        </div>


    </div>


</body>

</html>