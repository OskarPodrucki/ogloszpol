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
    <link rel="stylesheet" href="css/newAnnouncement.css">
</head>

<body>


    <?php
    include "components/header.php";
    ?>

    <div id="content">

        <div id="createAnnouncement">

            <div class="info">
                <div>
                    <img class="categoryImg" src="../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                </div>
                <div>
                    <h4 class="categoryTitle">tutaj bedzie możliwość dodawania nowych ogłoszeń</h4>
                </div>
            </div>

        </div>


    </div>


</body>

</html>