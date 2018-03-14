
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>
<script language="javascript" src="js/global.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet" href="css/films.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />


<?php
include_once "header.php";
?>

<script>
    $(document).ready(function () {


        //remove film
        $(".remove").click(function () {
            //event.preventDefault();	

            var remove_id = $(this).attr("id");
            //$(".container-fluid").html("");
            $.ajax({
                url: "traiter.php",
                method: "POST",
                data: {removeItemFromCart: 1, rid: remove_id},
                success: function (data) {

                    $("#cart_msg").html(data);
                    window.location.reload();

                }
            })
        })







    })
</script>



<div class="wait overlay">
    <div class="loader"></div>
</div>

<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" id="cart_msg">
            <!--Cart Message--> 
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Tous les Panier</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 col-xs-2"><b>Action</b></div>
                        <div class="col-md-2 col-xs-2"><b>image film</b></div>
                        <div class="col-md-2 col-xs-2"><b>titre film</b></div>							
                        <div class="col-md-2 col-xs-2"><b>prix </b></div>

                    </div>
                    <div id="cart_checkout">





                        <?php
                        if (isset($_SESSION["email"])) {

                            $email = $_SESSION["email"];
                            $sql = "SELECT a.idf,a.pochette,a.titre,a.prix,b.id FROM tabfilms a,panier b WHERE a.idf=b.idf AND b.email='$email'";


                            $query = mysqli_query($connexion, $sql);
                            echo "<form method='post' action='login.php'>";
                            $n = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $n++;
                                $film_id = $row["idf"];
                                $titre = $row["titre"];
                                $film_prix = $row["prix"];
                                $film_image = $row["pochette"];
                                $idp = $row["id"];

                                echo '<div class="row">
                                            <div class="col-md-2">
                                                    <div class="btn-group">
                                                            <a href="#"  id="' . $idp . '" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>

                                                    </div>
                                            </div>
                                            <input type="hidden" name="product_id[]" value="' . $film_id . '"/>
                                            <input type="hidden" name="" value="' . $idp . '"/>
                                            <div class="col-md-2"><img class="img-responsive" src="pochettes/' . $film_image . '" style="width:50px; height:50px;"></div>
                                            <div class="col-md-2">' . $titre . '</div>								
                                            <div class="col-md-2"><input type="text" class="form-control price" value="' . $film_prix . '.99 $" readonly="readonly"></div>

                                        </div>';
                            }
                            ///////////////////


                            $requette = "SELECT  SUM(a.prix) AS sum_item FROM tabfilms a,panier b WHERE a.idf=b.idf AND b.email='$email'";


                            try {
                                $sum_item = mysqli_query($connexion, $requette);
                                while ($row = mysqli_fetch_array($sum_item)) {
                                    $total = $row["sum_item"];
                                }
                                mysqli_free_result($sum_item);
                            } catch (Exception $e) {
                                echo "Probleme pour le total";
                            }
                            //mysqli_close($connexion);
                            //////////////



                            echo '<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<b class="net_total" style="font-size:20px;">Total :' . $total . '.99$</b>
					</div>';

                            if (!isset($_SESSION["email"])) {
                                echo '<input type="submit" style="float:right;" name="login_user_with_film" class="btn btn-info btn-lg" value="Payer" >
							</form>';
                            } else if (isset($_SESSION["email"])) {
                                //Paypal checkout form
                                echo '
						</form>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="FilmaTec@hotmail.com">
							<input type="hidden" name="upload" value="1">';

                                $x = 0;
                                $sql = "SELECT a.idf,a.pochette,a.titre,a.prix,b.id FROM tabfilms a,panier b WHERE a.idf=b.idf AND b.email='$email'";
                                $query = mysqli_query($connexion, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    $x++;
                                    echo
                                    '<input type="hidden" name="item_name_' . $x . '" value="' . $row["titre"] . '">
								  	 <input type="hidden" name="item_number_' . $x . '" value="' . $x . '">
								     <input type="hidden" name="amount_' . $x . '" value="' . $row["prix"] . '">';
                                }
                                $email = $_SESSION["email"];
                                echo
                                '<input type="hidden" name="return" value="http://localhost/project1/payment_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/project1/payment_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/project1/cancel.php"/>
									<input type="hidden" name="currency_code" value="USD"/>
									<input type="hidden" name="custom" value="' . $email . '"/>
									<input style="float:right;margin-right:80px;" type="image" name="submit"
										src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal "
										alt="PayPal - The safer, easier way to pay online">
								</form>';
                            }

                            mysqli_close($connexion);
                        }
                        ?> 



                    </div>






                </div> 
            </div>
            <div class="panel-footer"></div>
        </div>
    </div>
    <div class="col-md-2"></div>

</div>







<?php
include_once "footer.php";
?>












