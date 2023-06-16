<?php
session_start();
if(isset($_SESSION['mat_liv'], $_SESSION['mdp_liv'])){
	header("location: personnel_liv.php");
}

include_once("connexion.php");

$mat_liv = $mdp_liv = "";
$email_u_err = $mdp_u_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['mat_liv']))){
        $email_u_err = "Please enter your email";
    }else{
        $mat_liv = trim($_POST['mat_liv']);
    }

    if(empty(trim($_POST['mdp_liv']))){
        $mdp_u_err = "Please enter your password";
    }else{
        $mdp_liv = trim($_POST['mdp_liv']);
    }

    if(empty($email_u_err) && empty($mdp_u_err)){
        $res = $cnx->query("SELECT * FROM livreur WHERE mat_liv = '$mat_liv';");

        $ligne = $res->fetch(PDO::FETCH_ASSOC);
        
        if($ligne['mdp_liv'] == $mdp_liv){
            $_SESSION['mat_liv'] = $mat_liv;
            $_SESSION['mdp_liv'] = $mdp_liv;
            $_SESSION['code_postal_liv'] = $ligne['code_postal_liv'];
            header("location: personnel_liv.php");
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

<form action="login_liv.php" method="post">
    <div class="login-form">
        <h4 id="input-title">Welcome back</h4>
        <label for="mat_liv">Sign in with your matricule.</label>
        <input class = "form-control<?php echo (!empty($email_u_err)) ? 'is-invalid' : ''; ?>" type="text" name="mat_liv" placeholder="Email address">
        <?php if(!empty($email_u_err)) :?>
            <p style="color:red;"><?php echo $email_u_err?></p>
        <?php endif;?>
        <input class = "form-control<?php echo (!empty($mdp_u_err)) ? 'is-invalid' : ''; ?>" type="password" name="mdp_liv" placeholder="Password">
        <?php if(!empty($mdp_u_err)) :?>
            <p style="color:red;"><?php echo $mdp_u_err?></p>
        <?php endif;?>
        <input type="submit" name="next" value="Next">
    </div>
</form>

</body>
</html>
