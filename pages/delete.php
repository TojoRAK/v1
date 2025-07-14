<?php 
include("../inc/fonctions.php");
deleteImage($_GET['id']);
header('Location:fiche.php?id='. $_GET['idObj']);