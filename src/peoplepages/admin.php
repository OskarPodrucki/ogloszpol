<?php
session_start();

if ($_SESSION['upr'] != '1') {
    header("Location: ../mainpages/index.php");
    echo "NIE JESTEŚ ADMINEM";
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
    <link rel="stylesheet" href="../css/admin.css">
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
                </div>

                <div id="findUser">
                    <h2>ZNAJDZ UŻYTKOWNIKA</h2>
                </div>

                <div id="reportedUsers">
                    <h2>ZGŁOSZENI UŻYTKOWNICY</h2>
                </div>

                <div id="modifyRights">
                    <h2>MODYFIKUJ UPRAWNIENIA</h2>
                </div>

                <div id="addUser">
                    <h2>DODAJ UŻYTKOWNIKA</h2>
                </div>

                <div id="addCategory">
                    <h2>DODAJ KATEGORIĘ</h2>
                </div>

            </div>

        </div>

    </div>


</body>

</html>