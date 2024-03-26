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

            <form action="announcement.php" method="POST">
                <input type='hidden' name='categoryId' value="1">
                <input class='categorySubmit' type='submit' value=''>
                <div class="searched">
                    <div>
                        <img class="categoryImg" src="../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                    </div>
                    <div>
                        <h3 class="categoryTitle" id="siema1">tutaj będą się wyświetlać ogłoszenia</h3>
                        <h3 class="categoryTitle" id="siema2">cena</h3>
                        <h3 class="categoryTitle" id="siema3">używanie czy nie</h3>
                        <h3 class="categoryTitle" id="siema4">lokalizacja</h3>
                        <h3 class="categoryTitle" id="siema5">ikonka serca i czy lubisz czy nie pzdr</h3>
                    </div>
                </div>
            </form>

        </div>


    </div>


</body>

</html>