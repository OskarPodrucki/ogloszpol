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
    <link rel="stylesheet" href="../css/newAnnouncement.css">
</head>

<body>


    <?php
    include "../components/header.php";
    ?>

    <div id="content">

        <div id="createAnnouncement">

            <a href="index.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>

            <div id="createAnnouncementContent">
                <form action="newAnnouncement.php" method="POST">
                    <div id="opis">
                        <h1 class="createTitle">Dodaj opis</h1>
                        <input type="text" name="title" placeholder="Nazwa ogłoszenia">
                        <select name="kategoria">
                            <option value="none0">Wybierz kategorie</option>
                            <?php

                            $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                            if (!$conn) {
                                die("błąd okok");
                            }


                            $sql = "SELECT `id`, `nazwa`, `opis` FROM `kategorie`";

                            $results = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($results) > 0) {
                                while ($row = mysqli_fetch_assoc($results)) {
                                    echo "<option value=" . $row['id'] . ">" . $row['nazwa'] . "</option>";
                                }
                            }

                            mysqli_close($conn);
                            ?>
                        </select>
                        <input type="text" name="opis" placeholder="Opis ogłoszenia">
                    </div>
                    <div id="zdjecia">
                        <h1 class="createTitle">Dodaj zdjęcie</h1>
                        <input type="file" id="custom-file-upload">
                    </div>
                    <div id="kontakt">
                        <h1 class="createTitle">Dodaj dane kontaktowe</h1>
                        <input type="text" placeholder="Lokalizacja">
                        <input type="text" placeholder="Imie">
                        <input type="text" placeholder="E-mail">
                        <input type="text" placeholder="Numer telefonu">
                    </div>
                    <div id="zatwierdz">
                        <input type="submit">
                    </div>
                </form>
            </div>

        </div>

    </div>

</body>

</html>