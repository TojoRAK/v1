<?php
include("../inc/fonctions.php");
$categories = getCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="traitement.php" method="post" enctype="multipart/form-data">
        <p>Nom de l'objet : <input type="text" name="nom" id=""></p>
        <p>Categorie de l'objet : <select name="categorie" class="form-select me-2" style="width: auto;">
                <?php foreach ($categories as $categ) { ?>
                    <option value="<?= $categ['id_categorie'] ?>" >
                        <?= $categ['nom_categorie'] ?>
                    </option>
                <?php } ?>

            </select></p>

        <label for="fichier">Ajouter une photo</label>
        <input type="file" name="fichier[]" id="fichier" multiple required>
        <br><br>
        <input type="submit" value="Valider">
    </form>



</body>

</html>