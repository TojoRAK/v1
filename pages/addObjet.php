<?php
include("../inc/fonctions.php");
$categories = getCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un objet</title>
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
                        <a class="nav-link" href="accueil.php">
                            Tous les objets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accueil.php?moi=1">
                            Mes emprunts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="addObjet.php">
                            Ajouter un objet
                        </a>
                    </li>
                </ul>
                <a href="deco.php" class="btn btn-primary">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">
                            Ajouter un nouvel objet
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="traitement.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-tag"></i> Nom de l'objet
                                </label>
                                <input type="text" name="nom" id="nom" class="form-control" required
                                    placeholder="Entrez le nom de l'objet">
                            </div>

                            <div class="mb-3">
                                <label for="categorie" class="form-label">
                                    Catégorie de l'objet
                                </label>
                                <select name="categorie" id="categorie" class="form-select" required>
                                    <option value="">-- Sélectionnez une catégorie --</option>
                                    <?php foreach ($categories as $categ) { ?>
                                        <option value="<?= $categ['id_categorie'] ?>">
                                            <?= $categ['nom_categorie'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="fichier" class="form-label">
                                    Ajouter des photos
                                </label>
                                <input type="file" name="fichier[]" id="fichier" class="form-control" multiple required
                                    accept="image/*">

                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Ajouter l'objet
                                </button>
                                <a href="accueil.php" class="btn btn-secondary">
                                    Retour à l'accueil
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>