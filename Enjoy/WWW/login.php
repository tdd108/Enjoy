<?php
session_start();
if(isset($_SESSION['email_u'], $_SESSION['mdp_u'])){
	header("location: homepage.php");
}

include_once("connexion.php");

$email_u = $mdp_u = "";
$email_u_err = $mdp_u_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['email_u']))){
        $email_u_err = "Please enter your email";
    }else{
        $email_u = trim($_POST['email_u']);
    }

    if(empty(trim($_POST['mdp_u']))){
        $mdp_u_err = "Please enter your password";
    }else{
        $mdp_u = trim($_POST['mdp_u']);
    }

    if(empty($email_u_err) && empty($mdp_u_err)){
        $res = $cnx->query("SELECT * FROM utilisateur WHERE email_u = '$email_u';");

        $ligne = $res->fetch(PDO::FETCH_ASSOC);
        
        if($ligne['mdp_u'] == ($mdp_u)){
            $_SESSION['email_u'] = $email_u;
            $_SESSION['mdp_u'] = $mdp_u;
            $_SESSION['code_postal_u'] = $ligne['code_postal_u'];
            $_SESSION['adresse_u'] = $ligne['adresse_u'];
            $_SESSION['carte_bancaire'] = $ligne['carte_bancaire'];
            // header ('location: homepage.php');
        }        
        else{
            $mdp_u_err = "Your email or password is wrong";
        }
    }    
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Enjoy!</title>
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
<img src="./photos/logo/logo.png" class="logo" onclick="window.location.reload()" style="display: block;
  margin-left: auto;
  margin-right: auto; margin-top: 50px;">

<form action="login.php" method="post">
    <div class="login-form">
        <h4 id="input-title">Welcome back</h4>
        <label for="email_u">Sign in with your email address.</label>
        <input class = "form-control<?php echo (!empty($email_u_err)) ? 'is-invalid' : ''; ?>" type="email" name="email_u" placeholder="Email address">
        <?php if(!empty($email_u_err)) :?>
            <p style="color:red;"><?php echo $email_u_err?></p>
        <?php endif;?>
        <input class = "form-control<?php echo (!empty($mdp_u_err)) ? 'is-invalid' : ''; ?>" type="password" name="mdp_u" placeholder="Password">
        <?php if(!empty($mdp_u_err)) :?>
            <p style="color:red;"><?php echo $mdp_u_err?></p>
        <?php endif;?>
        <input type="submit" name="next" value="Next">
        <p style="text-align : center">Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        <p style="text-align : center">Livreur? <a href="login_liv.php">Click</a>.</p>
    </div>
</form>

</body>
</html>
