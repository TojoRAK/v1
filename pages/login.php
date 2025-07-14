<?php
if (isset($_GET['erreur'])) {
    $message = "Adresse Email ou Mot de Passe invalide";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="traitementLogin.php" method="post">
                            <h2 class="text-center mb-4">Connexion</h2>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de Passe :</label>
                                <input type="password" name="mdp" id="mdp" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>
                            <p class="text-center">Pas encore de compte ? <a href="../index.php">S'inscrire</a></p>
                            <?php if (isset($message)) { ?>
                                <div class="alert alert-danger text-center"><?php echo $message ?></div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>