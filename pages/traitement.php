<?php
include("../inc/fonctions.php");
session_start();
ini_set("display_errors", "1");

$uploadDir = '../uploads/pubs/';
$maxSize = 5 * 1024 * 1024;
$allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf', 'image/webp'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fichier'])) {
    $files = $_FILES['fichier'];
    $uploadedFiles = [];

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] != UPLOAD_ERR_OK) {
            die('Erreur lors de l\'upload du fichier ' . ($i + 1) . ' : ' . $files['error'][$i]);
        }

        if ($files['size'][$i] > $maxSize) {
            die('Le fichier ' . ($i + 1) . ' est trop volumineux.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $files['tmp_name'][$i]);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé pour le fichier ' . ($i + 1) . ' : ' . $mime);
        }

        $originalName = pathinfo($files['name'][$i], PATHINFO_FILENAME);
        $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;

        if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $newName)) {
            $uploadedFiles[] = $newName;
            echo "Fichier uploadé avec succès : " . $newName . "<br>";
        } else {
            die("Échec du déplacement du fichier " . ($i + 1));
        }
    }

    if (!empty($uploadedFiles)) {
        addObjet($_SESSION["user"], $_POST['categorie'], $_POST['nom'], $uploadedFiles);
        header("Location: ../pages/accueil.php");
        exit();
    }
} else {
    echo "Aucun fichier reçu.";
}
?>