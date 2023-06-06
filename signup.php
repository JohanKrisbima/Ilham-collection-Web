<?php
session_start();

if( isset($_SESSION['login'])){
    header('Location: home.php');
    exit;
}

require 'function.php';

if(isset($_POST["register"])){

    if(registrasi($_POST) > 0){
        echo "
        <script>
            alert('Data berhasil dibuat');   
            window.location.href = 'signin.php';                         
        </script>
        
        ";
    }
    else{
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signup.css" type="text/css" />
    <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
    <title>Sign Up</title>
</head>

<body>
   
        <div class="box">          
            <div class="form">
                <form action="" method="post">
                    <h2>Sign Up</h2>
                    <div class="inputBox">
                        <input type="text" name="email" required="required" autocomplete="off">
                        <span>E-mail</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="username" required="required" autocomplete="off">
                        <span>User Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="password" required="required" autocomplete="off">
                        <span>Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="password2" required="required" autocomplete="off">
                        <span>Confirmation Password</span>
                        <i></i>
                    </div>
                        <input class="share-button" type="submit" name="register" value="Register">
                 </form>  
            </div>       
        </div>           
</body>

</html>