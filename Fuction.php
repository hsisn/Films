<?php

function lister($requette, $connexion) {
    $rep = "";
    try {
        $listeFilms = mysqli_query($connexion, $requette);
        while ($ligne = mysqli_fetch_object($listeFilms)) {
            $rep .= "<div class=\"col-md-2\">
      <div class=\"thumbnail\">
      <a href=" . ($ligne->lienFilm) . ">
      <img src='./image/" . ($ligne->pochetteFilm) . "'  alt=\"Nature\" style=\"width:100%\" >
      <div class=\"caption\">
      <h3><b>Titre :</b> <br>" . ($ligne->titre) . "</h3>
      <h4><b>Réalisateur :</b> <br> " . ($ligne->res) . "</h4>
      <h4><b>Durée :</b> <br> " . ($ligne->duree) . " mn</h4>
      <h4><b>Catégorie :</b> <br> " . ($ligne->cat) . "</h4>
      <h4><b>Prix :</b> <br> " . ($ligne->prix) . " $</h4>
          <iframe width=\"420\" height=\"315\" src='" . ($ligne->lienFilm) . "'></iframe>
      <div><span id=\"panier\" class=\"glyphicon glyphicon-shopping-cart\" style=\"color: green; font-size: 20pt\"  >
      </div>
      </div>
      </a>
      </div>
      </div>";
        }
        mysqli_free_result($listeFilms);
    } catch (Exception $e) {
        echo "Probleme pour lister";
    } finally {
        
    }
    return $rep;
}

echo lister($requette, $connexion);

mysqli_close($connexion);
?>
