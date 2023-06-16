<?php
session_start();
// if(isset($_SESSION['email_u'], $_SESSION['mdp_u'])){
// 	header("location: homepage.php");
// }

include_once("connexion.php");

$email_u = $mdp_u = $mdp_u2 = "";
$email_u_err = $mdp_u_err = $mdp_u_err2 = $nom_u_err = $prenom_u_err = $address_u_err = $tel_u_err = $cb_u_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['email_u']))){
        $email_u_err = "Please enter your email";
    }else{
        $email_u = $_POST['email_u'];

        $res = $cnx->query("SELECT count(*) FROM utilisateur WHERE email_u = '$email_u';");

        $ligne = $res->fetch(PDO::FETCH_ASSOC);
        
        if($ligne['count'] == 1){
            $email_u_err = "Your email is already used.";
        }
    }

    if(empty(trim($_POST['mdp_u']))){
        $mdp_u_err = "Please enter your password.";
    }else if(strlen(trim($_POST['mdp_u'])) < 6){
        $mdp_u_err = "Password must have atleast 6 characters.";
    }
    else{
        $mdp_u = trim($_POST['mdp_u']);
    }

    if(empty(trim($_POST['mdp_u2']))){
        $mdp_u_err2 = "Please reenter your password.";
    }else if($_POST['mdp_u2'] != $mdp_u){
        $mdp_u_err2 = "Password did not match.";
    }

    if(empty($email_u_err) && empty($mdp_u_err) && empty($mdp_u_err2)){

    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Sign up</title>
    <style>
        body {
            font-family:sans-serif;
        }

        .login-form {
            width: 552px;
            height: 264px;
            top : 30%;
            left : 50%;
            transform: translate(-50%,-50%);
            position : absolute;
        }

        input{
            font-size : 15px;
            width: 100%;
            height: 48px;
            padding: 12px 20px;
            margin: 8px 0;
            border: 1px solid #ccc;
            display: inline-block;
            box-sizing: border-box;
        }

        input:active,
        input:focus {
            border: 1px #ccc;
        }
        .form-controlis-invalid{
            border-color : red;
        }

        input[type=submit]{
            color : white;
            font-weight: bold;
            background-color : #5fb709;
        }

        input[type=submit]:hover{
            background-color : #307518;
        }

        #input-title{
            font-size : 30px;
        }
    </style>
</head>

<body>

<form action="signup.php" method="post">
    <div class="login-form">
        <h4 id="input-title">Let's get started</h4>
        <label for="email_u">Sign up with your email address (required).</label>
        <input class = "form-control<?php echo (!empty($email_u_err)) ? 'is-invalid' : ''; ?>" type="email" name="email_u" placeholder="Email address">
        <?php if(!empty($email_u_err)) :?>
            <p style="color:red;"><?php echo $email_u_err?></p>
        <?php endif;?>

        <label for="mdp_u">Enter your password.</label>
        <input class = "form-control<?php echo (!empty($mdp_u_err)) ? 'is-invalid' : ''; ?>" type="password" name="mdp_u" placeholder="Password">
        <?php if(!empty($mdp_u_err)) :?>
            <p style="color:red;"><?php echo $mdp_u_err?></p>
        <?php endif;?>

        <label for="mdp_u2">Renter your password.</label>
        <input class = "form-control<?php echo (!empty($mdp_u_err2)) ? 'is-invalid' : ''; ?>" type="password" name="mdp_u2" placeholder="Renter Password">
        <?php if(!empty($mdp_u_err2)) :?>
            <p style="color:red;"><?php echo $mdp_u_err2?></p>
        <?php endif;?>

        <label for="nom_u">Your first name.</label>
        <input class = "form-control<?php echo (!empty($nom_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="nom_u" placeholder="Your first name">
        <?php if(!empty($nom_u_err)) :?>
            <p style="color:red;"><?php echo $nom_u_err?></p>
        <?php endif;?>

        <label for="prenom_u">Your last name.</label>
        <input class = "form-control<?php echo (!empty($prenom_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="prenom_u" placeholder="Your last name">
        <?php if(!empty($prenom_u_err)) :?>
            <p style="color:red;"><?php echo $prenom_u_err?></p>
        <?php endif;?>

        <label for="cb_u">Your credit card.</label>
        <input class = "form-control<?php echo (!empty($cb_u_err)) ? 'is-invalid' : ''; ?>" type="text" maxlength = 16 name="cb_u" placeholder="Your credit card">
        <?php if(!empty($cb_u_err)) :?>
            <p style="color:red;"><?php echo $cb_u_err?></p>
        <?php endif;?>

        <label for="crypto">Crypto.</label><br>
        <input class = "form-control<?php echo (!empty($crypt_err)) ? 'is-invalid' : ''; ?>" type="text" name="crypto" maxlength="3" style="width : 70px;"/><br>
        <?php if(!empty($crypto_err)) :?>
            <p style="color:red;"><?php echo $crypto_err?></p>
        <?php endif;?>

        <label for="tel_u">Your telephone.</label>
        <input maxlength = 9 class = "form-control<?php echo (!empty($tel_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="tel_u" placeholder="Your telephone">
        <?php if(!empty($tel_u_err)) :?>
            <p style="color:red;"><?php echo $tel_u_err?></p>
        <?php endif;?>

        <label for="address_u">Your address.</label>
        <input class = "form-control<?php echo (!empty($add_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="address_u" placeholder="Your address">
        <?php if(!empty($address_u_err)) :?>
            <p style="color:red;"><?php echo $address_u_err?></p>
        <?php endif;?>

        <label for="code_postal">Code postal.</label>
        <input class = "form-control<?php echo (!empty($add_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="address_u" placeholder="Your address">
        <?php if(!empty($address_u_err)) :?>
            <p style="color:red;"><?php echo $address_u_err?></p>
        <?php endif;?>

        <input type="submit" name="next" value="Next">
    </div>
</form>

</body>
</html>
