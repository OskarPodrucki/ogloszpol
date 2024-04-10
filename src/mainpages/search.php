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
    <link rel="stylesheet" href="../css/search.css">
</head>

<body>


    <?php
    include "../components/header.php";
    ?>

    <div id="content">

        <div id="search">

            <a href="index.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>

            <?php

            //przeglądanie ogłoszeń po wybranej kategorii
            if (isset($_POST['categoryId'])) {

                $kategoria = $_POST['categoryId'];

                // Połączenie z bazą danych
                $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                if (!$conn) {
                    die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                }

                // Zapytanie SQL dla kategorii
                $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE kategoria = $kategoria";

                // Wykonanie zapytania
                $results = mysqli_query($conn, $sql);

                // Wyświetlenie opcji kategorii
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<form class='form' action='announcement.php' method='POST'>";
                        echo "<input type='hidden' name='categoryId' value=$row[id]>";
                        echo "<div class='searched'>";
                        echo "<div>";
                        echo "<img class='categoryImg' src='../../img/pagelook/addedcategory.jpg' alt='addedCategoryImg'>";
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<input category='categorySubmit' type='submit' value='Podgląd'>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[tytul]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[cena]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>uzywane czy nie</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[lokalizacja]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[kontakt_telefoniczny]</h3>";
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

            //przeglądanie ogłoszeń
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Połączenie z bazą danych
                $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                if (!$conn) {
                    die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                }

                switch (false) {
                    case isset($_POST['searchInput']) && isset($_POST['searchLocation']) && isset($_POST['searchCategory']):
                        // Zapytanie SQL dla wszystkich kryteriów
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_POST['searchInput']}%' AND `lokalizacja` LIKE '%{$_POST['searchLocation']}%' AND `kategoria` = '{$_POST['searchCategory']}'";
                        break;
                    case isset($_POST['searchInput']) && isset($_POST['searchLocation']) && empty($_POST['searchCategory']):
                        // Zapytanie SQL dla tytułu i lokalizacji
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_POST['searchInput']}%' AND `lokalizacja` LIKE '%{$_POST['searchLocation']}%'";
                        break;
                    case isset($_POST['searchInput']) && empty($_POST['searchLocation']) && empty($_POST['searchCategory']):
                        // Zapytanie SQL dla tytułu
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `tytul` LIKE '%{$_POST['searchInput']}%'";
                        break;
                    case empty($_POST['searchInput']) && isset($_POST['searchLocation']) && isset($_POST['searchCategory']):
                        // Zapytanie SQL dla lokalizacji i kategorii
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `lokalizacja` LIKE '%{$_POST['searchLocation']}%' AND `kategoria` = '{$_POST['searchCategory']}'";
                        break;
                    case empty($_POST['searchInput']) && isset($_POST['searchLocation']) && empty($_POST['searchCategory']):
                        // Zapytanie SQL dla lokalizacji
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `lokalizacja` LIKE '%{$_POST['searchLocation']}%'";
                        break;
                    case empty($_POST['searchInput']) && empty($_POST['searchLocation']) && isset($_POST['searchCategory']):
                        // Zapytanie SQL dla kategorii
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia` WHERE `kategoria` = '{$_POST['searchCategory']}'";
                        break;
                    case empty($_POST['searchInput']) && empty($_POST['searchLocation']) && empty($_POST['searchCategory']):
                        // Zapytanie SQL dla wszystkich ogłoszeń (brak kryteriów)
                        $sql = "SELECT `id`, `tytul`, `opis`, `kategoria`, `cena`, `data_dodania`, `lokalizacja`, `zdjecie_url`, `kontakt_telefoniczny`, `użytkownikId` FROM `ogloszenia`";
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
                        echo "<input type='hidden' name='categoryId' value={$row['id']}>";
                        echo "<div class='searched'>";
                        echo "<div>";
                        echo "<img class='categoryImg' src='../../img/pagelook/addedcategory.jpg' alt='addedCategoryImg'>";
                        echo "</div>";
                        echo "<div class='info'>";
                        echo "<input category='categorySubmit' type='submit' value='Podgląd'>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[tytul]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[cena]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>uzywane czy nie</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[lokalizacja]</h3>";
                        echo "<h3 class='categoryTitle' id='siema1'>$row[kontakt_telefoniczny]</h3>";
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

            <form class="form" action="announcement.php" method="POST">
                <input type='hidden' name='categoryId' value="1">
                <input class='categorySubmit' type='submit' value='1'>
                <div class="searched">
                    <div>
                        <img class="categoryImg" src="../../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                    </div>
                    <div class="info">
                        <h3 class="categoryTitle" id="siema1">tutaj będą się wyświetlać ogłoszenia</h3>
                        <h3 class="categoryTitle" id="siema2">cena</h3>
                        <h3 class="categoryTitle" id="siema3">używanie czy nie</h3>
                        <h3 class="categoryTitle" id="siema4">lokalizacja</h3>
                        <h3 class="categoryTitle" id="siema5">ikonka serca, usunięcia i edycji</h3>
                    </div>
                </div>
            </form>

        </div>


    </div>


</body>

</html>