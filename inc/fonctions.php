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
    $sql = "SELECT nom_image , id_image FROM exm_images_objet WHERE id_objet = %d ORDER BY id_image ASC";
    $sql = sprintf($sql, $idObj);
    $result = mysqli_query(dbconnect(), $sql);
    $images = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
    }

    return $images;
}
function getInfoObjetbyId($id)
{
    $sql = "SELECT nom_objet, nom_categorie ,id_membre FROM v_objet_emprunt WHERE id_objet =%d";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

function getAllEmpruntbyId($id)
{
    $sql = "SELECT nom_emprunt, date_emprunt, date_retour FROM v_objet_emprunt WHERE id_objet =%d ORDER BY date_emprunt DESC";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    $emprunt = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emprunt[] = $row;
    }
    return $emprunt;
}
function deleteImage($id)
{
    $sql = "DELETE FROM exm_images_objet WHERE id_image = %d";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
}


function getResearchedObjets($categorie, $nom, $disponible, $offset)
{
    $sql = "SELECT * FROM v_objet_emprunt WHERE 1=1";

    if (!empty($categorie)) {
        $sql .= " AND id_categorie = " . intval($categorie);
    }
    if (!empty($nom)) {
        $sql .= " AND nom_objet LIKE '%" . mysqli_real_escape_string(dbconnect(), $nom) . "%'";
    }
    if ($disponible !== null && $disponible !== '') {
        $sql .= " AND date_emprunt IS NULL AND date_retour IS NULL";
    }

    $sql .= " ORDER BY nom_objet ASC LIMIT " . intval($offset) . ", 20";

    $result = mysqli_query(dbconnect(), $sql);
    $objets = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function getObjetmembre($id)
{
    $sql = "SELECT * FROM exm_objet WHERE id_membre = %d ORDER BY nom_objet ASC ";
    $sql = sprintf($sql, $id);
    $result = mysqli_query(dbconnect(), $sql);
    $objet = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objet[] = $row;
    }
    return $objet;
}