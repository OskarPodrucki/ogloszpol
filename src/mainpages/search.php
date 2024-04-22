<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_POST['czywyszukano'])) {
    $_SESSION['wyszukano'] = $_POST['czywyszukano'];
}


if ($_SESSION['wyszukano'] != "tak") {
    sleep(2);
    header("Location: ./index.php");
}


unset($_SESSION['announcementID']);

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="../css/search.css">
</head>

<body>


    <?php
    include "../components/header.php";
    ?>

    <div id="content">

        <a href="index.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>

        <div id="search">


            <?php


            if (empty($_SESSION['categoryID'])) {
                $_SESSION['categoryID'] = $_POST['categoryId'];
            }

            //przeglądanie ogłoszeń po wybranej kategorii

            if (isset($_SESSION['categoryID'])) {

                $kategoria = $_SESSION['categoryID'];

                // Połączenie z bazą danych
                $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                if (!$conn) {
                    die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                }

                // Zapytanie SQL dla kategorii
                $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE kategoria = $kategoria";

                // Wykonanie zapytania
                $results = mysqli_query($conn, $sql);
                echo "<h1>Wyszukane ogłoszenia: " . mysqli_num_rows($results) . "</h1>";

                // Wyświetlenie opcji kategorii
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<form class='form' action='announcement.php' method='POST'>";
                        echo "<input type='hidden' name='announcementID' value=$row[id]>";
                        echo "<div class='searched'>";
                        echo "<div>";
                        echo "<img class='categoryImg' src='../../img/categoryimg/category$row[zdjecie_url].png' alt='addedCategoryImg'>";
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<input category='categorySubmit' type='submit' value='Podgląd'>";
                        echo "<h3 class='categoryTitle' id='siema1'> | $row[tytul] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | CENA: $row[cena] zł | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | UŻYWANE: $row[uzywane] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | LOKALIZACJA: $row[lokalizacja] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | TELEFON: $row[kontakt_telefoniczny] | </h3>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                }

                // Zamknięcie połączenia z bazą danych
                mysqli_close($conn);
                exit();
            } else {
                echo "";
            }

            if (empty($_SESSION['input'])) {
                $_SESSION['input'] = $_POST['searchInput'];
            }

            if (empty($_SESSION['location'])) {
                $_SESSION['location'] = $_POST['searchLocation'];
            }

            if (empty($_SESSION['category'])) {
                $_SESSION['category'] = $_POST['searchCategory'];
            }

            //przeglądanie ogłoszeń
            if (isset($_SESSION['input']) && isset($_SESSION['location']) && isset($_SESSION['category'])) {

                // Połączenie z bazą danych
                $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                if (!$conn) {
                    die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                }

                switch (false) {
                    case isset($_SESSION['input']) && isset($_SESSION['location']) && isset($_SESSION['category']):
                        // Zapytanie SQL dla wszystkich kryteriów
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_SESSION['input']}%' AND `lokalizacja` LIKE '%{$_SESSION['location']}%' AND `kategoria` = '{$_SESSION['category']}'";
                        break;
                    case isset($_SESSION['input']) && isset($_SESSION['location']) && empty($_SESSION['category']):
                        // Zapytanie SQL dla tytułu i lokalizacji
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_SESSION['input']}%' AND `lokalizacja` LIKE '%{$_SESSION['location']}%'";
                        break;
                    case isset($_SESSION['input']) && empty($_SESSION['location']) && empty($_SESSION['category']):
                        // Zapytanie SQL dla tytułu
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_SESSION['input']}%'";
                        break;
                    case empty($_SESSION['input']) && isset($_SESSION['location']) && isset($_SESSION['category']):
                        // Zapytanie SQL dla lokalizacji i kategorii
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `lokalizacja` LIKE '%{$_SESSION['location']}%' AND `kategoria` = '{$_SESSION['category']}'";
                        break;
                    case empty($_SESSION['input']) && isset($_SESSION['location']) && empty($_SESSION['category']):
                        // Zapytanie SQL dla lokalizacji
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `lokalizacja` LIKE '%{$_SESSION['location']}%'";
                        break;
                    case empty($_SESSION['input']) && empty($_SESSION['location']) && isset($_SESSION['category']):
                        // Zapytanie SQL dla kategorii
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `kategoria` = '{$_SESSION['category']}'";
                        break;
                    case empty($_SESSION['input']) && empty($_SESSION['location']) && empty($_SESSION['category']):
                        // Zapytanie SQL dla wszystkich ogłoszeń (brak kryteriów)
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia`";
                        break;
                    default:
                        echo "Błąd wyszukiwania";
                        mysqli_close($conn);
                }

                // Wykonanie zapytania
                $results = mysqli_query($conn, $sql);
                echo "<h1>Wyszukane ogłoszenia: " . mysqli_num_rows($results) . "</h1>";

                // Wyświetlenie ogłoszeń
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<form class='form' action='announcement.php' method='POST'>";
                        echo "<input type='hidden' name='announcementID' value=$row[id]>";
                        echo "<div class='searched'>";
                        echo "<div>";
                        echo "<img class='categoryImg' src='../../img/categoryimg/category$row[zdjecie_url].png' alt='addedCategoryImg'>";
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<input category='categorySubmit' type='submit' value='Podgląd'>";
                        echo "<h3 class='categoryTitle' id='siema1'> | $row[tytul] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | CENA: $row[cena] zł | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | UŻYWANE: $row[uzywane] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | LOKALIZACJA: $row[lokalizacja] | </h3>";
                        echo "<h3 class='categoryTitle' id='siema1'> | TELEFON: $row[kontakt_telefoniczny] | </h3>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                }

                // Zamknięcie połączenia z bazą danych
                mysqli_close($conn);
            } else {
                echo "<h1>błąd wyszukiwania</h1>";
            }
            ?>

        </div>


    </div>


</body>

</html>