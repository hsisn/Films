<?php
session_start();
require_once("includes/db.php");
//Remove film du panier
if (isset($_POST["removeItemFromCart"])) {
    $remove_id = $_POST["rid"];
    //if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    $sql = "DELETE FROM panier WHERE id = '$remove_id' AND email=  '$email'  ";
    if (mysqli_query($connexion, $sql)) {
        echo "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <b>film supprimer  dans le panier</b>
        </div>";
        exit();
    }
}                                                        

                                     
                                                                
                        