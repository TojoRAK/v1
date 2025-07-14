<?php
session_start();
include("../inc/fonctions.php");
$profil = getUserById($_GET['id']);
$objets = getObjetmembre($_GET['id']);
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
                        <a class="nav-link" 
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
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['profil']) ? 'active' : '' ?>" 
                           href="profil.php?id=<?= $_SESSION['user'] ?>">
                        Mon Profil
                        </a>
                    </li>
                </ul>

                <form class="d-flex align-items-center gap-2" action="recherche.php" method="get">
                    <label for="nom" class="form-label mb-0 me-2">Nom:</label>
                    <input type="text" name="nom" id="nom" class="form-control me-2" placeholder="Rechercher un objet" style="width: 180px;">
                    <select name="categorie" class="form-select me-2" style="width: 180px;">
                        <option value="">Tous les categories</option>
                        <?php foreach ($categories as $categ) { ?>
                            <option value="<?= $categ['id_categorie'] ?>" 
                                    <?= isset($_GET['categorie']) && $_GET['categorie'] == $categ['id_categorie'] ? 'selected' : '' ?>>
                                <?= $categ['nom_categorie'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="form-check me-2">
                        <input class="form-check-input" type="checkbox" name="disponible" id="disponible"
                            <?= isset($_GET['disponible']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="disponible">Disponible</label>
                    </div>
                    <button class="btn btn-success" type="submit">
                     Filtrer
                    </button>
                </form>
                <a href="deco.php" class="btn btn-primary">Deconnexion</a>
            </div>
        </div>
    </nav>
    <h1>Profil de : <?= $profil['nom'] ?></h1>
    <?php if ($_GET['id'] == $_SESSION['user']) { ?>
        <h3>Mes objets :</h3>
    <?php } else { ?>
        <h3>Objets de <?= $profil['nom'] ?> :</h3>
    <?php } ?>
    <ul class="row">
        <?php foreach ($objets as $objet) { ?>
            <section class="col-lg-3 col-md-6 col-sm-12 mt-5">
                <a class="text-decoration-none" href="fiche.php?id=<?= $objet['id_objet'] ?>">
                    <article class="card card-hover border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $objet['nom_objet']; ?></h5>


                            </p>
                        </div>
                    </article>
                </a>
            </section>
        <?php } ?>
    </ul>
</body>

</html>