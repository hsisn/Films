<?php

include_once "header.php";
?>  
<script language="javascript" src="js/global.js"></script>
<link rel="stylesheet" href="css/films.css" type="text/css" />

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php

require_once("includes/db.php");
$num = $_GET['name'];

function envoyerForm($ligne) {
    global $num;
    $rep = "<div class='form-group' ><div class='row'><div class='col-md-6 col-md-push-4 ' ><form id=\"formEnreg\"  enctype=\"multipart/form-data\" action=\"modifier.php\" method=\"POST\" onSubmit=\"return valider();\">\n";
    $rep .= "	<h3>Fiche du film " . $num . " </h3><br><br>\n";
    $rep .= "	Numero:<input type=\"text\" class='form-control' id=\"num\" name=\"num\" value='" . $ligne->idf . "' readonly><br>\n";
    $rep .= "	Titre:<input type=\"text\" class='form-control' id=\"titre\" name=\"titre\" value='" . $ligne->titre . "'><br>\n";
    $rep .= "	Duree:<input type=\"text\" class='form-control' id=\"duree\" name=\"duree\" value='" . $ligne->duree . "'><br>\n";
    $rep .= "	Realisateur:<input type=\"text\"  class='form-control' id=\"res\" name=\"res\" value='" . $ligne->res . "'><br><br>\n";
    //$rep .= "	Categorie:<input type=\"text\" class='form-control' id=\"cat\" name=\"cat\" value='" . $ligne->cat . "'><br><br>\n";
    $rep .= "<div class=\"form-group\">
	
        Categorie
	<select class=\"form-control\" id=\"sel1\" name=\"cat\">
	<option>" . $ligne->cat . "</option>
        <option>ACTION</option>
	<option>COMEDIE</option>
	<option>SCIENCE FICTION</option>
	<option>HORREUR</option>
	<option>SUSPENSE</option>
        <option>POUR LA FAMILLE</option>
            
	</select>
	</div>";
    $rep .= "	Prix:<input type=\"text\" class='form-control' id=\"prix\" name=\"prix\" value='" . $ligne->prix . "'><br><br>\n";
    $rep .= "  Pochette:<input type=\"file\" class='form-control' id=\"pochette\" name=\"pochette\"><br><br>";
    $rep .= "	<b>Le lien pour la bande annonce :</b><br><input type=\"text\" class=\"form-control\" id=\"res\" name=\"lienFilm\" value='" . $ligne->lienFilm . "'><br><br>\n";
    $rep .= "	<input type=\"submit\"  value=\"Modifier\"><br><br>\n";
    $rep .= "</form>" . "<a href='lister.php'>Retour à la liste</a>" . "</div></div></div>\n";
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

include_once "footer.php";
?>
