<?php
/*Attention si vous utilisez une session, il faut la lancer ici!!*/
session_start();
if(!isset($_SESSION['mat_liv'], $_SESSION['mdp_liv'])){
	header("location: login_liv.php");
}

include("connexion.php");

$mat_liv = $_SESSION['mat_liv'];
$code_postal_liv = $_SESSION['code_postal_liv'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['accepter'])){
        $id_com = $_POST['accepter'];
        $cnx->exec("UPDATE commande SET statut_com = 'ac', mat_liv = '$mat_liv' WHERE id_com = '$id_com';");
    }
}

header("refresh: 3");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $mat_liv?></title>
	<style type="text/css">
        <?php include('style.css')?>
	</style>
</head>

<body>

    <div class="container">
        <div class="search-bar">
            <?php include('searchbar.php');?>
            <img src="./photos/logo/logo.png" class="logo" onclick="window.location.reload()">
        </div>

        <div class="header-title" style="width:100%; padding:50px">
            <h1>Commande Attente</h1>
        </div>
        <div class="restaurants" style="margin:0px; width:100%;">
            <?php if($cnx->query("SELECT * FROM commande NATURAL JOIN restaurant NATURAL JOIN utilisateur WHERE code_postal_res = '$code_postal_liv' AND statut_com = 'at';")) : ?>
                <?php foreach($cnx->query("SELECT * FROM commande NATURAL JOIN restaurant NATURAL JOIN utilisateur WHERE code_postal_res = '$code_postal_liv' AND statut_com = 'at';") as $ligne) : ?>
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
                            <div class="hotel-tags"><?php echo $ligne['adresse_res'];?></div>
                            <div class="hotel-tags"><?php echo $ligne['adresse_u'];?></div>
                            <div style="padding: 0 10px;">
                            <form action="" method = "post">
                                <button style="margin-top:10px;float:right;"type="submit" name="accepter" value = "<?php echo $ligne['id_com']?>">Accepter</button>
                            </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

    </div>
        <div class="errorNotify"></div>
    </div>
</body>
</html>
