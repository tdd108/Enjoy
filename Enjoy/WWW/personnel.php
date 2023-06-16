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

    if(isset($_POST['annuler'])){
        $id_com = $_POST['annuler'];
        echo $id_com;
        $cnx->exec("DELETE FROM contient WHERE id_com = $id_com;");
        $cnx->exec("DELETE FROM commande WHERE id_com = $id_com;");
        header("Refresh:0");
    }

    if(isset($_POST['envoyer'])){
        $id_com = $_POST['envoyer'];
        $rate = $_POST['rate'];
        $cmt = $_POST['commentaire'];
        $nom_res = $_POST['nom_res'];
        $cnx->exec("INSERT INTO commentaire VALUES('$email_u', '$nom_res', '$cmt', $rate);");
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
            <input type="text" id="search" placeholder="Search restaurant by names or tags.." title="Type in a name">
            <div class="dropdown" style="float:right;">
                <img src="photos/logo/cart.jpg" class="logo">
                <?php include('cart.php');?>
        </div>

        <div class="header-title" style="width:100%; padding:50px">
            <h1>Commande Attente</h1>
        </div>
        <div class="restaurants" style="margin:0px; width:100%;">
            <?php if($cnx->query("SELECT * FROM commande NATURAL JOIN contient WHERE email_u = '$email_u' AND statut_com = 'at';")) : ?>
                <?php foreach($cnx->query("SELECT * FROM commande WHERE email_u = '$email_u' AND statut_com = 'at';") as $ligne) : ?>
                    <?php
                        $plat_img = strtolower($ligne['nom_res']);
                        $plat_img =  str_replace(" ", "_", $plat_img);
                    ?>
                    <div class="hotel-card">
                        <div class="hotel-image" style="height:100%">
                            <img src="./restaurant/<?php echo $plat_img?>/<?php echo $plat_img?>.jpg" style="width : 320px; height : 140px">
                        </div>
                        <div class="hotel-description" style="word-wrap: break-word;">
                            <div class="hotel-name"><?php echo $ligne['nom_res'];?></div>
                            <div class="hotel-tags"><?php echo "MONTANT : ".$ligne['montant'];?></div>
                            <div style="padding: 0 10px;">
                            <form action="" method = "post">
                                <button style="margin-top:10px;float:right;"type="submit" name="annuler" value = "<?php echo $ligne['id_com']?>">Annuler</button>
                            </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

        <div class="header-title" style="width:100%; padding:50px">
            <h1>Commandes passées</h1>
        </div>
        <div class="restaurants" style="margin:0px; width:100%;">
            <?php if($cnx->query("SELECT * FROM commande NATURAL JOIN contient WHERE email_u = '$email_u' AND statut_com = 'l';")) : ?>
                <?php foreach($cnx->query("SELECT * FROM commande WHERE email_u = '$email_u' AND statut_com = 'l';") as $ligne) : ?>
                    <?php
                        $plat_img = strtolower($ligne['nom_res']);
                        $plat_img =  str_replace(" ", "_", $plat_img);
                    ?>
                    <div class="hotel-card">
                        <div class="hotel-image" style="height:100%">
                            <img src="./restaurant/<?php echo $plat_img?>/<?php echo $plat_img?>.jpg" style="width : 320px; height : 140px">
                        </div>
                        <div class="hotel-description" style="word-wrap: break-word;">
                            
                            <div class="hotel-name"><?php echo $ligne['nom_res'];?></div>
                                <div class="hotel-tags"><?php echo "MONTANT : ".$ligne['montant'];?></div>
                                <div style="padding: 0 10px;">
                                <?php 
                                    $name = "commenter";
                                    $name .= $ligne['id_com'];
                                ?>
                                <?php if(isset($_POST[$name])) : ?>
                                    <form action="" method = "post">
                                        <input style="width:100%;"type="text" name="commentaire" placeholder="Votre commentaire" title="Type in a name">
                                        <?php include('star.php')?>
                                        <input type="hidden" name="nom_res" value="<?php echo $ligne['nom_res'];?>">
                                        <button style="margin-top:10px;float:right;"type="submit" name="envoyer" value = "<?php echo $ligne['id_com']?>">Envoyer</button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method = "post">
                                        <button style="margin-top:10px;float:right;"type="submit" name="<?php echo $name?>" value = "Commenter">Commenter</button>
                                    </form>
                                <?php endif;?>
                            </div>

                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
 
    </div>
        <div class="errorNotify"></div>
    </div>
</body>
</html>
