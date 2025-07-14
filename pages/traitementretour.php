<?php
session_start(); 
include("../inc/fonctions.php");    
supprimerEmprunt($_POST['id_emprunt']);
ajouterRetour($_POST['id_objet'], $_POST['etat'], $_SESSION['user']);
header('Location:profil.php?id=' . $_SESSION['user']);