<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="signin.php" method="post">
                            <h2 class="text-center mb-4">Inscription</h2>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de Passe :</label>
                                <input type="password" name="mdp" id="mdp" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" id="nom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date de Naissance :</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre :</label>
                                <select name="genre" id="genre" class="form-select">
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville :</label>
                                <input type="text" name="ville" id="ville" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">S'inscrire</button>
                            <p class="text-center">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>