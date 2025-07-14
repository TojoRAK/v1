<?php
include ("../inc/fonctions.php");
session_start();
addEmprunt($_GET['id_objet'] , $_SESSION['user'], $_GET['duree']);
header('Location:accueil.php');


?>