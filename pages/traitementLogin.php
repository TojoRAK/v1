<?php
require("../inc/fonctions.php");
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$user = loginUser($email, $mdp);

if ($user == null) {
    header('Location:../pages/login.php?erreur=1');
} else {
    session_start();

    $_SESSION['user'] = $user['id_membre'];
    header('Location:../pages/accueil.php');
}
