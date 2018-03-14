<?php
include_once "header.php";

require_once("includes/db.php");

$num = $_POST['num'];
$titre = $_POST['titre'];
$duree = $_POST['duree'];
$res = $_POST['res'];
$cat = $_POST['cat'];
$prix = $_POST['prix'];
$dossier = "pochettes/";
$lien = $_POST['lienFilm'];
$requette = "SELECT pochette FROM tabfilms WHERE idf=?";
$stmt = $connexion->prepare($requette);
$stmt->bind_param("i", $num);
$stmt->execute();
$result = $stmt->get_result();
$ligne = $result->fetch_object();
$pochette = $ligne->pochette;
if ($_FILES['pochette']['tmp_name'] !== "") {
    //enlever ancienne pochette
    if ($pochette != "avatar.jpg") {
        $rmPoc = 'pochettes/' . $pochette;
        $tabFichiers = glob('pochettes/*');
        //print_r($tabFichiers);
        // parcourir les fichier
        foreach ($tabFichiers as $fichier) {
            if (is_file($fichier) && $fichier == trim($rmPoc)) {
                // enlever le fichier
                unlink($fichier);
                break;
                //
            }
        }
    }
    $nomPochette = sha1($titre . time());
    //Upload de la photo
    $tmp = $_FILES['pochette']['tmp_name'];
    $fichier = $_FILES['pochette']['name'];
    $extension = strrchr($fichier, '.');
    $pochette = $nomPochette . $extension;
    @move_uploaded_file($tmp, $dossier . $nomPochette . $extension);
    // Enlever le fichier temporaire chargé
    @unlink($tmp); //effacer le fichier temporaire
}
$requette = "UPDATE tabfilms set titre=?,duree=?,res=?,cat=?,prix=?,pochette=?,lienFilm=? WHERE idf=?";
$stmt = $connexion->prepare($requette);
$stmt->bind_param("sissdssi", $titre, $duree, $res, $cat, $prix, $pochette, $lien, $num);
$stmt->execute();
mysqli_close($connexion);
header('location: lister.php');
include_once "footer.php";
?>

