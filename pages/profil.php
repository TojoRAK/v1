<?php
session_start();
include("../inc/fonctions.php");
$profil = getUserById($_GET['id']);
$objets = getObjetmembre($_GET['id']);
$objetsemprunte = getEmpruntbyId($_GET['id']);

$objetsParCategorie = [];
foreach ($objets as $objet) {
    $cat = $objet['id_categorie'] ?? 'Sans catégorie';
    if (!isset($objetsParCategorie[$cat])) {
        $objetsParCategorie[$cat] = [];
    }
    $objetsParCategorie[$cat][] = $objet;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-hover:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
            transform: translateY(-6px) scale(1.03);
            transition: all 0.2s;
        }
    </style>
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
                        <a class="nav-link <?= isset($_GET['moi']) ? 'active' : '' ?>" href="accueil.php?moi=1">
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
                    <input type="text" name="nom" id="nom" class="form-control me-2" placeholder="Rechercher un objet"
                        style="width: 180px;">
                    <select name="categorie" class="form-select me-2" style="width: 180px;">
                        <option value="">Tous les categories</option>
                        <?php foreach ($categories as $categ) { ?>
                            <option value="<?= $categ['id_categorie'] ?>" <?= isset($_GET['categorie']) && $_GET['categorie'] == $categ['id_categorie'] ? 'selected' : '' ?>>
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
    <hr>
    <h3>Date de Naissance : <span class="text-danger"><?= $profil['date_naissance'] ?></span></h3>
    <h3>Ville : <span class="text-danger"><?= $profil['ville'] ?> </span></h3>
    <?php if ($profil['genre'] == 'M') { ?>
        <h3>Homme</h3>
    <?php } else { ?>
        <h3 class="text-danger">Femme</h3>
    <?php } ?>
    <hr>
    <?php if ($_GET['id'] == $_SESSION['user']) { ?>
        <h3>Mes objets :</h3>
    <?php } else { ?>
        <h4>Objets de <?= $profil['nom'] ?> :</h3>
        <?php } ?>

        <?php foreach ($objetsParCategorie as $catId => $objetsCat) { ?>
            <hr>
            <h4>
                <?php
                echo isset($objetsCat[0]['nom_categorie']) ? $objetsCat[0]['nom_categorie'] : 'Sans catégorie';
                ?>
            </h4>
            <ul class="row">
                <?php foreach ($objetsCat as $objet) { ?>
                    <section class="col-lg-3 col-md-6 col-sm-12 mt-5">
                        <a class="text-decoration-none" href="fiche.php?id=<?= $objet['id_objet'] ?>">
                            <article class="card card-hover border-0 shadow-sm" style="border-radius: 12px;">
                                <?php if (getImage($objet['id_objet']) != null) { ?>
                                    <img src="../uploads/pubs/<?= getImage($objet['id_objet']) ?>" class="card-img-top" alt=""
                                        style="height: 200px; object-fit: cover;">
                                <?php } else { ?>
                                    <img src="../assets/images/default.jpg" class="card-img-top" alt=""
                                        style="height: 200px; object-fit: cover;">
                                <?php } ?>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $objet['nom_objet']; ?></h5>


                                    </p>
                                </div>
                            </article>
                        </a>
                    </section>
                <?php } ?>
            </ul>
        <?php } ?>

        <?php foreach ($objetsemprunte as $objet) { ?>
            <hr>
            <h4>Mes emprunts :</h4>
            <ul class="row">
                <section class="col-lg-3 col-md-6 col-sm-12 mt-5">
                    <a class="text-decoration-none" href="fiche.php?id=<?= $objet['id_objet'] ?>">
                        <article class="card card-hover border-0 shadow-sm" style="border-radius: 12px;">
                            <?php if (getImage($objet['id_objet']) != null) { ?>
                                <img src="../uploads/pubs/<?= getImage($objet['id_objet']) ?>" class="card-img-top" alt=""
                                    style="height: 200px; object-fit: cover;">
                            <?php } else { ?>
                                <img src="../assets/images/default.jpg" class="card-img-top" alt=""
                                    style="height: 200px; object-fit: cover;">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $objet['nom_objet']; ?></h5>
                    </a>
                    <form action="traitementretour.php" method="post">
                        <p>Etat : <select name="etat" id="">
                                <option value="ok">OK</option>
                                <option value="abime">Abimé</option>
                            </select></p>
                            <input type="hidden" name="id_objet" value="<?= $objet['id_objet'] ?>">
                            <input type="hidden" name="id_emprunt" value="<?= $objet['id_emprunt'] ?>">
                            <button type="submit">Retourner</button>
                    </form>
                <?php } ?>

</body>

</html>