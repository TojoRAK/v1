<?php
include("../inc/fonctions.php");
session_start();
ini_set("display_errors","1");

$uploadDir = '../uploads/pubs/';
$maxSize = 5 * 1024 * 1024; 
$allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf', 'image/webp'];

// Créer le dossier d'upload s'il n'existe pas
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Vérifie si des fichiers sont soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fichier'])) {
    $files = $_FILES['fichier'];
    $uploadedFiles = [];
    
    // Traiter chaque fichier
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] != UPLOAD_ERR_OK) {
            die('Erreur lors de l\'upload du fichier ' . ($i+1) . ' : ' . $files['error'][$i]);
        }
        
        // Vérifie la taille
        if ($files['size'][$i] > $maxSize) {
            die('Le fichier ' . ($i+1) . ' est trop volumineux.');
        }
        
        // Vérifie le type MIME avec `finfo`
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $files['tmp_name'][$i]);
        finfo_close($finfo);
        
        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé pour le fichier ' . ($i+1) . ' : ' . $mime);
        }
        
        // Renommer le fichier
        $originalName = pathinfo($files['name'][$i], PATHINFO_FILENAME);
        $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;
        
        // Déplace le fichier
        if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $newName)) {
            $uploadedFiles[] = $newName;
            echo "Fichier uploadé avec succès : " . $newName . "<br>";
        } else {
            die("Échec du déplacement du fichier " . ($i+1));
        }
    }
    
    // Ajouter l'objet avec toutes ses images
    if (!empty($uploadedFiles)) {
        $result = addObjet($_SESSION["user"], $_POST['categorie'], $_POST['nom'], $uploadedFiles);
        if ($result) {
            header("Location: accueil.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'objet";
        }
    }
} else {
    echo "Aucun fichier reçu.";
}
?>
