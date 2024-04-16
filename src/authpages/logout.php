<?php
session_start();

$_SESSION['zalogowano'] = false;
$_SESSION['login'] = "";
$_SESSION['upr'] = "";

echo "ZOSTAŁEŚ WYLOGOWANY";
header("Location: ../mainpages/index.php");
sleep(3);
