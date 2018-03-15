//vue films
function listerF(listFilms) {
    var taille = listFilms.length;
    var rep = "<div class='col-md-4'>";

    for (var i = 0; i < taille; i++) {

<<<<<<< HEAD
            rep += "<div class='panel panel-success'>";
                rep += "<div class='panel-heading'><span style='font-weight: bold;font-size: 15px;'>" + listFilms[i].titre + "</span><br>"+listFilms[i].res+"</div>";
                    
                    rep += "<div class='panel-body'>";
                    rep += "<a  href=\"afficherDetail.php?name=" + listFilms[i].idf + "\" class=\"thumbnail\"><img src='pochettes/"+listFilms[i].pochette +"' style='width:250px; height:250px;'/></a>";
                    rep+="</div>";
                    
                    rep += "<div class='panel-heading'><span style='font-weight: bold'>" + listFilms[i].prix + "</span>" ;
                    rep += "<button pid=" + listFilms[i].idf + " style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter Au Panier</button> </div>";

            rep += "</div>";
        rep += "</div>";
    }
    
  $('#get_film').html(rep);
=======
        rep += "<div class='panel panel-success'>";
        rep += "<div class='panel-heading'><span style='font-weight: bold;font-size: 15px;'>" + listFilms[i].titre + "</span><br>$pro_res</div>";
        rep += "<div class='panel-body'>";
        rep += "<a  href=\"afficherDetail.php?name=" + listFilms[i].idf + "\" class=\"thumbnail\"><img src='pochettes/"+listFilms[i].pochette +"' style='width:250px; height:250px;'/></a></div>";
        rep += "<div class='panel-heading'><span style='font-weight: bold'>" + listFilms[i].prix + "</span>" + "($email != 'admin@admin.com' ?";
        rep += "<button pid=" + listFilms[i].idf + " style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter Au Panier</button> : ) + </div>";

        rep += "</div>";
        rep += "</div>";
    }
    $('#get_film').html(rep);
>>>>>>> 1f369710d226e425d6cb5fce301e6286a41631aa
}


function afficherFiche(reponse) {
    var uneFiche;
    if (reponse.OK) {
        uneFiche = reponse.fiche;
        $('#formFicheF h3:first-child').html("Fiche du film numero " + uneFiche.idf);
        $('#idf').val(uneFiche.idf);
        $('#titreF').val(uneFiche.titre);
        $('#dureeF').val(uneFiche.duree);
        $('#resF').val(uneFiche.res);
        $('#divFormFiche').show();
        document.getElementById('divFormFiche').style.display = 'block';
    } else {
        $('#messages').html("Film " + $('#numF').val() + " introuvable");
        setTimeout(function () {
            $('#messages').html("");
        }, 5000);
    }

}

var filmsVue = function (reponse) {
    var action = reponse.action;
    switch (action) {
        case "enregistrer" :
        case "enlever" :
        case "modifier" :
            $('#messages').html(reponse.msg);
            setTimeout(function () {
                $('#messages').html("");
            }, 5000);
            break;
        case "lister" :
            listerF(reponse.listeFilms);
            break;
        case "fiche" :
            afficherFiche(reponse);
            break;

    }
}

