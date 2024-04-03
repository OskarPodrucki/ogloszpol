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
                                const gallery = document.getElementById("zdjeciaKategorii")

                                const imageDirectory = '../../img/categoryimg';


                                async function fetchImageNames(directory) {
                                    const response = await fetch(directory);
                                    const data = await response.text();
                                    const parser = new DOMParser();
                                    const htmlDocument = parser.parseFromString(data, 'text/html');
                                    const links = htmlDocument.querySelectorAll('a');
                                    const imageNames = Array.from(links)
                                        .map(link => link.getAttribute('href'))
                                        .filter(href => /\.(jpeg|jpg|png|gif)$/i.test(href)); // Filter only image file names
                                    return imageNames;
                                }

                                // Function to create image elements and append them to the gallery
                                async function createGallery() {
                                    const imageNames = await fetchImageNames(imageDirectory);
                                    imageNames.forEach(imageName => {
                                        const img = document.createElement('img');
                                        img.className = "categoryImg"
                                        img.src = `${imageDirectory}/${imageName}`;
                                        gallery.appendChild(img);
                                    });
                                }

                                // Call the createGallery function to populate the gallery
                                createGallery();
                            </script>
                        </div>
                        <input type="number" name="categoryImgNumber">
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