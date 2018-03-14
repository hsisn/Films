
<script>

    $("body").delegate("#product", "click", function (event) {
        var pid = $(this).attr("pid");
        event.preventDefault();

        $.ajax({
            url: "gestionFilms.php",
            method: "POST",
            data: {addToCart: 1, proId: pid},
            success: function (data) {
                count_item();
                //getCartItem();
                $('#product_msg').html(data);

            }
        })
    })
    //ajouter film au panier
    //Count user panier items funtion
    count_item();
    function count_item() {
        $.ajax({
            url: "gestionFilms.php",
            method: "POST",
            data: {count_item: 1},
            success: function (data) {
                $(".badge").html(data);
            }
        })
    }






</script>  




<?php

include_once "header.php";
echo "<script type='text/javascript>";
echo "<link rel='stylesheet' href='css/bootstrap.min.css'>";
echo"<link rel='stylesheet' href='assets/css/style.css'>";
echo"<script src='assets/js/jquery-1.10.2.min.js'></script>";
echo"<script src='js/bootstrap.min.js'></script>";
echo"<script src='assets/js/custom.js'></script>";

echo "<script language=\"javascript\" src=\"js/global.js\"></script>
<link rel=\"stylesheet\" href=\"css/films.css\" type=\"text/css\" />";
echo "<div class=\"container\">
        <div class=\"row\">
            <a title='page index' href=\"index.php\" class=\"btn btn-primary a-btn-slide-text\">
            <span class=\"glyphicon glyphicon-th-list\" aria-hidden=\"true\" style=\"witdh:500px\"></span>

            </a>

        </div>
    </div><br>";
require_once("includes/db.php");

$num = $_GET['name'];
$requette = "SELECT * FROM tabfilms WHERE idf = $num";

echo lister($requette, $connexion);


if (isset($_GET["click"])) {

    echo msg();
    exit();
}


if (isset($_POST["addToCart"])) {
    $p_id = $_POST["proId"];


    if (isset($_SESSION["email"])) {

        $user_id = $_SESSION["email"];

        $sql = "SELECT * FROM panier WHERE idf = '$p_id' AND email = '$user_id'";
        $run_query = mysqli_query($connexion, $sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "
                             
                           			
			 <div class='row' >
					<div class='col-md-12' >
                                        <div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>film deja ajouter  Continue votre selection..!</b>
				</div>
				
				</div>		

				
			";
        } else {
            $sql = "INSERT INTO `panier`
			(`idf`, `email`) 
			VALUES ('$p_id','$user_id')";
            if (mysqli_query($connexion, $sql)) {
                echo "
                                  
					<div class='col-md-12' >
                                        <div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>film  Ajouter..!</b>
					</div>
				


					
				";
            }
        }
    }
}

///////////////////            




function lister($requette, $connexion) {
    $rep = "";
    try {
        $listeFilms = mysqli_query($connexion, $requette);
        while ($ligne = mysqli_fetch_object($listeFilms)) {
            $pro_image = ($ligne->pochette);
            
             if (isset($_SESSION["email"])) {
                 $email=$_SESSION["email"];
                  
                  }
                  else
                     {
                 $email="";
                  
                  } 
                      

            $rep .= "
            <div class='col-md-10'>
              <div id='product_msg'></div>
                <div class='panel panel-success'> 
                    <div class='panel-heading
                    
                        <span style='font-weight: bold;font-size: 15px;'>" . "<b>Titre: </b> " . ($ligne->titre) . "</span><span style='font-weight: bold;font-size: 15px;float:right'>" . "Categorie:  " . ($ligne->cat) . "</span><br>"
                    . "<b>Realisateur: </b> " . ($ligne->res) . " 
                        
                    </div>
                    <div class='panel-body'>
                   
                        
                        <img  src='pochettes/$pro_image' style='width:400px; height:400px;'/>
                         <iframe style='float: right' width='500' height='400' src='" . ($ligne->lienFilm) . "'></iframe>   
                    </div>
                    <div class='panel-heading'>
                        <span style='font-weight: bold'>" . "Prix: " . ($ligne->prix) . ".99 $</span>" .
                    ($email != 'admin@admin.com' ? "<button pid='" . ($ligne->idf) . "' style='float:right;' id='product' class='btn btn-danger btn-xs' >Ajouter Au Panier</button>" : "") .
                    " </div>
                </div>
            </div>	
			"
                    . " </div>
         ";
        }
        mysqli_free_result($listeFilms);
    } catch (Exception $e) {
        echo "Probleme pour lister";
    } finally {
        
    }
    return $rep;
}

mysqli_close($connexion);
?>

<?php

include_once "footer.php";
?>