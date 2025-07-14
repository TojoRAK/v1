<?php
session_start();
include("../inc/fonctions.php");
$info = getInfoObjetbyId($_GET['id']);
$infoemprunt = getAllEmpruntbyId($_GET['id']);
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">
            Final S2
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= !isset($_GET['moi']) && !isset($_GET['categorie']) ? 'active' : '' ?>" 
                           href="accueil.php">
                            Tous les objets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['moi']) ? 'active' : '' ?>" 
                           href="accueil.php?moi=1">
                        Mes emprunts
                        </a>
                    </li>
                </ul>

                <form class="d-flex" action="accueil.php" method="get">
                    <select name="categorie" class="form-select me-2" style="width: auto;">
                        <?php foreach ($categories as $categ) { ?>
                            <option value="<?= $categ['id_categorie'] ?>" 
                                    <?= isset($_GET['categorie']) && $_GET['categorie'] == $categ['id_categorie'] ? 'selected' : '' ?>>
                                <?= $categ['nom_categorie'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button class="btn btn-success" type="submit">
                     Filtrer
                    </button>
                </form>
                <a href="deco.php" class="btn btn-primary">Deconnexion</a>
            </div>
        </div>
    </nav>
    <h1><?= $info['nom_objet'] ?></h1>
    <h2>Proprietaire : <a href="profil.php?id=<?= $info['id_membre'] ?>"><?= $info['nom'] ?></a></h2>
    <p>Catégorie: <?= $info['nom_categorie'] ?></p>
    <h2>Historique d'emprunt:</h2>
    <ul>
        <?php foreach($infoemprunt as $inf){ ?>
            <li>Emprunté par: <?= $inf['nom_emprunt'] ?>, Date d'emprunt: <?= $inf['date_emprunt'] ?>, Date de retour: <?= $inf['date_retour'] ?></li>
        <?php } ?>
    </ul>
    <a href="accueil.php">Retour à la liste des objets</a>   
</body>
</html>