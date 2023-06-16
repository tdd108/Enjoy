<?php

$user =  "postgres";
$pass =  "1";

try {
    $cnx = new PDO("pgsql:host='localhost';dbname=enjoy",$user, $pass);
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée";
}

?>

