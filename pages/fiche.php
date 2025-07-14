<?php
session_start();
include("../inc/fonctions.php");
$info = getInfoObjetbyId($_GET['id']);
$infoemprunt = getAllEmpruntbyId($_GET['id']);
$categories = getCategories();
$images = getAllImages($_GET['id']);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Objet - <?= $info['nom_objet'] ?></title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
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
                        <a class="nav-link <?= isset($_GET['moi']) ? 'active' : '' ?>" href="accueil.php?moi=1">
                            Mes emprunts
                        </a>
                    </li>
                </ul>

                <form class="d-flex" action="accueil.php" method="get">
                    <select name="categorie" class="form-select me-2" style="width: auto;">
                        <?php foreach ($categories as $categ) { ?>
                            <option value="<?= $categ['id_categorie'] ?>" <?= isset($_GET['categorie']) && $_GET['categorie'] == $categ['id_categorie'] ? 'selected' : '' ?>>
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

    <div class="container mt-4">
        <h2>Proprietaire : <a href="profil.php?id=<?= $info['id_membre'] ?>"><?= $info['nom'] ?></a></h2>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0"><?= $info['nom_objet'] ?></h1>
                        <p class="mb-0 text-muted">Catégorie: <?= $info['nom_categorie'] ?></p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <?php if (!empty($images)) { ?>
                                <?php foreach ($images as $image) { ?>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="position-relative">
                                            <img src="../uploads/pubs/<?= $image['nom_image'] ?>" class="img-fluid rounded"
                                                alt="Image de l'objet" style="height: 200px; width: 100%; object-fit: cover;">
                                            <?php if ($_SESSION['user'] == $info['id_membre']) { ?>
                                                <a href="delete.php?id=<?= $image['id_image'] ?>&idObj=<?= $_GET['id'] ?>"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2">
                                                    ×
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Aucune image disponible pour cet objet.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if ($_SESSION['user'] == $info['id_membre']) { ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-plus"></i> Ajouter des images</h5>
                                </div>
                                <div class="card-body">
                                    <form action="traitement.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_objet" value="<?= $_GET['id'] ?>">
                                        <div class="mb-3">
                                            <label for="fichier" class="form-label">Sélectionner des photos</label>
                                            <input type="file" name="fichier[]" id="fichier" class="form-control" multiple
                                                required accept="image/*">

                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Ajouter les images
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-history"></i> Historique d'emprunt</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($infoemprunt)) { ?>
                            <div class="list-group">
                                <?php foreach ($infoemprunt as $inf) { ?>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><?= $inf['nom_emprunt'] ?></h6>
                                            <small><?= $inf['date_emprunt'] ?></small>
                                        </div>
                                        <?php if ($inf['date_emprunt'] != null && $inf['date_retour'] != null) { ?>
                                            <p class="mb-1">
                                                <strong>Emprunté le:</strong> <?= $inf['date_emprunt'] ?>
                                            </p>
                                            <small>
                                                <strong>Retourné le:</strong>
                                                <?= $inf['date_retour'] ? date('d/m/Y', strtotime($inf['date_retour'])) : 'Non retourné' ?>
                                            </small>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-info mb-0">
                                            Aucun emprunt enregistré pour cet objet.
                                        </div>
                                    </div>
                                <?php }
                                }
                        } else { ?>
                            <div class="alert alert-info mb-0">
                                Aucun emprunt enregistré pour cet objet.
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="accueil.php" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Retour à la liste des objets
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>