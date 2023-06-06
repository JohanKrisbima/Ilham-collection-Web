<?php

session_start();
require 'function.php';

// if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
//     $id = $_COOKIE['id'];
//     $key = $_COOKIE['key'];

//     // ambil username berdasarkan id 
//     $result = mysqli_query($conn, "SELECT username FROM user WHERE id_user = $id");

//     $row = mysqli_fetch_assoc($result);

//     // cek username dan cookie 
//     if($key === hash('sha256', $row['username'])){
//         $_SESSION['login'] = true;
//     }
// }

if(isset($_SESSION['login'])){
    header('Location: home.php');
    exit;
}

    if(isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"]; 

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        // cek username
        if(mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                //cek session
                  
                
                // cek cookie
                // if(isset($_POST['remember'])){
                //     //buat cookie
                //     setcookie('id', $row['id_user'], time()+300); 
                //     setcookie('key', hash('sha256', $row['username']), time()+300);
                // }
                $_SESSION['login'] = $row['id_user'];
                header("Location: home.php");
                exit;
                }
            }

        $error =true;
    }

    if(isset($error)){
        echo " <script>
                    alert('Username atau Password salah!');                              
                </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/signin.css" type="text/css" />
    <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
    <title>Sign-In</title>
</head>
<body>
        <div class="box">
            <div class="form">
                <form action="" method="post">
                    <h2>Login</h2>
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
                    <div class="links">
                        <!-- <input type="checkbox" name="remember" id="remember">
                        <label style= "color:white; position: relative; right: 70px; top:9px; font-size: 0.75em;" for="remember">Remember Me</label> -->
                        <a href="signup.php">Sign Up</a>
                    </div>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
        </div>
</body>
</html>