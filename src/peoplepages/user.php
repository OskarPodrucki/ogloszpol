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
                </div>

                <div id="findFollowedAnnouncements">
                    <h2>ZNAJDZ POLUBIONE OGŁOSZENIA</h2>
                </div>

                <div id="reportedUsers">
                    <h2>ZNAJDZ ZAMÓWIONE OGŁOSZENIA</h2>
                </div>

            </div>

        </div>

    </div>


</body>

</html>