<link rel="stylesheet" href="../css/header.css">
<div id="header">

    <a href='../mainpages/index.php'>
        <div>
            <img id="Logo" src='../../img/pagelook/ogloszpo!.png' alt='logo'>
        </div>
    </a>

    <?php

    echo $_SESSION['zalogowano'];

    echo $_SESSION['login'];

    echo $_SESSION['upr'];

    ?>

    <div id="newAnnouncement">
        <a id="link" href="../../src/mainpages/newAnnouncement.php"><button id="headerButton">Nowe ogłoszenie</button></a>
    </div>

    <?php
    if (empty($_SESSION['zalogowano']) && empty($_SESSION['login']) && empty($_SESSION['upr'])) {
        echo "<div id='auth'>";
        echo "<a id='link' href='../../src/authpages/choose.php'><button id='headerButton'>Twoje konto</button></a>";
        echo "</div>";
    } else {

        // url do odpowiedniej strony
        switch ($_SESSION['upr']) {
            case 1:
                $url = "../../src/peoplepages/admin.php";
                break;
            case 2:
                $url = "../../src/peoplepages/worker.php";
                break;
            case 3:
                $url = "../../src/peoplepages/user.php";
                break;
            default:
                echo "błąd";
                // zakończ proces, gdy nie ma pasującego uprawnienia
                exit;
        }

        echo "<div id='auth'>";
        echo "<a id='link' href=$url><button id='headerButton'>Witaj $_SESSION[login]</button></a>";
        echo "</div>";
    }
    ?>

    <!-- <div id="auth">
        <a id="link" href="../../src/authpages/choose.php"><button id="headerButton">Twoje konto</button></a>
    </div> -->

    <?php
    if (!empty($_SESSION['zalogowano']) && !empty($_SESSION['login']) && !empty($_SESSION['upr'])) {
        echo "<div id='logout'>";
        echo "<a id='link' href='../../src/authpages/logout.php'><button id='headerButton'>Wyloguj się</button></a>";
        echo "</div>";
    }
    ?>


</div>