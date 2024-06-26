<?php
session_start();

// Inicjacja zmiennych sesji
$_SESSION['categoryID'] = "0";

$_SESSION['input'] = "";
$_SESSION['location'] = "";
$_SESSION['category'] = "";

$_SESSION['wyszukano'] = "nie";

// $_SESSION['zalogowano'] = false;
// $_SESSION['login'] = "odwiedzacz";
// $_SESSION['upr'] = "odwiedzajacy";

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php
    // Wczytanie nagłówka
    include "../components/header.php";
    ?>

    <div id="content">

        <div id="search">
            <!-- Formularz wyszukiwania -->
            <form action="search.php" method="POST">
                <input type='hidden' name='czywyszukano' value='tak'>
                <input type="text" id="searchInp" name="searchInput" placeholder="wyszukaj ogłoszenie...">
                <input type="text" id="searchLoc" name="searchLocation" placeholder="lokalizacja...">
                <select id="searchCat" name="searchCategory">
                    <option value=none>wybierz kategorie...</option>
                    <?php
                    // Połączenie z bazą danych
                    $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                    // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                    if (!$conn) {
                        die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                    }

                    // Zapytanie SQL dla kategorii
                    $sql = "SELECT `id`, `nazwa` FROM `kategorie`";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sql);

                    // Wyświetlenie opcji kategorii
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            echo "<option value=" . $row['id'] . ">" . $row['nazwa'] . "</option>";
                        }
                    }

                    // Zamknięcie połączenia z bazą danych
                    mysqli_close($conn);
                    ?>
                </select>
                <input type="submit" id="searchButton" value="SZUKAJ">
            </form>
        </div>

        <div id="categories">
            <?php
            // Połączenie z bazą danych
            $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

            // Sprawdzenie czy połączenie zostało nawiązane poprawnie
            if (!$conn) {
                die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
            }

            // Zapytanie SQL dla kategorii
            $sql = "SELECT kategorie.id, kategorie.nazwa, zdjecia_kategorie.url AS url FROM kategorie JOIN zdjecia_kategorie ON zdjecia_kategorie.id_kategorii = kategorie.id;";

            // Wykonanie zapytania
            $results = mysqli_query($conn, $sql);

            // Wyświetlenie kategorii
            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    // Formularz dla każdej kategorii
                    echo "<form action='search.php' method='POST'>";
                    echo "<input type='hidden' name='categoryId' value=" . $row['id'] . ">";
                    echo "<input type='hidden' name='czywyszukano' value='tak'>";
                    echo "<input class='categorySubmit' type='submit' value=''>";
                    echo "<div class='category'>";
                    echo "<img class='categoryImg' src={$row['url']} alt='addedCategoryImg'>";
                    echo "</div>";
                    echo "<h4 class='categoryTitle'>" . $row['nazwa'] . "</h4>";
                    echo "</form>";
                }
            }

            // Zamknięcie połączenia z bazą danych
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>