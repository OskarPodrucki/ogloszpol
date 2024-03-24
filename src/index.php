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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    include "components/header.php";
    ?>

    <div id="content">


        <div id="search">
            <form action="index.php" method="POST">
                <input type="text" id="searchInp" name="searchInput" placeholder="wyszukaj ogłoszenie...">
                <input type="text" id="searchLoc" name="searchLocation" placeholder="lokalizacja...">
                <select id="searchCat" name="searchCategory">
                    <option value="none">Wybierz kategorię</option>
                    <option value="1">Motoryzacja</option>
                    <option value="2">Komputery</option>
                    <option value="3">Praca</option>
                </select>
                <input type="submit" id="searchButton" value="SZUKAJ">
            </form>
        </div>


        <div id="categories">

            <div class="category">
                <div>
                    <img class="categoryImg" src="../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                </div>
                <div>
                    <h4 class="categoryTitle">tutaj będzie nazwa kategorii</h4>
                </div>
            </div>

        </div>


    </div>


</body>

</html>