<?php
session_start();

if ($_SESSION['upr'] != 'pracownik') {
    header("Location: ../index.php");
} else {
    echo "";
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>

    <?php
    include "../components/header.php";
    ?>

    <h1>STRONA PRACOWNIKA</h1>

</body>

</html>