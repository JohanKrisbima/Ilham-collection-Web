<?php 

  include 'function.php';
  session_start();
  $id_user = $_SESSION['login'];

  if( !isset($id_user)){
      header('Location: signin.php');
      exit;
  }


  $produk = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY id_pakaian DESC LIMIT 0, 10");
 // $produk = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY id_pakaian DESC");
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
  <title>Ilham Collection</title>
  <link rel="stylesheet" href="./CSS/home.css"  type="text/css"/>
  <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
</head>

<body>
    <p>HAlo</p>
  <!-- Layout1 -->

    <!-- Navbar -->
    <!-- <nav>
      <ul>
        <li><a href="home.php" class="link">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
        <li><a href="" class="link">Development</a></li>
        <li><a href="" class="link">My Acount</a></li>
        <li><a href="logout.php" class="link">Log Out</a></li>
        <li class="trolley">
          <i class="fa-solid fa-cart-shopping"></i>
        </li>
      </ul>
    </nav>  -->
  
    <!-- <nav>
      <ul>
        <li><a href="home.php" class="link navhome">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
       
        <li><a href="" class="link">Developer</a></li>
        <li class="trolley">
          <i class="fa-solid fa-cart-shopping"></i>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn"><img src="./Foto/user.jpg"
              class="fa-solid fa-circle-user"></img></a>
          <div class="dropdown-content">
            <a href="#"><i class="fas fa-user"></i> Profile</a>
            <a href="#"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
         </div>
      </ul>

      <! <ul class="user1">
        <li class="user"><i class="fa-solid fa-circle-user"></i></li>

      </ul> -->
   
    <!-- Awal -->
   <div class="test">
    <p>Halo Pak </p>
   </div>
  </div>
  <div class="test">
    <p>Halo</p>
  </div>

  

</body>
<script src="./JS/home.js"></script>

</html>