
<?php

session_start();
//$ip_add = getenv("REMOTE_ADDR");
include "includes/db.php";


if (isset($_POST["getfilm"])) {

    $film_query = "SELECT * FROM tabfilms ";
    $run_query = mysqli_query($connexion, $film_query);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {

            $pro_id = $row['idf'];
            $pro_titre = $row['titre'];
            $pro_durre = $row['duree'];
            $pro_res = $row['res'];
            $pro_cat = $row['cat'];
            $pro_prix = $row['prix'];
            $pro_image = $row['pochette'];
            $_SESSION['idf'] = $pro_id;
            if (isset($_SESSION["email"])) {
                $email = $_SESSION["email"];
            } else {
                $email = "";
            }

/*
            echo "
            <div class='col-md-4'>
                <div class='panel panel-success'> 
                    <div class='panel-heading'><span style='font-weight: bold;font-size: 15px;'>$pro_titre</span><br>$pro_res
                    </div>
                    
                    <div class='panel-body'>
                    <a  href=\"afficherDetail.php?name=" . ($pro_id) . "\" class=\"thumbnail\">	<img src='pochettes/$pro_image' style='width:250px; height:250px;'/></a>
                    </div>
                    
                    <div class='panel-heading'><span style='font-weight: bold'>$pro_prix.99 $</span>" .($email != 'admin@admin.com' ? 
                    "<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter Au Panier</button>" : "") .
                    "</div>
                                                            
                </div>
            </div>";*/
        }
    }
}


//////////click categorie

if (isset($_POST["get_seleted_Category"])) {
    $cat = $_POST["cat_id"];
    $sql = "SELECT * FROM tabfilms WHERE cat = '$cat'";


    $run_query = mysqli_query($connexion, $sql);
    while ($row = mysqli_fetch_array($run_query)) {
        $pro_id = $row['idf'];
        $pro_titre = $row['titre'];
        $pro_durre = $row['duree'];
        $pro_res = $row['res'];
        $pro_cat = $row['cat'];
        $pro_prix = $row['prix'];
        $pro_image = $row['pochette'];

        if (isset($_SESSION["email"])) {
            $email = $_SESSION["email"];
        } else {
            $email = "";
        }
        echo "
				<div class='col-md-4'>
							<div class='panel panel-success'> 
                                                        
		
								<div class='panel-heading'><span style='font-weight: bold;font-size: 15px;'>$pro_titre</span><br>$pro_res</div>
								<div class='panel-body'>
								<a  href=\"afficherDetail.php?name=" . ($pro_id) . "\" class=\"thumbnail\">	"
        . "<img src='pochettes/$pro_image' style='width:250px; height:250px;'/></a>
								</div>
								<div class='panel-heading'><span style='font-weight: bold'>$pro_prix.99 $</span>" .
        ($email != 'admin@admin.com' ? "  <button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter Au Panier</button>" : "") .
        "</div>
                                                            
							</div>
						</div>	
			";
    }
}
////////achat film//////////////////////////////////
if (isset($_POST["addToCart"])) {


    $p_id = $_POST["proId"];


    if (isset($_SESSION["email"])) {

        $user_id = $_SESSION["email"];

        $sql = "SELECT * FROM panier WHERE idf = '$p_id' AND email = '$user_id'";
        $run_query = mysqli_query($connexion, $sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>film deja ajouter  Continue votre selection..!</b>
				</div>
			";
        } else {
            $sql = "INSERT INTO `panier`
			(`idf`, `email`) 
			VALUES ('$p_id','$user_id')";
            if (mysqli_query($connexion, $sql)) {
                echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>film  Ajouter..!</b>
					</div>
				";
            }
        }
        header('location: index.php');
    }
}

//Count User panier item
if (isset($_POST["count_item"])) {

    if (isset($_SESSION["email"])) {
        $adr = $_SESSION["email"];
        $requette = "SELECT COUNT(*) AS count_item FROM panier WHERE email = '$adr'";


        try {
            $count_item = mysqli_query($connexion, $requette);
            while ($row = mysqli_fetch_array($count_item)) {
                $_SESSION["count"] = $row["count_item"];
                echo $_SESSION["count"];
            }
            mysqli_free_result($count_item);
        } catch (Exception $e) {
            echo "Probleme pour lister";
        }
    } else {

        //  header('location:login.php') ; 

        echo 0;
    }

    mysqli_close($connexion);

    exit();
}
       
      
