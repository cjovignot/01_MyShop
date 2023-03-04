<?php
include_once("connect_db.php");
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="">
        <meta charset="UTF-8">
        <title>Wankers by Epitech</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheet.css" rel="stylesheet">
    </head>

    <body class="login">
        <?php
        // sign-in----------------------------------------------------------
        // is user connected ?

        if (isset($_SESSION['uname'])) {
            echo 'tu es connecté';
        }

        //if not connected :
            // if form is filled
        if (isset($pdo) && isset($_POST['uname']) && isset($_POST['password'])) {
                sign_in($pdo,$_POST['uname'],$_POST['password']);
        } else {
            echo "Connectez-vous!\n";  
        }
                
        //-----------------------------------------

        // Sign in function to verify if user exist
        function sign_in($pdo,$uname,$password) {
            $query_identify = $pdo->query("SELECT * FROM users WHERE username = '$uname'"); 
            $resuser = $query_identify->fetch(PDO::FETCH_ASSOC);
            $salt = uniqid(false);
            $hash = crypt($_POST['password'], $salt);
            
            if ($resuser && $resuser['username'] == $uname && $hash == $resuser['password']) {
                echo "Bienvenue " . htmlspecialchars($resuser['uname']) . "!\n";
                $_SESSION['iduser'] = $resuser['id'];
                $_SESSION['uname'] = $resuser['username'];
                $_SESSION['password'] = $resuser['password'];
                $_SESSION['mail'] = $resuser['email'];
                $_SESSION['admin'] = $resuser['admin'];
                // print_r($_SESSION);

                $userlogin = true;
                // var_dump($userlogin);
                header('Location: index.php');
                return $userlogin;
            } else {
                echo "User name or password are incorrect or don't exist.\n";
            }
        }
        ?>

        </div>
            <form action="signin.php" method="post">
                <div class="login_title">LOGIN</div>

                <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p> <?php } ?>

                <p>User Name</p>
                <div class="login_input_field"><input type="text" name="uname" placeholder="User Name" class="validate"></div><br>

                <p>Password</p>
                <div class="login_input_field"><input type="password" name="password" placeholder="Password" class="validate"></div><br> 

                <button class="admin_button" type="submit">Login</button>

            </form>
                
            <p class="login_p">Don't have an account?<a class="login_a" href="signup.php">Sign up</a> </p>
        </div>

        <script src="range.js"></script>

    </body>
    
</html>