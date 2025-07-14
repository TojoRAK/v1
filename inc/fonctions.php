<?php
require("connexion.php");
ini_set("display_errors", 1);
function signin($email, $mdp, $nom, $dateNaissance, $genre, $ville, $image)
{

    $sql = "INSERT INTO exm_membre (nom , date_naissance ,genre ,email,ville,mdp,image_profil) VALUES ('%s' , '%s' , '%s' , '%s', '%s', '%s', '%s');";
    $sql = sprintf($sql, $nom, $dateNaissance, $genre, $email, $ville, $mdp, $image);
    $requete = mysqli_query(dbconnect(), $sql);
}
function loginUser($email, $mdp)
{

    $sql = "SELECT * FROM exm_membre WHERE email = '%s' AND mdp = '%s'";
    $sql = sprintf($sql, $email, $mdp);

    $result = mysqli_query(dbconnect(), $sql);

    $user = mysqli_fetch_assoc($result);
    $row = mysqli_num_rows($result);
    echo $sql;

    if ($row > 0) {
        return $user;
    } else {
        return null;
    }
}

function getObjets()
{
    $sql = "SELECT * FROM v_objet_emprunt ORDER BY nom_objet ASC";
    $result = mysqli_query(dbconnect(), $sql);
    $objet = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objet[] = $row;
    }
    return $objet;
}
function getObjetsEmprunt($id)
{
    $sql = "SELECT * FROM v_objet_emprunt WHERE id_mpindrana = %d ORDER BY nom_objet ASC";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    $objet = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objet[] = $row;
    }
    return $objet;
}
function getCategories()
{
    $sql = "SELECT * FROM exm_categorie_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $objet = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objet[] = $row;
    }
    return $objet;
}

function getObjetsCat($id)
{
    $sql = "SELECT * FROM v_objet_emprunt WHERE id_categorie=%d ORDER BY nom_objet ASC";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    $objet = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objet[] = $row;
    }
    return $objet;
}
function getUserById($id)
{
    $sql = "SELECT * FROM exm_membre WHERE id_membre =%d";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

function addObjet($idMembre, $idCateg, $nomObjet, $images)
{
    $connexion = dbconnect();

    $sql = "INSERT INTO exm_objet (nom_objet, id_categorie, id_membre) VALUES ('%s' , %d , %d)";
    $sql = sprintf($sql, $nomObjet, $idCateg, $idMembre);
    $result = mysqli_query($connexion, $sql);

    if ($result) {
        $idObjet = mysqli_insert_id($connexion);

        foreach ($images as $image) {
            $sql2 = "INSERT INTO exm_images_objet (id_objet, nom_image) VALUES (%d, '%s')";
            $sql2 = sprintf($sql2, $idObjet, $image);
            $result2 = mysqli_query($connexion, $sql2);
        }
    }
}

function getImage($idObj)
{
    $sql = "SELECT nom_image FROM exm_images_objet WHERE id_objet = %d ORDER BY id_image ASC LIMIT 1";
    $sql = sprintf($sql, $idObj);
    $result = mysqli_query(dbconnect(), $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nom_image'];
    }
    
    return null; 
}

function getAllImages($idObj)
{
    $sql = "SELECT nom_image FROM exm_images_objet WHERE id_objet = %d ORDER BY id_image ASC";
    $sql = sprintf($sql, $idObj);
    $result = mysqli_query(dbconnect(), $sql);
    $images = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row['nom_image'];
    }
    
    return $images;
}
