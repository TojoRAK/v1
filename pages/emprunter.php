<?php
include("../inc/fonctions.php");
$objet = getInfoObjetbyId($_GET["id"]);
$idObj = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Resume de l'emprunt </h1>
    <h3><?= $objet['nom_objet'] ?></h3>
    <form action="traitementEmp.php" method="get">
        <input type="hidden" name="id_objet" value="<?= $idObj ?>">
        <input type="number" name="duree" id="">
        <input type="submit" value="Valider">
    </form>
</body>

</html>