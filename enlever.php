<?php
include_once "header.php";

require_once("includes/db.php");
$num = $_GET['name'];
$requete = "SELECT * FROM tabfilms WHERE idf=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $num);
$stmt->execute();
$result = $stmt->get_result();
if (!$ligne = $result->fetch_object()) {
    echo "Film " . $num . " introuvable";
    mysqli_close($connexion);
    exit;
}
$pochette = $ligne->pochette;
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
        }
    }
}
$requete = "DELETE FROM tabfilms WHERE idf=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $num);
$stmt->execute();
mysqli_close($connexion);
header('location: lister.php');

include_once "footer.php";
?>
