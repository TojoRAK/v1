<?php
session_start();
include("../inc/fonctions.php");
$objets = getObjets();
if (isset($_GET['moi'])) {
    $objets = getObjetsEmprunt($_SESSION['user']);
}
if (isset($_GET['categorie'])) {
    $objets = getObjetsCat($_GET['categorie']);
}
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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
                <a href="addObjet.php" class="btn btn-primary">Ajouter un objet</a>

            </div>
        </div>
    </nav>
    <div class="container">
        <h3 class="mt-4">Bienvenue : <span class="text-danger"><?= getUserById($_SESSION['user'])['nom'] ?></span></h3>
        <div class="row">
            <?php foreach ($objets as $objet) { ?>
                <section class="col-lg-3 col-md-6 col-sm-12 mt-5">
<<<<<<< HEAD
                    <article class="card border-0 shadow-sm" style="border-radius: 12px;">
                        <img src="../uploads/pubs/<?= getImage($objet['id_objet']) ?>" class="card-img-top" alt="Property Image"
                            style="border-radius: 12px 12px 0 0; height: 200px; object-fit: cover;">
=======
                    <a href="fiche.php?id=<?= $objet['id_objet'] ?>"><article class="card border-0 shadow-sm" style="border-radius: 12px;">
>>>>>>> origin/Sanda
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $objet['nom_objet']; ?></h5>
                            <p class="card-text text-muted">
                                <?php if (!empty($objet['date_emprunt'])) { ?>
                                <p><b>Emprunter : </b><?= $objet['nom'] ?></p>
                                Emprunt : <?php echo $objet['date_emprunt']; ?>
                                <br>
                            <?php } ?>
                            <?php if (!empty($objet['date_retour'])) { ?>
                                Retour : <?php echo $objet['date_retour']; ?>
                            <?php } ?>
                            <?php if (empty($objet['date_emprunt']) && empty($objet['date_retour'])) { ?>
                                Disponible
                            <?php } ?>
                            </p>
                            <p><b>Categorie :</b> <?= $objet['nom_categorie'] ?> </p>
                            <p><b>Proprietaire : </b><?= $objet['nom'] ?></p>

                        </div>
                    </article>
                    </a>
                </section>
            <?php } ?>
        </div>
    </div>

</body>

</html>