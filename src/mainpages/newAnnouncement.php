<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="../css/newAnnouncement.css">
    <link rel="stylesheet" href="../css/newAnnouncementImg.css">
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
                        <select name="category">
                            <option value="none">Wybierz kategorie</option>
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
                        <input type="text" name="description" placeholder="Opis ogłoszenia">
                        <input type="number" name="price" placeholder="Cena ogłoszenia">
                    </div>
                    <div id="zdjecia">
                        <h1 class="createTitle">Wybierz zdjęcie</h1>
                        <div id="zdjeciaKategorii">
                            <script>
                                // Pobieranie elementu galerii
                                const gallery = document.getElementById("zdjeciaKategorii");

                                // Ścieżka do katalogu z obrazami
                                const imageDirectory = '../../img/categoryimg';

                                // Funkcja pobierająca nazwy obrazów z katalogu
                                async function fetchImageNames(directory) {
                                    try {
                                        // Pobranie danych z katalogu
                                        const response = await fetch(directory);
                                        const data = await response.text();

                                        // Parsowanie danych do postaci dokumentu HTML
                                        const parser = new DOMParser();
                                        const htmlDocument = parser.parseFromString(data, 'text/html');

                                        // Wybieranie wszystkich linków w dokumencie
                                        const links = htmlDocument.querySelectorAll('a');

                                        // Filtracja nazw plików obrazów
                                        const imageNames = Array.from(links)
                                            .map(link => link.getAttribute('href'))
                                            .filter(href => /\.(jpeg|jpg|png|gif)$/i.test(href));

                                        return imageNames;
                                    } catch (error) {
                                        console.error('Wystąpił błąd podczas pobierania nazw obrazów:', error);
                                        return [];
                                    }
                                }

                                async function createGallery() {
                                    try {
                                        // Pobranie nazw obrazów
                                        const imageNames = await fetchImageNames(imageDirectory);

                                        // Tworzenie kontenerów dla obrazów
                                        imageNames.forEach(imageName => {
                                            const container = document.createElement('div');
                                            container.className = "container";

                                            // Pobieranie liczby z nazwy pliku
                                            const number = imageName.match(/\d+/)[0];

                                            // Tworzenie elementu checkbox
                                            const radio = document.createElement('input');
                                            radio.type = "radio";
                                            radio.name = "categoryImgNumber"
                                            radio.value = number;
                                            radio.id = imageName.split('.')[0];
                                            container.appendChild(radio);

                                            // Tworzenie elementu label
                                            const label = document.createElement('label');
                                            label.htmlFor = imageName.split('.')[0];

                                            // Tworzenie elementu img
                                            const img = document.createElement('img');
                                            img.src = `${imageDirectory}/${imageName}`; // Tutaj łączysz ścieżkę do katalogu z nazwą pliku
                                            label.appendChild(img);

                                            container.appendChild(label);
                                            gallery.appendChild(container);
                                        });
                                    } catch (error) {
                                        console.error('Wystąpił błąd podczas tworzenia galerii:', error);
                                    }
                                }


                                // Wywołanie funkcji obrazki
                                createGallery();
                            </script>

                        </div>
                        link do filmu: https://www.youtube.com/watch?v=-UO-uGFphYA
                    </div>
                    <div id="kontakt">
                        <h1 class="createTitle">Dodaj dane kontaktowe</h1>
                        <input type="text" name="location" placeholder="Lokalizacja">
                        <input type="text" name="mail" placeholder="E-mail">
                        <input type="text" name="phoneNumber" placeholder="Numer telefonu w formacie:    000-000-000">
                    </div>
                    <div id="zatwierdz">
                        <input type="submit">
                    </div>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['price']) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['categoryImgNumber']) && isset($_POST['location']) && isset($_POST['mail']) && isset($_POST['phoneNumber'])) {
                        $price = $_POST['price'];
                        $title = $_POST['title'];
                        $category = $_POST['category'];
                        $description = $_POST['description'];
                        $categoryImgNumber = $_POST['categoryImgNumber'];
                        $location = $_POST['location'];
                        $mail = $_POST['mail'];
                        $phone = $_POST['phoneNumber'];

                        $conn = mysqli_connect('localhost', 'root', '', 'ogloszpol');

                        if (!$conn) {
                            die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
                        }

                        $sql = "INSERT INTO `ogloszenia`(`id`, `użytkownikId`, `zdjecie_url`, `tytul`, `opis`, `kategoria`, `cena`, `lokalizacja`, `kontakt_telefoniczny`, `data_dodania`) VALUES (NULL,'10','$categoryImgNumber','$title','$description','$category','$price','$location','$phone',NOW())";

                        if (mysqli_query($conn, $sql)) {
                            echo "Ogłoszenie zostało dodane pomyślnie.";
                        } else {
                            echo "Błąd: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);
                    } else {
                        echo "Proszę wypełnić wszystkie wymagane pola.";
                    }
                }
                ?>


            </div>

        </div>

    </div>

</body>

</html>