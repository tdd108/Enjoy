<?php
session_start();
include("connexion.inc.php");

$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];

$res = $cnx->query("select * from authentification where pseudo = '$pseudo';");

$user = $res->fetch();

if($user && md5($_POST['mdp']) == $user['mdp']){
    echo "Authentification réussie";
    $_SESSION['pseudo'] = "$pseudo";
    $_SESSION['mdp'] = "$mdp";
    header("location: form_cb.html");
}else if(!$user){
    echo "login incorrect";
    header("Location: form_auth.php");
}
else{
    echo "mot de passe incorrect";
    header("Location: form_auth.php");
}


?>