<?php
session_start();

if ($_SESSION['upr'] != '3') {
    header("Location: ../mainpages/index.php");
    echo "NIE JESTEŚ UŻYTKOWNIKEM";
    sleep(2);
} else {
    echo "";
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo! - użytkownik</title>
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>


    <?php
    include "../components/headerPeoplePages.php";
    ?>

    <div id="content">

        <div id="peoplepage">


            <div id="profile">

                <img id="profileImg" src="../../img/pagelook/addedcategory.jpg" alt="awatar">

                <div id="info">

                    <?php

                    // Połączenie z bazą danych
                    $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                    // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                    if (!$conn) {
                        die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                    }

                    // Zapytanie SQL dla kategorii
                    $sql = "SELECT `id`, `uprawnienia`, `login`, `haslo`, `email`, `lokalizacja`, `imie`, `nazwisko`, `data_rejestracji` FROM `uzytkownicy` WHERE `login` = '$_SESSION[login]'";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sql);

                    // Wyświetlenie opcji kategorii
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            echo "<hr>";
                            echo "<h2>Login: $row[login]</h2>";
                            echo "<hr>";
                            echo "<h2>Imie: $row[imie]</h2>";
                            echo "<hr>";
                            echo "<h2>Nazwisko: $row[nazwisko]</h2>";
                            echo "<hr>";
                            echo "<h2>E-mail: $row[email]</h2>";
                            echo "<hr>";
                            echo "<h2>Lokalizacja: $row[lokalizacja]</h2>";
                            echo "<hr>";
                        }
                    }

                    // Zamknięcie połączenia z bazą danych
                    mysqli_close($conn);

                    ?>

                </div>

            </div>


            <div id="operations">

                <div id="findAnnouncement">
                    <h2>ZNAJDZ OGŁOSZENIE</h2>

                    <?php

                    // Połączenie z bazą danych
                    $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                    // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                    if (!$conn) {
                        die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                    }

                    $sqluserID = "SELECT `id` FROM `uzytkownicy` WHERE `login` = '$_SESSION[login]'";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sqluserID);

                    // Wyświetlenie opcji kategorii
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            $userID = $row['id'];
                        }
                    }

                    $sql = "SELECT * FROM `ogloszenia` WHERE `użytkownikId` =$userID";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sql);

                    // Wyświetlenie ogłoszeń
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            echo "<form class='form' action='announcement.php' method='POST'>";
                            echo "<input type='hidden' name='categoryId' value=$row[id]>";
                            echo "<div class='searched'>";
                            echo "<div>";
                            echo "<img class='categoryImg' src='../../img/pagelook/addedcategory.jpg' alt='addedCategoryImg'>";
                            echo "</div>";
                            echo "<div class='info'>";
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

                    ?>

                </div>

                <div id="findFollowedAnnouncements">
                    <h2>ZNAJDZ POLUBIONE OGŁOSZENIA</h2>

                    <?php

                    // Połączenie z bazą danych
                    $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                    // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                    if (!$conn) {
                        die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                    }

                    $sqluserID = "SELECT `id` FROM `uzytkownicy` WHERE `login` = '$_SESSION[login]'";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sqluserID);

                    // Wyświetlenie opcji kategorii
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            $userID = $row['id'];
                        }
                    }

                    $sql = "SELECT * FROM `polubienia` JOIN `ogloszenia` ON ogloszenia.id = polubienia.id_ogloszenia WHERE polubienia.id_uzytkownika = $userID;";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sql);

                    // Wyświetlenie ogłoszeń
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            echo "<form class='form' action='announcement.php' method='POST'>";
                            echo "<input type='hidden' name='categoryId' value=$row[id]>";
                            echo "<div class='searched'>";
                            echo "<div>";
                            echo "<img class='categoryImg' src='../../img/pagelook/addedcategory.jpg' alt='addedCategoryImg'>";
                            echo "</div>";
                            echo "<div class='info'>";
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

                    ?>

                </div>

                <div id="reportedUsers">
                    <h2>ZNAJDZ ZAMÓWIONE OGŁOSZENIA</h2>

                    <?php

                    // Połączenie z bazą danych
                    $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                    // Sprawdzenie czy połączenie zostało nawiązane poprawnie
                    if (!$conn) {
                        die("Błąd podczas łączenia z bazą danych: " . mysqli_connect_error());
                    }

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sqluserID);

                    // Wyświetlenie opcji kategorii
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            $userID = $row['id'];
                        }
                    }

                    $sql = "SELECT * FROM `zamówienia` JOIN `ogloszenia` ON ogloszenia.id = zamówienia.id_zamowienia WHERE zamówienia.id_kupującego AND ogloszenia.użytkownikId = $userID;";

                    // Wykonanie zapytania
                    $results = mysqli_query($conn, $sql);

                    // Wyświetlenie ogłoszeń
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            echo "<form class='form' action='announcement.php' method='POST'>";
                            echo "<input type='hidden' name='categoryId' value=$row[id]>";
                            echo "<div class='searched'>";
                            echo "<div>";
                            echo "<img class='categoryImg' src='../../img/pagelook/addedcategory.jpg' alt='addedCategoryImg'>";
                            echo "</div>";
                            echo "<div class='info'>";
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
                    ?>

                </div>

            </div>

        </div>

    </div>


</body>

</html>