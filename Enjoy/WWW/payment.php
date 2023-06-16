<?php
session_start();
if(!isset($_SESSION['email_u'], $_SESSION['mdp_u'])){
	header("location: login.php");
}

include("connexion.php");
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $nom_res = key($_SESSION['cart']);
}

$email_u = $_SESSION['email_u'];
$sum = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['passer'])){
        $sum = $_SESSION['sum'];
        $id = $cnx->query("INSERT INTO commande VALUES (DEFAULT, $sum, DEFAULT, '$email_u', '$nom_res') RETURNING id_com;");
        $id = $id->fetch();
        foreach(array_keys($cart[$nom_res]) as $nom_plat){
            $id_com = $id['id_com'];
            $quantite = $cart[$nom_res][$nom_plat][0];
            $cnx->exec("INSERT INTO contient VALUES ($id_com, '$nom_plat', $quantite);");
        }
        echo $id['id_com'];
        unset($_SESSION['sum']);
        unset($_SESSION['cart']);
        header ("location: homepage.php");
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
            <img src="./photos/logo/logo.png" class="logo" onclick="location.href = 'homepage.php'">
        </div>
        

        <div style="width : 500px; margin:10px;">
            <div style="padding : 50px">
                <h1><?php echo $nom_res;?></h1>
                <p><?php echo $_SESSION['adresse_u'], $_SESSION['code_postal_u']?></p>
            </div>
            <hr>
            <div style="padding : 50px">
                <h3>Mode of payment</h3>
                <p><?php echo $_SESSION['carte_bancaire'];?></p>
            </div>
            <hr>
            <div style="padding : 50px">
                <h3>Your articles</h3>
                <?php foreach(array_keys($cart[$nom_res]) as $nom_plat) : ?>
                    <?php $sum += $cart[$nom_res][$nom_plat][0]*$cart[$nom_res][$nom_plat][1];?>
                    <p><?php echo $nom_plat." QUANTITE : ".$cart[$nom_res][$nom_plat][0]." PRIX : ".$cart[$nom_res][$nom_plat][1];?></p>
                <?php endforeach;?>
            </div>
            <hr>
            
            <div style="padding : 50px">
                <h3>Facture</h3>
                <p style="float : left;">Sous-Total : <?php echo $sum?></p><br>
                <p style="float : left;">Frais</p><br>
                <p style="float : left;">Service : 0.48</p><br>
                <p style="float : left;">Livraison : 1.49</p><br>
                <?php $sum = $sum + 0.48 + 1.49?>
                <?php $_SESSION['sum'] = $sum?>
                <p style="float : left;">Total : <?php echo $sum?></p><br>
            </div>
            <hr>
            <form action="" method="post" style="padding : 50px">
                    <button type="submit" name="passer" value="Commander" style="width:500px;height:50px;">Commander</button>
            </form>
        </div>

        
    </div>

    <div class="errorNotify"></div>
</body>
</html>
