<?php 
require("../include/fonctions.php");
ini_set("display_errors" ,1);
signin($_POST['email'] , $_POST['mdp'] , $_POST['nom'] , $_POST['date'] , $_POST['genre'] , $_POST['ville'] , $_POST['image']);
header('Location:login.php');
