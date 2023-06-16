<?php
/*Attention si vous utilisez une session, il faut la lancer ici!!*/
session_start();
if(!isset($_SESSION['email_u'], $_SESSION['mdp_u'])){
	header("location: login.php");
}

include("connexion.php");

$email_u = $_SESSION['email_u'];
$code_postal_u = $_SESSION['code_postal_u'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['delete'])){
        header("Refresh:0");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>homepage</title>
	<style type="text/css">
        <?php include('style.css')?>
	</style>
</head>

<body>

    <div class="container">
        <div class="search-bar">
            <?php include('searchbar.php');?>
            <img src="./photos/logo/logo.png" class="logo" onclick="window.location.reload()">
            <input type="text" id="search" placeholder="Search restaurant by names or tags.." title="Type in a name">
            <div class="dropdown" style="float:right;">
                <img src="photos/logo/cart.jpg" class="logo">
                <?php include('cart.php');?>
        </div>

        <!-- <div class="filters">
            <select name="dropown" id="sortby" onchange="sortby(event)">
                <option disabled="">Sort By</option>
                <option value="rating">Sort By RATING</option>
                <option value="eta">Sort By ETA</option>
            </select>
            <button class="show-fav">Your Favourites</button>
        </div> -->
        <div class="header-title" style="margin-left: 200px; margin-top : 50px;">
            <h1>Top picks:</h1>
        </div>
        <div class="restaurants">
            
            <?php foreach($cnx->query("SELECT * FROM restaurant WHERE statut_res = 'd';") as $ligne) : ?>
                <?php
                    // $restaurant_page = implode(" ", $ligne['nom_res']);
                    $restaurant_page = strtolower($ligne['nom_res']);
                    $restaurant_page =  str_replace(" ", "_", $restaurant_page);
                ?>
                <div class="hotel-card" onclick="location.href = './restaurant/<?php echo $restaurant_page?>/<?php echo $restaurant_page?>.php';">
                    <div class="hotel-image">
                        <img src="restaurant/<?php echo $restaurant_page ?>/<?php echo $restaurant_page ?>.jpg" style="width : 480px; height : 147px; object-fit: cover;">
                    </div>
                    <div class="hotel-description">
                        <div class="hotel-name"><?php echo $ligne['nom_res'];?></div>
                        <div class="hotel-tags" style = "word-wrap : break-word;"><?php echo $ligne['mot_clef'];?></div>
                        <div style="padding: 0 10px;">
                            <span class="hotel-location fa fa-star checked">4.2</span>
                            <span class="hotel-eta">25 Mins</span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
 
    </div>
        <div class="errorNotify"></div>
    </div>
</body>
</html>
