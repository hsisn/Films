<?php
include_once "header.php";

require_once("includes/db.php");
$titre = $_POST['titre'];
$duree = $_POST['duree'];
$res = $_POST['res'];
$cat = $_POST['cat'];
$prix = $_POST['prix'];

$dossier = "pochettes/";
$nomPochette = sha1($titre . time());
$pochette = "avatar.jpg";
if ($_FILES['pochette']['tmp_name'] !== "") {
    //Upload de la photo
    $tmp = $_FILES['pochette']['tmp_name'];
    $fichier = $_FILES['pochette']['name'];
    $extension = strrchr($fichier, '.');
    @move_uploaded_file($tmp, $dossier . $nomPochette . $extension);
    // Enlever le fichier temporaire chargé
    //@unlink($tmp); //effacer le fichier temporaire
    $pochette = $nomPochette . $extension;
}
$lien = $_POST['lien'];

$requete = "INSERT INTO tabfilms values(0,?,?,?,?,?,?,?)";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("sissdss", $titre, $duree, $res, $cat, $prix, $pochette, $lien);
$stmt->execute();

header('location: lister.php');


