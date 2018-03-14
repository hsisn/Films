<?php
include_once "header.php";

echo "<div class=\"container\">
    <div class=\"row\">
        <a href=\"ajouter.php\" class=\"btn btn-primary a-btn-slide-text\" title=\"ajouter\">
            <span  class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\" ></span>

        </a>
        <a href=\"lister.php\" class=\"btn btn-primary a-btn-slide-text\" title=\"lister\">
            <span  class=\"glyphicon glyphicon-th-list\" aria-hidden=\"true\" ></span>

        </a>
        
    </div>
    
</div>
";
require_once("includes/db.php");

echo "
<div class=\"container\">
	<table  class=\"table table-striped\">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Titre</th>
				<th>Réalisateur</th>
				<th>Durée</th>
				<th>Prix</th>				
                                <th>Catégorie</th>
				<th>Pochette</th>
                                <th>Fonctions</th>
			</tr>
		</thead>
		<tbody>
	";
$requette = "SELECT * FROM tabfilms order by idf";
$rep = "";
try {
    $listeFilms = mysqli_query($connexion, $requette);
    while ($ligne = mysqli_fetch_object($listeFilms)) {
        $rep .= "<tr><td>" . ($ligne->idf) . "</td><td>" . ($ligne->titre) . "</td><td>" . ($ligne->res) . "</td><td>" . ($ligne->duree) . "</td><td>" . ($ligne->prix) . ".99 $</td><td>" . ($ligne->cat) . "</td><td><img src='pochettes/" . ($ligne->pochette) . "' width=60 height=60></td><td>
	<div class=\"row\">
      
      <a href=\"fiche.php?name=" . ($ligne->idf) . " \" class=\"btn btn-primary a-btn-slide-text\">
        <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>
                  
      </a>
      <a  href=\"detail.php?name=" . ($ligne->idf) . "\" class=\"btn btn-primary a-btn-slide-text\">
        <span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>
                   
      </a>
       <a  name=\"effacer\"  href='#' id='" . ($ligne->idf) . "' class=\"btn btn-primary a-btn-slide-text\">      
       <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
                  
     </a>
   </div>
		</td></tr>";
    }
    mysqli_free_result($listeFilms);
} catch (Exception $e) {
    echo "Probleme pour lister";
} finally {

    $rep .= "</tbody></table>" . "<a href='index.php'>Retour à la page d'accueil</a>" . "</div>";
    echo $rep;
}
mysqli_close($connexion);

include_once "header.php";
?> 
<script>
    $(document).ready(function () {

        $("[name='effacer']").each(function (index, value) {


            $(this).click(
                    function () {

                        var r = confirm("Voullez-vous supprimer ce film");
                        if (r == true) {
                            window.location.replace("enlever.php?name=" + $(this).attr("id"));
                        } else {

                            window.location.replace("lister.php");
                        }

                    });
        });

    });
</script>

