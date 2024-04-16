<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo! - login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <div id="loginDiv">

        <a href="choose.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>

        <h1>LOGOWANIE</h1>

        <form action="login.php" method="POST">

            <input type="text" name='login' placeholder="login">
            <input type="password" name='password' placeholder="haslo">
            <input type="submit" placeholder="ZALOGUJ SIĘ">

        </form>
    </div>

    <?php
    if (isset($_POST['login']) && isset($_POST['password'])) {

        $loginF = $_POST['login'];
        $password = $_POST['password'];

        function szyfrujHasło($password)
        {
            return md5($password);
        }

        $hashedPassword = szyfrujHasło($password);

        $host = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $database = "ogloszpol";

        $conn = mysqli_connect($host, $dbuser, $dbpass, $database);

        if (!$conn) {
            die("błąd połączenia" . mysqli_connect_errno());
        }

        $sql = "SELECT * FROM `uzytkownicy` WHERE login='$loginF' AND haslo='$hashedPassword'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            echo "zalogowano";

            $_SESSION['zalogowano'] = true;
            $_SESSION['login'] = $row['login'];
            $_SESSION['upr'] = $row['uprawnienia'];

            header("Location: ../mainpages/index.php");
            sleep(2);
        } else {
            echo "błąd w logowaniu";

            $_SESSION['zalogowano'] = false;
            $_SESSION['login'] = "";
            $_SESSION['upr'] = "";
        }

        mysqli_close($conn);
    } else {
        echo "";

        $_SESSION['zalogowano'] = false;
        $_SESSION['login'] = "";
        $_SESSION['upr'] = "";
    }

    echo "<br>";

    echo $_SESSION['login'];

    echo "<br>";

    echo $_SESSION['upr'];

    echo "<br>";
    ?>

</body>

</html>