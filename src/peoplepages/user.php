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
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


    <?php
    include "../components/header.php";
    ?>

    <div id="content">

        <div id="peoplepage">

            <div class="info">
                <div>
                    <img class="categoryImg" src="../../img/pagelook/addedcategory.jpg" alt="addedCategoryImg">
                </div>
                <div>
                    <h4 class="categoryTitle">tutaj będzie strona dla poszczególnych użytkowników</h4>
                </div>
            </div>

        </div>


    </div>


</body>

</html>