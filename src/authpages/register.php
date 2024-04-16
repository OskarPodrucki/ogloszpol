<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ogloszpo! - rejestracja</title>
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>

    <div id="registerDiv">

        <a href="choose.php"><img id="returnImg" src="../../img/pagelook/return.png" alt="powrot"></a>

        <h1>REJESTRACJA</h1>

        <form action="register.php" method="POST">
            <input type="text" name="firstname" placeholder="firstname">
            <input type="text" name="lastname" placeholder="lastname">
            <input type="text" name="email" placeholder="email">
            <input type="text" name="login" placeholder="login">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="ZAREJESTRUJ SIĘ">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {

            $login = $_POST['login'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $imie = $_POST['firstname'];
            $nazwisko = $_POST['lastname'];

            // Funkcja do hashowania hasła
            function hashowanieHasla($password)
            {
                return md5($password);
            }

            $hashedPassword = hashowanieHasla($password);

            $host = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $database = "ogloszpol";

            $conn = mysqli_connect($host, $dbuser, $dbpass, $database);

            if (!$conn) {
                die("Błąd połączenia: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO `uzytkownicy`(`login`, `haslo`, `email`, `uprawnienia`, `imie`, `nazwisko`, `data_rejestracji`) VALUES ('$login','$hashedPassword','$email',3,'$imie','$nazwisko', NOW())";

            if (mysqli_query($conn, $sql)) {
                header("Location: ./login.php");
            } else {
                echo "";
            }

            mysqli_close($conn);
        } else {
            echo "Niepoprawne dane przesłane z formularza";
        }
    }
    ?>


</body>

</html>