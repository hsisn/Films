<?php
include_once "header.php";
?> 


<?php
require_once("includes/db.php");

$num = $_GET['name'];

function envoyerForm($ligne) {
    global $num;
    $rep = "<div class='container'><div class='row'> <div class='col-md-6 col-md-push-4'><form id=\"formEnreg\"  enctype=\"multipart/form-data\" action=\"modifier.php\" method=\"POST\" onSubmit=\"return valider();\">\n";
    $rep .= "	<h3>Fiche du film " . $num . " </h3><br><br>\n";
    $rep .= "	<b>Numero :</b><br><input type=\"text\" class=\"form-control\" id=\"num\" name=\"idf\" value='" . $ligne->idf . "' readonly><br>\n";
    $rep .= "	<b>Titre :</b><br><input type=\"text\" class=\"form-control\" \"form-control\" id=\"titre\" name=\"titre\" value='" . $ligne->titre . "' readonly><br>\n";
    $rep .= "	<b>Réalisateur :</b><br><input type=\"text\" class=\"form-control\" id=\"titre\" name=\"res\" value='" . $ligne->res . "' readonly><br>\n";
    $rep .= "	<b>Duree :</b><br><input type=\"text\" class=\"form-control\"id=\"duree\" name=\"duree\" value='" . $ligne->duree . "'readonly><br>\n";

    $rep .= "	<b>categorie :</b><br><input type=\"text\" class=\"form-control\"id=\"cat\" name=\"cat\" value='" . $ligne->cat . "'readonly><br>\n";

    $rep .= "	<b>Prix :</b><br><input type=\"text\" class=\"form-control\" id=\"res\" name=\"prix\" value='" . $ligne->prix . "'readonly><br><br>\n";

    $rep .= "  <b>Pochette :</b><br><img  src='pochettes/" . ($ligne->pochette) . "' width=60 height=60><br><br>\n";
    $rep .= "	<b>lien :</b><br><input type=\"text\" class=\"form-control\"id=\"lien\" name=\"lienFilm\" value='" . $ligne->lienFilm . "'readonly><br>\n";

    $rep .= "</form><a href='lister.php' style='margin-left: 10px;margin-bottom: 25px'>Retour à la page précédente</a></div></div></div>\n";
    return $rep;
}

//Obtenir le film en question
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
echo envoyerForm($ligne);
mysqli_close($connexion);
?>

<?php
include_once "footer.php";
?>