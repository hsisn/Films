<?php
include_once "header.php";
?> 
<div class="container">
    <div class="row">

        <a href="lister.php" class="btn btn-primary a-btn-slide-text" title="lister">
            <span class="glyphicon glyphicon-th-list" aria-hidden="true" ></span>

        </a>

    </div>

</div>

<div id="ajouter" class="container">
    <div class="raw">
        <div class="col-md-8">
            <form id="formEnreg" enctype="multipart/form-data" action="enregistrer.php" method="POST" onSubmit="return valider();">
                <h3>Ajouter un film</h3>
                <div class="form-group">
                    <label for="titre">Titre:</label>
                    <input type="text" class="form-control" id="titre" name="titre">
                </div>

                <div class="form-group">
                    <label for="duree">Durée:</label>
                    <input type="text" class="form-control" id="duree" name="duree">
                </div>
                <div class="form-group">
                    <label for="realisateur">Réalisateur:</label>
                    <input type="text" class="form-control" id="realisateur" name="res">
                </div>

                <div class="form-group">
                    <label for="categorie">Catégorie:</label>
                    <select class="form-control" id="categorie" name="cat">
                        <option>ACTION</option>
                        <option>SUSPENSE</option>
                        <option>COMEDIE</option>
                        <option>DRAME</option>
                        <option>SCIENCE FICTION</option
                        <option>HORREUR</option>
                        <option>POUR LA FAMILLE</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="prix">Prix:</label>
                    <input type="text" class="form-control" id="prix" name="prix">
                </div>


                <div class="form-group">
                    <label for="pochette">Pochette:</label>
                    <input type="file" class="form-control-file" id="pochette" name="pochette" aria-describedby="fileHelp">
                </div>
                <div class="form-group">
                    <label for="prix">Lien:</label>
                    <input type="text" class="form-control" id="lien" name="lien">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button><br><br>
                <a href="lister.php">Retour à la liste</a>
            </form>
        </div>
    </div>
</div>


<?php
include_once "footer.php";
?>