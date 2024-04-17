<?php
session_start();

$_SESSION['wyszukano'];

$_SESSION['categoryID'];

if (!isset($_SESSION['announcementID'])) {
    $_SESSION['announcementID'] = $_POST['announcementID'];
}


$_SESSION['input'];
$_SESSION['location'];
$_SESSION['category'];

if ($_SESSION['wyszukano'] != "tak") {
    sleep(2);
    header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="../css/announcement.css">
</head>

<body>


    <?php
    include "../components/header.php";
    ?>

    <div id="content">

        <div id="createAnnouncement">


            <a href="search.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>


            <div id="announcement">
                <?php

                $announcementID = $_SESSION['announcementID'];

                // Połączenie z bazą danych
                $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                if (!$conn) {
                    die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                }

                // Zapytanie SQL dla kategorii
                $sql = "SELECT `id`, `użytkownikId`, `zdjecie_url`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `lokalizacja`, `kontakt_telefoniczny`, `data_dodania` FROM `ogloszenia` WHERE `id` = $announcementID";

                // Wykonanie zapytania
                $results = mysqli_query($conn, $sql);



                // Wyświetlenie opcji kategorii
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<div>";
                        echo "<img id='announcementImg' src='../../img/categoryimg/category$row[zdjecie_url].png' alt='$row[zdjecie_url]'>";
                        echo "</div>";
                        echo "<div>";
                        echo "<h5 id='announcementWhenAdded'>Kiedy dodano: $row[data_dodania]</h5>";
                        echo "<h5 id='announcementPhone'>Telefon: $row[kontakt_telefoniczny]</h5>";
                        echo "<h1 id='announcementTitle'>$row[tytul]</h1>";
                        echo "<h3 id='announcementPrice'>$row[cena] zł</h3>";
                        echo "<h1 id='Description'>Opis:</h1>";
                        echo "<p id='announcementDescription'>$row[opis]</p>";
                        echo "<div id='announcementButtons'>";
                        echo "<form action='announcement.php'>";
                        echo "<input type='hidden' name='announcement' value=$announcementID>";
                        echo "<input type='hidden' name='action' value=1>";
                        echo "<input class='actionButton' type='submit' value='POLUB'>";
                        echo "</form>";
                        echo "<form action='announcement.php'>";
                        echo "<input type='hidden' name='announcement' value=$announcementID>";
                        echo "<input type='hidden' name='action' value=2>";
                        echo "<input class='actionButton' type='submit' value='EDYTUJ'>";
                        echo "</form>";
                        echo "<form action='announcement.php'>";
                        echo "<input type='hidden' name='announcement' value=$announcementID>";
                        echo "<input type='hidden' name='action' value=3>";
                        echo "<input class='actionButton' type='submit' value='USUŃ'>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                }

                if (isset($_POST['announcement']) && $_POST['action'] = 1){
                    
                }

                    // Zamknięcie połączenia z bazą danych
                    mysqli_close($conn);

                ?>
            </div>

        </div>


    </div>


</body>

</html>