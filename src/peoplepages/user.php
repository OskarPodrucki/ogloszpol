<?php
session_start();

// if ($_SESSION['upr'] != 'uprawnienie') {
//     header("Location: ../index.php");
// } else {
//     echo "";
// }

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

                    <hr>

                    <h2>Imie: twoje imie</h2> <button>Edytuj</button>

                    <hr>

                    <h2>Nazwisko: twoje nazwisko</h2> <button>Edytuj</button>

                    <hr>

                    <h2>E-mail: twój e-mail</h2> <button>Edytuj</button>

                    <hr>

                    <h2>Lokalizacja: twoja Lokalizacja</h2> <button>Edytuj</button>

                    <hr>

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

                    $sql = 'SELECT * FROM `ogloszenia` WHERE użytkownikid = 1';

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

                    $sql = 'SELECT * FROM `polubienia` JOIN `ogloszenia` ON ogloszenia.id = polubienia.id_ogloszenia WHERE polubienia.id_uzytkownika = 1;';

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

                    $sql = 'SELECT * FROM `zamowienia` JOIN `ogloszenia` ON ogloszenia.id = zamowienia.id_ogloszenia WHERE zamowienia.id_uzytkownika = 1;';

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