<?php
/*Attention si vous utilisez une session, il faut la lancer ici!!*/
session_start();
if(!isset($_SESSION['email_u'], $_SESSION['mdp_u'])){
	header("location: login.php");
}


include "connexion.php";


$email_u = $_SESSION['email_u'];
$code_postal_u = $_SESSION['code_postal_u'];


$nom_res_php =  basename($_SERVER['PHP_SELF'], ".php");
$nom_res = str_replace("_", " ", $nom_res_php);
$nom_res = ucwords($nom_res, " \t\r\n\f\v'");
$cart = array();

$res = $cnx->query("SELECT * FROM restaurant WHERE nom_res = '$nom_res';");

$ligne = $res->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }
    if(isset($_POST['add'])){
        if(count($cart) == 0 || key($cart) != $nom_res){
            $cart = array();
            $cart[$nom_res] = array();
        }
        if(!isset($cart[$nom_res][$_POST['add']])){
            $cart[$nom_res][$_POST['add']][0] = 1;
            $cart[$nom_res][$_POST['add']][1] = $_POST['prix'];
        }else{
            $cart[$nom_res][$_POST['add']][0]++;
        }

        $_SESSION['cart'] = $cart;
    }
    if(isset($_POST['delete'])){
        header("Refresh:0");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $nom_res_php ?></title>
	<style type="text/css">
        <?php include('../../style.css')?>
	</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- <div class="container">
        <div class="search-bar">
            <?php include('searchbar.php');?>
            <img src="../../photos/logo/logo.png" class="logo" onclick="location.href = '../../homepage.php'">
            <input type="text" id="search" placeholder="Search restaurant by names or tags.." title="Type in a name">
            <div class="dropdown" style="float:right;">
                <img src="../../photos/logo/cart.jpg" class="logo">
            <?php include('cart.php');?>
        </div>
        <div class="banner">
            <img src="../../restaurant/blue_moon_over_avila/blue_moon_over_avila.jpg" style="width : 100%; height : 160px; object-fit : cover;">
            <div class="res_info" style="margin-left: 200px; margin-top : 50px;">
                <h1><?php echo $nom_res?></h1>
                <i class="fa fa-map-marker" style="font-size:24px"></i>
                <?php echo $ligne['adresse_res'];?><br>
                <i class="fa fa-clock-o" style="font-size:24px"></i>
                <?php echo $ligne['horrais_ouvri']." - ".$ligne['horrais_ferme'];?><br>
            </div>
        </div>
        <div class="restaurants">
            <?php foreach($cnx->query("SELECT * FROM proposer NATURAL JOIN plat WHERE nom_res = '$nom_res';") as $ligne) : ?>
                <?php
                    $plat_img = strtolower($ligne['nom_plat']);
                    $plat_img =  str_replace(" ", "_", $plat_img);
                ?>
                <div class="hotel-card">
                    <div class="hotel-image">
                        <img src="../../food-sample.jpg" style="width : 480px; height : 147px; object-fit: cover;">
                    </div>
                    <div class="hotel-description">
                        <div class="hotel-name"><?php echo $ligne['nom_plat'];?></div>
                        <div class="hotel-tags" style = "word-wrap : break-word;"><?php echo $ligne['desc_plat'];?></div>
                        <div style="padding: 0 10px;">
                            <span style="float:left;"><?php echo $ligne['prix']?>€</span>
                            <form action="<?php echo $nom_res_php?>.php" method = "post">
                                <input type="hidden" name="prix" value="<?php echo $ligne['prix'];?>">
                                <button style="float:right;"type="submit" name="add" value = "<?php echo $ligne['nom_plat']?>">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
 
    </div>
        <div class="errorNotify"></div>
    </div> -->
</body>
</html>
