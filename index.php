<?php
include_once "header.php";

 if (logged_in() && get_name($_SESSION['email']) == 'admin') : ?>

    <div style='margin-left:30px;margin-top: 5px;background-color: yellow;font-size: 15px;float:left'><span class="glyphicon glyphicon-cog"></span><a href="lister.php" >Dashboard</a>    </div>							                         
   
<?php endif; 



?>
 
   
<br>    <br>


<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 col-md-12">
            <div id="get_category">
            </div>
            <div class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><h4>Categories</h4></a></li>
                <li><a href="#" class='category' cid='ACTION'>Action</a></li>
                <li><a href="#"class='category' cid='DRAME'>Drame at répertoire</a></li>
                <li><a href="#"class='category' cid='COMEDIE'>Comédie</a></li>
                <li><a href="#"class='category' cid='SCIENCE FICTION'>Science-ﬁction</a></li>
                <li><a href="#"class='category' cid='HORREUR'>Horreur</a></li>
                <li><a href="#"class='category' cid='SUSPENSE'>Suspense</a></li> 
                <li><a href="#"class='category' cid='POUR LA FAMILLE'>Pour la famille</a></li>



            </div> 


        </div>
        <div class="col-md-10 col-md-12">
            <div class="row">
               					

                    <div class="col-md-12 col-md-12" id="product_msg">
                    </div>
              

            </div>
            
            
            <div class="panel panel-success">
                <div class="panel-heading">Tous les  films</div>
                <div class="panel-body">
                    <div id="get_film">

                    </div>

                </div>
                <div class="panel-footer">&copy; 2018</div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>



<?php
include_once "footer.php";
?>