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
    <link rel="stylesheet" href="css/announcement.css">
</head>

<body>


    <?php
    include "components/header.php";
    ?>

    <div id="content">

        <div id="createAnnouncement">

            <a href="search.php"><img id="returnImg" src="../img/pagelook/return.png" alt="powrot"></a>

            <div id="announcement">
                <div>
                    <img id="announcementImg" src="../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                </div>
                <div>
                    <h5 id="announcementWhenAdded">Kiedy dodano</h5>
                    <h5 id="announcementPhone">Telefon: 000 000 000</h5>
                    <h1 id="announcementTitle">Nazwa ogłoszenia</h1>
                    <h3 id="announcementPrice">Cena ogłoszenia</h3>
                    <h1 id="Description">Opis:</h1>
                    <p id="announcementDescription">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, quidem. Ducimus illo error obcaecati non libero ex quisquam cum modi. Itaque, qui perferendis non aut nesciunt culpa inventore quidem magni?</p>
                    <div id="announcementButtons">
                        <button class="announcementButton">POLUB</button> <button class="announcementButton">EDYTUJ</button> <button class="announcementButton">USUŃ</button>
                    </div>
                </div>
            </div>

        </div>


    </div>


</body>

</html>