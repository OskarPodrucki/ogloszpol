<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo!</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div id="header">

        <div id="centerLogo">
            <img id="logo" src="../img/pagelook/ogloszpo!.png" alt="logo">
        </div>


        <div id="newAnnouncement">
            <button>Nowe ogłoszenie</button>
        </div>

        <div id="auth">
            <button>Twoje konto</button>
        </div>


    </div>


    <div id="content">


        <div id="search">
            <form action="index.php" method="POST">
                <input type="text" id="searchInp" name="searchInput" placeholder="wyszukaj ogłoszenie...">
                <input type="text" id="searchLoc" name="searchLocation" placeholder="lokalizacja...">
                <select id="searchCat" name="searchCategory">
                    <option value="none">Wybierz kategorię</option>
                    <option value="1">Motoryzacja</option>
                    <option value="2">Komputery</option>
                    <option value="3">Praca</option>
                </select>
                <input type="submit" id="searchButton" value="SZUKAJ">
            </form>
        </div>


        <div id="categories">

            <div class="category">
                <div class="categoryImg">
                    tutaj będzie obrazek
                </div>
                <div class="categoryName">
                    tutaj będzie nazwa kategorii
                </div>
            </div>

        </div>


    </div>


</body>

</html>